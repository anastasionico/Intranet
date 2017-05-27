<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        return view('/users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
        //validion
        $this->validate(request(),[
            //'img' => 'nullable|image|dimensions:max-width:1024',
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'job_title' => 'nullable|alpha',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:4|alpha_num',
            'password' => 'required|confirmed',
            'birthdate' => 'nullable|date|before:yesterday',
            'department_id' => 'required|integer',
            'expenses_auth_id' => 'required|integer',
            'expenses_mileage_rate' => 'required',
            'holiday_manager' => 'required|integer',
            'holiday_total' => 'required|integer',
            'holiday_taken' => 'required|integer',
        ]);

        //store
        User::create(
            request(['name','surname',
                'job_title','email',
                'username','password',
                'birthdate','department_id',
                'expenses_auth_id','expenses_mileage_rate',
                'holiday_manager','holiday_total','holiday_taken'
            ])
        );
        
        //redirect to home page   
        return redirect('users');
       
        /*holiday_outstanding has to been calculate by subtracting the holiday_total by the holiday_taken */
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
        
        return view('/users/show', compact('user') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
