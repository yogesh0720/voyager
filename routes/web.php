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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    //Inquiry
    Route::get('inquiry', ['uses' => 'Voyager\InquiryController@index', 'as' => 'index']);
    Route::get('inquiry/create', ['uses' => 'Voyager\InquiryController@create', 'as' => 'create']);

    Route::post('inquiry', ['uses' => 'Voyager\InquiryController@store',   'as' => 'store']);

    Route::get('inquiry/{id}', ['uses' => 'Voyager\InquiryController@show',   'as' => 'show']);
    Route::get('inquiry/{id}/edit', ['uses' => 'Voyager\InquiryController@edit', 'as' => 'edit']);

    Route::put('inquiry/{id}', ['uses' => 'Voyager\InquiryController@update',  'as' => 'update']);
    Route::delete('inquiry/{id}', ['uses' => 'Voyager\InquiryController@destroy',  'as' => 'delete']);
});
