<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\EmailVerification;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register()
    {
        //dd(request());
        $user = User::where('email', request()->email)->first();
        if($user!=null) {
            return view('register')->withErrors([
                'login'=> 'User with this email already exist'
            ]);
        }
        if(request()->password != request()->password_confirmation){
            
            return view('register', ['prevData' => request()])->withErrors([
                'login'=> 'Passwords doesnt match'
            ]);
        }
        $user = request()->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
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
        
        dd(Auth::user());
    }
}
