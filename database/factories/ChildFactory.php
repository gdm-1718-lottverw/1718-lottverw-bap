

<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */


$factory->define(App\Models\Child::class, function (Faker $faker) {
    $o = App\Models\Organization::pluck('id');
    return [
        'name' => $faker->firstName() . " " . $faker->lastName(),
        'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '-3 years', $min = '-12 years'),
        'national_regestry_number' =>  generateNumber(),
        'gender' =>  generateSex(),
        'organization_id' => rand(1, (count($o) - 1)),
        'potty_trained' => $faker->boolean($chanceOfGettingTrue = 80)
    ];
});

function generateNumber($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateSex() {
    $m = 'male'; $f = 'female';
    if(rand(0, 10) % 2){
        return $m;
    } else {
        return $f;
    }
    
}

