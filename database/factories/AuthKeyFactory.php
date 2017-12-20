<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\AuthKey::class, function (Faker $faker) {
    $roles = App\Models\Role::pluck('id');
    return [
        'username' => $faker->unique()->userName(),
        'password' => bcrypt('secret'),
        'first_login' => $faker->date($format = 'Y-m-d', $max = '-2 months'),
        'last_login' =>  $faker->date($format = 'Y-m-d', $max = 'now'),
        'expire_date' => $faker->date($format = 'Y-m-d', $max = '+1 year'),
        'role_id' => rand(1, (count($roles) -1))
    ];
});
