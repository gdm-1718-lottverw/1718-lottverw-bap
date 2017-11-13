<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Organization::class, function (Faker $faker) {
    return [
        'name' => $faker->words($nb = 3, $asText = true),
        'email' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'phone' => $faker->date($format = 'Y-m-d', $max = '+6 months') ,
        'auth_key_id' => factory(App\Models\AuthKey::class)->create()->id,
    ];
});
