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


Route::prefix('/sites')->group(function () {
	Route::get('', 'SitesController@index');
	Route::get('/create', 'SitesController@create');
	Route::post('/store' , 'SitesController@store');
	Route::get('/{id}' , 'SitesController@show');
	Route::get('/edit/{id}', 'SitesController@edit');
	Route::post('/update/{id}', 'SitesController@update');
	Route::get('/delete/{id}', 'SitesController@destroy');
});

Route::prefix('/departments')->group(function () { 
	Route::get('', 'DepartmentsController@index');
	Route::get('/create', 'DepartmentsController@create');
	Route::post('/store' , 'DepartmentsController@store');
	Route::get('/{id}' , 'DepartmentsController@show');
	Route::get('/edit/{id}', 'DepartmentsController@edit');
	Route::post('/update/{id}', 'DepartmentsController@update');
	Route::get('/delete/{id}', 'DepartmentsController@destroy');
});

Route::prefix('/calendar')->group(function () { 
	Route::get('', 'CalendarController@index');
	Route::get('/create', 'CalendarController@create');
	Route::post('/store' , 'CalendarController@store');
	Route::get('/search' , 'CalendarController@search');
	// Route::get('/getdata', 'CalendarController@getData');
	// Route::get('/{id}' , 'CalendarController@show');
	// Route::get('/edit/{id}', 'CalendarController@edit');
	// Route::post('/update/{id}', 'CalendarController@update');
	// Route::get('/delete/{id}', 'CalendarController@destroy');
});

