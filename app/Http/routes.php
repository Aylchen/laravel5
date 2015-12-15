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
 * *********************************Home*********************************
 */
Route::get('/', 'IndexController@index');

Route::get('/home', 'IndexController@home');

/**
 * ********************************Auth**********************************
 */
Route::controller('auth', 'Auth\AuthController');

/**
 * **************************RESET THE PASSWORD**************************
 */
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/**
 *  ******************************Article*********************************
 */
//article-all-search
Route::match(['get', 'post'], 'articles/index', 'ArticleController@index');

Route::get('/articles/{id}/delete', 'ArticleController@destroy');

Route::resource('articles', 'ArticleController');

/*
| when the user wants to submit a comment but he hasn't signed in,
| then jump to the auth/login page and then redirect back, the id below
| is the article_id
*/

Route::post('comments/{id}', 'CommentController@store');

Route::get('comments/{id}', function ($id) {
    return redirect('/articles/'.$id);
});

Route::resource('comments', 'CommentController');

/**
 *  *******************************USER*************************************
 */
Route::group(['prefix' => 'user', 'middleware' => 'is_login'], function () {

    Route::get('profile', 'UserController@profile');

    Route::get('comments', 'UserController@comments');

    Route::get('comments/delete/{id}', 'CommentController@destroy');

    Route::get('comments/{id}', 'CommentController@edit');

    Route::patch('comments/{id}', 'CommentController@update');

    // article-user-search
    Route::match(['get', 'post'], 'articles', 'UserController@articles');

});

/**
 *  *******************************Admin*************************************
 */
Route::get('admin/login', 'AdminController@login');

Route::post('admin/login', 'AdminController@doLogin');

Route::get('admin/logout', 'AdminController@doLogout');

Route::group([ 'prefix' => 'admin', 'middleware' => 'admin_auth'], function () {

    Route::get('/', 'AdminController@index' );

    /*
    | I still don't know how to simply the routes below,
    | admin/delete/{action}/admin/delete/{action} can do, but this can't be used
    | for the permission check in the middleware
    */

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
