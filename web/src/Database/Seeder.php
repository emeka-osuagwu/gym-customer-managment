<?php

namespace Emeka\Database;

use Faker\Factory;
use Emeka\Http\Models\User;
use Emeka\Http\Models\Plan;
use Emeka\Http\Models\PlanUser;
use Emeka\Http\Models\Workout;

class Seeder
{
    /**
     * This method generate and saves fake users data in to the database.
     */
    public function handelUserSeed($size)
    {
        $faker = Factory::create();

        $new_record = [];

        for ($i=0; $i < $size; $i++) {
            User::create([
                'email' => $faker->email,
                'first_name' => $faker->name,
                'last_name' => $faker->name,
                'phone_number' => $faker->phoneNumber,
                'image' => $faker->imageUrl,
                'location' => $faker->streetAddress,
                'sex' => rand(0, 1) ? "Male" : "Female",
            ]);
        }

        return $size . " new Record created in the database";
    }

    /**
     * This method generate and saves fake plans in to the database.
     */
    public function handelPlanSeed($size)
    {
        $faker = Factory::create();

        for ($i=0; $i < $size; $i++) {
            Plan::create([
                'name' => $faker->name,
                'description' => $faker->name,
                'type' => rand(0, 1) ? "beginner" : "expert",
            ]);
        }

        return $size . " new Record created in the database";
    }

    /**
     * This method generate and saves fake user plans in to the database.
     */
    public function handelUserPlanSeed($size)
    {
        $faker = Factory::create();

        $new_record = [];

        for ($i=0; $i < $size; $i++) {
            PlanUser::create([
                'user_id' => rand(1, 10),
                'plan_id' => rand(1, 10),
            ]);
        }

        return $size . " new Record created in the database";
    }

    /**
     * This method generate and saves fake user plans in to the database.
     */
    public function handelWorkoutSeed()
    {
        $count_work_out = Workout::all();

            Workout::create(['title' => "Push Up"]);
            Workout::create(['title' => "Set Up"]);
            Workout::create(['title' => "Running"]);
            Workout::create(['title' => "Pull Up"]);
            Workout::create(['title' => "Squad"]);
            Workout::create(['title' => "Yoga"]);
        if($count_work_out->count() < 1){
            

            return "new Record created in the database";
        }
    }
}