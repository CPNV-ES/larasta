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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/remarks', 'RemarksController@index');

Route::post('/remarks/filter','RemarksController@filter');

Route::post('/remarks/add','RemarksController@create');

Route::get('/remarks/{rid}/edit','RemarksController@edit');

Route::post('/remarks/delete','RemarksController@delete');

Route::post('/remarks/update','RemarksController@update');

// Quentin N
Route::get('/contratGen', 'ContratGenController@index');

// Steven

Route::get('/synchro', 'SynchroController@index');

// Jean-Yves
Route::get('/visits','VisitsController@index');

Route::get('/visits/manage','VisitsController@manage');

// Add by Benjamin Delacombaz 12.12.2017 10:40
Route::get('/wishesMatrix', 'WishesMatrixController@index');

// Kevin
Route::get('/traveltime', 'TravelTimeController@index');

// Bastien - Grille d'évaluation
Route::get('/evalgrid', 'EvalController@index');

// Davide
Route::get('/listPeople', 'PeopleControlleur@index');

