<?php

namespace App\Http\Requests\User\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePINRequest extends FormRequest
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
            'current_pin' => 'required',
            'new_pin' => 'required|digits:6|confirmed',
            //  'captcha' => 'required|captcha'
        ];
    }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */
    // public function messages()
    // {
    //     return [
    //         'captcha.captcha' => 'The captcha is incorrect',
    //     ];
    // }
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

        if (!Hash::check($this->current_pin, $user->pin)) {
            throw new \Exception('Incorrect PIN! Try again');
        }

        $user->pin = Hash::make($this->new_pin);
        $user->save();

        session()->flash('success', 'You have successfully changed your PIN!');
        return redirect()->route('history');
    }
}
