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
Route::get('/', 'InternshipsController@index')->name("index");

Route::post('/', 'InternshipsController@changeFilter');

Route::get('/newinternship/{id}', 'InternshipsController@showForm');

Route::post("/entreprise/{id}", 'InternshipsController@enterFormInDb');

Route::get('/internships/{iid}/view','InternshipsController@view');

Route::get('/internships/{iid}/edit','InternshipsController@edit')->name("editInternships");

Route::get('/internships/{iid}/update','InternshipsController@update')->name("updateInternships");

Route::get('/internships/{iid}/addVisit','InternshipsController@addVisit');

Route::get('/internships/{iid}/updateVisit','InternshipsController@updateVisit');

Route::get('/internships/{iid}/addRemark','InternshipsController@newRemark');

Route::get('/internships/{iid}/new','InternshipsController@createInternship');

Route::post('/internships/{iid}/create','InternshipsController@addInternship');
//
Route::post('/internships/{id}/files',"InternshipsController@storeFile")->name("internship.storeFile");
Route::delete('/internships/{id}/files/{idMedia}',"InternshipsController@deleteFile")->name("internship.deleteFile");

Route::get('/admin','AdminController@index')->middleware('admin');

Route::get('/about', function () {
    return view('about');
});

Route::get('/remarks', 'RemarksController@index');

Route::post('/remarks/filter','RemarksController@filter');

Route::post('/remarks/add','RemarksController@create');

Route::post('/remarks/ajax/add','RemarksController@ajaxCreate');

Route::get('/remarks/{rid}/edit','RemarksController@edit');

Route::post('/remarks/delete','RemarksController@delete');

Route::post('/remarks/update','RemarksController@update');

// Antonio - Entreprises list
Route::get('/entreprises', 'EntreprisesController@index');
Route::post('/entreprises/add', 'EntreprisesController@add');
Route::post('/entreprises/filter', 'EntreprisesController@filter');

// Antonio - Entreprise details
Route::get('/entreprise/{id}', 'EntrepriseController@index');
Route::get('/entreprise/{id}/remove', 'EntrepriseController@remove');
Route::post('/entreprise/{id}/save', 'EntrepriseController@save');
Route::post('/entreprise/addRemarks', 'EntrepriseController@addRemarks');


// Quentin N - Contract generation
Route::get('/contract/{id}', 'ContractController@generateContract');

Route::post('/contract/{id}/view', 'ContractController@visualizeContract')->name("viewContract");

Route::post('/contract/{id}/save', 'ContractController@saveContract')->name("saveContract");

Route::get('/contract/{id}/cancel', 'ContractController@cancelContract');

// Steven
Route::get('/synchro', 'SynchroController@index');
Route::post('/synchro/modify', 'SynchroController@modify');

// Jean-Yves
Route::get('/visits','VisitsController@index');
Route::post('/visits','VisitsController@filter');
Route::get('/visits/{rid}/manage','VisitsController@manage')->name("visit.manage");
Route::post('/visits/create','VisitsController@create');
Route::get('/visits/{id}/mail','VisitsController@mail');
Route::get('/visits/{id}/delete', 'VisitsController@delete');
Route::post('/visits/{id}/update', 'VisitsController@update');
Route::post('/visits/{id}/files',"VisitsController@storeFile")->name("visit.storeFile");
Route::delete('/visits/{id}/files/{idMedia}',"VisitsController@deleteFile")->name("visit.deleteFile");

// Add by Benjamin Delacombaz 12.12.2017 10:40
Route::get('/wishesMatrix', 'WishesMatrixController@index')->name('wishesMatrix');
// Add by Benjamin Delacombaz 21.01.2018
Route::post('/wishesMatrix', 'WishesMatrixController@save');

// Kevin
Route::get('/traveltime/{flockId}/load', 'TravelTimeController@load');
Route::get('/traveltime/{flockId}/calculate', 'TravelTimeController@calculate');

// Logbook
Route::get('/internships/{iid}/logbook', 'LogbookController@show');

// Nicolas - Stages
Route::get('/reconstages', 'ReconStagesController@index');
Route::post('/reconstages/reconmade', 'ReconStagesController@reconducted');
// Nicolas - Documents
Route::get('/documents', 'DocumentsController@index');

// Davide
Route::get('/listPeople', 'PeopleControlleur@index');
Route::post('/listPeople/category', 'PeopleControlleur@category');
Route::get('/listPeople/{id}/info','PeopleControlleur@info');
Route::post('/listPeople/update/{id}','PeopleControlleur@update');
Route::post('/contact/delete','PeopleControlleur@deleteContact');
Route::post('/contact/add','PeopleControlleur@addContact');
Route::post('/listPeople/changeCompany','PeopleControlleur@changeCompany');

//Life cicle
Route::get('/editlifecycle','LifeCycleController@index');

Route::post('/addlifecycle','LifeCycleController@addEmptyContractState');
Route::post('/removelifecycle','LifeCycleController@removeLifeCycleState');

//Mailling
Route::get('/mailing','MailingController@mailling');

