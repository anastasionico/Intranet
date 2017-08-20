<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionCreateTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function an_authenticated_user_can_add_new_permissions()
    {
        $this->be($user = factory('App\User')->create());

    	$newPermission = factory('App\Permission')->make();
    	$request = $newPermission->toArray();
    	$request['create'] = 1;
    	$request['read'] = 1;
    	$request['update'] = 1;
    	$request['delete'] = 1;

    	
    	$this->post('permissions', $request);
        $this->assertDatabaseHas('permissions',[
        	'name' => $newPermission->name . ' create'
        ]);
		$this->assertDatabaseHas('permissions',[
        	'name' => $newPermission->name . ' read'
        ]);
    	$this->assertDatabaseHas('permissions',[
        	'name' => $newPermission->name . ' update'
        ]);
        $this->assertDatabaseHas('permissions',[
        	'name' => $newPermission->name . ' delete'
        ]);
    }

    /** @test */
    public function a_permission_require_a_name()
    {
    	$this->store(['name' => null])
    		->assertSessionHasErrors('name');
	}	
	
	/** @test */
	public function a_permission_require_a_description()
	{
		$this->store(['description' => null])
			->assertSessionHasErrors('description');
	}

	public function store($override)
	{
		$this->withExceptionHandling()
		->be(factory('App\User')->create());

		$newPermission = factory('App\Permission')->make($override);

		return $this->post('/permissions' , $newPermission->toArray());

	}
}
