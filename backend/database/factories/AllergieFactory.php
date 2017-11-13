<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Allergie::class, function (Faker $faker) {
    $children = App\Models\Child::pluck('id');
    $activity = App\Models\Activity::pluck('id');
    $gravity = ['deadly', 'light', 'medium light', 'medium', 'severe'];
    $type = ['food', 'latex', 'pollen', 'animal', 'insects', 'other'];
    return [
        'gravity' => array_rand ($gravity, 1),
        'type' => array_rand ($type, 1),
        'description' => $faker->sentences($nb = 3, $asText = true),
        'medication' => $faker->words($nb = 2, $asText = true),
        'children_id' => rand(1, (count($children) % 2))
    ];
});

