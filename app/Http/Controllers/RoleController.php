<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$roles = Role::orderby('name')->get();
    	return view('/roles/index' ,compact('roles'));
    }
	
	public function create()
	{
	   	$permissions = Permission::orderby('name')->get();
        return view('/roles/create', compact('permissions'));
	}

	public function store(Request $request)
    {
        $this->validate(request(),[
    		'name' => 'required|unique:roles,name',
    		'description' => 'required',
		]);
		$slug = str_replace(' ', "-", $request->name);
		
		$newRole = Role::create([
			'name' => request('name'),
			'slug' => $slug,
			'description' => request('description'),
		]);
        
        $newRole->permissions()->sync(array_values($request->permissions));

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
        $permissions = Permission::orderby('name')->get();
        $permissionsPerRole = $role->permissions->pluck("id")->toArray();
    	return view('roles/edit', compact('role', 'permissions','permissionsPerRole'));
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
        $role->permissions()->sync(array_values($request->permissions));
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
