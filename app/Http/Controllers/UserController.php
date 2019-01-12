<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


use App\User;

class UserController extends Controller
{
    public function getByUsername()
    {
        $user = User::where('username', request()->username)->first();

        //User not found or deleted    
        if($user == null || $user->deleted) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }

        if($user->settings != null && !$user->settings->show_mail)
            $user->email = 'Hidden by users request';
        return $user;
    }

    public function delete()
    {
        $user = User::where('username', request()->username)->first();

        //User not found or already deleted
        if($user == null || $user->deleted) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }
        if(Auth::check() == null) {
            return response()->json([
                'error' => 'Not authorised for this action'
            ], 401);
        }
        $user->deleted = true;
        $user->update();
    }

    public function edit(User $user)
    {   
        $user = new User(request()->user);
        $oldUserData = User::where('id', $user->id)->first();
        $oldUserData->username = $user->username;
        $oldUserData->email= $user->email;
        $oldUserData->update();
    }

    public function getSettings()
    {
        $user = User::where('email', request()->email)->first();
        return $user->settings();
    }
}
