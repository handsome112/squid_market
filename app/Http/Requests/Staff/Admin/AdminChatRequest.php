<?php

namespace App\Http\Requests\Staff\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Adminchats;

class AdminChatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return !auth()->check();
    // }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => 'required',
            // 'captcha' => 'required|captcha'
        ];
    }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */
    public function send()
    {
        $user = auth()->user();

        $message = new Adminchats();
        $message->sender_id = $user->id;
        $message->message = $this->message;
        $message->save();

        return redirect()->back();
    }
}