<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $fillable = ['name', 'site_id', 'cost_center_last'];
	public function users()
	{
		return $this->hasMany(User::class);	
	}
	
	public function site()
	{
		return $this->belongsTo(Site::class);
	}
	
}
