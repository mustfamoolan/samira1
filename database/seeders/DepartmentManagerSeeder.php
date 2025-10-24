<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DepartmentManager;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class DepartmentManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();

        foreach ($departments as $department) {
            DepartmentManager::create([
                'name' => 'مسؤول ' . $department->name,
                'phone' => '222222222' . $department->id,
                'password' => Hash::make('123456'),
                'department_id' => $department->id,
                'is_active' => true,
            ]);
        }
    }
}
