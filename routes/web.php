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
    return view('auth.login');
});

Auth::routes();

//Routes for the app home
Route::resource('home', 'HomeController');

// //Routes for the app error
// Route::get('/', 'HomeController@errors')->name('error');

//Routes pour Gestions des citoyens
Route::resource('/citoyens', 'GestionsCitoyensController');
Route::get('data/citoyens/print', 'GestionsCitoyensController@printCitoyens')->name('printCitoyens');
Route::get('data/citoyens/view', 'GestionsCitoyensController@viewdata')->name('viewAll');
Route::get('data/citoyens/excel', 'GestionsCitoyensController@getExcel')->name('getExcel');
Route::post('delete/citoyens/{id}', 'GestionsCitoyensController@delete')->name('delete');
Route::post('/filtrer-par-dates', 'GestionsCitoyensController@find')->name('findCitoyenRange');


//Routes pour Gestions des cartes consulaire
Route::resource('/cartes', 'GestionCartesConsulaireController');
Route::post('/cartes/find', 'GestionCartesConsulaireController@searchCitoyen')->name('searchCitoyen');
Route::get('/cartes/save', 'GestionCartesConsulaireController@save')->name('saveC');
Route::get('/carte/preview/{id}', 'GestionCartesConsulaireController@preview')->name('carteView');
Route::get('data/cartes/excel', 'GestionCartesConsulaireController@getExcel')->name('getExcelCartes');
Route::get('data/cartes/excel/print', 'GestionCartesConsulaireController@getExcelForCards')->name('getExcelCartesPrint');
Route::post('/cartes/filtrer-par-dates', 'GestionCartesConsulaireController@find')->name('findCarteRange');


//Routes pour Gestions des utilisateurs
Route::resource('/users', 'AdminController');
Route::post('/users-list', 'AdminController@check')->name('checka');
Route::patch('/users/update/{id}', 'AdminController@updateUser')->name('userUpdate');
Route::get('/users/restore/{id}', 'AdminController@restore')->name('userRestore');
//route redirected after a user has been created---> to do users list
Route::get('users-liste','AdminController@users')->name('allUsers');


//Routes pour Gestions des Laisser Passer
Route::resource('/pass', 'LasserPasserController');
Route::post('/pass/find', 'LasserPasserController@searchCitoyen')->name('searchCitoyens');
Route::get('/pass/pint/{id}', 'LasserPasserController@print')->name('passPrint');
Route::get('data/pass/excel', 'LasserPasserController@getExcel')->name('getExcelPass');
Route::post('/pass/filtrer-par-dates', 'LasserPasserController@find')->name('findPassRange');


//Routes pour Gestions des demandeurs de visa
Route::resource('/visa-demand', 'GestionVisasController');

//Routes pour Gestions des visas
Route::resource('/visas', 'VisasController');
// Route::post('/visas/find', 'LasserPasserController@searchAsker')->name('searchAsker');

//Routes pour Gestions des evenements
Route::resource('/events', 'EventController');

//Routes pour Gestions des naissances
Route::resource('/naissances', 'NaissanceController');
// Route::get('/naissances/print', 'NaissanceController@print')->name('printNaiss');
Route::get('data/naissances/excel', 'NaissanceController@getExcel')->name('getExcelNaiss');
Route::post('/naissances/filtrer-par-dates', 'NaissanceController@find')->name('findNaissRange');



//Routes pour Gestions des deces
Route::resource('/deces', 'DecesController');
Route::get('data/deces/excel', 'DecesController@getExcel')->name('getExcelDeces');
Route::post('/deces/filtrer-par-dates', 'DecesController@find')->name('findDecesRange');


//Routes pour Gestions des mariage
Route::resource('/mariage', 'MariageController');
Route::get('data/mariage/excel', 'MariageController@getExcel')->name('getExcelMariage');
Route::post('/mariage/filtrer-par-dates', 'MariageController@find')->name('findMariaRange');


