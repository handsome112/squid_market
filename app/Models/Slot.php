<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Traits\UUIDs;

class Slot extends Model
{
    use HasFactory, UUIDs;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}