<?php

use Illuminate\Database\Seeder;

class OtherInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\OtherInformation::class, 25)->create();
    }
}
