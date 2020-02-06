<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//logbook
Route::get('/internships/{internshipId}/logbook/activities', 'LogbookController@getActivities')->name("getActivities");
Route::get('/internships/logbook/activities/{activityId}', 'LogbookController@getActivity')->name("getActivity");

Route::post('/internships/{internshipId}/logbook/activities','LogbookController@addActivity')->name("postActivity");

Route::put('/internships/logbook/activities/{activityId}', 'LogbookController@updateActivity')->name("putActivity");

Route::delete('/internships/logbook/activities/{activityId}', 'LogbookController@deleteActivity')->name("deleteActivity");