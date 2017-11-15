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
        factory(App\Models\PlannedAttendance::class, 900)->create();
    }
}
