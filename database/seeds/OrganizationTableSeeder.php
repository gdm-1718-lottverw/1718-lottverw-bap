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
        factory(App\Models\Organization::class, 100)->create()->each(function ($organization) {
          //  $organization->authKey()->save(factory(App\Models\AuthKey::class)->make());
            $organization->addresses()->save(factory(App\Models\Address::class)->make());
        });
    }
}
