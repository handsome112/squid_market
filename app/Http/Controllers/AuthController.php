<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\{
    LoginRequest,
    RegisterRequest,
    ResetPasswordRequest,
    VerifyLoginRequest,
    ResetwithMnemonicRequest
};
use App\Models\{User, Livefeeds};

class AuthController extends Controller
{
    /**
     * Login view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewLogin()
    {
        return view('auth.login');
    }

    public function viewToLogin(Request $request)
    {
        session_start();
        $answer = $request->onionguard_answer;
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

        return view('auth.login');
    }

    /**
     * Login HTTP request
     * @param  LoginRequest	$request
     *
     * @return App\Http\Requests\Auth\Login
     */
    public function postLogin(LoginRequest $request)
    {
        try {
            return $request->login();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Register view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewRegister(Request $request)
    {
        return view('auth.register', [
            'reference_code' => $request->reference,
        ]);
    }

    public function viewResetwithPGP()
    {
        return view('auth.resetwithpgp');
    }

    public function viewResetwithMnemonic()
    {
        return view('auth.resetwithmnemonic');
    }

    public function postResetWithMnemonic(ResetwithMnemonicRequest $request)
    {
        try {
            return $request->reset();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }
    /**
     * Register HTTP request
     * @param  RegisterRequest	$request
     *
     * @return App\Http\Requests\Auth\Register
     */
    public function postRegister(RegisterRequest $request)
    {
        try {
            return $request->register();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Reset password view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewResetPassword()
    {
        return view('auth.resetpassword');
    }

    public function viewMnemonic()
    {
        return view('auth.register-success');
    }

    public function postResetPassword(ResetPasswordRequest $request)
    {
        try {
            return $request->createRequest();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Reset password HTTP request
     * @param  ResetPasswordRequest	$request
     *
     * @return App\Http\Requests\Auth\ResetPassword
     */
    public function putResetPassword(ResetPasswordRequest $request)
    {
        try {
            return $request->reset();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Return verify login view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewVerifyLogin()
    {
        if (
            session()->has('verification_name') and
            session()->get('verification_name') === 'verify_login'
        ) {
            return view('auth.verifylogin');
        }

        return abort(404);
    }

    /**
     * Verify login HTTP request
     * @param  VerifyLoginRequest	$request
     *
     * @return App\Http\Requests\Auth\VerifyLogin
     */
    public function postVerifyLogin(VerifyLoginRequest $request)
    {
        try {
            return $request->verify();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Logout HTTP request
     *
     * @return Illuminate\Routing\Redirector
     */
    public function logout()
    {
        $user = auth()->user();

        $livefeed = new Livefeeds();
        $livefeed->event = auth()->user()->username . ' has just signed out.';
        $livefeed->type = 'signout';
        $livefeed->save();
        $user->last_logoff = Carbon::now();
        $user->save();
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        session()->flush();

        return redirect()->route('login');
    }

    public function returnHome()
    {
        $user = auth()->user();

        session()->forget($user->username);
        $user->mnemoniccopy = 1;
        $user->save();

        return redirect()->route('accountindex');
    }
}