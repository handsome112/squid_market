<?php

namespace App\Http\Requests\User\Conversation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\{Hash, Auth};
use App\Tools\PGP;
use App\Models\{User, Conversation, ConversationMessage};

class OpenConversationMessagesRequest extends FormRequest
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
            'password' => 'required',
        ];
    }

    /**
     * Create new message
     * @param  Conversation
     *
     * @return Illuminate\Routing\Redirector
     */

    public function open()
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

        $user = auth()->user();
        if (!Hash::check($this->password, $user->password)) {
            throw new \Exception('Incorrect password!');
        }

        return view('user.conversationmessages', [
            'conversations' => Conversation::myMessages(),
        ]);
    }
}