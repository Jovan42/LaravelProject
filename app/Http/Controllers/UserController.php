<?php

namespace App\Http\Controllers;

use App\User;
use App\EmailVerification;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\UserHelper;
use App\PasswordReset;
use App\Mail\PasswordResetMail;

class UserController extends Controller
{

    use AuthenticatesUsers;

    public function register()
    {
        $user = UserHelper::registerUser(request());
        UserHelper::sendVerificationMail($user);
        
        return redirect('/home');
    }

    public function resend($mail) {
        $user = User::where('email', request()->email)->first();
        if ($user->verified == false) {
            EmailVerification::where('user_id', $user->id)->delete();
            UserHelper::sendVerificationMail($user);
        }
    }

    public function verify($link)
    {
        if ($user->verified == false) {
            DB::transaction(function () use ($link) {
                $ver = EmailVerification::get()->where('link', $link)->first();
                $ver->user->verified = true;

                $ver->user->update();

                EmailVerification::where('link', $link)->delete();
            });
        }
    }

    public function login()
    {
        $result = UserHelper::isLoggedin();
        if ($result != null)     return $result;
        
        $user = User::where('email', request()->email)->first();

        $result = UserHelper::doesExist($user, 'login');
        if ($result != null)     return $result;


        $result = UserHelper::isVerified($user);
        if ($result != null)     return $result;

        $cred = array(
            'email' => request()->email,
            'password' => request()->password
        );
        
        $result = UserHelper::attemptLogin($cred);
        if ($result != null)     return $result;
    }

    public function requestPassChange()
    {
        $user = User::where('email', request()->email)->first();

        $result = UserHelper::doesExist($user, 'resetPass');
        if ($result != null)     return $result;
        UserHelper::sendPasswordResetMail($user);

    }

    public function logout()
    {
       Auth::logout();
    }
}
