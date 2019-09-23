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

/**
 * TODO : action 함수명은 영어식 표현을 따릅니다.
 */
Route::get('/todo/{todo}/complete', 'TodoController@complete')->name('todo.complete');
Route::post('/todo/{todo}/complete', 'TodoController@storeComplete')->name('todo.store_complete');

/**
 * TODO : 안쓰는 action 을 disable 하거나 그냥 각각 분리해서 표현하세요.
 */
Route::resource('todo', 'TodoController');
Route::resource('time', 'TimeController');
Route::resource('memory', 'MemoryController');
