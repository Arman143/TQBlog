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

Route::get('/', 'DashboardController@index');
Auth::routes();

Route::get('/dashboard/', 'DashboardController@index');

Route::group(['namespace' => 'Dashboard'], function () {
    Route::get('dashboard/posts/ajax', 'PostsController@ajax');
    Route::post('dashboard/posts/ajax-image-upload', 'PostsController@ajaxImageUpload');
    Route::resource('dashboard/posts', 'PostsController');
});

Route::group(['namespace' => 'Dashboard'], function () {
    Route::get('dashboard/users/ajax', 'UsersController@ajax');
    Route::resource('dashboard/users', 'UsersController');
});

Route::group(['namespace' => 'Dashboard'], function () {
    Route::get('dashboard/categories/ajax', 'CategoriesController@ajax');
    Route::resource('dashboard/categories', 'CategoriesController');
});