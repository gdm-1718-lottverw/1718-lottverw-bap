<?php

use Illuminate\Database\Seeder;

class ParentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Parents::class, 100)->create()->each(function($parent){
            $parent->addresses()->save(factory(App\Models\Address::class)->make());
        });
    }
}
