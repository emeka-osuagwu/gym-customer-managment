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
                $table->string('type')->default('beginner');
                
                $table->string('monday')->default('free');
                $table->string('tuesday')->default('free');
                $table->string('wednesday')->default('free');
                $table->string('thursday')->default('free');
                $table->string('friday')->default('free');
                $table->string('saturday')->default('free');
                $table->string('sunday')->default('free');
                
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

    /**
     * This method create users schema.
     */
    public function createUserPlanTable()
    {
        if (! $this->capsule->schema()->hasTable('user_plan')) 
        {
            $this->capsule->schema()->create('user_plan', function ($table) {
                $table->primary(['plan_id', 'user_id']); 
                $table->integer('user_id')->unsigned();;
                $table->integer('plan_id')->unsigned();
            });
            
            return "user plan table created";
        }
        else
        {
            return "user plan table already exists";
        }
    }

    /**
     * This method create users schema.
     */
    public function dropUserPlanTable()
    {
        if ($this->capsule->schema()->hasTable('user_plan')){
            $this->capsule->schema()->drop('user_plan');
        }

        return "user plan table dropped";
    }

    /**
     * This method create users schema.
     */
    public function createWorkOutTable()
    {
        if (! $this->capsule->schema()->hasTable('workout')) 
        {
            $this->capsule->schema()->create('workout', function ($table) {
                $table->increments('id');
                $table->string('title')->unique();
                $table->timestamps();
            });
            
            return "workout table created";
        }
        else
        {
            return "workout table already exists";
        }
    }

    /**
     * This method create users schema.
     */
    public function dropWorkOutTable()
    {
        if ($this->capsule->schema()->hasTable('workout')){
            $this->capsule->schema()->drop('workout');
        }
        
        return "workout table dropped";
    }

}