<?php

use Illuminate\Database\Seeder;

class GuardianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Guardian::class, 100)->create()->each(function($guard){
            $children = App\Models\Child::pluck('id');
            $guard->children()->attach( $children[ rand(1, (count($children) -1))] );
        });
    }
}
