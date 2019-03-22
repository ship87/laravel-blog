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

Route::get('/deneme', function () {
    echo url('deneme');
});


Route::get('/salla', function () {
    echo 'sallamasyon';
})->name('sallaURL');

Route::namespace('Admin')->name(config('app.theme').'admin.')->middleware(['auth'])->prefix(config('app.url_admin'))->group(function (
) {

    Route::get('', 'AdminController@index')->name('home');
    Route::get('images', 'ImageController@index');
    Route::resource('categories', 'CategoryController')->except('show');
    Route::resource('pages', 'PageController')->except('show');
    Route::resource('posts', 'PostController')->except('show');
    Route::resource('tags', 'TagController')->except('show');
    Route::resource('users', 'UserController')->except('show');
    Route::resource('page-comments', 'PageCommentController')->except('show');
    Route::resource('post-comments', 'PostCommentController')->except('show');
	Route::resource('roles', 'RoleController')->except('show');
	Route::resource('permissions', 'PermissionController')->except('show');
});

Route::group(['namespace' => 'Client'], function () {

    Route::get('/contact', 'ContactController@create')->name('contact.create');
    Route::post('/contact', 'ContactController@store')->name('contact.store');

    Route::prefix(config('app.url_blog'))->name(config('app.theme').'client'.config('app.url_blog'))->group(function (
    ) {
        Route::get('archive/{year}/{month?}/{day?}', 'BlogController@indexArchive');
        Route::get('category/{category}', 'BlogController@indexCategory');
        Route::get('{id}/{slug}', 'BlogController@page');
        Route::get('{slug?}', 'BlogController@index');
    });

    Route::get('/{any}', 'PageController@page')->where('any', '(.*)');
});