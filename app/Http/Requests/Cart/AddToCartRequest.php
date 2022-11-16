<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Product, Offer, Delivery};
use App\Tools\Converter;
class AddToCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
                // 'offer' => 'required',
                // 'delivery_method' => 'required'
            ];
    }

    /**
     * Add a new product in the cart session
     * @param Product $product
     *
     * @return Illuminate\Routing\Redirector
     */
    public function add(Product $product)
    {
        #Get auth user
        $user = auth()->user();

        if ($user->id == $product->seller->id) {
            throw new \Exception('This product belongs to you!');
        }

        if ($user->isSeller()) {
            throw new \Exception(
                'You cannot buy any porducts with seller account!'
            );
        }

        #Get offer
        // $offer = Offer::find($this->offer);

        #Check if an offer is for the product that will be added to the cart
        // if (
        //     is_null($offer) or
        //     $offer->product_id !== $product->id or
        //     $offer->deleted == true
        // ) {
        //     throw new \Exception('The chosen offer is invalid!');
        // }

        #Get delivery method
        // $delivery = Delivery::find($this->delivery_method);

        #Check if an delivery method is for the product that will be added to the cart
        // if (
        //     is_null($delivery) or
        //     $delivery->product_id !== $product->id or
        //     $delivery->deleted == true
        // ) {
        //     throw new \Exception('The chosen delivery method is invalid!');
        // }

        #Get all products from the cart or return an empty array
        $products = session()->has('cart') ? session()->get('cart') : [];

        #Checks if the product already exists in the cart and if it does, just update it
        foreach ($products as $index => $productCart) {
            if ($productCart['product_id'] == $product->id) {
                unset($products[$index]);
            }
        }

        #Update the session
        $rates = Converter::currencyLatestPrice();
        session()->put('cart', $products);
        if ($product->type == 'Physical') {
            $ships_with = json_decode($product->ships_with, true);
            $ships_time = json_decode($product->ships_time, true);
            $ships_price = json_decode($product->ships_price, true);

            #Add to session cart
            session()->push('cart', [
                'a' => $product,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'seller_id' => $product->seller->id,
                'seller' => $product->seller->username,
                'quantity' => 1,
                'mesure' => $product->mesure,
                'price' => $product->price,
                'currency' => $product->currency,
                'image' => $product->image,
                'paytype' => $product->paytype,
                'type' => $product->type,
                'autofilled' => $product->autofilled,
                'deliveryinfo' => $product->deliveryinfo,
                'paymethod' => $product->paymethod,
                'ships_from' => $product->ships_from,
                'ships_to' => $product->ships_to,
                'ships_price' => $ships_price,
                'ships_with' => $ships_with,
                'ships_time' => $ships_time,
                'delivery_method_num' => 0,
                // 'delivery_method' => $delivery_method,
                // 'delivery_price' => $delivery->price,
                // 'delivery_method' =>
                //     $delivery->name . ' - ' . $delivery->days . ' day(s)',
                // 'total' => $delivery->price + $product->price,
                'total' => number_format($product->price + $ships_price[1], 2),
            ]);
        } else {
            session()->push('cart', [
                'a' => $product,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'seller_id' => $product->seller->id,
                'seller' => $product->seller->username,
                'quantity' => 1,
                'mesure' => $product->mesure,
                'price' => $product->price,
                'currency' => $product->currency,
                'image' => $product->image,
                'paytype' => $product->paytype,
                'type' => $product->type,
                'autofilled' => $product->autofilled,
                'deliveryinfo' => $product->deliveryinfo,
                'paymethod' => $product->paymethod,
                'delivery_method_num' => 0,
                'total' => number_format($product->price, 2),
            ]);
        }
        return redirect()->route('cart');
    }
}