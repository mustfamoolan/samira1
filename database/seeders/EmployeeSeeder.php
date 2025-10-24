<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();

        foreach ($departments as $department) {
            Employee::create([
                'name' => 'موظف ' . $department->name,
                'phone' => '111111111' . $department->id,
                'password' => Hash::make('123456'),
                'department_id' => $department->id,
                'is_active' => true,
            ]);
        }
    }
}
