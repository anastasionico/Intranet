<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
	protected $fillable = ['name', 'cost_center_first' , 'manufacturer' , 'address', 'phone' , 'lat' , 'lng' , 'company_id'];

	public function department()
	{
		return $this->hasMany(Department::class);
	}
	
	public function company()
	{
		return $this->belongsTo(Company::class);
	}
	

}
