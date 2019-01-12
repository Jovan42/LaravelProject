<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getForUser()
    {
        $user = User::where('email', request()->email)->first();
        return $user->posts();
    }
}
