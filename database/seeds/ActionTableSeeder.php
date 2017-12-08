<?php

use Illuminate\Database\Seeder;

class ActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = ['in', 'out'];
        foreach($actions as $a){
            DB::table('actions')->insert([
                'name' => $a,
                'active' => true,
            ]);
        }
    }
}
