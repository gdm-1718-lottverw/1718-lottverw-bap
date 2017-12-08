<?php

use Illuminate\Database\Seeder;

class PlannedAttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "BRU";
        factory(App\Models\PlannedAttendance::class, 200)->create();
    }
}
