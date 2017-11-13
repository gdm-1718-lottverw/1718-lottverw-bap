<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
            RoleTableSeeder::class,
            ParentTableSeeder::class,
            OrganizationTableSeeder::class,
            ActivityTableSeeder::class,
            ChildrenTableSeeder::class,
            ActivityChildTableSeeder::class,
            AllergieTableSeeder::class,
         ]);
    }
}
