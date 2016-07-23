<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('Login', 'Auth\AuthController@showLoginForm')->name('login');
Route::get('Register', 'Auth\AuthController@showRegistrationForm')->name('register');
Route::get('email/verification', 'Auth\EmailController@getVerification')->name('email-verification');

Route::post('validate/recaptcha', 'ValidationController@validateRecaptcha')->name('recatcha');
