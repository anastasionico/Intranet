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
    	$permissions = Permission::orderBy('name')->paginate(10);
    	
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
			$slug = str_replace(' ', "-", request('name')) . '-create';
			$name = request('name') . ' create';
			Permission::create([
				'name' => $name,
				'slug' => $slug,
				'description' => request("description"),
			]);
		}
		if($request->update){
			$slug = str_replace(' ', "-", request('name')) . '-update';
			$name = request('name') . ' update';
			Permission::create([
				'name' => $name,
				'slug' => $slug,
				'description' => request("description"),
			]);
		}
		if($request->read){
			$slug = str_replace(' ', "-", request('name')) . '-read';
			$name = request('name') . ' read';
			Permission::create([
				'name' => $name,
				'slug' => $slug,
				'description' => request("description"),
			]);
		}
		if($request->delete){
			$slug = str_replace(' ', "-", request('name')) . '-delete';
			$name = request('name') . ' delete';
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

		return redirect('/permissions');
	}

	public function show($id)
	{
		$permission = Permission::find($id);
		return view('/permissions/show', compact('permission'));
	}

	public function edit($id)
	{
		$permission = Permission::find($id);
		return view('/permissions/edit', compact('permission'));
	}
	public function update(Request $request, $id)
	{
		// dd($request->all());
		$this->validate(request(),[
    		'name' => 'required',
    		'description' => 'required',
		]);

		$name = $slug = str_replace(' ', "-", request('name'));

		$permission = Permission::find($id);
		$permission->name = $name;
		$permission->slug = $slug;
		$permission->description = request('description');
		$permission->save();

		return redirect('/permissions');
	}
}
