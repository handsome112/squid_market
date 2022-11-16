<?php

namespace App\Http\Requests\Staff\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Models\{User, Product, Favorite};

class UserBanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() &&
            auth()
                ->user()
                ->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'banreason' => 'required|min:20|max:300',
        ];
    }

    public function ban(User $user)
    {
        $user->banreason = $this->banreason;
        $user->ban = 1;
        $user->ban_since = Carbon::now();
        $user->save();
        session()->flash(
            'success',
            'You have successfully banned ' . $user->username . '.!'
        );
        $livefeed = new Livefeeds();
        $livefeed->event =
            $this->username . ' has been banned from the market.';
        $livefeed->type = 'ban';
        $livefeed->save();
        return redirect()->route('admin.users');
    }
}