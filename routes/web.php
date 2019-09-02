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

Route::get('/', 'PostsController@displayAll');

Route::resource('posts', 'PostsController');
// Route::get('posts', 'PostsController');
// Route::get('posts/create', 'PostsController');
// Route::get('posts/show', 'PostsController');
// Route::get('posts/index', 'PostsController');
// Route::get('posts/update', 'PostsController');
// Route::get('posts/edit', 'PostsController');
// Route::delete('posts/delete', 'PostsController');

Auth::routes();

Route::get('/home', 'PostsController@index')->name('home')->middleware('auth');
