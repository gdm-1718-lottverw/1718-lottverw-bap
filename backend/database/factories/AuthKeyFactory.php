<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\AuthKey::class, function (Faker $faker) {
    $roles = App\Models\Role::pluck('id');
    return [
        'username' => $faker->unique()->userName(),
        'password' => bcrypt('secret'),
        'first_login' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
        'last_login' =>  $faker->dateTimeThisYear($max = 'now', $timezone = null),
        'expire_date' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
        'role_id' => rand(1, (count($roles)))
    ];
});
