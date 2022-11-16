<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Tools\Converter;

class BecomeSellerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() &&
            !auth()
                ->user()
                ->isSeller();
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
                // 'terms' => 'accepted',
            ];
    }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */
    public function become()
    {
        #Updates authenticated user role for seller
        $user = auth()->user();

        // if (is_null($user->pgp_key)) {
        //     throw new \Exception(
        //         'You must have a pgp key linked to your account!'
        //     );
        // }

        if (!$user->paidSellerFee()) {
            session()->flash(
                'error',
                'Deposit the required amount at the address!'
            );
            return redirect()->back();
        }

        $user->seller = true;
        $user->seller_since = Carbon::now();
        $user->bid_monero_wallet = \Monerod::createNewAddress();
        $user->save();
        if ($user->bid_monero_wallet == null) {
            $user->seller = false;
            $user->save();
            session()->flash(
                'error',
                'WE ARE HAVING TECHNICAL DIFFICULTIES, PLEASE TRY AGAIN LATER.'
            );

            return redirect()->back();
        }

        return redirect()->route('seller.dashboard');
    }
}