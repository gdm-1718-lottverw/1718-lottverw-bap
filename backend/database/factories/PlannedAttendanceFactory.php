<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\PlannedAttendance::class, function (Faker $faker) {
    $children = App\Models\Child::pluck('id');
    $organizations = App\Models\Organization::pluck('id');
    return [
        'date' => $faker->date(),
        'type' => $faker->date(),
        'registered_on' => $faker->date(),
        'has_been_pickup_by' => $faker->date(),
        'pickup_time' => $faker->date(),
        'other_details' => $faker->date(),
        'go_home_alone' => $faker->date(),
        'children_id' => rand(1, (count($children) -1)),
        'organization_id' => rand(1, (count($organizations) -1))
    ];
});

