    <?php

use Illuminate\Database\Seeder;

class FirstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
        	'id' => 1,
        	'username' => "admin",
            'name' => "admin",
            'surname' => "",
            'email' => "",
        	'password' => bcrypt('changeme'),
        	'role_id' => 1,
        	'department_id' => 1,
        ])->each( function ($u){
            $u->roles()->attach(factory(App\Role::class)->create([
                'id' => 1,
            ]));
        });
		
        factory(App\Role::class)->create([
            'name' => 'Admin',
            ])->each(function($r) {
	    	$perms = [ 
	    		'permission create', 'permission read', 'permission update', 'permission delete',
    			'calendar create', 'calendar read', 'calendar update', 'calendar delete',  
    			'company create', 'company read', 'company update', 'company delete',  
    			'department create', 'department read', 'department update', 'department delete',  
    			'holiday create', 'holiday read', 'holiday update', 'holiday delete',  
    			'role create', 'role read', 'role update', 'role delete',  
    			'site create', 'site read', 'site update', 'site delete',  
    			'task create', 'task read', 'task update', 'task delete',  
    			'user create', 'user read', 'user update', 'user delete',  
    		];
    		foreach ($perms as $perm) {
                $r->permissions()->attach(factory(App\Permission::class)->create([
					'name' => $perm,
				]));
			}
	    });

		factory(App\Department::class)->create([
			'id' => 1,
			'site_id' => 1,
		]);

		factory(App\Site::class)->create([
			'id' => 1,
			'company_id' => 1,
		]);
        
		factory(App\Company::class)->create([
			'id' => 1,
		]);
    }
}
