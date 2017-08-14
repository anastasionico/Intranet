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
        factory(App\Role::class, 2)->create()->each(function($r) {
	    	$r->permissions()->attach(factory(App\Permission::class, 2)->create());
		});
    }
}
