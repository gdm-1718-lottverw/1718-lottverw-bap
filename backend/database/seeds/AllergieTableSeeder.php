<?php

use Illuminate\Database\Seeder;

class AllergieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Allergie::class, 100)->create();
    }
}
