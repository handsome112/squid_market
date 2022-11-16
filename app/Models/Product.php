<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUIDs;

class Product extends Model
{
    use HasFactory, UUIDs;

    /**
     * Returns the product owner/seller
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class, 'product_id', 'id');
    }

    /**
     * Get the category the product belongs to
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Return all product images
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }

    /**
     * Return all offers
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers()
    {
        return $this->hasMany(Offer::class, 'product_id', 'id')->where(
            'deleted',
            false
        );
    }

    /**
     * Return all delivery methods
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'product_id', 'id')->where(
            'deleted',
            false
        );
    }

    /**
     * Returns the first image in the collection
     *
     * @return App\Models\Image
     */
    public function featuredImage()
    {
        // $firstImage = $this->images()
        //     ->orderBy('created_at')
        //     ->first();

        return $this->image;
    }

    /**
     * Take the offer with the lowest price
     *
     * @return float
     */
    public function from()
    {
        // $offer = $this->offers()
        //     ->orderBy('price', 'ASC')
        //     ->first();

        return $this->price;
    }

    /**
     * Returns the country of origin of the product
     *
     * @return string
     */
    public function shipsFrom()
    {
        if (in_array($this->ships_from, array_keys(config('countries')))) {
            return config('countries.' . $this->ships_from);
        } else {
            return 'Undefined';
        }
    }

    /**
     * Returns the product delivery location
     *
     * @return string
     */
    public function shipsTo()
    {
        if (in_array($this->ships_to, array_keys(config('countries')))) {
            return config('countries.' . $this->ships_to);
        } elseif ($this->ships_to == 'WWW') {
            return 'World wide';
        } else {
            return 'Undefined';
        }
    }

    /**
     * Get all product feedbacks
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'product_id', 'id')->where(
            'message',
            '!=',
            ''
        );
    }

    public function totalFeedbacks($type = null, $mounths = null)
    {
        if (!is_null($type) && is_null($mounths)) {
            return $this->feedbacks()
                ->where('type', $type)
                ->where('message', '!=', '')
                ->count();
        }

        if (!is_null($type) && !is_null($mounths)) {
            return $this->feedbacks()
                ->where('type', $type)
                ->where('message', '!=', '')
                ->where('created_at', '>=', Carbon::now()->subMonth($mounths))
                ->where('created_at', '<=', Carbon::now())
                ->count();
        }

        return $this->feedbacks()->count();
    }

    public function totalRates()
    {
        if ($this->totalFeedbacks() == 0) {
            return number_format(0, 1);
        }

        $totalrates = $this->feedbacks()->sum('rating');
        $rates = $totalrates / $this->totalFeedbacks();

        return number_format($rates, 1);
    }

    public static function totalfeaturedproductsofseller($seller_id)
    {
        return self::where('seller_id', $seller_id)
            ->where('featured', 1)
            ->count();
    }

    public static function featuredproductsofseller($seller_id)
    {
        return self::get()
            ->where('seller_id', $seller_id)
            ->where('featured', 1);
    }

    public function usedbanwords()
    {
        $text = $this->description;
        $usedbanwords = '';

        $ban_words_file_path = './banwords.txt';
        $ban_words = file($ban_words_file_path);
        for ($i = 0; $i < count($ban_words); $i++) {
            if (strpos($text, trim($ban_words[$i])) == true) {
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
}