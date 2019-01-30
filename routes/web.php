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

Route::namespace('Admin')->prefix(config('app.url_admin'))->name(config('app.theme').'admin.')->group(function () {

    Route::get('', 'AdminController@index');

    Route::resource('categories', 'CategoryController');

    Route::resource('page-comments', 'PageCommentController');
    Route::resource('pages', 'PageController');

    Route::resource('post-comments', 'PostCommentController');
    Route::resource('posts', 'PostController');

    Route::resource('tags', 'TagController');

    Route::resource('users', 'UserController');
});

Route::group(['namespace' => 'Client'], function () {

    Route::get('/contact', 'ContactController@create')->name('contact.create');
    Route::post('/contact', 'ContactController@store')->name('contact.store');

    Route::prefix(config('app.url_blog'))->name(config('app.theme').'client'.config('app.url_blog'))->group(function () {

        Route::get('archive/{year}/{month?}/{day?}', 'BlogController@indexArchive');
        Route::get('category/{category}', 'BlogController@indexCategory');
        Route::get('{id}/{slug}', 'BlogController@page');
        Route::get('{slug?}', 'BlogController@index');
    });

    Route::get('/{any}', 'PageController@page')->where('any', '(.*)');
});