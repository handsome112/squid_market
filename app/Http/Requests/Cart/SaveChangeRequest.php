<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Product, Offer, Delivery};
use App\Tools\Converter;

class SaveChangeRequest extends FormRequest
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
    public function saveChange()
    {
        $products = session()->has('cart') ? session()->get('cart') : [];
        $rates = Converter::currencyLatestPrice();

        foreach ($products as &$productCart) {
            if ($productCart['product_id'] == $this->cartbtn) {
                $productCart['deliveryinfo'] =
                    $this->{'deliveryinfo' . $productCart['product_id']};
                $productCart['delivery_method_num'] =
                    $this->{'delivery_method_num' . $productCart['product_id']};
                $productCart['paymethod'] =
                    $this->{'paymethod' . $productCart['product_id']};
                $productCart['quantity'] =
                    $this->{'quantity' . $productCart['product_id']};
                if ($productCart['type'] == 'Physical') {
                    $productCart['total'] = number_format(
                        $productCart['price'] *
                            $this->{'quantity' . $productCart['product_id']} +
                            $productCart['ships_price'][
                                $this->{'delivery_method_num' .
                                    $productCart['product_id']} + 1
                            ],
                        2
                    );
                } else {
                    $productCart['total'] = number_format(
                        $productCart['price'] *
                            $this->{'quantity' . $productCart['product_id']},
                        2
                    );
                }
                // $productCart->save();
                session()->forget('cart');
                session()->put('cart', $products);
            }
        }

        session()->flash('success', 'You have successfully saved changes!');
        return redirect()->route('cart');
    }
    public function toCheckout()
    {
        $rates = Converter::currencyLatestPrice();
        $products = session()->has('cart') ? session()->get('cart') : [];

        foreach ($products as &$productCart) {
            $productCart['deliveryinfo'] =
                $this->{'deliveryinfo' . $productCart['product_id']};
            $productCart['delivery_method_num'] =
                $this->{'delivery_method_num' . $productCart['product_id']};
            $productCart['paymethod'] =
                $this->{'paymethod' . $productCart['product_id']};
            $productCart['quantity'] =
                $this->{'quantity' . $productCart['product_id']};
            if ($productCart['type'] == 'Physical') {
                $productCart['total'] = number_format(
                    $productCart['price'] *
                        $this->{'quantity' . $productCart['product_id']} +
                        $productCart['ships_price'][
                            $this->{'delivery_method_num' .
                                $productCart['product_id']} + 1
                        ],
                    2
                );
            } else {
                $productCart['total'] = number_format(
                    $productCart['price'] *
                        $this->{'quantity' . $productCart['product_id']},
                    2
                );
            }
            // $productCart->save();
            session()->forget('cart');
            session()->put('cart', $products);
        }

        #Get all products from the cart
        $allProducts = session()->has('cart') ? session()->get('cart') : [];

        #Count total products
        $totalProducts = count($allProducts);

        #Set total price
        $totalPrice = 0.0;
        #Sum the total of all products
        foreach ($allProducts as $product) {
            $price =
                ($product['total'] * $rates[auth()->user()->currency]) /
                $rates[$product['a']->currency];
            $totalPrice += $price;
        }

        return view('master.checkout', [
            'rates' => $rates,
            'products' => $allProducts,
            'totalProducts' => $totalProducts,
            'totalPrice' => $totalPrice,
        ]);
    }
}