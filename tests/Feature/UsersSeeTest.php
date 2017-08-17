<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersSeeTest extends TestCase
{
    use DatabaseMigrations;
	
	/**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    
    /** @test */
    public function an_unauthenticated_user_cannot_see_users_list()
    {
    	$this->expectException('Illuminate\Auth\AuthenticationException');
    	$user = factory('App\User')->make();
    	$this->get('/users')
    		->assertSee($user->name);
    }
    
	/** @test */
    public function an_authenticated_user_can_see_users_list()
    {
    	$this->be($user = factory('App\User')->create());
    	$this->get('/users')
    		->assertSee($user->name);
    }

	/** @test */
	public function an_authenticated_user_can_see_other_users_detail_page()
	{
		$this->be($user = factory('App\User')->create());
		$this->get('/users/'. $user->id)
			->assertSee($user->name);
	}

	
}