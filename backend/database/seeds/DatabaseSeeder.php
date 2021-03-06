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
            ChildrenTableSeeder::class,
            AllergieTableSeeder::class,
            GuardianTableSeeder::class,
            PedagogicReportTableSeeder::class,
            MedicalReportTableSeeder::class,
            DoctorTableSeeder::class,
            OtherInformationTableSeeder::class,
            PlannedAttendanceTableSeeder::class,
            ActionTableSeeder::class,
            LogTableSeeder::class,
            DoctorTableSeeder::class,
            VacationTableSeeder::class,
         ]);
    }
}
