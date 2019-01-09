<?php

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
    return view('login');
});
Route::get('/resetPass', function () {
    return view('passReset');
});

Route::post('/resetPass/', 'UserController@requestPassChange');

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::get('/verify/{link}', 'UserController@verify');
Route::get('/resend/{email}', 'UserController@resend');


Route::get('/home/', 'UserController@requestPassChange');

Route::get('/logout/', 'UserController@resend');