<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
	public function index()
	{
		return view('/company/index');
	}

	public function create()
	{
		return view('/company/create');
	}

	public function store(Request $request)
	{
		dd($request);
		//validate
		$this->validate(request(),[
			'name' => 'required',
			'url' => 'required'
			]);

		//save
		Company::create([
					'name' => request('name'),
					'url' =>  request('url')
				]);
		//redirect
		return redirect('/company');
	}


}

