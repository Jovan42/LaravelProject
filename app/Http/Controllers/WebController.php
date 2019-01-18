<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function passwordReset()
    {
        return view('password_reset');
    }
}
