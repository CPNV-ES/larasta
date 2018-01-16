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

Route::get('/', 'InternshipsController@index');

Route::post('/', 'InternshipsController@changeFilter');

Route::get('/internships/{iid}/edit','InternshipsController@edit');

Route::get('/about', function () {
    return view('about');
});

Route::get('/remarks', 'RemarksController@index');

Route::post('/remarks/filter','RemarksController@filter');

Route::post('/remarks/add','RemarksController@create');

Route::get('/remarks/{rid}/edit','RemarksController@edit');

Route::post('/remarks/delete','RemarksController@delete');

Route::post('/remarks/update','RemarksController@update');

// Antonio - Entreprises list
Route::get('/entreprises', 'EntreprisesController@index');
Route::post('/entreprises/add', 'EntreprisesController@add');
Route::get('/entreprise/{id}', 'EntrepriseController@index');

// Quentin N - Contract generation
Route::get('/contract/{internshipid}', 'ContractController@index');
Route::get('/contract/{internshipid}/view', 'ContractController@index');

// Steven

Route::get('/synchro', 'SynchroController@index');
Route::get('/synchro/new', 'SynchroController@new');
Route::get('/synchro/delete', 'SynchroController@delete');

// Jean-Yves
Route::get('/visits','VisitsController@index');

Route::get('/visits/{rid}/manage','VisitsController@manage');

Route::get('/visits/add', 'VisitsController@add');

Route::post('/visits/create','VisitsController@create');

Route::get('/visits/{id}/mail','VisitsController@mail');

// Add by Benjamin Delacombaz 12.12.2017 10:40
Route::get('/wishesMatrix', 'WishesMatrixController@index');

// Kevin
Route::get('/traveltime', 'TravelTimeController@index');
Route::post('/traveltime/calculate', 'TravelTimeController@calculate');

/**
 * Bastien - Evaluation grid
 * 
 * All the routes to interact with the evaluation Grid (edition)
 * Grouped by the /evalgrid prefix
 */
Route::prefix('evalgrid')->group(function () {
    /**
     * Home page of the section (just for dev)
     */
    Route::get('evalgrid', 'EvalController@index')->name('evalGridHome');
    /**
     * Create a new evaluation linked to a visit
     * @param visit the visit id
     */
    Route::get('neweval/{visit}', 'EvalController@newEval')->where('visit', '[0-9]+')->name('newEvalGrid');
    /**
     * Display an evaluation grid for edition or reading
     * @param mode 'readonly' or 'edit'
     * @param gridID the id of the grid we want to edit. OPTIONAL parameter (we can also pass the id by the session with the 'activeEditedGrid' key)
     */
    Route::get('grid/{mode}/{gridID?}', 'EvalController@editEval')->where(['mode' => 'edit|readonly', 'gridID' => '[0-9]+'])->name('editEvalGrid');
    /**
     * Edit the values of the grid fields (see the controller method for more infos)
     */
    Route::post('editcriteriavalue', 'EvalController@editCriteriaValue')->name('editEvalGridCriteriaValue');
});

// Nicolas - Stages
Route::get('/reconstages', 'ReconStagesController@index');

// Davide
Route::get('/listPeople', 'PeopleControlleur@index');
//

//Julien - Grille d'évaluation - Modélisation
Route::get('/editGrid', 'EditGridController@index');

