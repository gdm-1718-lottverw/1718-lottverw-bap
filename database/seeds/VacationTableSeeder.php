<?php

use Illuminate\Database\Seeder;

class VacationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Vacation::class, 360)->create();
    }
}
