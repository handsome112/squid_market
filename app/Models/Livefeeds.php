<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\UUIDs;

class Livefeeds extends Model
{
    use HasFactory, UUIDs;

    /**
     * Returns the user who posted the news
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function symbol()
    {
        switch ($this->type) {
            case 'register':
                return "<i  style='color: green; font-size: x-large;' class='fa fa-user me-0'></i>";
                break;
            case 'vendor':
                return "<i  style='color: red; font-size: x-large;' class='fa fa-store me-0'></i>";
                break;
            case 'pgp':
                return "<i  style='color: greenyellow; font-size: x-large;' class='fa fa-key me-0'></i>";
                break;
            case '2fa':
                return "<i  style='color: green; font-size: x-large;' class='fa fa-shield-alt me-0'></i>";
                break;
            case 'signin':
                return "<i  style='color: red; font-size: x-large;' class='fa fa-door-open me-0'></i>";
                break;
            case 'signout':
                return "<i  style='color: red; font-size: x-large;' class='fa fa-door-open me-0'></i>";
                break;
            case 'madepurchase':
                return "<i  style='color: green; font-size: x-large;' class='fa fa-coins me-0'></i>";
                break;
            case 'shipedsale':
                return "<i  style='color: green; font-size: x-large;' class='fa fa-shipping-fast me-0'></i>";
                break;
            case 'deliveredorder':
                return "<i  style='color: green; font-size: x-large;' class='fa fa-truck-loading me-0'></i>";
                break;
            case 'positivefeedback':
                return "<i  style='color: greenyellow; font-size: x-large;' class='fa fa-plus me-0'></i>";
                break;
            case 'neutralfeedback':
                return "<i  style='color: rgb(164, 168, 164); font-size: x-large;' class='fa fa-meh me-0'></i>";
                break;
            case 'negativefeedback':
                return "<i  style='color: red; font-size: x-large;' class='fa fa-minus me-0'></i>";
                break;
            case 'deletesale':
                return "<i  style='color: red; font-size: x-large;' class='fa fa-trash me-0'></i>";
                break;
            case 'addsale':
                return "<i  style='color: greenyellow; font-size: x-large;' class='fa fa-cookie-bite me-0'></i>";
                break;
            case 'opensupport':
                return "<i  style='color: red; font-size: x-large;' class='fa fa-headset me-0'></i>";
                break;
            case 'sendmessage':
                return "<i  style='color: green; font-size: x-large;' class='fa fa-comments me-0'></i>";
                break;
            case 'changeavatar':
                return "<i  style='color: green; font-size: x-large;' class='fa fa-user-astronaut me-0'></i>";
                break;
            case 'startdispute':
                return "<i  style='color: red; font-size: x-large;' class='fa fa-passport me-0'></i>";
                break;
            case 'windispute':
                return "<i  style='color: green; font-size: x-large;' class='fa fa-passport me-0'></i>";
                break;
            case 'autofinalize':
                return "<i  style='color: red; font-size: x-large;' class='fa fa-flag-checkered me-0'></i>";
                break;
            case 'changepass':
                return "<i  style='color: red; font-size: x-large;' class='fa fa-lock me-0'></i>";
                break;
            case 'report':
                return "<i  style='color: red; font-size: x-large;' class='fa fa-skull-crossbones me-0'></i>";
                break;
            case 'ban':
                return "<i  style='color: red; font-size: x-large;' class='fa fa-ban me-0'></i>";
                break;
        }
    }
    /**
     * Get the latest five news
     *
     * @return App\Models\Notices
     */
    public static function latest()
    {
        return self::orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();
    }

    /**
     * Get the date of creation of the news
     *
     * @return Carbon\Carbon
     */
    public function createdAt()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    /**
     * Get the news update date
     *
     * @return Carbon\Carbon
     */
    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }
}