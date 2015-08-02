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

Route::get('/', 'PagesController@home');

Route::get('/dashboard', [
    'middleware' => 'auth',
    'uses' => 'PagesController@dashboard'
]);

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('auth/login-fail', 'Auth\AuthController@getLoginFail');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Bookmark routes
Route::get('bookmark', 'BookmarksController@index');
Route::get('bookmark/{id}', 'BookmarksController@find');
Route::get('bookmark/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'BookmarksController@getEdit'
]);
Route::post('bookmark/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'BookmarksController@postEdit'
]);
Route::post('bookmark/create', [
    'middleware' => 'auth',
    'uses' => 'BookmarksController@postCreate'
]);