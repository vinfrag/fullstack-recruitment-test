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
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
    
    Route::get('/cities', 'CityController@index');

    Route::get('/practices', 'PracticeController@index');
    Route::get('/practices-by-cities', 'PracticeController@getListByCities');

    Route::get('/therapists', 'TherapistController@index');
    Route::get( '/therapists/{city}/{practice}', 'TherapistController@getList');

    

});
