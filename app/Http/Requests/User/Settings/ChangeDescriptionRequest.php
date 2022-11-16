<?php

namespace App\Http\Requests\User\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangeDescriptionRequest extends FormRequest
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
            // 'description' => 'required|min:10',
        ];
    }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */

    public function save()
    {
        $user = auth()->user();

        $user->description = $this->description;
        $user->save();

        session()->flash(
            'success',
            'You have successfully changed your Profile Description!'
        );
        return redirect()->route('accountindex');
    }
}