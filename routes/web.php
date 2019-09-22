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

Route::get('/', 'HomeController@index');
Route::get('/category/create', 'CategoryController@create')->name('categories.create');
Route::post('/category', 'CategoryController@store')->name('categories.store');

Route::get('/todo/{todo}/complete', 'TodoController@complete')->name('todo.complete');
Route::post('/todo/{todo}/complete', 'TodoController@complete_store')->name('todo.complete_store');

Route::resource('todo', 'TodoController');
Route::resource('time', 'TimeController');
Route::resource('memory', 'MemoryController');