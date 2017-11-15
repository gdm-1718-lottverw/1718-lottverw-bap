<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Guardian::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName() . ' ' . $faker->lastName(),
        'phonenumber' => $faker->e164PhoneNumber()
    ];
});
