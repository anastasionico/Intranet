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


Auth::routes();


Route::get('/home', 'UsersController@index')->name('home');

Route::get('/users', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::get('/users/{id}', 'UsersController@show')->where('id','[0-9]+'); //the where() cointraints the {id} to be an integer.
Route::get('/users/edit/{id}', 'UsersController@edit');
Route::post('/users/update/{id}', 'UsersController@update');
Route::get('/users/delete/{id}', 'UsersController@destroy');
Route::post('/users','UsersController@store');

Route::get('/tasks', 'TasksController@index');
Route::get('/tasks/create', 'TasksController@create');
Route::post('/tasks/store', 'TasksController@store');
Route::get('/tasks/edit/{id}', 'TasksController@edit');
Route::post('/tasks/update/{id}', 'TasksController@update');
Route::get('/tasks/delete/{id}', 'TasksController@destroy');

Route::get('/company', 'CompanyController@index');
Route::get('/company/create', 'CompanyController@create');
Route::post('/company/store', 'CompanyController@store');