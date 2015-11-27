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

/**
    Method1: Route::get('/',['middleware'=>'auth',function () {
        return view('welcome');
    }]);

    Method2: Route::get('/', function () {return view('welcome');})->middleware('auth');
    Method3: Route::group(['middleware' => 'auth'], function () {
        Route::get('/', function () {
        return view('welcome');
        }) ;
    });
 */
Route::get('/', function () {
    return  view('welcome');
});

Route::controller('auth', 'Auth\AuthController');

Route::get('/users', 'UserController@index');

Route::get('/test', 'UserController@test');

/*Route::get('/articles', 'ArticleController@index');

Route::get('/articles/{id}', 'ArticleController@show');

Route::get('/articles/create', 'ArticleController@create');

Route::post('/articles','ArticleController@store');

Route::get('/articles/{id}/edit', 'ArticleController@edit');*/

Route::resource('articles', 'ArticleController');