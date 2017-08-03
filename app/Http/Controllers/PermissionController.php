<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class PermissionController extends Controller
{
    
    public function __construct()
    {
    	$this->middleware('auth');
    }
    
    public function index()
    {
    	$permissions = Permission::paginate(10);
    	// dd($permissions);
    	return view('/permissions/index', compact('permissions'));
    }

    public function create()
    {
    	return view('/permissions/create');
    }

    public function store(Request $request)
    {
    	$this->validate(request(),[
    		'name' => 'required',
    		'description' => 'required',
		]);


		if($request->create){
			$slug = 'create-' . str_replace(' ', "-", request('name'));
			$name = 'create-' . request('name');
			Permission::create([
				'name' => $name,
				'slug' => $slug,
				'description' => request("description"),
			]);
		}
		if($request->update){
			$slug = 'update-' . str_replace(' ', "-", request('name'));
			$name = 'update-' . request('name');
			Permission::create([
				'name' => $name,
				'slug' => $slug,
				'description' => request("description"),
			]);
		}
		if($request->read){
			$slug = 'read-' . str_replace(' ', "-", request('name'));
			$name = 'read-' . request('name');
			Permission::create([
				'name' => $name,
				'slug' => $slug,
				'description' => request("description"),
			]);
		}
		if($request->delete){
			$slug = 'delete-' . str_replace(' ', "-", request('name'));
			$name = 'delete-' . request('name');
			Permission::create([
				'name' => $name,
				'slug' => $slug,
				'description' => request("description"),
			]);
		}
		return redirect('permissions');
	}

	public function destroy($id)
	{
		$permission = Permission::find($id);
		$permission->delete();

		return back();
	}
}
