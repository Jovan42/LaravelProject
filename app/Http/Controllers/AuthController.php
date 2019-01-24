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

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    
    public function register()
    {
       
        $validator = Validator::make(request()->all(), [
            'username' => ['required', 'min:6', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'same:password_confirmation'],
            'password_confirmation' => 'required'
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->errors()->messages(), 409);
        }

        $user = request()->all();
        $user['password'] = Hash::make(request()->password);
        $user = User::create($user);
        UserHelper::sendVerificationMail($user);    
        return response()->json("User registered", 200);
    }

    public function login()
    {   
        if(Auth::check()) {
           return response()->json("Already logged in", 400);
        }        
        $user = User::where('email', request()->email)->first();

        $result = UserHelper::doesExist($user, 'login');
        if ($result != null)     return response()->json("User does not exist", 404);


        $result = UserHelper::isVerified($user);
        if ($result != null)    return response()->json("User is not verified", 403);

        $cred = array(
            'email' => request()->email,
            'password' => request()->password
        );
        
        $result = UserHelper::attemptLogin($cred);
        if ($result != null)     return response()->json("Email and password does not match", 401);
        Session::save();
        return response()->json("Successful login", 200);
    }

    public function logout()
    {
       Auth::logout();
       return response()->json("Successful logout", 200);
    }

    public function resend($mail) {
        $user = User::where('email', request()->email)->first();
        if ($user->verified == false) {
            EmailVerification::where('user_id', $user->id)->delete();
            UserHelper::sendVerificationMail($user);
            return response()->json("Mail succesfully send", 200);
        }
        return response()->json("Verification link does not exist", 404);
    }

    public function verify($link)
    {   

        $ver = EmailVerification::get()->where('link', $link)->first();
        if($ver == null)     return response()->json("Verification link does not exist", 404);

        $ver->user->verified = true;
        $ver->user->update();
        EmailVerification::where('link', $link)->delete();
    }

    public function requestPassChange()
    {
        if(request()->email == null)    return response()->json("User does not exist", 404);
        $user = User::where('email', request()->email)->first();

        if ($user == null)     return response()->json("User does not exist", 404);
        UserHelper::sendPasswordResetMail($user);
        return response()->json("Succesful request", 200);
    }

    public function resetPassword()
    {
        $link = request()->link;
        $pReset = PasswordReset::where('link', $link)->first();
       
        if($pReset == null) return response()->json(" Password change link does not exist", 404);
        $user = $pReset->user;
        
        $validator = Validator::make(request()->all(), [
            'password' => ['required', 'min:6', 'same:password_confirmation'],
            'password_confirmation' => 'required'
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->errors()->messages(), 409);
        }
        $user['password'] = Hash::make(request()->password);
        
        DB::transaction(function () use ($link, $user){ 
            $user->update();
            PasswordReset::where('link', $link)->delete();
        });
    }

    public function check()
    {
        if(Auth::user() != null)
            return Auth::user();
            return response()->json("Noone is logged in", 403);
    }
}
