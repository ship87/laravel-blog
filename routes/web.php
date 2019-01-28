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

Auth::routes();

Route::group(['namespace' => 'Admin'], function () {

    Route::get(config('app.url_admin'), 'AdminController@index')->name('admin');

    Route::resource(config('app.url_admin').'/category', 'CategoryController');

    Route::resource(config('app.url_admin').'/pagecomment', 'PageCommentController');
    Route::resource(config('app.url_admin').'/page', 'PageController');

    Route::resource(config('app.url_admin').'/postcomment', 'PostCommentController');
    Route::resource(config('app.url_admin').'/post', 'PostController');

    Route::resource(config('app.url_admin').'/tag', 'TagController');

    Route::resource(config('app.url_admin').'/user', 'UserController');
});

Route::group(['namespace' => 'Client'], function () {

	Route::get(config('app.url_blog').'/archive/{year}/{month?}/{day?}', 'BlogController@indexArchive');
	Route::get(config('app.url_blog').'/category/{category}', 'BlogController@indexCategory');
    Route::get(config('app.url_blog').'/{id}/{slug}', 'BlogController@page');
    Route::get(config('app.url_blog').'/{slug?}', 'BlogController@index');

	Route::get('/contact', 'ContactController@create')->name('contact.create');
	Route::post('/contact', 'ContactController@store')->name('contact.store');

    Route::any('/{any}', 'PageController@page')->where('any', '(.*)');
});