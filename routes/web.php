<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ParcelleController;
use App\Http\Controllers\Admin\LogementController;
use App\Http\Controllers\Admin\PayController;
use App\Http\Controllers\Admin\notificationController;
use App\Http\Controllers\Users\payementsController;
use App\Http\Controllers\Admin\ActiController;
use App\Notifications\Admin\AjoutPaiement;
use App\Http\Controllers\Admin\PersonnelController;
use App\Http\Controllers\Admin\VersementtController;
use App\Http\Controllers\Admin\ConsulterVController;
use App\Http\Controllers\Admin\InscritActiController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\Exemptioncontroller;
use App\Http\Controllers\Admin\MembreController;
use App\Http\Controllers\Admin\ReglementCotiController;


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

Route::group(['middleware'=>\App\Http\Middleware\UserMidleware:: class],function(){
          Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('hom');
});

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function (){
        Route::get('dashboard',[App\Http\Controllers\Admin\DashdoardController::class, 'index']);
        Route::controller(App\Http\Controllers\Admin\SouscriptionsController::class)->group(function (){
        Route::get('/souscriptions','index');
        Route::get('/souscriptions/createL','createL');
        Route::get('/souscriptions/createP','createP');
        Route::get('/souscriptions/contrats','contrat');
        Route::post('/souscriptions','store');
        Route::get('/souscriptions/{souscriptions}/edit','edit');// le nom dans {} doit etre identique a celui dans le formulaire
        Route::put('/souscriptions/{souscriptions}','update');
        Route::get('/souscriptions/{sous_id}/showcontrats','show');
    });
    

});
Route::resource('Paiement', PayController::class);
Route::get('infopaie/{id}', [App\Http\Controllers\Admin\PayController::class, 'infopaie'])->name('voirpaie');
Route::resource('versements',VersementtController::class);
Route::resource('consulterV',ConsulterVController::class);



Route::controller(App\Http\Controllers\Users\payementsController::class)->group(function (){
    Route::get('/users/payements','index');
    Route::get('/users/payements/create/{id}','create');
    Route::POST('/users/payements/store','store');
    Route::get('/users/payements/{p}/edit','edit');
    Route::put('/users/payements/{p}','update');
    

});

Route::group(['middleware'=>\App\Http\Middleware\UserMidleware:: class],function(){ 
        Route::controller(App\Http\Controllers\Users\activiteController::class)->group(function (){
            Route::get('/users/activites/create','create');
            Route::post('/users/activites','store'); 
            Route::get('/users/activites','index');
 
        });
    });

Route::controller(App\Http\Controllers\Users\ConsulterVController::class)->group(function (){
    Route::get('/users/consulterV','index');
    Route::get('/users/consulterV/create','create');
    Route::post('/users/consulterV','store');   
});


Route::resource('Activite', ActiController::class);
Route::POST('activitetype',[ActiController::class, 'activitetype'])->name('activitetype');
Route::GET('actidetail/{id}',[ActiController::class, 'actidetail'])->name('routeactidetail');
Route::POST('actiedit/{id}',[ActiController::class,  'editactidetail'])->name('routedit');
Route::post('/events/{actividetails}/register', [ActiController::class, 'register'])->name('events.register');
Route::post('/events/{actividetails}/unregister', [ActiController::class, 'unregister'])->name('events.unregister');


Route::group(['middleware'=>\App\Http\Middleware\AdminMidleware:: class],function(){
            Route::resource('parcelle', ParcelleController::class);
            Route::resource('logement', LogementController::class);
            Route::POST('setactivite/{nombre}',[ActiController::class, 'setactiviteType'])->name('setactivite');
            Route::delete('actiremove/{id}',[ActiController::class, 'remove'])->name('routeremove');
            Route::POST('completdetail/{id}',[ActiController::class, 'ajoutactideail'])->name('completer');
            Route::POST('adminparticip',[ActiController::class, 'adminparticipation'])->name('adminparticip');
            Route::get('accepter/{id}', [App\Http\Controllers\admin\ActiController::class, 'RepParticipation'])->name('accepter');
            Route::get('refuser/{id}', [App\Http\Controllers\admin\ActiController::class, 'RefusParticip'])->name('refuser');
            Route::resource('operatnotify', notificationController::class);
            Route::resource('personnel',PersonnelController::class);
});
Route::resource('inscritActivite', InscritActiController::class);
Route::POST('incrit/{activite_id}', [App\Http\Controllers\admin\ActiController::class, 'notify'])->name('inscrit');
Route::get('insertOnInscription', [App\Http\Controllers\InscritActiController::class, 'store'])->name('insertOnInscription');

Route::group(['middleware'=>\App\Http\Middleware\AdminMidleware:: class],function(){
Route::get('markasred/{id}', [App\Http\Controllers\Admin\PayController::class, 'markasread'])->name('markasred');
Route::get('markonly/{id}', [App\Http\Controllers\Admin\PayController::class, 'markonly'])->name('markonly');
});
Route::get('test', [App\Http\Controllers\Admin\ActiController::class, 'test'])->name('test');
Route::get('notify', [App\Http\Controllers\Users\payementsController::class, 'notify'])->name('notify');


Route::group(['middleware'=>\App\Http\Middleware\AdminMidleware:: class],function(){
            Route::resource('membre', MembreController::class);
            Route::resource('regle', ReglementCotiController::class);
            Route::resource('categorie', CategorieController::class);
            Route::resource('exemption', Exemptioncontroller::class);
            Route::POST('membreregler/{id}', [MembreController::class, 'regler'])->name('reglercoti');
});
  





