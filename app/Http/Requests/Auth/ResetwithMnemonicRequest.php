<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Hash, Crypt, Auth};
use App\Tools\PGP;
use App\Models\User;

class ResetwithMnemonicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|alpha_num|min:4|max:20',
            'password' => 'required|min:8|max:80|confirmed',
            'mnemonic' => 'required',
        ];
    }

    /**
     * Get custom messages from requisition rules
     *
     * @return array
     */
    // public function messages()
    // {
    //     return [
    //         'captcha.captcha' => 'The captcha is incorrect',
    //     ];
    // }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */
    public function createRequest()
    {
        if (is_null($this->username)) {
            throw new \Exception('Enter your username!');
        }

        #Get user
        $user = User::where('username', $this->username)->first();

        if (is_null($user) or is_null($user->pgp_key)) {
            throw new \Exception(
                'User does not exist or does not have a PGP key!'
            );
        }

        #Get user username
        session()->put('user_username', $user->username);

        #Create verification
        PGP::verification($user->pgp_key, 'reset_password');

        Auth::login($user);
        session()->regenerate();

        if (!is_null($user->pgp_key)) {
            PGP::verification($user->pgp_key, 'verify_login'); #Create new verification
            return redirect()->route('verifylogin');
        }

        session()->put('overlay', 'OK');
        return redirect()->route('home');
    }

    /**
     * Reset password
     *
     * @return Illuminate\Routing\Redirector
     */
    public function reset()
    {
        // if (
        //     !session()->has('verification_code') or
        //     session()->get('verification_name') !== 'reset_password'
        // ) {
        //     return redirect()->back();
        // }

        // #Decrypt verification code
        // $verificationCode = Crypt::decryptString(
        //     session()->get('verification_code')
        // );

        // $username = session()->get('user_username');

        // if (is_null($this->new_password)) {
        //     throw new \Exception('Please enter a new password and confirm!');
        // }

        // if ($verificationCode !== $this->verification_code) {
        //     throw new \Exception('Invalid verification code!');
        // }

        $user = User::where('username', $this->username)->first();
        if ($this->mnemonic !== $user->mnemonic) {
            session()->flash('error', 'Mnemonic is incorrect!');
            return redirect()->back();
        }
        $user->password = Hash::make($this->password);
        $user->save();

        #Clear sessions
        session()->forget([
            'verification_name',
            'encrypted_message',
            'verification_code',
            'user_username',
        ]);

        session()->flash('success', 'Password reset successfully!');
        return redirect()->route('login');
    }
}