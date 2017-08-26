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
    	// Given an guest and a permission

    	factory('App\User')->make();
    	$permission = factory("App\Permission")->create();
    	// dd($permission->id);
    	// When the guest try to delete a selected permission
    	// Then the test shoud return an exception
    	$this->get('permissions/delete/'. $permission->id)
    		->assertRedirect('/login');
    }

    
}
