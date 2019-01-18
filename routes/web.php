<?php

use App\Helpers\UserHelper;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', 'WebController@login');
Route::get('/register', 'WebController@register');
Route::get('/post/{id}', 'WebController@post');
Route::get('/home', 'WebController@login');
Route::get('/add_post', 'WebController@addPost');
Route::get('/reset_password', 'WebController@passwordReset');



Route::get('/resetPass/{link}', function () {
    return view('auth/password_reset_form', ['link' => request()->link]);
});

Route::post('/resetPass/', 'UserController@resetPassword');


Route::post('/register', 'AuthController@register');
Route::post('/login', 'UserController@login');
Route::get('/verify/{link}', 'UserController@verify');
Route::get('/resend/{email}', 'UserController@resend');


Route::get('/logout/', 'UserController@logout');

Route::group(['prefix' => 'api', 'middleware' => 'cors'], function() {
    Route::group(['prefix' => 'auth'], function()
    {
        Route::get('/check/', 'AuthController@check');

        Route::post('/register', 'AuthController@register');
        Route::post('/login', 'AuthController@login');
        Route::post('/logout', 'AuthController@logout');
        Route::get('/resendVerification/{email}', 'AuthController@resend');
        Route::get('/verify/{link}', 'AuthController@verify');
        Route::post('/requestPasswordChange/', 'AuthController@requestPassChange');
        Route::post('/resetPass/{link}', 'AuthController@resetPassword');
    });

    Route::group(['prefix' => 'user'], function()
    {
        Route::get('/{username}', 'UserController@getByUsername');
        Route::delete('/{username}', 'UserController@delete');
        Route::post('/', 'AuthController@register');
        Route::put('/', 'UserController@edit');
        Route::get('/{username}/posts', 'PostController@getForUser');  

        Route::group(['prefix' => '{username}/settings'], function()
        {
            Route::get('/', 'UserController@getSettings');

        });
    });

    Route::group(['prefix' => 'post'], function()
    {
        Route::get('/{id}', 'PostController@getById');
        Route::get('/', 'PostController@getAll');
        Route::delete('/{id}', 'PostController@delete');
        Route::post('/', 'PostController@add');
        Route::put('/{id}', 'PostController@edit');
        Route::get('/{id}/comments', 'CommentController@getForPost');
        Route::get('/{id}/tags', 'TagController@getForPost');
        Route::get('/{id}/category', 'CategoryController@getForPost');
        Route::post('/{id}/tags', 'PostController@addTag');
        Route::delete('/{id}/tags', 'PostController@removeTag');
        
        Route::group(['prefix' => '{post}/comment'], function()
        {
           
            Route::post('/', 'CommentController@add');
           
            Route::post('/{id}/like', 'CommentController@like');
            Route::post('/{id}/dislike', 'CommentController@dislike');
        });

    });

    Route::group(['prefix' => '/comment'], function()
    {
        Route::get('/{id}', 'CommentController@getById');
        Route::delete('/{id}', 'CommentController@delete');
        Route::put('/{id}', 'CommentController@edit');
    });

    Route::group(['prefix' => 'tag'], function()
    {
        Route::get('/', 'TagController@getAll');
        Route::get('/{id}', 'TagController@getById');
        Route::delete('/{id}', 'TagController@delete');
        Route::post('/', 'TagController@add');
        Route::put('/{id}', 'TagController@edit');
        Route::get('/{id}/posts', 'PostController@getWithTag');

        
    });

    Route::group(['prefix' => 'category'], function()
    {
        Route::get('/', 'CategoryController@getAll');
        Route::get('/{id}', 'CategoryController@getById');
        Route::delete('/{id}', 'CategoryController@delete');
        Route::post('/', 'CategoryController@add');
        Route::put('/{id}', 'CategoryController@edit');
        Route::get('/{id}/posts', 'PostController@getWithCategory');
    });

    
});