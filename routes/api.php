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


    Route::apiResource('categories', 'CategoryController');
    Route::apiResource('tags', 'TagController');
    Route::apiResource('users', 'UserController');
    Route::apiResource('page-comments', 'PageCommentController');
    Route::apiResource('post-comments', 'PostCommentController');
    Route::apiResource('metatags', 'MetatagController');
    Route::apiResource('pages', 'PageController');

    Route::get('pages/{page}/relationships/page-comments', [
        'uses' => 'PageRelationshipController@comments',
        'as' => 'pages.relationships.page-comments',
    ]);
    Route::get('pages/{page}/page-comments', [
        'uses' => 'PageRelationshipController@comments',
        'as' => 'pages.page-comments',
    ]);

    Route::get('pages/{page}/relationships/metatags', [
        'uses' => 'PageRelationshipController@metatags',
        'as' => 'pages.relationships.metatags',
    ]);
    Route::get('pages/{page}/metatags', [
        'uses' => 'PageRelationshipController@metatags',
        'as' => 'pages.metatags',
    ]);

    Route::apiResource('posts', 'PostController');
    Route::get('posts/{post}/relationships/post-comments', [
        'uses' => 'PostRelationshipController@comments',
        'as' => 'posts.relationships.post-comments',
    ]);
    Route::get('posts/{post}/post-comments', [
        'uses' => 'PostRelationshipController@comments',
        'as' => 'posts.post-comments',
    ]);

    Route::get('posts/{post}/relationships/metatags', [
        'uses' => 'PostRelationshipController@metatags',
        'as' => 'posts.relationships.metatags',
    ]);
    Route::get('posts/{post}/metatags', [
        'uses' => 'PostRelationshipController@metatags',
        'as' => 'posts.metatags',
    ]);

    Route::get('posts/{post}/relationships/categories', [
        'uses' => 'PostRelationshipController@categories',
        'as' => 'posts.relationships.categories',
    ]);
    Route::get('posts/{post}/categories', [
        'uses' => 'PostRelationshipController@categories',
        'as' => 'posts.categories',
    ]);

    Route::get('posts/{post}/relationships/tags', [
        'uses' => 'PostRelationshipController@tags',
        'as' => 'posts.relationships.tags',
    ]);
    Route::get('posts/{post}/tags', [
        'uses' => 'PostRelationshipController@tags',
        'as' => 'posts.tags',
    ]);
});


