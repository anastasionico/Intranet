<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class UserTest extends TestCase
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
    public function user_belongs_to_a_department()
    {
    	$user = factory('App\User')->create();

    	$this->assertInstanceOf('App\Department', $user->Department);
	}

	/** @test */
    public function user_has_a_role()
    {
    	$user = factory('App\User')->create();

    	$this->assertInstanceOf('App\Role', $user->role);
	}
}
