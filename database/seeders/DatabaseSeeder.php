<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Database\Seeders\PermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Course::factory(10)->create();
        // Student::factory(100)->create();
        // Employee::factory(10)->create();
        $this->call([
            //EmployeeSeeder::class,
            PermissionsSeeder::class
        ]);
    }
}
