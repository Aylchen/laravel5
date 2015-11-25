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

Route::get('/',['middleware'=>'auth',function () {
    return view('welcome');
}]);
//
/**
    Method2: Route::get('/', function () {return view('welcome');})->middleware('auth');
    Method3: Route::group(['middleware' => 'auth'], function () {
        Route::get('/', function () {
        return view('welcome');
        }) ;
    });
 */
Route::get('/publish', 'ArticleController@publish');

Route::post('/publish','ArticleController@store');

/*Route::get('/auth/login', 'Auth\AuthController@getLogin');

Route::post('/auth/login', 'Auth\AuthController@postLogin');

Route::get('/auth/register', 'Auth\AuthController@getRegister');

Route::post('/auth/register', 'Auth\AuthController@postRegister');

Route::get('/auth/logout', 'Auth\AuthController@getLogout');*/

Route::controller('auth', 'Auth\AuthController');

Route::get('/users', 'UserController@index');