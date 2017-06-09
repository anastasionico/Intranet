<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	public function site()
	{
		return $this->hasMany(Site::class);
	}
}
