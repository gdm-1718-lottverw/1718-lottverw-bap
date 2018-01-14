<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Doctor::class, function (Faker $faker) {
    $children = App\Models\Child::pluck('id');
    $i = 1;
    return [
        'children_id' => rand(1, 700),
        'name' => $faker->firstName() . " " . $faker->lastName(),
        'phone_number' => $faker->phoneNumber(),
    ];
});
