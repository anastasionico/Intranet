<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$roles = Role::all();
    	return view('/roles/index' ,compact('roles'));
    }
	
	public function create()
	{
		return view('/roles/create');
	}

	public function store(Request $request)
    {
    	
    	$this->validate(request(),[
    		'name' => 'required|unique:roles,name',
    		'description' => 'required',
		]);
		$slug = str_replace(' ', "-", $request->name);
		
		Role::create([
			'name' => request('name'),
			'slug' => $slug,
			'description' => request('description'),
		]);

		return redirect('roles');
    }

    public function show($id)
    {
    	$role = Role::find($id);
    	return view('roles/show', compact('role'));
    }

    public function edit($id)
    {
    	$role = Role::find($id);
    	return view('roles/edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate(request(),[
    		'name' => 'required',
    		'description' => 'required',
		]);
		$slug = str_replace(' ', "-", $request->name);
		
		$role = Role::find($id);
		$role->name = request('name');
		$role->description = request('description');
		$role->slug = $slug;
		
		$role->save();

		return redirect('/roles');
    }

    public function destroy($id)
    {
    	$role = Role::find($id);
        $role->delete();

        return redirect('/roles');
    }
}
