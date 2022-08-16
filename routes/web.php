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

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome/{name}', function($name){
    return 'Hello..! Again Mr. '.$name;
})-> name('valid');

Route::get('Uknown/{name?}', function(){
    return 'Just Leave...!';
});

// Namespace
//Route::namespace('Front')->group(function () {
//
//    //all route only access controller or methods in folder app/Http/Controllers/Front
//
//    Route::get('test', 'UserController@showUserName');
//    Route::get('test1', function(){return 'test new namespace';});
//});

//////////////////
/* Route Prefix Lesson */

//Route::prefix('users')->group(function(){
//    Route::get('/', function(){return 'users';});
//    Route::get('show', function(){return 'show users';});
//    Route::get('edit', function(){return 'edit users';});
//});
//
//Route::group(['prefix'=>'users', 'middleware'=>'auth'], function(){
//    Route::get('profile',function(){return 'my profile';});
//});
//
//// middleware
//Route::get('adminMidlleware', function (){
//    return 'admin';
//})->middleware('auth');

//////////////////
/* Controller Namespace Lesson */

//Route::get('second', 'Admin\SecondController@showString');

//Route::namespace('Admin')->group(function(){
//    Route::get('second', 'SecondController@showString');
//});

//Route::group(['namespace'=>'Admin'], function (){
//    Route::get('second', 'SecondController@showString');
//});

//////////////////
/* Controller Middleware Lesson */

//Route::get('controllermiddleware', 'Admin\SecondController@showString')->middleware('auth');
Route::group(['namespace'=>'Admin'], function(){
//    Route::get('controllermiddleware','SecondController@showString')->middleware('auth');
    Route::get('controllermiddleware1','SecondController@showString1');
    Route::get('controllermiddleware2','SecondController@showString2');
    Route::get('controllermiddleware3','SecondController@showString3');
});

Route::get('login', function (){return 'Must Be Login';})->name('login');

//// for all routes
//Route::group(['middleware'=>'auth'],function(){
//    Route::get('ControllerMiddleware', function(){return 'controller middleware';});
//});


//////////////////
/* Controller Resource Lesson */

Route::resource('news', 'NewsController');

//////////////////
/* View Lesson */

//Route::get('testview', function(){
//    // must not use return view in route...
//        //return view('welcome')->with('name','omar');
//        return view('welcome')->with(['name'=>'omar', 'age'=>26]);
//});

Route::group(['namespace'=>'Front'],function(){
    Route::get('testview', 'UserController@showindex');
//    Route::get('testview', 'UserController@showindex');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/redirect/{service}', 'SocialController@redirect');
Route::get('/callback/{service}', 'SocialController@callback');

Route::group([
        'prefix'=>LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function(){
        Route::group(['prefix'=>'offers'], function(){
            Route::get('/', 'CrudController@index');
//    Route::get('store', 'CrudController@store');
            Route::get('create', 'CrudController@create');
            Route::post('store', 'CrudController@store')->name('offer_store');
        });

    });
