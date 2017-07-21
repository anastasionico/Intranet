<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;


class UsersController extends Controller
{
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
        $users = User::all();
        $departments = Department::all();
        return view('/users/create' , compact('departments','users'));
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
        //validion
        $this->validate(request(),[
            'img' => 'nullable|image|dimensions:max-width:1024',
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'job_title' => 'required',
            'job_level' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:3|alpha_num',
            'password' => 'required|confirmed',
            'birthdate' => 'nullable|date|before:yesterday',
            'department_id' => 'required|integer',
            'personal_manager' => 'required|integer',
            'expenses_mileage_rate' => 'nullable',
            'holiday_total' => 'required|integer',
            'holiday_taken' => 'required|integer',
        ]);
        
        //store
        User::create([
            'name' => request('name'),
            'surname' => request('surname'),
            'job_title' => request('job_title'),
            'level' => request('job_level'),
            'email' => request('email'),
            'username' => request('username'),
            'password' => bcrypt(request('password')),
            'birthdate' => request('birthdate'),
            'department_id' => request('department_id'),
            'manager_id' => request('personal_manager'),
            'expenses_mileage_rate' => request('expenses_mileage_rate'),
            'holiday_total' => request('holiday_total'),
            'holiday_taken' => request('holiday_taken'),
        ]);
        
        //redirect to home page   
        return redirect('/users');
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
        $personal_manager_id = $user->manager_id;
        $personal_manager = User::find($personal_manager_id);
        $department = Department::where('id', $user->department_id)->first();
                
        return view('/users/show', compact('user','department','personal_manager') );
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
        $personal_manager_id = $user->manager_id;
        $departments = Department::all();

        $personal_manager = User::find($personal_manager_id);
        
        // dd($user);
        return view('users/edit', compact('users', 'user','departments','personal_manager'));
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
        // dd($request->all() );
        //VALIDATION
        $this->validate(request(),[
            'img' => 'nullable|image|dimensions:max-width:1024',
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'job_title' => 'required',
            'job_level' => 'required',
            'email' => 'required|email',
            'username' => 'required|min:3|alpha_num',
            'password' => 'required|confirmed',
            'birthdate' => 'nullable|date|before:yesterday',
            'department_id' => 'required|integer',
            'personal_manager' => 'required|integer',
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
}
