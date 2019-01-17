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

Route::get('/'.config('app.url_admin'), 'AdminController@index')->name('admin');

Route::get('/'.config('app.url_blog').'/{id}/{slug}', 'BlogController@page');

Route::get('/'.config('app.url_blog'), 'BlogController@index');

Route::any('/{any}', 'PageController@page')->where('any', '(.*)');

/*
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {
	Route::resource('/posts', 'PostController');
	Route::resource('/categories', 'CategoryController');
	Route::resource('/tags', 'TagController');
	Route::resource('/comments', 'CommentController');
});
*/