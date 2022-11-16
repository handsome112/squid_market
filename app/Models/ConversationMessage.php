<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Tools\PGP;
use App\Traits\UUIDs;

class ConversationMessage extends Model
{
    use HasFactory, UUIDs;

    /**
     * Get the user who owns the message
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'issuer_id', 'id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    /**
     * Take the conversation this message belongs to
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id', 'id');
    }

    /**
     * Decrypt message
     *
     * @return string
     */
    public function decryptMessage()
    {
        return Crypt::decryptString($this->message);
    }

    public function violateMessage()
    {
        $message = Crypt::decryptString($this->message);

        $ban_words_file_path = './banwords.txt';
        $ban_words = file($ban_words_file_path);
        for ($i = 0; $i < count($ban_words); $i++) {
            if (strpos($message, trim($ban_words[$i])) == true) {
                $message = str_replace(
                    trim($ban_words[$i]),
                    '<strong style="color:blue">(SCRAPED)</strong>',
                    $message
                );
            }
        }

        $livefeed = new Livefeeds();
        $livefeed->event =
            auth()->user()->username . ' used a banned word in chat.';
        $livefeed->type = 'ban';
        $livefeed->save();

        return strip_tags($message, '<strong>');
    }

    public function usedbanwords()
    {
        $message = Crypt::decryptString($this->message);
        $usedbanwords = '';

        $ban_words_file_path = './banwords.txt';
        $ban_words = file($ban_words_file_path);
        for ($i = 0; $i < count($ban_words); $i++) {
            if (strpos($message, trim($ban_words[$i])) == true) {
                $usedbanwords .= trim($ban_words[$i]) . ',';
            }
        }

        if ($usedbanwords == '') {
            $usedbanwords = 'None';
        }

        return $usedbanwords;
    }

    public function checkViolate()
    {
        if ($this->usedbanwords() == 'None') {
            return 'No';
        } else {
            return 'Yes';
        }
    }

    /**
     * Shows the date the message is created
     *
     * @return Carbon\Carbon
     */
    public function creationDate()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public static function totalCounts()
    {
        return self::whereNotNull('receiver_id')->count();
    }
}