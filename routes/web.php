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

// landing/home page route
Route::get('/', function () {
    return view('welcome');
});

// authentication routes
Auth::routes();

// home/dashboard route
Route::get('/home', 'HomeController@index')->name('home');

// projects routes
Route::get('/projects', 'ProjectsController@index')->middleware('auth');
Route::get('/projects/create', 'ProjectsController@create')->middleware('auth');
Route::post('/projects', 'ProjectsController@store')->middleware('auth');
Route::get('/projects/{id}', 'ProjectsController@show')->middleware('auth');
Route::get('/projects/{id}/edit', 'ProjectsController@edit')->middleware('auth');
Route::patch('/project', 'ProjectsController@update')->middleware('auth');
Route::delete('/project', 'ProjectsController@destroy')->middleware('auth');

// todos routes
Route::get('/project/{id}/todos', 'TodosController@index')->middleware('auth');
Route::get('/project/{id}/todos/create', 'TodosController@create')->middleware('auth');
Route::post('/todos', 'TodosController@store')->middleware('auth');
Route::get('/todos/{id}', 'TodosController@show')->middleware('auth');
Route::get('/todos/{id}/edit', 'TodosController@edit')->middleware('auth');
Route::patch('/todos', 'TodosController@update')->middleware('auth');
Route::delete('/todos', 'TodosController@destroy')->middleware('auth');