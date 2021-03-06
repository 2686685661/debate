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

Route::post('/login', 'LoginController@login');
Route::get('/', function () {
    return view('index');
});
Route::group(['middleware' => ['login_check']], function () {
    Route::get('/welcome', function () {
        return view('welcome');
    });
    Route::group(['prefix' => 'user'], function() {

    });
    Route::group(['prefix' => 'debate'], function() {
        Route::post('/change', 'DebateController@change');
        Route::get('/getNum', 'DebateController@getNum');
        Route::post('/option', 'DebateController@option');
        Route::get('/getOption','DebateController@getOption');
        Route::get('/getUser','DebateController@getUser');
        Route::post('/updateUser','DebateController@updateUser');

        Route::get('/getCount','DebateController@getCount');
    });
});

