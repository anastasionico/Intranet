<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	public function permissions()
    {
    	return $this->BelongsToMany('App\Permission')->withPivot('permission_id', 'role_id');
    }
}
