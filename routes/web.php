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

Route::group(['middleware' => ['auth']], function () {

    Route::get('/newinternship/{id}', 'InternshipsController@showForm');

    Route::post("/entreprise/{id}", 'InternshipsController@enterFormInDb');

    Route::get('/internships/{iid}','InternshipsController@view')->name('internship');

    Route::get('/internships/{iid}/edit','InternshipsController@edit')->name("editInternships");

    Route::put('/internships/{iid}','InternshipsController@update')->name("updateInternships");

    Route::post('/internships/{id}/addVisit','VisitsController@store')->name('visit.create');

    Route::put('/internships/{id}/updateVisit','VisitsController@updateVisit')->name('visit.update');

    Route::get('/internships/{iid}/addRemark','InternshipsController@newRemark');

    Route::get('/internships/{iid}/new','InternshipsController@createInternship');

    Route::post('/internships/{iid}/create','InternshipsController@addInternship');
    //
    Route::post('/internships/{id}/files',"InternshipsController@storeFile")->name("internship.storeFile");
    Route::delete('/internships/{id}/files/{idMedia}',"InternshipsController@deleteFile")->name("internship.deleteFile");

    Route::get('/admin','AdminController@index')->middleware('admin');

    Route::get('/admin/snapshot', 'snapshotController@showSnapshot');
    Route::get('/admin/snapshot/take', 'snapshotController@takeDbSnapshot')->name('snapshot.take');
    Route::post('/admin/snapshot/upload', 'snapshotController@upload')->name('snapshot.upload');
    Route::post('/admin/snapshot/reload', 'snapshotController@reload')->name('snapshot.reload');

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
    Route::post('/visits/remarks','VisitsController@addRemarks');
    Route::get('/visits/{id}/mail','VisitsController@mail');
    Route::get('/visits/{id}/delete', 'VisitsController@delete');
    Route::post('/visits/{id}/update', 'VisitsController@update');
    Route::post('/visits/{id}/files',"VisitsController@storeFile")->name("visit.storeFile");
    Route::delete('/visits/{id}/files/{idMedia}',"VisitsController@deleteFile")->name("visit.deleteFile");

    // WishesMatrix
    Route::get('/wishesMatrix', 'WishesMatrixController@index')->name('wishesMatrix');
    Route::post('/wishesMatrix', 'WishesMatrixController@save');
    Route::post('/updateWishes', 'WishesMatrixController@saveWishes');
    Route::post('/wishesPostulations', 'WishesMatrixController@saveWishespostulations');

    // Kevin
    Route::get('/traveltime/{flockId}/load', 'TravelTimeController@load');
    Route::get('/traveltime/{flockId}/calculate', 'TravelTimeController@calculate');

    // Logbook
    Route::get('/internships/{internshipId}/logbook', 'LogbookController@index')->name("logbookIndex");
    Route::get('/internships/{internshipId}/logbook/review', 'LogbookController@reviewMode')->name("logbookReview");
    Route::put('/internships/{internshipId}/externalLogbook', "InternshipsController@storeLogbookFile")->name("externalLogbook.store");

    // Nicolas - Stages
    Route::get('/reconstages', 'ReconStagesController@index')->name('reconstage.index');
    Route::post('/reconstages/reconducted', 'ReconStagesController@reconducted')->name('reconstage.reconducted');
    // Nicolas - Documents
    Route::get('/documents', 'DocumentsController@index');

    // Davide
    Route::get('/listPeople', 'PeopleController@index');
    Route::post('/listPeople/category', 'PeopleController@category');
    Route::get('/listPeople/{id}/info','PeopleController@info');
    Route::post('/listPeople/update/{id}','PeopleController@update');
    Route::post('/contact/delete','PeopleController@deleteContact');
    Route::post('/contact/add','PeopleController@addContact');
    Route::post('/listPeople/changeCompany','PeopleController@changeCompany');

    //Life cicle
    Route::get('/editlifecycle','LifeCycleController@index');

    Route::post('/addlifecycle','LifeCycleController@addEmptyContractState');
    Route::post('/removelifecycle','LifeCycleController@removeLifeCycleState');

    //Mailling
    Route::get('/mailing','MailingController@mailling');

});
    
//GitHub
Route::get('/auth/github', 'Auth\AuthController@redirectToProvider')->name('login');
Route::get('/auth/callback', 'Auth\AuthController@handleProviderCallback');
Route::post('/auth/logout', 'Auth\AuthController@logoutUser');

