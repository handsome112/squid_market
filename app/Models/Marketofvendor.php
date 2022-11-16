<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUIDs;

class Marketofvendor extends Model
{
    use HasFactory, UUIDs;

    public static function getRow(Market $market, User $user)
    {
        return self::where('market_id', $market->id)
            ->where('user_id', $user->id)
            ->get();
    }
}