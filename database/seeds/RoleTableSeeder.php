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
        DB::table('roles')->insert([
            'name' => 'admin',
            'active' => true,
        ]);

        DB::table('roles')->insert([
            'name' => 'parent',
            'active' => true,
        ]);

        DB::table('roles')->insert([
            'name' => 'guardian',
            'active' => true,
        ]);
    }
}
