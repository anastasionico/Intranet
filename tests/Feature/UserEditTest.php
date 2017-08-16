<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserEditTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function an_unauthenticated_user_cannot_see_the_edit_page()
    {
    	$this->withExceptionHandling()
    		->get('/users/edit/1')
    		->assertRedirect('/login');
    }
}
