<?php

namespace App\Models;
use App\Traits\UUIDs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminchats extends Model
{
    use HasFactory, UUIDs;

    /**
     * Get the user who owns the message
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}