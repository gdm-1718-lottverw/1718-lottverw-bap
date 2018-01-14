<?php

use Illuminate\Database\Seeder;

class MedicalReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\MedicalReport::class, 150)->create();
    }
}
