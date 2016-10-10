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

$factory->define(App\DAL\Core\Sys\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'first_name' => $faker->name,
        'middle_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        // 'remember_token' => str_random(10),
        'activity' => 1,
        'created' => Carbon::now(),
        'modified' => Carbon::now(),
        'deleted' => null
    ];
});

/*
$factory->define(App\DAL\::class, function (Faker\Generator $faker) {
    return [
    ];
});
*/
