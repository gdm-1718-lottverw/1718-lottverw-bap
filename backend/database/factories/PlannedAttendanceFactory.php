<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\PlannedAttendance::class, function (Faker $faker) {
    $children = App\Models\Child::pluck('id');
    $organizations = App\Models\Organization::pluck('id');
    $guardian = App\Models\Guardian::pluck('id');
    return [
        'date' => $faker->dateTimeBetween($startDate = '-4 months', $endDate = '+3 months', $timezone = date_default_timezone_get()),
        'type' => generateDay(),
        'go_home_alone' => $faker->boolean($chanceOfGettingTrue = 5),
        'in' => $faker->boolean($chanceOfGettingTrue = 5),
        'out' => $faker->boolean($chanceOfGettingTrue = 0),
        'organization_id' => rand(1, (count($organizations) - 1)),
        'child_id' => rand(1, (count($children) - 1)),
        'parent_notes' => $faker->sentence($nbWords = 12, $variableNbWords = true)
    ];
});


function generateDay() {
    $type = ['voormiddag', 'namiddag'];
    $x = rand(0, 1);
    return $type[$x];
} 

