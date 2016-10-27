<?php

use App\User;
use App\Stats;
use Carbon\Carbon;

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
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'role' => 'publisher',
        'updated_at' => Carbon::now(),
        'created_at' => Carbon::now(),
    ];
});

$factory->define(Stats::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 2, $max = 51),
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'site' => $faker->randomElement($array = array ('lawofficer.com','article107news.com','havokjournal.com')),
        'impressions' => $faker->numberBetween($min = 50, $max = 100000),
        'served' => $faker->numberBetween($min = 0, $max = 50000),
        'fill' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
        'income' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 4),
        'ecpm' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 4),
        'tag' => $faker->randomElement($array = array ('Lawofficer.com Top 320×50 Mobile','Lawofficer.com Bottom 728×90 Desktop','Lawofficer.com ROS 300×250 Desktop')),
        'updated_at' => Carbon::now(),
        'created_at' => Carbon::now(),
    ];
});