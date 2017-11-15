<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\OtherInformation::class, function (Faker $faker) {
    $children = App\Models\Child::pluck('id');
    return [
        'description' => $faker->sentences($nb = 3, $asText = true),
        'children_id' => rand(1, (count($children) - 1))
    ];
});
