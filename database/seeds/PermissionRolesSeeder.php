<?php

use Illuminate\Database\Seeder;

class PermissionRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    factory(App\Role::class, 5)->create()->each(function($r) {
	    	// $r->permissions()->save(factory(App\Permission::class)->make());
	    	$r->permissions()->attach(factory(App\Permission::class, 2)->create());
		});

    }
}
