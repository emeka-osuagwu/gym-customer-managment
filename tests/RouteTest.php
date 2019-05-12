<?php

namespace Test;

use Faker\Factory;
use Emeka\Http\Models\User;
use PHPUnit\Framework\TestCase;
use Test\Http\Config\RequestService;
use Emeka\Database\DatabaseConnection;
use Illuminate\Database\Capsule\Manager;

class RouteTest extends TestCase
{
	/**
	 * $faker
	 * @var Faker\Factory
	 */
	public $faker;

	/**
	 * $request
	 * @var Test\Http\Config\RequestService;
	 */
	public $request;

	public function setUp()
	{
	    parent::setUp();
	    $this->faker = Factory::create();
	    $this->request = new RequestService;

	    new DatabaseConnection(new Manager());

	    $this->setUpDatabase();
	}

	/**
	 * Create records in the database
	 */
	public function setUpDatabase()
	{
	    User::create([
	        'email' => 'emekaosuagwu@hotmail.com',
	        'first_name' => 'Osuagwu',
	        'last_name' => 'Emeka',
	        'phone_number' => "09095685594",
	        'image' => 'https://github.com/rakit/validation',
	        'location' => 'Lagos, Nigeria',
	        'sex' => 'Male',
	    ]);

	    User::create([
	        'email' => 'mustafa.ozyurt@hotmail.com',
	        'first_name' => 'Mustafa',
	        'last_name' => 'Ozyurt',
	        'phone_number' => "09095685594",
	        'image' => 'https://github.com/rakit/validation',
	        'location' => 'Berlin, Germany',
	        'sex' => 'Male',
	    ]);
	}

	/**
	 * Test get all customer endpoint
	 */
	public function testGetAllCustomersRoute()
	{
		$response = $this->request->handel('GET', 'http://localhost:8080/api', []);
	    $this->assertSame(200, $response['status']);
	    $this->assertIsArray($response['data']);
	    $this->assertArrayHasKey('email', $response['data'][0]);
	}

	/**
	 * Test invalid route error
	 */
	public function testGetErrorOnInvalidRoute()
	{
		$response = $this->request->handel('GET', 'http://localhost:8080/something-route', []);
	    $this->assertSame(404, $response['code']);
	}

	/**
	 * Test create customer endpoint
	 */
	public function testCreateRecipe()
	{
		$customer = [
			'email' => $this->faker->email,
			'first_name' => $this->faker->firstNameMale,
			'last_name' => $this->faker->firstNameMale,
			'phone_number' => $this->faker->e164PhoneNumber,
			'sex' => rand(0, 1) ? "male" : "female",
			'location' => "nigaria",
		];

		$data = [
			'form_params' => $customer
		];

		$response = $this->request->handel('POST', 'http://localhost:8080/api/customer', $data);

	    $this->assertSame(200, $response['status']);
	    $this->assertArrayHasKey('email', $response['data']);
	}

	// *
	//  * Test get customer endpoint
	public function testGetCustomer()
	{
		$response = $this->request->handel('GET', 'http://localhost:8080/api/customer/1', []);
	    $this->assertSame(200, $response['status']);
		$this->assertArrayHasKey('email', $response['data'][0]);
	}

	/**
	 * Test update customer endpoint
	 */
	public function testUpdateCustomer()
	{
		$customer = [
			'first_name' => 'randomname'
		];

		$data = [
		    'form_params' => $customer,
		];

		$response = $this->request->handel('POST', 'http://localhost:8080/api/customer/1', $data);
	    
	    $this->assertSame(200, $response['status']);
	    $this->assertSame($customer['first_name'], $response['data'][0]['first_name']);
	}

	/**
	 * Test delete custom endpoint
	 */
	public function testDeleteCustomer()
	{
		$response = $this->request->handel('DELETE', 'http://localhost:8080/api/customer/1', []);
	   
	    $this->assertSame(200, $response['status']);
	    $this->assertSame("record deleted", $response['message']);
	}
	
	protected function tearDown()
	{
	    User::truncate();
	}
}