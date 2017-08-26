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
        'username' => $faker->userName,
        'password' => $password ?: $password = bcrypt('changeme'),
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'birthdate' => $faker->date($format = 'Y-m-d', $max = '-18 years'),
        'role_id' => function () {
            return factory(App\Role::class)->create()->id;
        },
        'department_id' => function () {
            return factory(App\Department::class)->create()->id;
        },
        'manager_id' => 1,
        'expenses_mileage_rate' => 20,
        'holiday_total' => $faker->numberBetween($min = 23, $max = 35),
        'on_holiday' => 0,
        'holiday_taken' => $faker->numberBetween($min = 0, $max = 23),
        'holiday_outstanding' => $faker->numberBetween($min = 0, $max = 5),
        'email' => $faker->unique()->safeEmail,
        'remember_token' => str_random(10),
        'level' => $faker->numberBetween($min = 1, $max = 3),

    ];
});


$factory->define(App\Department::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->catchPhrase,
        'cost_center_last' => $faker->numberBetween($min = 15, $max = 25),
        'site_id' => function () {
            return factory(App\Site::class)->create()->id;
        },
        'manager_id' => 1,
    ];
});

$factory->define(App\Site::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'cost_center_first' => $faker->numberBetween($min = 15, $max = 25),
        'manufacturer' => $faker->sentence,
        'address' => $faker->streetAddress,
        'phone' => $faker->phoneNumber,
        'lat' => $faker->latitude($min = 50, $max = 60),
        'lng' => $faker->longitude($min = 0, $max = 5),
        'company_id' => function () {
            return factory(App\Company::class)->create()->id;
        },
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'url' => $faker->url,
    ];
});

$factory->define(App\Task::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'sentence' => $faker->sentence,
        'priority' => $faker->numberBetween($min = 0, $max = 3),
        'done' => 0,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        
    ];
});

$factory->define(App\EventModel::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'allday' => 0,
        'start' => $faker->dateTimeBetween('-10 days', 'now'),
        'end' => $faker->dateTimeBetween('+1 day', '+10 days'),
        'url' => $faker->url,
        'backgroundColor' => $faker->safeColorName,
        'textColor' => $faker->safeColorName,

    ];
});

$factory->define(App\Holiday::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return Factory(App\User::class)->create()->id;
        },
        'start' => $faker->dateTimeBetween('-10 days', 'now'),
        'end' => $faker->dateTimeBetween('+1 day', '+10 days'),
        'returning_day' => $faker->dateTimeBetween('+11 day', '+12 days'),
        'approved' => 0,
        'approved_by' => function () {
            return Factory(App\User::class)->create()->id;
        },
    ];
});

$factory->define(App\Permission::class, function (Faker\Generator $faker) {
    $word = $faker->word;
    return [
        'name' => $word,
        'slug' => $word,
        'description' => $faker->sentence,
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    $name = $faker->jobTitle;
    $slug = str_replace(' ', "-", $name);
    return [
        'name' => $name,
        'slug' => $slug,
        'description' => $faker->sentence,
    ];
});


