<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $fillable = ['name', 'url', 'img'];
	
	public function site()
	{
		return $this->hasMany(Site::class);
	}
}
