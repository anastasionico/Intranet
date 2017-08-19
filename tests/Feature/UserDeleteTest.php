<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserDeleteTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function an_authenticated_user_can_delete_another_user()
    {
    	$this->be($user = factory('App\User')->create());
		$secondUser = factory('App\User')->create();

    	$this->get('/users/delete/'. $secondUser->id);

    	$this->assertDatabaseMissing('users', [
        	'id' => $secondUser->id
    	]);
    }

    /** @test */
    public function an_authenticated_user_cannot_delete_itself()
    {
    	$this->be($user = factory('App\User')->create());
    
    	$this->get('/users/delete/' . $user->id);
    	$this->assertDatabaseHas('users', ['id' => $user->id]);
	}
}
