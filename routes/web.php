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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', function () {
    return view('admin.users.index');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth' ], function (){

    Route::group(['middleware' =>  'admin'], function () {
        Route::resource('users', 'UsersController');
        Route::get('users/{id}/destroy', [
            'uses' => 'UsersController@destroy',
            'as' => 'users.destroy'
        ]);
    });

    Route::resource('categories', 'CategoriesController');
    Route::get('categories/{id}/destroy', [
        'uses'=>'CategoriesController@destroy',
        'as' => 'categories.destroy'
    ]);

    Route::resource('tags', 'TagsController');
    Route::get('tags/{id}/destroy', [
        'uses'=>'TagsController@destroy',
        'as' => 'tags.destroy'
    ]);

    Route::resource('articles', 'ArticlesController');
    Route::get('articles/{id}/destroy', [
        'uses'=>'ArticlesController@destroy',
        'as' => 'articles.destroy'
    ]);

    Route::get('articles/categoria/{name}', [
        'uses'=>'ArticlesController@searchByCategoryName',
        'as' => 'articles.category'
    ]);

    Route::get('articles/tag/{id}', [
        'uses'=>'ArticlesController@searchByTagId',
        'as' => 'articles.tag'
    ]);

    Route::get('images', [
        'uses'=>'ImagesController@index',
        'as' => 'images.index'
    ]);

});

