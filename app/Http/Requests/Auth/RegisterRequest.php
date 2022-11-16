<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Hash, Auth};
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Tools\Converter;
use App\Models\{User, Livefeeds};

class RegisterRequest extends FormRequest
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
            'username' =>
                'required|unique:users,username|alpha_num|min:4|max:20',
            'password' => 'required|min:8|max:80|confirmed',
            'pin' => 'required|digits:6|confirmed',
            'reference_code' => 'nullable|exists:users,reference_code',
            // 'captcha' => 'required|captcha'
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
    //         'captcha.captcha' => 'The captcha is incorrect'
    //     ];
    // }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */
    public function register()
    {
        session_start();
        $answer = $this->onionguard_answer;
        if (
            $_SESSION['times_0'] != $answer[1] - 2 ||
            $_SESSION['times_1'] != $answer[2] - 2 ||
            $_SESSION['times_2'] != $answer[3] - 2
        ) {
            session()->flash(
                'error',
                'You got the captcha Wrong - Are you a Robot?'
            );
            return redirect()->back();
        }

        $user = new User();
        $user->username = $this->username;
        $user->password = Hash::make($this->password);
        $user->pin = Hash::make($this->pin);
        $user->reference_code = Str::random(15);
        $user->last_login = Carbon::now();
        $user->avatar = Converter::convert_into_base64(
            public_path('img/favicon' . rand(0, 9) . '.png')
        );
        // $user->avatar = asset('profilepic.jpeg');

        if (!is_null($this->reference_code)) {
            #Get affiliate who referred the new user
            $affiliate = User::where(
                'reference_code',
                $this->reference_code
            )->first();

            $user->referenced_by = $affiliate->id;
        }

        $user->save();

        #Creates a wallet for the new user. If the daemon is not active, the return value is null
        $user->monero_wallet = \Monerod::createNewAccount($user->id);
        $user->become_monero_wallet = \Monerod::createNewAddress();
        $user->save();

        if (
            is_null($user->monero_wallet) ||
            is_null($user->become_monero_wallet)
        ) {
            $user->delete();
            session()->flash(
                'error',
                'WE ARE HAVING TECHNICAL DIFFICULTIES, PLEASE TRY AGAIN LATER.'
            );

            return redirect()->back();
        }
        #Generate Mnemonic and Personal Phrase
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $mnemonic = '';
        for ($i = 0; $i < 60; $i++) {
            $mnemonic .= $characters[rand(0, strlen($characters) - 1)];
        }
        $phrase_number = rand(0, 941);
        $file_path = './phrase.txt';
        $phrase_file = file($file_path);
        $personal_phrase = $phrase_file[$phrase_number];
        $user->phrase = $personal_phrase;
        $user->mnemonic = $mnemonic;
        $user->save();

        #Start authentication
        // Auth::login($user);
        // session()->regenerate();

        $livefeed = new Livefeeds();
        $livefeed->event = $this->username . ' just registered on the market.';
        $livefeed->type = 'register';
        $livefeed->save();
        session()->flash(
            'success',
            $this->username . ' have successfully registered.'
        );
        // return redirect()->route('register-success');
        session()->put($user->username, 'OK');
        return redirect()->route('login');
    }
}