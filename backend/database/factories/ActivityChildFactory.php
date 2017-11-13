<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\ActivityChild::class, function (Faker $faker) {
    $children = App\Models\Child::pluck('id');
    $activity = App\Models\Activity::pluck('id');
    return [
        'child_id' => rand(1, (count($children) -1)),
        'activity_id' => rand(1, (count($activity) -1))
    ];
});
