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


Route::get('/', 'IndexController@index');

Route::get('/home', 'IndexController@home');

Route::controller('auth', 'Auth\AuthController');

Route::get('/articles/{id}/delete', 'ArticleController@destroy');

Route::resource('articles', 'ArticleController');
//下边两个是发表评论时用，用户没有登录时需要先登录然后跳转回文章页面（这里的{id}为article id
Route::post('comments/{id}', 'CommentController@store');

Route::get('comments/{id}', function ($id) {

    return redirect('/articles/'.$id);

});

Route::resource('comments', 'CommentController');

Route::group(['prefix' => 'user'], function () {

    Route::get('profile', 'UserController@profile');

    Route::get('comments', 'UserController@comments');

    Route::get('comments/delete/{id}', 'CommentController@destroy');

    Route::get('comments/{id}', 'CommentController@edit');

    Route::patch('comments/{id}', 'CommentController@update');

    Route::get('articles', 'UserController@articles');

});