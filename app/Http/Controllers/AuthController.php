<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\EmailVerification;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\UserHelper;
use App\PasswordReset;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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

    public function resetPassword()
    {
        $link = request()->link;
        $pReset = PasswordReset::where('link', $link)->first();
        $user = $pReset->user;
        if($pReset == null)
            abort(404);
        $pass = request()->validate([
            'password' => ['required', 'min:6', 'same:password_confirmation'],
            'password_confirmation' => 'required'
        ]);
        $user['password'] = Hash::make(request()->password);
        DB::transaction(function () use ($link, $user){ 
            $user->update();
            PasswordReset::where('link', $link)->delete();
        });
    }
}
