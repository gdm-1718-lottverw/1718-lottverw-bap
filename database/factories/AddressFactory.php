<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Address::class, function (Faker $faker) {
    return [
        'postal_code' => $faker->postcode,
        'number' => $faker->buildingNumber,
        'street' => $faker->streetName,
        'city' => $faker->city,
        'country' => $faker->country,
    ];
});
