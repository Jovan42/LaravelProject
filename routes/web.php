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


Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::get('/verify/{link}', 'UserController@verify');
Route::get('/resend/{email}', 'UserController@resend');

Route::get('/home/', 'UserController@requestPassChange');

Route::get('/logout/', 'UserController@logout');
