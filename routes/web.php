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

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
        Route::group(['prefix'=>'offers'], function(){
            Route::get('/', 'CrudController@index')->name('offers');
            Route::get('all', 'CrudController@index')->name('offers');
            Route::get('create', 'CrudController@create');
            Route::post('store', 'CrudController@store')->name('offer_store');
            Route::get('edit/{id}', 'CrudController@edit');
            Route::post('update/{id}', 'CrudController@update')->name('offer_update');
            Route::get('delete/{id}', 'CrudController@delete')->name('offer_delete');
        });
        Route::get('youtube', 'CrudController@getVideo')->middleware('auth');

    }
);
Route::group(['prefix'=>'ajax-offer'], function(){

    Route::get('create', 'OffersController@create')->name('ajax-create');
    Route::post('store', 'OffersController@store')->name('ajax-store');
    Route::get('all', 'OffersController@all')->name('ajax-all');
    Route::post('delete', 'OffersController@delete')->name('ajax-delete');
    Route::get('edit/{id}', 'OffersController@edit')->name('ajax-edit');
    Route::post('update', 'OffersController@update')->name('ajax-update');
});

Route::group(['namespace'=>'Auth',
            'middleware'=>['auth','checkage']], function(){
    Route::get('adults', 'CustomAuthContrller@checkAge');
});
Route::get('not-adults', function(){
    return 'Sorry, You\'re Not An Adult';
});

Route::group(['namespace'=>'Auth'], function(){

    Route::get('site', 'CustomAuthContrller@site')->name('site')->middleware('auth:web');
    
    Route::group(['prefix'=>'admin'], function(){
        Route::get('/', 'CustomAuthContrller@admin')->name('admin')->middleware('auth:admin');
        Route::get('login', 'CustomAuthContrller@adminLogin')->name('adminLogin');
        Route::post('login', 'CustomAuthContrller@saveAdminLogin')->name('saveAdminLogin');
    
    });
});
