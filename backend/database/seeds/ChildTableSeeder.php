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
        factory(App\Models\Child::class, 900)->create()->each(function($child){
            $parents = App\Models\Parents::pluck('id');
            $activities = App\Models\Activity::pluck('id');
            $child->parents()->attach( $parents[ rand(1, (count($parents) -1))] );
            $child->activities()->attach( $activities[ rand(1, (count($activities) -1))] ); 
            $child->addresses()->save(factory(App\Models\Address::class)->make());
        });
    }
}
