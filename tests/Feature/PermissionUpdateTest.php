<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionUpdateTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_unauthenticated_user_cannot_see_the_edit_page()
    {
    	$this->withExceptionHandling();

    	factory('App\User')->make();

    	$this->get('/permissions/edit/1')
    		->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_the_edit_a_permission()
    {
    	$this->be(factory('App\User')->make());

    	$permission = factory('App\Permission')->create(['name' => 'money create']);
    	$permission->name = 'money delete';

		$this->post("/permissions/update/" . $permission->id, $permission->toArray());
		$this->assertDatabaseHas('permissions',[
				'name' => 'money delete'
			]);
	}
}
