<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Activity::class, 50)->create();
    }
}
