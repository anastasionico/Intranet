<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
	public function index()
	{
		$companies = Company::all();
		return view('/company/index' , compact('companies'));
	}

	public function create()
	{
		return view('/company/create');
	}

	public function store(Request $request)
	{
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

	public function show($id){
		$company = Company::find($id);
		return view('company/show', compact('company'));
	}

	public function edit($id){
		$company = Company::find($id);
		return view('company/edit', compact('company'));
	}

	public function update(Request $request, $id)
	{
		//validate
		$this->validate(request(),[
			'name' => 'required',
			'url' => 'required'
		]);

		//update
		$company = Company::find($id);
		$company->name = request('name');
		$company->url = request('url');
		$company->save();
		//redirect
		return redirect("/company");
	}	
	
	public function destroy($id)
	{
		$company = Company::find($id);
		$company->delete();
		
		return redirect('/company');
   	}
}

