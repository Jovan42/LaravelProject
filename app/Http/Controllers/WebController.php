<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tag;

class WebController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function post($id)
    {
        return view('post', compact('id'));
    }
    public function addPost()
    {
        return view('addPost');
    }
    public function passwordResetRequest()
    {
        return view('password_reset_request');
    }
    public function passwordReset($link)
    {
        return view('password_reset',compact('link'));
    }

    public function tag(Tag $id)
    {
        return view('tag',compact('id'));
    }
}
