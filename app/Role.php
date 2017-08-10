<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole

{
	protected $fillable = ['name', 'description', 'slug'];
	
	public function User()
	{
		return $this->hasMany(User::class);
	}
	public function permissions()
    {
    	return $this->BelongsToMany('App\Permission')->withPivot('permission_id', 'role_id');
    }


}
