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
Route::prefix('/users')->group(function () {
	Route::get('', 'UsersController@index');
	Route::get('/create', 'UsersController@create');
	Route::get('/{id}', 'UsersController@show')->where('id','[0-9]+'); //the where() cointraints the {id} to be an integer.
	Route::get('/edit/{id}', 'UsersController@edit');
	Route::post('/update/{id}', 'UsersController@update');
	Route::get('/delete/{id}', 'UsersController@destroy');
	Route::post('','UsersController@store');	
});


Route::prefix('/tasks')->group(function () {
	Route::get('', 'TasksController@index');
	Route::get('/create', 'TasksController@create');
	Route::post('/store', 'TasksController@store');
	Route::get('/edit/{id}', 'TasksController@edit');
	Route::post('/update/{id}', 'TasksController@update');
	Route::get('/delete/{id}', 'TasksController@destroy');	
});


Route::prefix('/company')->group(function () {
    Route::get('', 'CompanyController@index');
	Route::get('/create', 'CompanyController@create');
	Route::post('/store', 'CompanyController@store');
	Route::get('/{id}', 'CompanyController@show');
	Route::get('/edit/{id}', 'CompanyController@edit');
	Route::post('/update/{id}', 'CompanyController@update');
	Route::get('/delete/{id}', 'CompanyController@destroy');
});

