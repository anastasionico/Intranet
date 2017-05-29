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
    	// Given that run the command to create a new user App\user::create();
    	$newUserTestStore = factory(User::class)->create();
        
    	// The user should be saved into the database and PHPunit will be able to match the new user with the new data
		$this->assertDatabaseHas('users',[
		    "name" => $newUserTestStore->name,
		    "username" => $newUserTestStore->username,
		    "surname" => $newUserTestStore->surname,
		    "department_id" => $newUserTestStore->department_id,
		    "email" =>  $newUserTestStore->email,
		    "password" => $newUserTestStore->password,
		    "remember_token" => $newUserTestStore->remember_token,
		  ]);
	}
    
    public function testDestroy(){
        // Create a new user record into the database
        $newUserTestDestroy = factory(User::class)->create();

        // Delete the element 
        $fetchUser = User::where('email',$newUserTestDestroy->email);
        $fetchUser->delete();
        
        // Verify that the element is not in the database anymore
        $this->assertDatabasemissing('users',[
            "name" => $newUserTestDestroy->name,
            "username" => $newUserTestDestroy->username,
            "surname" => $newUserTestDestroy->surname,
            "department_id" => 1,
            "email" =>  $newUserTestDestroy->email,
            "password" => $newUserTestDestroy->password,
            "remember_token" => $newUserTestDestroy->remember_token,
        ]);
    }
    

    public function testUpdate()
    {
        // Given an user (create a fake one using factory) i need to sent some new data to the edit function 
        $newUserUpdate = factory(User::class)->create();
        $newUserUpdateId = $newUserUpdate['id'];
        $Arrayrequest['name'] = 'Roberta';
        $Arrayrequest['username'] = 'Roby1';
        
        // I need to send the id and the new data to the function that will save the new data into the database
        User::updateUser($newUserUpdateId , $Arrayrequest );
        
        // Then i will check if the update_at field of the record has been update and if i was redirected to the users/ page again (verify if the user has been update )
        //(verify if the admin had been redirected to the  show page)
    }
    
}
