<?php

namespace App\Helpers;

use App\User;
use App\EmailVerification;
use App\Mail\SendVerificationLink;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ResetPassword;
use App\PasswordReset;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Validator;

class UserHelper
{
    public static function sendVerificationMail($user)
    {
        $ver = EmailVerification::create([
            'user_id' => $user->id,
            'link' => md5(uniqid($user->username, true))
        ]);

        Mail::to($user->email)->send(
            new SendVerificationLink($ver->link)
        );
    }

    public static function sendPasswordResetMail($user)
    {
        PasswordReset::where('user_id', $user->id)->delete();
        $res = PasswordReset::create([
            'user_id' => $user->id,
            'link' => md5(uniqid($user->username, true))
        ]);
        
        Mail::to(request()->email)->send(
            new PasswordResetMail($res->link)
        );
    }

    public static function registerUser($request)
    {


        $user = $request->validate([
            'username' => ['required', 'min:6'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'same:password_confirmation'],
            'password_confirmation' => 'required'
        ]);
        

        $user['password'] = Hash::make(request()->password);
        return User::create($user);
    }

    public static function doesExist($user, $redirect = 'errorPage')
    {
        if($user==null) {
            return view($redirect)->withErrors([
                'login'=> 'User does not exist'
            ]);
        }
        return null;
    }

    public static function isVerified($user)
    {
        if(!$user->verified) {
            Auth::logout();
            return view('login', ['mail' => $user->email])->withErrors([
                'login'=> 'You must verify email first'
            ]);
        }
        return null;
    }
    
    public static function attemptLogin($cred)
    {
        if (!Auth::attempt($cred)) {
            return view('login')->withErrors([
                'login'=> 'Username and password don\'t match'
            ]);
        }
        return null;
    }
    
    public static function isLoggedin()
    {
        if(Auth::user() != null)
            return view('home');
        return null;
    }

    

}   
