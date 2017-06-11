<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

	public function testSavingCompany()
	{
		//validate and save the data
		$request = new \Illuminate\Http\Request;
		$request->request->parameters->name= 'ImperialCommercials';
		$request->request->url= 'www.imperialcommercials.co.uk';
		
		$company = new \App\Http\Controllers\CompanyController;
		$company->store($request);

		//check if the data has been saved into the database
		$this->assertDatabaseHas('companies', [
	        'name' => $request['name'],
	        'url' => $request['url']
	    ]);
		//redirect to the /company page
		$this->assertPathIs('/company');
	}
}
