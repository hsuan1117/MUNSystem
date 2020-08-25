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
Route::get('/app/conference/join', 'ConferenceController@joinConferenceUI')->name('app.conference.join');
Route::get('/app/conference/{conferenceID}', 'ConferenceController@showConference')->name('app.conference.conference');
Route::get('/app/conference/{conferenceID}/step', 'ConferenceController@getStep')->name('app.conference.action.getStep');
Route::get('/app/conference/{conferenceID}/speaking', 'ConferenceController@getSpeaking')->name('app.conference.action.getSpeaking');
Route::get('/app/conference/{conferenceID}/role', 'ConferenceRoleController@home')->name('app.conference.role.home');
Route::get('/app/conference/{conferenceID}/role/add', 'ConferenceRoleController@addRoleUI')->name('app.conference.role.add');
Route::get('/app/conference/{conferenceID}/rollCall', 'ConferenceRollCallController@home')->name('app.conference.roleCall.home');
Route::get('/app/conference/{conferenceID}/openingSpeech', 'ConferenceOpeningSpeechController@home')->name('app.conference.openingSpeech.home');
Route::get('/app/conference/{conferenceID}/amendment', 'ConferenceAmendmentController@home')->name('app.conference.amendment.home');
Route::get('/app/conference/{conferenceID}/amendment/add', 'ConferenceAmendmentController@addUI')->name('app.conference.amendment.add');
Route::get('/app/conference/{conferenceID}/note', 'ConferenceNoteController@home')->name('app.conference.note.home');
Route::get('/app/conference/{conferenceID}/note/add', 'ConferenceNoteController@addUI')->name('app.conference.note.add');
Route::get('/app/conference/{conferenceID}/vote', 'ConferenceVotingController@home')->name('app.conference.voting.home');
Route::get('/app/conference/{conferenceID}/vote/add', 'ConferenceVotingController@addUI')->name('app.conference.voting.add');
Route::get('/app/conference/{conferenceID}/vote/{voteID}/voting', 'ConferenceVotingController@voting')->name('app.conference.voting.voting');

Route::post('/app/conference/add', 'ConferenceController@addConference')->name('app.conference.action.add');
Route::post('/app/conference/join', 'ConferenceController@joinConference')->name('app.conference.action.join');
Route::post('/app/conference/{conferenceID}/role/add', 'ConferenceRoleController@addRole')->name('app.conference.action.role.add');
Route::post('/app/conference/{conferenceID}/rollCall/change', 'ConferenceRollCallController@change')->name('app.conference.action.roleCall.change');
Route::post('/app/conference/{conferenceID}/openingSpeech/change', 'ConferenceOpeningSpeechController@change')->name('app.conference.action.openingSpeech.change');
Route::post('/app/conference/{conferenceID}/openingSpeech/startSpeech', 'ConferenceOpeningSpeechController@startSpeech')->name('app.conference.action.openingSpeech.startSpeech');
Route::post('/app/conference/{conferenceID}/amendment/change', 'ConferenceAmendmentController@change')->name('app.conference.action.amendment.change');
Route::post('/app/conference/{conferenceID}/amendment/accept', 'ConferenceAmendmentController@accept')->name('app.conference.action.amendment.accept');
Route::post('/app/conference/{conferenceID}/amendment/add', 'ConferenceAmendmentController@add')->name('app.conference.action.amendment.add');
Route::post('/app/conference/{conferenceID}/note/change', 'ConferenceNoteController@change')->name('app.conference.action.note.change');
Route::post('/app/conference/{conferenceID}/note/accept', 'ConferenceNoteController@accept')->name('app.conference.action.note.accept');
Route::post('/app/conference/{conferenceID}/note/add', 'ConferenceNoteController@add')->name('app.conference.action.note.add');
Route::post('/app/conference/{conferenceID}/vote/add', 'ConferenceVotingController@add')->name('app.conference.action.voting.add');
Route::post('/app/conference/{conferenceID}/vote/change', 'ConferenceVotingController@change')->name('app.conference.action.voting.change');
