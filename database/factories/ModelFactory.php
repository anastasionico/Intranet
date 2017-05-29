<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'surname' => $faker->lastName,
        'department_id' => $faker->randomDigitNotNull,
        'birthdate' => $faker->date,
        'job_title' => $faker->jobTitle,
        'expenses_auth_id' => $faker->randomDigitNotNull,
        'expenses_mileage_rate' => $faker->randomDigitNotNull,
        'holiday_manager' => $faker->randomDigitNotNull,
        'holiday_total' => $faker->randomDigitNotNull,
        'holiday_taken' => $faker->randomDigitNotNull,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});