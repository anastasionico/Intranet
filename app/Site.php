<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
	public function department()
	{
		return $this->hasMany(Department::class);
	}
	
	public function company()
	{
		return $this->belongsTo(Company::class);
	}
	

}
