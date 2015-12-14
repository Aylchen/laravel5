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

Route::group(['prefix' => 'user', 'middleware' => 'is_login'], function () {

    Route::get('profile', 'UserController@profile');

    Route::get('comments', 'UserController@comments');

    Route::get('comments/delete/{id}', 'CommentController@destroy');

    Route::get('comments/{id}', 'CommentController@edit');

    Route::patch('comments/{id}', 'CommentController@update');

    Route::get('articles', 'UserController@articles');

});

Route::get('/admin/login', 'AdminController@login');

Route::post('/admin/login', 'AdminController@doLogin');

Route::get('/admin/logout', 'AdminController@doLogout');


Route::group([ 'prefix' => 'admin', 'middleware' => 'admin_auth'], function () {

    Route::get('/', 'AdminController@index' );

    Route::group(['prefix' => 'permissions'], function () {

        Route::get('/', 'AdminController@permissions');

        Route::post('delete', 'AdminController@permission_delete');

        Route::post('edit', 'AdminController@permission_edit');
    });

    Route::group(['prefix' => 'roles'], function () {

        Route::get('/', 'AdminController@roles');

        Route::post('delete', 'AdminController@role_delete');

        Route::post('edit', 'AdminController@role_edit');
    });

    Route::group(['prefix' => 'administrators'], function () {

        Route::get('/', 'AdminController@administrators');

        Route::post('delete', 'AdminController@administrator_delete');

        Route::post('edit', 'AdminController@administrator_edit');
    });

    Route::group(['prefix' => 'users'], function () {

        Route::get('/', 'AdminController@users');

        Route::post('delete', 'AdminController@user_delete');

    });

    Route::group(['prefix' => 'articles'], function () {

        Route::get('/', 'AdminController@articles');

        Route::post('delete', 'AdminController@article_delete');

    });

    Route::group(['prefix' => 'comments'], function () {

        Route::get('/', 'AdminController@comments');

        Route::post('delete', 'AdminController@comment_delete');

    });


});
