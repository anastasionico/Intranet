<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCreateTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    
    /** @test */
    public function an_unauthenticated_user_cannot_create_new_user()
	{
		$newUser = factory('App\User')->create();
		
		$this->withExceptionHandling()
			->post('/users', $newUser->toArray())
			->assertRedirect('/login');
	}

	/** @test */
	public function an_authenticated_user_can_create_a_user()
	{
		// given an authenticate user
		$this->be($user = factory('App\User')->create());
		
		// when the auth user add a new user
		$newUser = factory('App\User')->make();
		$response = $this->post('/users', $newUser->toArray());

		// then after the script passed by the post users page need to redirect me to the user location and show the new user name
		$this->get($response->headers->get('location'))
			->assertSee($newUser->name);
	}

	/** @test */
    public function an_unauthenticated_user_cannot_see_the_create_user_page()
    {
    	$this->withExceptionHandling()
    		->get('/users/create')
    		->assertRedirect('/login');
    }

    /** @test */
    public function a_user_require_a_name()
    {
    	$this->store(['name' => null ])
    		->assertSessionHasErrors('name');
    }

   	/** @test */
    public function a_user_require_a_email()
    {
    	$this->store(['email' => null ])
    		->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_user_require_a_surname()
    {
    	$this->store(['surname' => null ])
    		->assertSessionHasErrors('surname');
    }

    /** @test */
    public function a_user_require_a_role_id()
    {
    	factory('App\Role',2)->create();

    	$this->store(['role_id' => null ])
    		->assertSessionHasErrors('role_id');

    	$this->store(['role_id' => 999 ])
    		->assertSessionHasErrors('role_id');	
    }

    /** @test */
    public function a_user_require_a_level()
    {
    	factory('App\Role',2)->create();
    	
    	$this->store(['level' => null ])
    		->assertSessionHasErrors('level');
	}

	/** @test */
    public function a_user_require_a_username()
    {
    	factory('App\Role',2)->create();
    	
    	$this->store(['username' => null ])
    		->assertSessionHasErrors('username');
	}

	/** @test */
	public function a_user_require_a_department()
	{
		factory('App\Department',2)->create();

		$this->store(['department_id' => null])
			->assertSessionHasErrors('department_id');
		$this->store(['department_id' => 999])
			->assertSessionHasErrors('department_id');
	}

	/** @test */
	public function a_user_require_a_manager()
	{
		factory('App\User',2)->create();

		$this->store(['manager_id' => null])
			->assertSessionHasErrors('manager_id');
		$this->store(['manager_id' => 999])		
			->assertSessionHasErrors('manager_id');
	}
    
	// FIX THIS METHOD AND ENABLE THE VALIDATION FOR PASSWORDS
    public function store($override)
    {
    	//create an authenticated user and add and, since we aspect and exception to make the test pass we add the withExceptHandling() to the test
    	$this->withExceptionHandling()
    		->be( factory('App\User')->create() );

    	//create a user using factory and put a field as null
    	$newUser = factory('App\User')->make($override);

    	//go to the store method in the controller and send the request in the form of array
    	return $this->post('/users', $newUser->toArray());
    }
}
