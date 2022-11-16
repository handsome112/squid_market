<?php

namespace App\Http\Requests\User\Balance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\Tools\Converter;
use App\Models\Transition;

class WithdrawRequest extends FormRequest
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
            'monero_wallet_address' => 'required',
            'value' => 'required|numeric|min:1',
            'pin' => 'required',
        ];
    }

    /**
     * Withdraw bitcoin
     *
     * @return Illuminate\Routing\Redirector
     */
    public function withdraw()
    {
        #Get auth user
        $user = auth()->user();

        \Monerod::validateAddress($this->monero_wallet_address);

        if (!Hash::check($this->pin, $user->pin)) {
            throw new \Exception('The PIN is incorrect!');
        }

        if ($this->value < 30) {
            throw new \Exception(
                'Whoops! YOU DO NOT HAVE ENOUGH FUNDS FOR WITHDRAWALS, MINIMUM IS 30 USD'
            );
        }
        #Convert the value entered in USD to XMR
        $amount = Converter::moneroConverter($this->value);

        #Compare
        if ($amount > $user->balance()) {
            throw new \Exception(
                'Whoops! Your balance is below withdrawal Limit.'
            );
        }

        $walletReceiver = $this->monero_wallet_address;

        if ($walletReceiver == $user->monero_wallet) {
            throw new \Exception('You cannot send it to your self!');
        }

        $result = \Monerod::transfer($amount, $walletReceiver, $user->id);

        #Create a transition record
        $transition = new Transition();
        $transition->tx_key = $result->tx_key;
        $transition->user_id = $user->id;
        $transition->action = 'Monero withdrawal';
        $transition->amount = "-$amount";
        $transition->balance = $user->balance();
        $transition->fee = $result->fee;
        $transition->save();

        session()->flash('success', 'Successfully Sent!');
        return redirect()->route('payment');
    }
}