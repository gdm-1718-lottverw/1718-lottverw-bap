<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Activity::class, function (Faker $faker) {
    return [
        'name' => $faker->words($nb = 3, $asText = true),
        'description' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'date' => $faker->date($format = 'Y-m-d', $max = '+6 months') ,
        'start' => $faker->time($format = 'H:i'),
        'end' => $faker->time($format = 'H:i'),
        'reservation' => $faker->boolean,
        'canceled' => $faker->boolean,
        'organization_id' => rand(0, 100)
    ];
});
