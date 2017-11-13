<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            DB::table('addresses')->insert([
                'postal_code' => $faker->postcode,
                'number' => $faker->buildingNumber,
                'street' => $faker->streetName,
                'city' => $faker->city,
                'country' => 'belgium'
            ]);
        }
    }
}