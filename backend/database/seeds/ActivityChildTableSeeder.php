<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ActivityChildTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ActivityChild::class, 100)->create();
    }
}
