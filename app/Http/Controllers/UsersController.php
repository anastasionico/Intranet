<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class UsersController extends Controller
{
    use EntrustUserTrait; // add this trait to your user model
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('/users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderby('name')->get();
        $departments = Department::orderby('name')->get();
        $roles = Role::orderby('name')->get();
        return view('/users/create' , compact('departments','users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());    
        $this->validate(request(),[
            'name' => 'required',
            'surname' => 'required',
            'role_id' => 'required|exists:roles,id',
            'level' => 'required',
            'email' => 'required',
            'username' => 'required',
            'department_id' => 'required|exists:departments,id',
            'manager_id' => 'required|exists:users,id',
            'expenses_mileage_rate' => 'required',
            'holiday_total' => 'required',
            'holiday_taken' => 'required',
        ]);
        
        $newUser = User::create([
            'name' => request('name'),
            'surname' => request('surname'),
            'role_id' => request('role_id'),
            'level' => request('level'),
            'email' => request('email'),
            'username' => request('username'),
            'password' => bcrypt(request('password')),
            'birthdate' => request('birthdate'),
            'department_id' => request('department_id'),
            'manager_id' => request('manager_id'),
            'expenses_mileage_rate' => request('expenses_mileage_rate'),
            'holiday_total' => request('holiday_total'),
            'holiday_taken' => request('holiday_taken'),
        ]);
        $newUser->roles()->attach(request('role_id'));

        return redirect('/users/' . $newUser->id );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        // dd($user->can('user-update'));
        $manager = User::find($user->manager_id);
        $department = Department::where('id', $user->department_id)->first();
        return view('/users/show', compact('user','department','manager') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $user = User::find($id);
        $departments = Department::all();
        $roles = Role::orderby('name')->get();
        $manager = User::find($user->manager_id);
        
        return view('users/edit', compact('users', 'user','departments','manager','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(),[
            'img' => 'nullable|image|dimensions:max-width:1024',
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'role_id' => 'required',
            'level' => 'required',
            'email' => 'required|email',
            'username' => 'required|min:3|alpha_num',
            'birthdate' => 'nullable|date|before:yesterday',
            'department_id' => 'required|integer',
            'manager_id' => 'required|integer',
            'expenses_mileage_rate' => 'nullable',
            'holiday_total' => 'required|integer',
            'holiday_taken' => 'required|integer',
        ]);
        
        //UPDATE
        User::updateUser($request, $id);
        
        //REDIRECT TO SHOW PAGE
        return redirect("/users/{$id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users');
    }

    public function editPassword()
    {
        return view('users.updatepassword');
    }
    public function updatePassword(request $request)
    {
        $this->validate(request(),[
            "oldPassword" => 'required',
            "password" => 'required|confirmed',
        ]);

        $user_oldPassword =  Auth::user()->password;
        if(!password_verify($request->input('oldPassword'), $user_oldPassword)){
            $request->session()->flash('alert-danger', 'Sorry The old password is not correct');
            return redirect('/users/editpassword');
        }

        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $request->session()->flash('alert-success', 'You have changed your password');
        return redirect('/users/editpassword');
    }
}
