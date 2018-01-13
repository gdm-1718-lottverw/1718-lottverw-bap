<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Vacation::class, function (Faker $faker) {
	$o = App\Models\Organization::pluck('id');
    return [
        'occasion' => $faker->words($nb = 2, $asText = true),
        'day' => $faker->dateTimeBetween($startDate = '-1 months', $endDate = '+1 year', $timezone = date_default_timezone_get()),
        'organization_id' => rand(1, (count($o) -1))
    ];
});
