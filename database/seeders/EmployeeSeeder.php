<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Admin',
            'level' => 0,
            'email' => 'admin@example.com',
            'password' => '123',
        ];
        Employee::create($data);

        $data = [
            'name' => 'Super Admin',
            'level' => 1,
            'email' => 'sadmin@example.com',
            'password' => '123',
        ];
        Employee::create($data);
    }
}
