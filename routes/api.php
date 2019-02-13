<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('Api')->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('pages', 'PageController');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagController');
    Route::resource('users', 'UserController');
    Route::resource('page-comments', 'PageCommentController');
    Route::resource('post-comments', 'PostCommentController');
});
