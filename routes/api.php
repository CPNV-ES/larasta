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
Route::get('/internships/{internshipId}/logbook/activities', 'LogbookController@getActivities');
Route::get('/internships/logbook/activity/{activityId}', 'LogbookController@getActivity');

Route::post('/internships/{internshipId}/logbook/activities','LogbookController@addActivity');

Route::put('/internships/logbook/activity/{activityId}', 'LogbookController@updateActivity');