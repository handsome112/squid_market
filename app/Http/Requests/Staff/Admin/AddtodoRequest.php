<?php

namespace App\Http\Requests\Staff\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Todolist;

class AddtodoRequest extends FormRequest
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
            'nametodo' => 'required|min:4|max:40',
            // 'captcha' => 'required|captcha'
        ];
    }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */
    public function add()
    {
        $user = auth()->user();

        $todo = new Todolist();
        $todo->name = $this->nametodo;
        $todo->user_id = $user->id;
        $todo->save();

        return redirect()->back();
    }
}