<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
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
    public function an_authenticated_user_can_see_users_list()
    {
    	$this->be($user = factory(\App\User::class)->create());
    	$this->get('/users')
    		->assertSee($user->name);
	}
}
