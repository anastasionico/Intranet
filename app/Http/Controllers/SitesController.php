<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\Company;

class SitesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{
		$sites = Site::all();
		return view('/sites/index' , compact('sites'));
	}

	public function create(){
		$companies = Company::all();
		return view('/sites/create' , compact('companies'));
	}

	public function store(Request $request)
	{
		$this->validate(request(), [
			'name' => 'required',
			'address' => 'required',	
			'phone' => 'required|numeric',
			'company' => 'required',
			'cost_center_first' => 'required',
			'manufacturer' => 'string',
			'lat' => 'numeric|nullable',
			'lng' => 'numeric|nullable'
		]);

		Site::create([
			'name' => request('name'),
			'address' => request('address'),	
			'phone' => request('phone'),
			'company_id' => request('company'),
			'cost_center_first' => request('cost_center_first'),
			'manufacturer' => request('manufacturer'),
			'lat' => request('lat'),
			'lng' => request('lng'),
		]);

		return redirect('/sites');
	}

	public function show($id)
	{
		$site = Site::find($id);
		return view('/sites/show' , compact('site'));
	}

	public function edit($id)
	{
		$companies = Company::all();
		$site = Site::find($id);
		return view('/sites/edit' , compact('site', 'companies'));
	}

	public function update(Request $request, $id)
	{
		$this->validate(request(), [
			'name' => 'required',
			'address' => 'required',	
			'phone' => 'required|numeric',
			'company' => 'required',
			'cost_center_first' => 'required',
			'manufacturer' => 'string',
			'lat' => 'nullable|numeric',
			'lng' => 'nullable|numeric'
		]);

		$site = Site::find($id);
		$site->name = request('name');
		$site->address = request('address');
		$site->phone = request('phone');
		$site->company_id = request('company');
		$site->cost_center_first = request('cost_center_first');
		$site->manufacturer = request('manufacturer');
		$site->lat = request('lat');
		$site->lng = request('lng');
		$site->save();
		
		return redirect('/sites');
	}

	public function destroy($id)
	{
		$site = Site::find($id);
		$site->delete();

		return redirect('/sites');
	}
}
