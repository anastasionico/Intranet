<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles()
    {
    	return $this->BelongsToMany('App\Role')->withPivot('permission_id', 'role_id');
    }
}
