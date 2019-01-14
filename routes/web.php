<?php

use App\Helpers\UserHelper;

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

//Login and
Route::get('/', function () {
    return view('welcome');
});

//Profile views
Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    $result = UserHelper::isLoggedin();
    if ($result != null) {
        return $result;
    }
    return view('login');
});
Route::get('/requestPasswordChange', function () {
    return view('auth/request_password_change');
});

Route::get('/resetPass/{link}', function () {
    return view('auth/password_reset_form', ['link' => request()->link]);
});

Route::post('/requestPasswordChange/', 'UserController@requestPassChange');
Route::post('/resetPass/', 'UserController@resetPassword');


Route::post('/register', 'AuthController@register');
Route::post('/login', 'UserController@login');
Route::get('/verify/{link}', 'UserController@verify');
Route::get('/resend/{email}', 'UserController@resend');

Route::get('/home/', 'UserController@requestPassChange');

Route::get('/logout/', 'UserController@logout');

Route::group(['prefix' => 'api'], function() {
    Route::group(['prefix' => 'auth'], function()
    {
        Route::post('/register', 'AuthController@register');
        Route::post('/login', 'AuthController@login');
        Route::post('/logout/', 'AuthController@logout');
        Route::get('/resendVerification/{email}', 'AuthController@resend');
        Route::get('/verify/{link}', 'AuthController@verify');
        Route::get('/requestPasswordChange/{email}', 'AuthController@requestPassChange');
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
    });

    Route::group(['prefix' => 'tag'], function()
    {
        Route::get('/{id}', 'TagController@getById');
        Route::delete('/{id}', 'TagController@delete');
        Route::post('/', 'TagController@add');
        Route::put('/', 'TagController@edit');
        Route::get('/{id}/posts', 'PostController@getWithTag');
    });

    Route::group(['prefix' => 'category'], function()
    {
        Route::get('/{id}', 'CategoryController@getById');
        Route::delete('/{id}', 'CategoryController@delete');
        Route::post('/', 'CategoryController@add');
        Route::put('/c', 'CategoryController@edit');
        Route::get('/{id}/posts', 'PostController@getWithCategory');
    });

    Route::group(['prefix' => 'comment'], function()
    {
        Route::get('/{id}', 'CommentController@getById');
        Route::delete('/{id}', 'CommentController@delete');
        Route::post('/', 'CommentController@add');
        Route::put('/', 'CommentController@edit');
        Route::post('/{id}/like', 'CommentController@like');
        Route::post('/{id}/dislike', 'CommentController@dislike');
    });
});