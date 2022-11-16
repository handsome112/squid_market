<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transition extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'string';
    public $primaryKey = 'user_id';

    public static function getWithdrawHistory()
    {
        return self::where('action', 'Monero withdrawal')->get();
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function creationDate()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}