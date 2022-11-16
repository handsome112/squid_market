<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Traits\UUIDs;

class Reportvendor extends Model
{
    use HasFactory, UUIDs;

    /**
     * Decrypt message
     *
     * @return Illuminate\Support\Facades\Crypt
     */
    public function decryptMessage()
    {
        return Crypt::decryptString($this->message);
    }

    /**
     * Get the user who owns the message
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function suspect()
    {
        return $this->belongsTo(User::class, 'suspect_id', 'id');
    }
    public function complainant()
    {
        return $this->belongsTo(User::class, 'complainant_id', 'id');
    }

    /**
     * Get the reported product
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->status;
    }

    public static function totalCounts()
    {
        return self::get()->count();
    }
}