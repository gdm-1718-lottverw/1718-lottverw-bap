<?php

use Illuminate\Database\Seeder;

class ChildrenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Child::class, 200)->create()->each(function($child){
            $parents = App\Models\Parents::pluck('id');
            $child->parents()->attach( $parents[ rand(1, (count($parents) -1))] );
        });
    }
}
