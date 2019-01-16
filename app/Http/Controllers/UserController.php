<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


use App\User;

class UserController extends Controller
{
    public function getByUsername($username)
    {
        $user = User::where('username', $username)->first();

        //User not found or deleted    
        if($user == null || $user->deleted) {
            return response()->json("User does not exist", 404);
        }

        if($user->settings != null && !$user->settings->show_mail)
            $user->email = 'Hidden by users request';
        return response()->json($user, 200);
    }

    public function delete()
    {
        $user = User::where('username', request()->username)->first();

        //User not found or already deleted
        if($user == null || $user->deleted) {
            return response()->json("User does not exist", 404);
        }

        if(Auth::check() == null || Auth::user()->id != $user->id) {
            return response()->json("Unauthorized to delete this user", 401);
        }
        $user->deleted = true;
        $user->update();
        return response()->json("Successfully deleted", 200);
    }

    public function edit(User $user)
    {   
        return response()->json("Unable to edit user", 404);
    }

    public function getSettings( $username)
    {
        $user = User::where('username', $username)->first();
        if($user == null || $user->deleted) {
            return response()->json("User does not exist", 404);
        }
        return $user->settings;
    }
    


}
