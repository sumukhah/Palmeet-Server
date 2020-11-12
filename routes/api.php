<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::get('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('meetings', 'MeetingController@index');
    Route::get('meetings/{meeting}', 'MeetingController@show');
    Route::post('meetings', 'MeetingController@store');
    Route::put('meetings/{meeting}', 'MeetingController@update');
    Route::delete('meetings/{meeting}', 'MeetingController@delete');
});
