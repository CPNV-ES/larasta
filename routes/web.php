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

// Route::get('/internships', function(){return redirect(route("index"));});

Route::post('/', 'InternshipsController@changeFilter');

Route::group(['middleware' => ['auth']], function () {

    
    //TODO Refactor these routes by using Route::resource() ↓
    // Route::resource('internships','InternshipsController');
    Route::get('/internships','InternshipsController@index')->name('internships.index'); 
    Route::get('/internships/create','InternshipsController@create')->name('internships.create'); 
    Route::get('/internships/{id}/create','InternshipsController@create')->name('internships.create'); 
    Route::post('/internships','InternshipsController@store')->name('internships.store'); 
    Route::get('/internships/{id}','InternshipsController@show')->name('internships.show'); 
    Route::get('/internships/{id}/edit','InternshipsController@edit')->name('internships.edit'); 
    Route::put('/internships/{id}','InternshipsController@update')->name('internships.update'); 
    Route::delete('/internships/{id}','InternshipsController@destroy')->name('internships.destroy'); 
    
    Route::get('/internships/{iid}/addRemark','InternshipsController@newRemark');
    Route::post('/internships/{id}/addVisit','VisitsController@store')->name('visit.create');
    Route::put('/internships/{id}/updateVisit','VisitsController@updateVisit')->name('visit.update');
    // Logbook
    Route::get('/internships/{internshipId}/logbook', 'LogbookController@index')->name("logbookIndex");
    Route::get('/internships/{internshipId}/logbook/review', 'LogbookController@reviewMode')->name("logbookReview");
    Route::put('/internships/{internshipId}/externalLogbook', "InternshipsController@storeLogbookFile")->name("externalLogbook.store");
    //file manage
    Route::post('/internships/{id}/files',"InternshipsController@storeFile")->name("internship.storeFile");
    Route::delete('/internships/{id}/files/{idMedia}',"InternshipsController@deleteFile")->name("internship.deleteFile");
    //admin pages
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admin','AdminController@index');
        Route::get('/admin/snapshot', 'SnapshotController@showSnapshot');
        Route::get('/admin/snapshot/take', 'SnapshotController@takeDbSnapshot')->name('snapshot.take');
        Route::post('/admin/snapshot/upload', 'SnapshotController@upload')->name('snapshot.upload');
        Route::post('/admin/snapshot/reload', 'SnapshotController@reload')->name('snapshot.reload');
        Route::get('/admin/evaluationgrid', 'EvaluationGridController@index');
        Route::get('/mailing','MailingController@mailling');
        Route::get('/flocks', 'FlocksController@index');
        Route::get('/params', 'ParamsController@index');
        Route::post('/params/update', 'ParamsController@update');
    });
    
    Route::get('/about', function () {
        return view('about');
    });

    // Route::resource('remarks','RemarksController');
    Route::get('/remarks','RemarksController@index')->name('remarks.index'); 
    Route::post('/remarks','RemarksController@index')->name('remarks.store'); 
    Route::get('/remarks','RemarksController@index')->name('remarks.create'); 
    Route::get('/remarks/{id}','RemarksController@index')->name('remarks.show'); 
    Route::put('/remarks/{id}','RemarksController@index')->name('remarks.update'); 
    Route::delete('/remarks/{id}','RemarksController@index')->name('remarks.destroy'); 
    Route::get('/remarks/{id}/edit','RemarksController@index')->name('remarks.edit'); 

    Route::post('/remarks/filter','RemarksController@filter')->name("remark.filter");
    Route::post('/remarks/ajax/add','RemarksController@ajaxCreate');

    Route::post("/entreprise/{id}", 'InternshipsController@enterFormInDb');

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
    Route::get('/synchro/{message?}', 'SynchroController@index')->name('synchro.index');
    Route::post('/synchro/modify', 'SynchroController@modify')->name('synchro.store');

    // Jean-Yves
    Route::get('/visits','VisitsController@index');
    Route::post('/visits','VisitsController@filter');
    Route::post('/visits/create','VisitsController@create');
    Route::post('/visits/remarks','VisitsController@addRemarks');
    Route::get('/visits/{rid}/manage','VisitsController@manage')->name("visit.manage");
    Route::post('/visits/{id}/sendMail', 'VisitsController@sendMail');
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

    // Nicolas - Stages
    Route::get('/reconstages', 'ReconStagesController@index')->name('reconstage.index');
    Route::post('/reconstages/reconducted', 'ReconStagesController@reconducted')->name('reconstage.reconducted');
    // Nicolas - Documents
    Route::get('/documents', 'DocumentsController@index');

    // Davide
    Route::get('/people', 'PeopleController@index');
    Route::get('/people/create', 'PeopleController@create')->name("person.create");
    Route::get('/people/{id}','PeopleController@show')->name("person.show");
    Route::get('/people/{id}/edit','PeopleController@edit')->name("person.edit");
    Route::put('/people/{id}','PeopleController@update')->name("person.update");

    Route::post('/people/category', 'PeopleController@category');
    Route::post('/people/changeCompany','PeopleController@changeCompany');
    Route::post('/contact/delete','PeopleController@deleteContact');
    Route::post('/contact/add','PeopleController@addContact');

    //Life cicle
    Route::get('/editlifecycle','LifeCycleController@index');

    Route::post('/addlifecycle','LifeCycleController@addEmptyContractState');
    Route::post('/removelifecycle','LifeCycleController@removeLifeCycleState');

});
    
//Azure
Route::get('/auth/azure', 'Auth\AuthController@redirectToProvider')->name('login');
Route::get('/callback', 'Auth\AuthController@handleProviderCallback');
Route::post('/auth/logout', 'Auth\AuthController@logoutUser');

