<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Organization::class, 5)->create()->each(function ($organization) {
            $organization->addresses()->save(factory(App\Models\Address::class)->make());
        });
    }
}
