<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Traits\UUIDs;
use App\Tools\Converter;

class Bid extends Model
{
    use HasFactory, UUIDs;

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public static function bids($slotnum)
    {
        return self::where('slotnum', $slotnum)->count();
    }

    public static function highestPrice($slotnum)
    {
        if (self::bids($slotnum) != 0) {
            $bid = self::with('price')
                ->where('slotnum', $slotnum)
                ->orderBy('price', 'DESC')
                ->first();

            return $bid->price;
        } else {
            return 100;
        }
    }

    public static function highestBidder($slotnum)
    {
        if (self::bids($slotnum) != 0) {
            $bid = self::with('product_id')
                ->where('slotnum', $slotnum)
                ->orderBy('price', 'DESC')
                ->first();

            return $bid->product->seller->username;
        } else {
            return 'None';
        }
    }

    public static function firstBid($slotnum)
    {
        $bid = self::where('slotnum', $slotnum)
            ->orderBy('updated_at', 'DESC')
            ->first();

        return $bid;
    }
}