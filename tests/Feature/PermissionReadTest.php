<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionReadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_unauthenticated_user_cannot_see_all_permissions()
    {
    	$this->expectException('Illuminate\Auth\AuthenticationException');
    	
    	factory('App\User')->make();
    	$newPermission = factory('App\Permission')->create();
    	
    	$this->get('/permissions')
    		->assertSee($newPermission->name);
    }

    /** @test */
    public function an_authenticate_user_can_see_all_permissions()
    {
    	$this->be(factory('App\User')->create());
    	$newPermission = factory('App\Permission')->create();
    	
    	$this->get('/permissions')
    		->assertSee($newPermission->name);
	}

	/** @test */
	public function an_authenticate_user_can_see_the_permission_detailed_page()
	{
		//given an authenticate user
		$this->be($user = factory('App\User')->create());
		$permissionNew = factory('App\Permission')->create();

		$this->get("/permissions/$permissionNew->id")
			->assertSee("$permissionNew->name");
	}
    
}
