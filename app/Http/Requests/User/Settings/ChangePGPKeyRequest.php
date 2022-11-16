<?php

namespace App\Http\Requests\User\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use App\Tools\PGP;
use App\Models\Livefeeds;

class ChangePGPKeyRequest extends FormRequest
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
            'pgp_key' => 'nullable',
            'verification_code' => 'nullable',
            // 'captcha' => 'required|captcha'
        ];
    }
    // public function messages()
    // {
    //     return [
    //         'captcha.captcha' => 'The captcha is incorrect'
    //     ];
    // }

    /**
     * Create change order
     *
     * @return Illuminate\Routing\Redirector
     */
    public function createRequisition()
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

        $pgpKey = $this->pgp_key;

        if (is_null($pgpKey)) {
            throw new \Exception('No valid PGP Key found Try again!');
        }

        session()->put('pgp_key', $pgpKey); #Create a new session to store the PGP key entered in the field
        PGP::verification($pgpKey, 'confirm_new_pgp_key'); #Create new verification
        return redirect()->route('pgp');
    }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */
    public function change()
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
        #Get auth user
        $user = auth()->user();

        if (!session()->has('verification_name')) {
            throw new \Exception('Try again!');
        }

        #Decrypt session verification code
        $verificationCode = Crypt::decryptString(
            session()->get('verification_code')
        );

        if ($this->verification_code !== $verificationCode) {
            throw new \Exception('Invalid code! Try again');
        }

        #Set new PGP key
        $user->pgp_key = session()->get('pgp_key');
        $user->save();
        $livefeed = new Livefeeds();
        $livefeed->event = $this->username . ' just changed their pgp key.';
        $livefeed->type = 'pgp';
        $livefeed->save();

        #Destroy verification sessions
        session()->forget([
            'pgp_key',
            'verification_name',
            'encrypted_message',
            'verification_code',
        ]);

        session()->flash(
            'success',
            'You have successfully changed your PGP key!'
        );
        return redirect()->route('pgpkey');
    }
}