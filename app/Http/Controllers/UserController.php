<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\EmailVerification;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationLink;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{

    use AuthenticatesUsers;

    public function register()
    {
        //Checking if two passwords match
        /*if(request()->password != request()->password_confirmation){
            
            return view('register', ['prevData' => request()])->withErrors([
                'login'=> 'Passwords doesnt match'
            ]);
        }*/

        //Validate register data
        $user = request()->validate([
            'username' => ['required', 'min:6'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'same:password_confirmation'],
            'password_confirmation' => 'required'
        ]);

        $user['password'] = Hash::make(request()->password);
        $user = User::create($user);
        $ver = EmailVerification::create([
            'user_id' => $user->id,
            'link' => md5(uniqid($user->username, true))
        ]);

        Mail::to($user->email)->send(
            new SendVerificationLink($ver->link)
        );
        return redirect('/posts');
    }

    public function resend($mail) {
        $user = User::where('email', request()->email)->first();

        EmailVerification::where('user_id',  $user->id)->delete();
        $ver = EmailVerification::create([
            'user_id' => $user->id,
            'link' => md5(uniqid($user->username, true))
        ]);
        Mail::to($user->email)->send(
            new SendVerificationLink($ver->link)
        );

        
    }

    public function verify($link)
    {
        DB::transaction(function () use ($link) {
            $ver = EmailVerification::get()->where('link', $link)->first();           
            $ver->user->verified = true;
            
            $ver->user->update();
            
            EmailVerification::where('link', $link)->delete();
            
        });
    }

    public function login(){
        $user = User::where('email', request()->email)->first();
        if($user==null) {
            return view('login')->withErrors([
                'login'=> 'User does not exist'
            ]);
        }
        $cred = array(
            'email' => request()->email,
            'password' => request()->password
        );
        if (!Auth::attempt($cred)) {
            return view('login')->withErrors([
                'login'=> 'Username and password doesnt match'
            ]);
        } else {
            if(!$user->verified) {
                Auth::logout();
                return view('login', ['mail' => $user->email])->withErrors([
                    'login'=> 'You must verify email first'
                ]);
            }
        }
        Auth::login($user);
    }

    public function requestPassChange()
    {
        $user = User::where('email', request()->email)->first();
        if($user == null) {
            return view('passReset')->withErrors([
                'login'=> 'User does not exist'
            ]);
        }
        $res = EmailVerification::create([
            'user_id' => $user->id,
            'link' => md5(uniqid($user->username, true))
        ]);
        Mail::to(request()->email)->send(
            new ResetPassword($res->link)
        );

    }

    public function logout()
    {
       Auth::logout();
    }

    public function showLoginForm()
    {
        return view('login');
    }

}
