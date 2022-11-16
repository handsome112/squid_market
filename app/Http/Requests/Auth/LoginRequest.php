<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Hash, Auth};
use Carbon\Carbon;
use App\Tools\PGP;
use App\Models\{User, Livefeeds};

class LoginRequest extends FormRequest
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
            'username' => 'required',
            'password' => 'required',
            // 'captcha' => 'required|captcha',
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
    public function login()
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

        #Get user
        $user = User::where('username', $this->username)->first();

        if (is_null($user) or !Hash::check($this->password, $user->password)) {
            throw new \Exception('Incorrect username or password!');
        }

        if ($user->ban == 1) {
            session()->flash(
                'error',
                'YOUR ACCOUNT HAS BEEN PURGED FROM SQUID MARKET BECAUSE OF: ' .
                    $user->banreason .
                    '.'
            );
            return redirect()->back();
        }

        // #Start authentication
        Auth::login($user);
        session()->regenerate();

        #Update last site visit
        $user->last_login = Carbon::now();
        $user->save();

        if (!is_null($user->pgp_key)) {
            PGP::verification($user->pgp_key, 'verify_login'); #Create new verification
            return redirect()->route('verifylogin');
        }

        $livefeed = new Livefeeds();
        $livefeed->event = $this->username . ' has just signed in.';
        $livefeed->type = 'signin';
        $livefeed->save();
        session()->put('overlay', 'OK');
        if (
            session()->has($user->username) &&
            session()->get($user->username) == 'OK'
        ) {
            return redirect()->route('register-success');
        } else {
            return redirect()->route('accountindex');
        }
    }
}