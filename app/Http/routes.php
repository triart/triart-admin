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

    Route::get('/artworker', ['uses' => 'ArtworkerController@index']);
    Route::get('/artworker/create', ['uses' => 'ArtworkerController@createForm']);
    Route::post('/artworker', ['uses' => 'ArtworkerController@store']);
    Route::get('/artworker/{id}', ['uses' => 'ArtworkerController@view']);
    Route::put('/artworker/{id}', ['uses' => 'ArtworkerController@update']);
    Route::get('/artworker/{id}/delete', ['uses' => 'ArtworkerController@delete']);
    Route::post('/avatar/{id}', ['uses' => 'ArtworkerController@uploadAvatar']);

    Route::get('artworker/{artworker_id}/arts', ['uses' => 'ArtController@index']);

});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
