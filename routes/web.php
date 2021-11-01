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


// Route::get('login', function () {
//     return 'Autantication required';
// })->name('login');


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
