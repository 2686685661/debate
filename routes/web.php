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

// Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');



Route::group(['middleware' => ['login_check']], function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::group(['prefix' => 'user'], function() {

    });
    Route::group(['prefix' => 'debate'], function() {
        Route::post('/change', 'DebateController@change');
        Route::get('/getNum', 'DebateController@getNum');
        Route::post('/option', 'DebateController@option');
        Route::get('/getOption','DebateController@getOption');
    });
});

