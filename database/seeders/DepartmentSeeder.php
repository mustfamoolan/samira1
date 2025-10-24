<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'قسم الاستشارية',
                'description' => 'قسم الاستشارية لتسجيل وإدارة المرضى الجدد والاستشارات الطبية',
                'department_type' => 'consultation',
                'is_active' => true,
            ],
            [
                'name' => 'قسم فحص البصر',
                'description' => 'قسم فحص البصر لفحوصات النظر وقياسات العين',
                'department_type' => 'vision_test',
                'is_active' => true,
            ],
            [
                'name' => 'وحدة المذخر',
                'description' => 'وحدة المذخر لإدارة الأدوية والمواد الطبية والمخزون',
                'department_type' => 'pharmacy',
                'is_active' => true,
            ],
            [
                'name' => 'قسم الحسابات',
                'description' => 'قسم الحسابات للأمور المالية والفواتير والمدفوعات',
                'department_type' => 'accounting',
                'is_active' => true,
            ],
            [
                'name' => 'قسم العمليات',
                'description' => 'قسم العمليات للعمليات الجراحية وإدارة غرف العمليات',
                'department_type' => 'operations',
                'is_active' => true,
            ],
            [
                'name' => 'قسم الحجوزات',
                'description' => 'قسم الحجوزات لحجز المواعيد وإدارة الجدول اليومي',
                'department_type' => 'bookings',
                'is_active' => true,
            ],
            [
                'name' => 'وحدة الحقن',
                'description' => 'وحدة الحقن لجلسات الحقن والعلاجات التخصصية',
                'department_type' => 'injection',
                'is_active' => true,
            ],
            [
                'name' => 'قسم الإحصاء',
                'description' => 'قسم الإحصاء للتقارير والإحصائيات وتحليل البيانات',
                'department_type' => 'statistics',
                'is_active' => true,
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
