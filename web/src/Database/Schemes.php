<?php

namespace Emeka\Database;

use Emeka\Database\DatabaseConnection;
use Illuminate\Database\Capsule\Manager as Capsule;

class Schemes
{

    protected $capsule;

    function __construct()
    {
        $this->capsule = new Capsule();
        new DatabaseConnection($this->capsule);
    }

    /**
     * This method create users schema.
     */
    public function createUserTable()
    {

        if (! $this->capsule->schema()->hasTable('users')) 
        {
            $this->capsule->schema()->create('users', function ($table) {
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
            
            return "user table created";
        }
        else
        {
            return "user table already exists";
        }
    }

    /**
     * This method create users schema.
     */
    public function dropUserTable()
    {
        if ($this->capsule->schema()->hasTable('users')){
            $this->capsule->schema()->drop('users');
        }

        return "user table dropped";
    }

    /**
     * This method create users schema.
     */
    public function createPlanTable()
    {
        if (! $this->capsule->schema()->hasTable('plans')) 
        {
            Capsule::schema()->create('plans', function ($table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('description');
                $table->string('image')->nullable();
                $table->enum('type', ['beginner', 'expert', 'intermediate'])->default('beginner');
                $table->timestamps();
            });
            
            return "plan table created";
        }
        else
        {
            return "plan table already exists";
        }
    }

    /**
     * This method create users schema.
     */
    public function dropPlanTable()
    {
        if ($this->capsule->schema()->hasTable('plans')){
            $this->capsule->schema()->drop('plans');
        }

        return "plan table dropped";
    }
}