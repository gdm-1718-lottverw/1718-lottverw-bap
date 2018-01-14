<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\AuthKey::class, function (Faker $faker) {
    $roles = App\Models\Role::pluck('id');
    return [
        'username' => $faker->unique()->userName(),
        'password' => bcrypt('Secret'),
        'first_login' => $faker->dateTimeBetween($startDate = '-8 months', $endDate = '+1 year', $timezone = date_default_timezone_get()),
        'last_login' => $faker->dateTimeBetween($startDate = '-8 months', $endDate = '+1 year', $timezone = date_default_timezone_get()),
        'expire_date' => $faker->dateTimeBetween($startDate = '-8 months', $endDate = '+1 year', $timezone = date_default_timezone_get()),
        'role_id' => 2
    ];
});
