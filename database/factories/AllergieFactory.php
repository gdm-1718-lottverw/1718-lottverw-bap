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
    $gravity = ['deadly', 'light', 'medium light', 'medium', 'severe'];
    $x = rand(1, 5);
    if($x == 1){
        return $gravity[0];
    } else if( $x == 2) {
        return $gravity[1];
    }else if( $x == 3) {
        return $gravity[3];
    }else if( $x == 4) {
        return $gravity[3];
    }else if( $x == 5) {
        return $gravity[4];
    }
}
function generateType() {
    $type = ['food', 'latex', 'pollen', 'animal', 'insects', 'other'];
    $x = rand(1, 6);
    if($x == 1){
        return $type[0];
    } else if( $x == 2) {
        return $type[1];
    }else if( $x == 3) {
        return $type[3];
    }else if( $x == 4) {
        return $type[3];
    }else if( $x == 5) {
        return $type[4];
    } else if( $x == 6) {
        return $type[5];
    }
}

