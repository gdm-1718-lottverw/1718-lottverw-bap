<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Allergie::class, function (Faker $faker) {
    $children = App\Models\Child::pluck('id');
    return [
        'gravity' => generateGravity(),
        'type' => generateType(),
        'description' => $faker->sentences($nb = 3, $asText = true),
        'medication' => $faker->words($nb = 2, $asText = true),
        'children_id' => rand(1, (count($children) - 1))
    ];
});

function generateGravity() {
    $gravity = ['deadly', 'light', 'medium', 'severe'];
    $x = rand(0, 3);
    return $gravity[$x];
}
function generateType() {
    $type = ['food', 'animals', 'insects', 'other'];
    $x = rand(0, 3);
    return $type[$x];
}

