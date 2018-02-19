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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    $users = \App\User::all();
    $user = \App\User::find(Auth::user()->id);
    $manager = \App\User::find($user->manager_id);
    $tasksUser = \App\Task::select('*')
        ->where('user_id', '=', Auth::user()->id)
        ->count();
    $tasksUserDone = \App\Task::select('*')
        ->where('user_id', '=', Auth::user()->id)
        ->where('done', '=', 1)
        ->count();
	$tasksChart = \App\Task::selectRaw('count(*) count, date(updated_at) date')
        ->groupBy('date')
        ->orderByRaw('min(updated_at)')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

    foreach($tasksChart as $task){
    	$taskDate[] = $task->date;
		$taskCount[] = $task->count;
    };
    $i=1;
    
    $OrgChart = null;
    $OrgChartmanager = null;

    foreach ($users as $OrgChartUser) {
    	
    	$OrgChart[$i]['fullname'] = $OrgChartUser->name . " " . $OrgChartUser->surname;
    	$OrgChart[$i]['title'] = $OrgChartUser->job_title;
    	$OrgChartmanager = \App\User::select('name', 'surname')
    		->where('id', '=', $OrgChartUser->manager_id)->first()->toArray();	
		$OrgChartmanager = implode(' ', $OrgChartmanager);
        $OrgChart[$i]['manager'] = $OrgChartmanager;
		
    	$i++;
    };
    
    return view('admin', compact('users', 'user', 'manager','tasksUser', 'tasksUserDone', 'taskDate','taskCount', 'OrgChart'));
})->middleware('auth')->name('dashboard');



Route::get('/home', 'UsersController@index')->name('home');

Route::get('/guestregistration', function(){
	return view('users.guestregistration');
});

Route::prefix('/users')->group(function() 
{
	Route::get('', 'UsersController@index');
	Route::get('/create', 'UsersController@create');

	Route::get('/{id}', 'UsersController@show')->where('id','[0-9]+'); //the where() cointraints the {id} to be an integer.
	Route::get('/edit/{id}', 'UsersController@edit');
	Route::post('/update/{id}', 'UsersController@update');
	Route::get('/delete/{id}', 'UsersController@destroy');
	Route::post('','UsersController@store');	
	Route::get('/editpassword', "UsersController@editPassword");
	Route::post('/updatepassword', "UsersController@updatePassword");
});

Route::prefix('/tasks')->group(function() 
{
	Route::get('', 'TasksController@index');
	Route::get('/create', 'TasksController@create');
	Route::post('/store', 'TasksController@store');
	Route::get('/edit/{id}', 'TasksController@edit');
	Route::post('/update/{id}', 'TasksController@update');
	Route::get('/delete/{id}', 'TasksController@destroy');	
});

Route::prefix('/company')->group(function() 
{
    Route::get('', 'CompanyController@index');
	Route::get('/create', 'CompanyController@create');
	Route::post('/store', 'CompanyController@store');
	Route::get('/{id}', 'CompanyController@show');
	Route::get('/edit/{id}', 'CompanyController@edit');
	Route::post('/update/{id}', 'CompanyController@update');
	Route::get('/delete/{id}', 'CompanyController@destroy');
});

Route::prefix('/sites')->group(function() 
{
	Route::get('', 'SitesController@index');
	Route::get('/create', 'SitesController@create');
	Route::post('/store' , 'SitesController@store');
	Route::get('/{id}' , 'SitesController@show');
	Route::get('/edit/{id}', 'SitesController@edit');
	Route::post('/update/{id}', 'SitesController@update');
	Route::get('/delete/{id}', 'SitesController@destroy');
});

Route::prefix('/departments')->group(function() 
{ 
	Route::get('', 'DepartmentsController@index');
	Route::get('/create', 'DepartmentsController@create');
	Route::post('/store' , 'DepartmentsController@store');
	Route::get('/{id}' , 'DepartmentsController@show');
	Route::get('/edit/{id}', 'DepartmentsController@edit');
	Route::post('/update/{id}', 'DepartmentsController@update');
	Route::get('/delete/{id}', 'DepartmentsController@destroy');
});

Route::prefix('/calendar')->group(function() 
{ 
	Route::get('', 'CalendarController@index');
	Route::get('/create', 'CalendarController@create');
	Route::get('/create/{date}', 'CalendarController@create');
	Route::post('/store' , 'CalendarController@store');
	Route::get('/search' , 'CalendarController@search');
	Route::get('/show/{id}' , 'CalendarController@show');
	Route::get('/department/{id}' , 'CalendarController@department');
	Route::get('/delete/{id}' , 'CalendarController@destroy');
});

Route::prefix('/holiday')->group(function()
{
	Route::get('', 'HolidayController@index');
	Route::get('/reports', 'HolidayController@reports');
	Route::get('/create', 'HolidayController@create');
	Route::get('/createTwo', 'HolidayController@create');
	Route::get('/create/{dateStart}/{dateEnd}', 'HolidayController@create');
	Route::post('/store', 'HolidayController@store');
	Route::get('/{id}' , 'HolidayController@show');
	Route::get('/accept/{id}' , 'HolidayController@accept');
	Route::get('/deny/{id}' , 'HolidayController@deny');
	Route::post('/delegate' , 'HolidayController@delegate');
	Route::get('/dept/{id}' , 'HolidayController@dept');
	Route::get('/edit/{id}', 'HolidayController@edit');
	Route::Post('/update/{id}' , 'HolidayController@update');
	Route::get('/delete/{id}', 'HolidayController@destroy');
});

Route::prefix('/roles')->group(function()
{
	Route::get('/','RoleController@index');
	Route::get('/create' , 'RoleController@create');	
	Route::post('/store', 'RoleController@store');	
	Route::get('/{id}', 'RoleController@show');
	Route::get('/edit/{id}', 'RoleController@edit');
	Route::Post('/update/{id}' , 'RoleController@update');
	Route::get('/delete/{id}', 'RoleController@destroy');
});

Route::prefix('/permissions')->group(function(){
	Route::get('/','PermissionController@index');
	Route::get('/create','PermissionController@create');
	Route::post('','PermissionController@store');
	Route::get('/delete/{id}', 'PermissionController@destroy');
	Route::get('/{id}', 'PermissionController@show');
	Route::get('/edit/{id}', 'PermissionController@edit');
	Route::Post('/update/{id}' , 'PermissionController@update');
});