//Routes pour les authorisatons
Route::resource('/authorisations', 'AuthorisationController');
Route::post('/authorisations/find', 'AuthorisationController@citoyen')->name('findCitoyen');
Route::get('/authorisations/print/{id}', 'AuthorisationController@print')->name('printAutorisation');
Route::get('data/authorisations/excel', 'AuthorisationController@getExcel')->name('getExcelAuto');
Route::post('/authorisations/filtrer-par-dates', 'AuthorisationController@find')->name('findAuthoRange');

//Routes pour les procurations
Route::resource('/procurations', 'ProcurationController');
Route::post('/procurations/find', 'ProcurationController@citoyen')->name('findCitoyen2');
Route::get('/procurations/print/{id}', 'ProcurationController@print')->name('printProcurations');
Route::get('data/procurations/excel', 'ProcurationController@getExcel')->name('getExcelProc');
Route::post('/procurations/filtrer-par-dates', 'ProcurationController@find')->name('findProcuRange');


//Routes pour Gestions des Legalisations
Route::resource('/legalisations', 'LegalisationsController');
Route::post('/legalisations/find', 'LegalisationsController@searchCitoyen')->name('searchCitoyenLegalisations');
Route::get('/legalisations/print/table', 'LegalisationsController@printPage')->name('printLeg');
Route::get('data/legalisations/excel', 'LegalisationsController@getExcel')->name('getExcelLega');
Route::post('/legalisations/filtrer-par-dates', 'LegalisationsController@find')->name('findLegaRange');
Route::get('legalisations/print/stamp/{id}', 'LegalisationsController@printStamp')->name('printStamp');

//Routes pour Gestions de la caisse
Route::resource('/caisse', 'CaisseController');
Route::get('/caisses/frais', 'CaisseController@frais');
// Route::get('/caisse/paiements', 'CaisseController@index')->name('paiementsCaisse');
Route::get('/print/receipt/{id}', 'CaisseController@printReceipt')->name('prinRecipts');

Route::post('/accept/laissez-passer', 'AcceptController@laisser')->name('passCard');
Route::post('/accept/carte-consulaire-n', 'AcceptController@cards')->name('consularCard');
Route::post('/accept/carte-consulaire-r', 'AcceptController@cardsr')->name('consularCardr');

Route::post('/accept/visas', 'AcceptController@visas')->name('visasAc');
Route::post('/accept/naissance', 'AcceptController@naissances')->name('naissa');
Route::post('/accept/deces', 'AcceptController@deces')->name('dece');
Route::post('/accept/mariage', 'AcceptController@mariages')->name('maria');
Route::post('/accept/authorisation', 'AcceptController@authorisations')->name('authorisation');
Route::post('/accept/procuration', 'AcceptController@procurations')->name('procuration');
Route::post('/accept/legalisations', 'AcceptController@legalisations')->name('legalisations');


//Routes pour Gestions des stocks
Route::resource('/stocks', 'GestionStocksController');
Route::post('/stocks/filter-par-mois', 'GestionStocksController@find')->name('findMonth');

//Routes pour Gestions des sorties
Route::resource('/sorties', 'GestionSortiesController');
Route::post('/sorties/filter-par-mois', 'GestionSortiesController@find')->name('findMonthSorties');

//Routes pour les verifications
Route::get('/verify/authorisation/{id}', 'VerifyController@verifAutho')->name('verifAutho');
Route::get('/verify/procuration/{id}', 'VerifyController@verifProc')->name('verifProc');
Route::get('/verify/naissance/{id}', 'VerifyController@verifNaiss')->name('verifNaiss');
Route::get('/verify/deces/{id}', 'VerifyController@verifDeces')->name('verifDeces');
Route::get('/verify/cic/{id}', 'VerifyController@verifCartes')->name('verifCartes');


//Routes pour les rapports
Route::resource('/rapports', 'RapportsController');
Route::post('/rapports/filtrer-par-dates', 'RapportsController@find')->name('findMonthRange');


//Routes pour les paramettres
Route::resource('/settings', 'Settings');
