<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = [
    	'name' , 'slug', 'description'
    ];
    public function roles()
    {
    	return $this->BelongsToMany('App\Role')->withPivot('permission_id', 'role_id');
    }
}
