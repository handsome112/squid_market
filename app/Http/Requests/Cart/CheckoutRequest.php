<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\Tools\{PGP, Converter};
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\Crypt;
use App\Models\{Order, User};

class CheckoutRequest extends FormRequest
{
    use NotificationTrait;

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
            'pin' => 'required',
        ];
    }

    public function payWithBalance()
    {
        #Get auth user
        $buyer = auth()->user();

        if (!Hash::check($this->pin, $buyer->pin)) {
            throw new \Exception('The pin entered is incorrect!');
        }

        session()->flash(
            'error',
            'YOU DO NOT HAVE ENOUGH FUNDS IN YOUR MARKET WALLET TO PLACE THIS ORDER, WE ADVISE YOU USE DIRECT PAY'
        );
        return redirect()->route('checkout');
    }

    public function payDirect()
    {
        #Get auth user
        $buyer = auth()->user();
        $rates = Converter::currencyLatestPrice();

        if (!Hash::check($this->pin, $buyer->pin)) {
            session()->flash('error', 'The pin entered is incorrect!');
            return redirect()->back();
        }

        #Get products to cart
        $products =
            count(session()->get('cart')) > 0 ? session()->get('cart') : [];

        try {
            foreach ($products as $product) {
                $seller = User::findOrFail($product['seller_id']);

                $order = new Order();
                $order->product_id = $product['product_id'];
                $order->buyer_id = $buyer->id;
                $order->seller_id = $seller->id;
                $order->paymethod = $product['paymethod'];
                // $order->address = PGP::encryptMessage(
                //     $seller->pgp_key,
                //     $this->address
                // );
                $order->address = $this->encrypted
                    ? Crypt::encryptString(
                        PGP::encryptMessage(
                            $receiver->pgp_key,
                            $product['deliveryinfo']
                        )
                    )
                    : Crypt::encryptString($product['deliveryinfo']);
                if ($product['type'] == 'Physical') {
                    $order->ships_with =
                        $product['ships_with'][
                            $product['delivery_method_num'] + 1
                        ];
                    $order->ships_price =
                        $product['ships_price'][
                            $product['delivery_method_num'] + 1
                        ];
                    $order->ships_time =
                        $product['ships_time'][
                            $product['delivery_method_num'] + 1
                        ];
                    $order->delivery_method =
                        $product['ships_with'][
                            $product['delivery_method_num'] + 1
                        ] .
                        ' - Price ' .
                        number_format(
                            ($product['ships_price'][
                                $product['delivery_method_num'] + 1
                            ] *
                                $rates[$buyer->currency]) /
                                $rates[$product['a']->currency],
                            2
                        ) .
                        ' ' .
                        $buyer->currency .
                        ' - ' .
                        $product['ships_time'][
                            $product['delivery_method_num'] + 1
                        ] .
                        ' Days Average';
                } else {
                    $order->ships_with = 'Digital';
                    $order->ships_price = '0';
                    $order->ships_time = '0';
                    $order->delivery_method = 'Digital';
                }
                $order->quantity = $product['quantity'];
                $order->mesure = $product['mesure'];
                $order->escrow_monero_wallet = \Monerod::createNewAddress();
                $order->total = $product['total'];
                $order->total_in_monero = Converter::moneroConverter(
                    ($product['total'] * $rates['USD']) /
                        $rates[$product['currency']]
                );
                $order->save();
                if (is_null($order->escrow_monero_wallet)) {
                    $order->delete();
                    session()->flash(
                        'error',
                        'WE ARE HAVING TECHNICAL DIFFICULTIES, PLEASE TRY AGAIN LATER.'
                    );

                    return redirect()->back();
                }
                $buyername = $order->buyer->username;

                #Create notification
                $this->createNotification(
                    $order->seller->id,
                    'You have an unpaid incoming order for product <strong>#' .
                        $order->product->id .
                        '</strong>.',
                    Route('sale', ['order' => $order->id])
                );
            }

            #Clear cart
            session()->forget('cart');

            return redirect()->route('order', ['order' => $order->id]);
        } catch (Exception $exception) {
            throw new \Exception('Oops... An error has occurred!');
        }
    }
    /**
     * Checkout
     *
     * @return Illuminate\Routing\Redirector
     */
    public function checkout()
    {
        #Get auth user
        $buyer = auth()->user();

        if (!Hash::check($this->pin, $buyer->pin)) {
            throw new \Exception('The pin entered is incorrect!');
        }

        #Get products to cart
        $products =
            count(session()->get('cart')) > 0 ? session()->get('cart') : [];

        try {
            foreach ($products as $product) {
                $seller = User::findOrFail($product['seller_id']);

                $order = new Order();
                $order->product_id = $product['product_id'];
                $order->buyer_id = $buyer->id;
                $order->seller_id = $seller->id;
                $order->paymethod = $product['paymethod'];
                // $order->address = PGP::encryptMessage(
                //     $seller->pgp_key,
                //     $this->address
                // );
                $order->address = $this->encrypted
                    ? Crypt::encryptString(
                        PGP::encryptMessage(
                            $receiver->pgp_key,
                            $product['deliveryinfo']
                        )
                    )
                    : Crypt::encryptString($product['deliveryinfo']);
                if ($product['type'] == 'Physical') {
                    $order->ships_with =
                        $product['ships_with'][
                            $product['delivery_method_num'] + 1
                        ];
                    $order->ships_price =
                        $product['ships_price'][
                            $product['delivery_method_num'] + 1
                        ];
                    $order->ships_time =
                        $product['ships_time'][
                            $product['delivery_method_num'] + 1
                        ];
                    $order->delivery_method =
                        $product['delivery_method'][
                            $product['delivery_method_num']
                        ];
                } else {
                    $order->ships_with = 'Digital';
                    $order->ships_price = '0';
                    $order->ships_time = '0';
                    $order->delivery_method = 'Digital';
                }
                $order->quantity = $product['quantity'];
                $order->escrow_monero_wallet = \Monerod::createNewAddress();
                $order->total = $product['total'];
                $order->total_in_monero = Converter::moneroConverter(
                    $product['total']
                );
                $order->save();

                $buyername = $order->buyer->username;
                #Create notification
                $this->createNotification(
                    $order->seller->id,
                    'You have an unpaid incoming order for product <strong>#' .
                        $order->product->id .
                        '</strong>.',
                    Route('sale', ['order' => $order->id])
                );
            }

            #Clear cart
            session()->forget('cart');

            return redirect()->route('order', ['order' => $order->id]);
        } catch (Exception $exception) {
            throw new \Exception('Oops... An error has occurred!');
        }
    }
}