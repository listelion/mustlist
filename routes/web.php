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

Route::get('/', 'HomeController@index')->middleware('auth');
Route::get('/test', 'HomeController@test');
Route::get('/category/create', 'CategoryController@create')->name('categories.create')->middleware('auth');
Route::post('/category', 'CategoryController@store')->name('categories.store')->middleware('auth');

Route::get('/todo/{todo}/complete', 'TodoController@complete')->name('todo.complete')->middleware('auth');
Route::post('/todo/{todo}/complete', 'TodoController@completeStore')->name('todo.completeStore')->middleware('auth');

Route::resource('todo', 'TodoController')->middleware('auth');
Route::resource('time', 'TimeController')->middleware('auth');
Route::resource('memory', 'MemoryController')->middleware('auth');
Route::resource('word', 'WordController')->middleware('auth');
Route::resource('korean_gubun', 'Korean_gubunController')->middleware('auth');

Route::get('/study', 'StudyController@index')->middleware('auth');
Route::get('/study/create', 'StudyController@create')->middleware('auth');

