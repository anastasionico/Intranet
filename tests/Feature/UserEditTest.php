<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserEditTest extends TestCase
{
    use DatabaseMigrations;
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
    
    /** @test */
    public function an_authenticated_user_can_see_the_edit_page()
    {
        $this->be($user = factory('App\User')->create() );

        $newUser = factory('App\User')->make();
        $this->post('/users' , $newUser->toarray());

        $this->get('/users/' . $newUser->id)
            ->assertSee($newUser->name);
    }

    /** @test */
    public function an_authenticated_user_can_edit_a_user()
    {
    // FIX HERE

       // given an authenticate user
        // $this->be($user = factory('App\User')->create());
        
        // when the auth user add a new user
        // $newUser = factory('App\User')->make();
        // $this->post('/users', $newUser->toArray());
        
        //and edit his name
        // $newUserEdit = $newUser->toArray();
        // $newUserEdit['name'] = "Aaron";
        

        // $this->post('/users/update/2', $newUserEdit);

        //then i need to see the new data changed into the database thus, 
        // $this->get('/users/2')
        //     ->assertSee($newUserEdit->name);
    }
}
