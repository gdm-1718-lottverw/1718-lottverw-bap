<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['organization', 'parent'];
        foreach($roles as $r){
            DB::table('roles')->insert([
                'name' => $r,
                'active' => true,
            ]);
        }
    }
}
