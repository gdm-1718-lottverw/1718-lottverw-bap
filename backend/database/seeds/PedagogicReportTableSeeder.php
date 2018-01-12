<?php

use Illuminate\Database\Seeder;

class PedagogicReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\PedagogicReport::class, 100)->create();
    }
}
