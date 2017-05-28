<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class UserTest extends TestCase
{
    use DatabaseTransactions; //undo all the editing to the database after testing
    /**
     * A basic test example.
     *
     * @return void
     */
    /*
    public function testGetUser(){
    	//get 
    	$this->assertTrue(true);
    }
    */	
    
    public function testStore(){
    	//given that run the command to create a new user App\user::create();
    	$newUser = factory(User::class)->create();
    
    	//the user should be saved into the database and PHPunit will be able to match the new user with the new data
		$this->assertDatabaseHas('users',[
		    "name" => $newUser->name,
		    "username" => $newUser->username,
		    "surname" => $newUser->surname,
		    "department_id" => 1,
		    "email" =>  $newUser->email,
		    "password" => $newUser->password,
		    "remember_token" => $newUser->remember_token,
		  ]);
	}
    
    public function testDestroy(){
        //create a new user record into the database
        $newUser = factory(User::class)->make();

        //delete the element 
        $fetchUser = User::where('email',$newUser->email);
        $fetchUser->delete();
        
        //verify that the element is not in the database anymore
        $this->assertDatabasemissing('users',[
            "name" => $newUser->name,
            "username" => $newUser->username,
            "surname" => $newUser->surname,
            "department_id" => 1,
            "email" =>  $newUser->email,
            "password" => $newUser->password,
            "remember_token" => $newUser->remember_token,
        ]);
    }

    public function testUpdate()
    {
        
        //given I edit the field and submit the form with new data
        
        //I will trigger the update method in the user controller
        //then i will check if the update_at form has been update and if i was redirected to the users/ page again

    }
}
