<?php

namespace Emeka\Database;

use Faker\Factory;
use Emeka\Http\Models\User;
use Emeka\Http\Models\Plan;

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

        $new_record = [];

        for ($i=0; $i < $size; $i++) {
            Plan::create([
                'name' => $faker->email,
                'description' => $faker->name,
                'type' => rand(0, 1) ? "beginner" : "expert",
            ]);
        }

        return $size . " new Record created in the database";
    }
}