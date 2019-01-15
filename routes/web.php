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

Route::get('/'.config('app.url_blog').'/{id?}/{slug?}', 'PostController@index');

Route::any('/{any}', 'PageController@index')->where('any', '(.*)');

