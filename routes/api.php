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
Route::post('logout', 'Auth\LoginController@logout');


Route::group(['middleware' => 'auth:api'], function() {

    Route::get('profile', 'HomeController@index');

    //Pals and Pal Requests Endpoints

    Route::get('pals', 'PalRequestController@index');
    Route::post('new-pal-request', 'PalRequestController@newPalRequest');
    Route::get('accept-pal-request/{id}', 'PalRequestController@acceptPalRequest');
    Route::get('decline-pal-request/{id}', 'PalRequestController@declinePalRequest');

    //Meetings Endpoints

    Route::get('meetings', 'MeetingController@index');
    Route::post('meeting-new', 'MeetingController@store');
    Route::post('meeting-invite', 'MeetingController@invitePals');
    Route::get('my-meeting-invites', 'MeetingController@myMeetingInvites');
    Route::get('meeting-invite-accept/{id}', 'MeetingController@acceptMeetingInvite');
    Route::get('meeting-invite-decline/{id}', 'MeetingController@declineMeetingInvite');
    Route::get('meetings/{meeting}', 'MeetingController@show');
    Route::put('meetings/{meeting}', 'MeetingController@update');
    Route::get('meeting-delete/{meeting}', 'MeetingController@delete');


});
