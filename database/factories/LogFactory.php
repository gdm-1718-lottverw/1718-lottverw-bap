<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Log::class, function (Faker $faker) {
    $children = App\Models\Child::pluck('id');
    $actions = App\Models\Action::pluck('id');
    $organizations = App\Models\Organization::pluck('id');
   
    return [
        'action_time' => $faker->boolean($chanceOfGettingTrue = 5),
        'action_id' => rand(1, (count($actions) - 1)),
        'organization_id' => rand(1, (count($organizations) - 1)),
        'child_id' => rand(1, (count($children) - 1))
    ];
});
