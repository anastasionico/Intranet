<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Site;
class DepartmentsController extends Controller
{
 	public function index()
 	{
 		$departments = Department::all();
 		return view('departments/index', compact('departments')); 
 	}

 	public function create()
 	{
 		$sites = Site::all();
 		return view('departments/create', compact('sites'));
 	}

 	public function store(Request $request)
 	{
 		$this->validate(request(), [
 			'name' => 'required',
 			'site' => 'required',
 			'cost_center_last' => 'required',
 		]);

 		Department::create([
 			'name' => request('name'),
			'cost_center_last' => request('cost_center_last'),
			'site_id' => request('site'),
		]);
		return redirect('/departments');
 	}

 	public function show($id)
 	{
 		$department = Department::find($id);
 		return view('/departments/show' , compact('department'));
 	}

 	public function edit($id){
 		$sites = Site::all();
 		$department = Department::find($id);
 		return view('/departments/edit' , compact('department', 'sites'));
 	}

 	public function update(Request $request, $id)
 	{
 		$this->validate(request(), [
 			'name' => 'required',
 			'site' => 'required',
 			'cost_center_last' => 'required',
 		]);

 		$department = Department::find($id);
 		$department->name = request('name');
 		$department->cost_center_last = request('cost_center_last');
 		$department->site_id = request('site');
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
