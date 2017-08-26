<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionDeleteTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function an_unathenticate_user_cannot_delete_a_permission()
    {
    	$this->withExceptionHandling();
    	
    	factory('App\User')->make();
    	$permission = factory("App\Permission")->create();
    	
    	$this->get('permissions/delete/'. $permission->id)
    		->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticate_user_can_delete_a_permisson()
    {
    	$this->be(factory('App\User')->make());
    	$permission = factory('App\Permission')->create();
    	$this->assertDatabaseHas('permissions',[
    			'id' => $permission->id
			]);

		$this->get('permissions/delete/'. $permission->id);
    	$this->assertDatabaseMissing('permissions',[
    			'id' => $permission->id
			]);
    }

    /** @test */
    // NEED TO WORK ON THE RELATIONSH HAS MANY FOR COMPLETE THIS TEST
    // public function an_authenticate_user_can_delete_a_permisson_if_job_allows(){
        // Given an authenticated user not allowded to delete a permission
        // $role = factory('App\Role', 5)->create()->each(function($r) {
        //     $r->permissions()->saveMany(factory('App\Permission', 5)->make());
        //     // dd($r->permissions);
        // });
        
        // $this->be($user = factory('App\User')->make([
        //     'role_id' => $role
        // ]));

        // dd($user->role->permissions);

        // foreach ($user->role->permissions as $permission) {
        //     echo $permission;
        // }
        // exit();
    //     // when he get the permission/index page
    //     // then he cannot see the delete buttons
    // }
}
