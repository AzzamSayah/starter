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

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

define('PAGINATION_COUNT',3);

Route::get('/', function () {

    // $data = [];
    // $data['name'] = 'Azzam Sayah';
    // $data['age'] = 40;

    return view('welcome');


    //return view('welcome')-> with(['name' => 'Azzam Sayah', 'age' => 30]);

});

// Route::namespace('Front')-> group(function (){

// Route::get('users','UserController@showUserName');

// });

// Route::group(
//     ['namespace' => 'Front', 'middleware' => 'auth'],
//     function () {

//         Route::get('users', 'UserController@showUserName');
//     }
// );



// Route::get('check', function () {
//     return 'middleware';
// })->middleware('auth');


Route::get('login', function () {
    return 'Autantication required';
})->name('login');


// Route::group(['namespace' => 'Front'], function () {
//     Route::get('first', 'FirstController@showString');
// });

// Route::namespace('Front')->group(function () {
//     Route::get('hello1', 'FirstController@showString1');
//     Route::get('hello2', 'FirstController@showString2');
//     Route::get('hello3', 'FirstController@showString3');
//     Route::get('hello4', 'FirstController@showString4');
// });

//Route::resource('news', 'Front\NewsController');

Route::get('index', 'Front\UserController@getIndex');

// Route:: get('landing', function(){
// return view('landing');
// });

// Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('redirect/{service}', 'SocialController@redirect');
Route::get('callback/{service}', 'SocialController@callback');

Route :: get('fillable','CrudController@getOffers');

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
Route::group(['prefix' => 'offers'],function(){
    //Route::get('store', 'CrudController@store');

        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store')->name('offers-store');
        Route::get('all', 'CrudController@getAllOffers')->name('offers.all');

        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offers.update');
        
        Route::get('delete/{offer_id}', 'CrudController@deleteOffer')->name('offers.delete');

        Route::get('get-all-inactive-offers', 'CrudController@getAllInactiveOffers');
        
    });
    
Route::get('youtube','CrudController@getVideo')->middleware('auth');   

});

######################### begin ajax routes #######################

Route::group(['prefix' => 'ajax-offers'],function(){

    Route::get('create','OfferController@create');
    Route::post('store', 'OfferController@store') -> name('ajax.offers.store');
    Route::get('all', 'OfferController@all')->name('ajax.offers.all');
    Route::post('delete', 'OfferController@delete')->name('ajax.offers.delete');

        Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
        Route::post('update', 'OfferController@update')->name('ajax.offers.update');
});

######################### end ajax routes #######################




################## begin Authentication and guards ####################
Route :: get('NotAdult',function(){
    return "Not Allowed";
}) -> name('not.Adult');

Route::group(['middleware' => 'CheckAge','namespace' => 'Auth'],function(){

Route:: get('Adults','CustomAuthController@Adult') -> name('adult');

});

Route::group(['namespace' => 'Auth'],
    function () {

Route::get('admin', 'CustomAuthController@admin')->middleware('auth:admin')->name('admin');

Route::get('site', 'CustomAuthController@site')->middleware(('auth:web'))->name('site');

Route::get('admin/login', 'CustomAuthController@adminLogin')->name('admin.login');

Route::post('admin/login', 'CustomAuthController@checkAdminLogin')->name('save.admin.login');
    });
################## end Authentication and guards######################



############## begin one to one relations routes ################
Route::get('has-one','relations\RelationsController@hasOneRelation');
Route::get('has-one-reverse', 'relations\RelationsController@hasOneRelationReverse');
Route::get('get-users-has-phones', 'relations\RelationsController@getUsersHasPhones');

Route::get('get-users-has-phones-with-condition', 'relations\RelationsController@getUsersHasPhonesWithCondition');

Route::get('get-users-not-has-phones', 'relations\RelationsController@getUsersNotHasPhones');
############## end one to one relations routes ################


############## begin one to many relations routes ################

Route::get('hospital-has-many', 'relations\RelationsController@getHospitalDoctors');

Route::get('hospitals', 'relations\RelationsController@hospitals')->name('hospital.all');

Route::get('doctors/{hospital_id}', 'relations\RelationsController@doctors') -> name('hospital.doctors');

Route::get('doctors-delete/{hospital_id}', 'relations\RelationsController@deleteDoctors') -> name('hospital.doctors.delete');

Route::get('hospitals-has-doctors', 'relations\RelationsController@hospitalsHasDoctors');

Route::get('hospitals-has-doctors-male', 'relations\RelationsController@hospitalsHasDoctorsMale');
Route::get('hospitals-not-has-doctors', 'relations\RelationsController@hospitalsNotHaveDotors');

############## end one to many relations routes ################


############## begin many to many relations routes ################

Route::get('doctor-services','relations\RelationsController@getDoctorServices');

Route::get('service-doctors', 'relations\RelationsController@getServiceDoctors');

Route::get('doctors-services/{doctor_id}', 'relations\RelationsController@getDoctorServicesByDoctorID')->name('doctor.services');

Route::post('saveServices-to-doctor', 'relations\RelationsController@saveServicesToDoctor')->name('save.doctor.services');

############## end many to many relations routes ################



############## begin has one through relations routes ##############
Route::get('has-one-through', 'relations\RelationsController@getPatientDoctor');

Route::get('has-many-through', 'relations\RelationsController@getCountryDoctors');


############## end has one through relations routes ##############