<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/manage/users', 'ManageController@users')->name('manage.users');
Route::get('/manage', 'ManageController@home')->name('manage.home');
Route::get('/app', 'AppController@home')->name('app.home');
Route::get('/app/conference', 'ConferenceController@home')->name('app.conference.home');
Route::get('/app/conference/add', 'ConferenceController@addConferenceUI')->name('app.conference.add');
Route::get('/app/conference/{conferenceID}', 'ConferenceController@showConference')->name('app.conference.conference');

Route::post('/app/conference/add', 'ConferenceController@addConference')->name('app.conference.action.add');
