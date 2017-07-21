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

 Route::get('/', 'PostsController@index');
Auth::routes();

Route::get('/dashboard/', 'DashboardController@index');

Route::get('dashboard/posts/get-posts', 'Dashboard\PostsController@getPosts');
Route::group(['namespace' => 'Dashboard'], function () {
    
    Route::resource('dashboard/posts', 'PostsController');
    
    
});


Route::resource('posts', 'PostsController');