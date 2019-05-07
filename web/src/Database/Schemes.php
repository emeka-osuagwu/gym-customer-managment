<?php

namespace Emeka\Database;

use Emeka\Database\DatabaseConnection;
use Illuminate\Database\Capsule\Manager as Capsule;

class Schemes
{
    /**
     * This method create users schema.
     */
    public function createUserTable()
    {
        $capsule = new Capsule();
        new DatabaseConnection($capsule);

        if (! Capsule::schema()->hasTable('users')) 
        {
            Capsule::schema()->create('users', function ($table) {
                $table->increments('id');
                $table->string('email')->unique();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('phone_number');
                $table->string('image');
                $table->string('location');
                $table->string('sex');
                $table->timestamps();
            });
            
            return "table created";
        }
        else
        {
            return "table already exists";
        }
    }

    /**
     * This method create users schema.
     */
    public function dropUserTable()
    {
        if (Capsule::schema()->hasTable('users')){
            Capsule::schema()->drop('users');
        }

        return "table dropped";
    }
}