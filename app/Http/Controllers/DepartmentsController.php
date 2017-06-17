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
}
