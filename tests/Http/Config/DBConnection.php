<?php

namespace Test\Http\Config;

use Emeka\Http\Models\User;
use Emeka\Database\Schemes;
use Emeka\Database\DatabaseConnection;
use Illuminate\Database\Capsule\Manager;

class DBConnection
{
	/**
	 * @return DatabaseConnection
	 */
	public function getConnection()
	{
	    return new DatabaseConnection(new Manager());
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

	public function dropAllTables($value='')
	{
		User::truncate();
	}
	
}