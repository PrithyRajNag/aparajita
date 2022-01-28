<?php

namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

//    public function showForgetPasswordForm()
//    {
//        return view('profile.forget_pass');
//    }


    public function submitForgetPasswordForm(Request $request)
    {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);
//        return redirect()->back();
        return redirect()->route('customer-login')->with('success', 'Reset Password Link Sent On Your Email Id.');
    }


    public function submitResetPasswordForm()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return redirect()->back()->with('error', 'Invalid token provided.');
        }

        return redirect()->route('customer-login')->with('success', 'Password has been successfully changed.');
    }
}
