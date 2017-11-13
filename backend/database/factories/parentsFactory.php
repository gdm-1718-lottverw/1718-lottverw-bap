<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Parents::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'relation' => $faker->word(),
        'family_type' => $faker->word(),
        'email' =>  $faker->unique()->email(),
        'phone_number' =>  $faker->unique()->phoneNumber(),
        'auth_key_id' => factory(App\Models\AuthKey::class)->create()->id,
    ];
});
