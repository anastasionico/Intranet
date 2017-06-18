<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Site;
use App\User;

class DepartmentsController extends Controller
{
 	public function index()
 	{
 		$users = User::all();
 		$departments = Department::all();
 		return view('departments/index', compact('departments','users')); 
 	}

 	public function create()
 	{
 		$users = User::all();
 		$sites = Site::all();
 		return view('departments/create', compact(['sites','users']));
 	}

 	public function store(Request $request)
 	{
 		$this->validate(request(), [
 			'name' => 'required',
 			'site' => 'required',
 			'manager' => 'required',
 			'cost_center_last' => 'required',
 		]);

 		Department::create([
 			'name' => request('name'),
			'site_id' => request('site'),
			'manager_id' => request('manager'),
			'cost_center_last' => request('cost_center_last'),
			
		]);
		return redirect('/departments');
 	}

 	public function show($id)
 	{
 		$department = Department::find($id);
 		return view('/departments/show' , compact('department'));
 	}

 	public function edit($id){
 		$users = User::all();
 		$sites = Site::all();
 		$department = Department::find($id);
 		return view('/departments/edit' , compact('department', 'sites','users'));
 	}

 	public function update(Request $request, $id)
 	{
 		
 		$this->validate(request(), [
 			'name' => 'required',
 			'site' => 'required',
 			'manager' => 'required|numeric',
 			'cost_center_last' => 'required',
 		]);

 		$department = Department::find($id);
 		$department->name = request('name');
 		$department->site_id = request('site');
 		$department->manager_id = request('manager');
 		$department->cost_center_last = request('cost_center_last');
 		$department->save();

		return redirect('/departments');	
 	}

 	public function destroy($id)
 	{
 		$department = Department::find($id);
 		$department->delete();

 		return redirect('/departments');
 	}
}
