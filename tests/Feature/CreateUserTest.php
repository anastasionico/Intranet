<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateUserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    
    /** @test */
    public function an_unauthenticated_user_cannot_see_the_create_user_page()
    {
    	$this->withExceptionHandling()
    		->get('/users/create')
    		->assertRedirect('/login');
    }

    /** @test */
    public function an_unauthenticated_user_cannot_create_new_user()
	{
		$this->expectException('Illuminate\Auth\AuthenticationException');
		$user = factory('App\User')->make();
		
		$newUser = factory('App\User')->create();
		$this->post('/users', $newUser->toArray());

		$this->get('/users/'. $newUser->id)
			->assertSee($newUser->name);
	}

	/** @test */
	public function an_authenticated_user_can_create_a_user()
	{
		// given an authenticate user
		$this->be($user = factory('App\User')->create());
		
		// when the auth user add a new user
		$newUser = factory('App\User')->make();
		$this->post('/users', $newUser->toArray());
		
		// then the page with the new user is should be visible the name and surname of the new user detail cairo_pattern_get_extend(pattern)
		$this->get('/users/'. $newUser->id)
			->assertSee($newUser->name);
	}
}
