<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', 'DashboardController@home');

    /**
     * Artworker Endpoints
     */
    Route::post('/artworker', 'ArtworkerController@create');
    Route::get('/artworker/{id}', 'ArtworkerController@view');
    Route::post('/artworker/{id}/update', 'ArtworkerController@update');
    Route::post('/artworker/{id}/delete', 'ArtworkerController@delete');

});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
