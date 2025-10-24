<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentManager;
use App\Models\Employee;
use App\Models\Patient;
use Illuminate\Http\Request;

class DepartmentViewController extends Controller
{
    /**
     * عرض dashboard قسم الاستشارية
     */
    public function consultation()
    {
        $department = Department::where('department_type', 'consultation')->first();

        if (!$department) {
            abort(404, 'قسم الاستشارية غير موجود');
        }

        $managers = DepartmentManager::where('department_id', $department->id)->get();
        $employees = Employee::where('department_id', $department->id)->get();
        $patients = Patient::whereHas('doctor', function($query) use ($department) {
            $query->where('department_id', $department->id);
        })->get();

        $stats = [
            'managers_count' => $managers->count(),
            'employees_count' => $employees->count(),
            'patients_count' => $patients->count(),
            'pending_patients' => $patients->where('status', 'pending')->count(),
            'completed_patients' => $patients->where('status', 'complete')->count(),
        ];

        return view('admin.departments.consultation.dashboard', compact('department', 'managers', 'employees', 'patients', 'stats'));
    }

    /**
     * عرض dashboard قسم فحص البصر
     */
    public function visionTest()
    {
        $department = Department::where('department_type', 'vision_test')->first();

        if (!$department) {
            abort(404, 'قسم فحص البصر غير موجود');
        }

        $managers = DepartmentManager::where('department_id', $department->id)->get();
        $employees = Employee::where('department_id', $department->id)->get();
        $patients = Patient::whereHas('doctor', function($query) use ($department) {
            $query->where('department_id', $department->id);
        })->get();

        $stats = [
            'managers_count' => $managers->count(),
            'employees_count' => $employees->count(),
            'patients_count' => $patients->count(),
            'pending_patients' => $patients->where('status', 'pending')->count(),
            'completed_patients' => $patients->where('status', 'complete')->count(),
        ];

        return view('admin.departments.vision-test.dashboard', compact('department', 'managers', 'employees', 'patients', 'stats'));
    }

    /**
     * عرض dashboard وحدة المذخر
     */
    public function pharmacy()
    {
        $department = Department::where('department_type', 'pharmacy')->first();

        if (!$department) {
            abort(404, 'وحدة المذخر غير موجودة');
        }

        $managers = DepartmentManager::where('department_id', $department->id)->get();
        $employees = Employee::where('department_id', $department->id)->get();

        $stats = [
            'managers_count' => $managers->count(),
            'employees_count' => $employees->count(),
        ];

        return view('admin.departments.pharmacy.dashboard', compact('department', 'managers', 'employees', 'stats'));
    }

    /**
     * عرض dashboard قسم الحسابات
     */
    public function accounting()
    {
        $department = Department::where('department_type', 'accounting')->first();

        if (!$department) {
            abort(404, 'قسم الحسابات غير موجود');
        }

        $managers = DepartmentManager::where('department_id', $department->id)->get();
        $employees = Employee::where('department_id', $department->id)->get();

        $stats = [
            'managers_count' => $managers->count(),
            'employees_count' => $employees->count(),
        ];

        return view('admin.departments.accounting.dashboard', compact('department', 'managers', 'employees', 'stats'));
    }

    /**
     * عرض dashboard قسم العمليات
     */
    public function operations()
    {
        $department = Department::where('department_type', 'operations')->first();

        if (!$department) {
            abort(404, 'قسم العمليات غير موجود');
        }

        $managers = DepartmentManager::where('department_id', $department->id)->get();
        $employees = Employee::where('department_id', $department->id)->get();
        $patients = Patient::whereHas('doctor', function($query) use ($department) {
            $query->where('department_id', $department->id);
        })->get();

        $stats = [
            'managers_count' => $managers->count(),
            'employees_count' => $employees->count(),
            'patients_count' => $patients->count(),
            'pending_patients' => $patients->where('status', 'pending')->count(),
            'completed_patients' => $patients->where('status', 'complete')->count(),
        ];

        return view('admin.departments.operations.dashboard', compact('department', 'managers', 'employees', 'patients', 'stats'));
    }

    /**
     * عرض dashboard قسم الحجوزات
     */
    public function bookings()
    {
        $department = Department::where('department_type', 'bookings')->first();

        if (!$department) {
            abort(404, 'قسم الحجوزات غير موجود');
        }

        $managers = DepartmentManager::where('department_id', $department->id)->get();
        $employees = Employee::where('department_id', $department->id)->get();

        $stats = [
            'managers_count' => $managers->count(),
            'employees_count' => $employees->count(),
        ];

        return view('admin.departments.bookings.dashboard', compact('department', 'managers', 'employees', 'stats'));
    }

    /**
     * عرض dashboard وحدة الحقن
     */
    public function injection()
    {
        $department = Department::where('department_type', 'injection')->first();

        if (!$department) {
            abort(404, 'وحدة الحقن غير موجودة');
        }

        $managers = DepartmentManager::where('department_id', $department->id)->get();
        $employees = Employee::where('department_id', $department->id)->get();
        $patients = Patient::whereHas('doctor', function($query) use ($department) {
            $query->where('department_id', $department->id);
        })->get();

        $stats = [
            'managers_count' => $managers->count(),
            'employees_count' => $employees->count(),
            'patients_count' => $patients->count(),
            'pending_patients' => $patients->where('status', 'pending')->count(),
            'completed_patients' => $patients->where('status', 'complete')->count(),
        ];

        return view('admin.departments.injection.dashboard', compact('department', 'managers', 'employees', 'patients', 'stats'));
    }

    /**
     * عرض dashboard قسم الإحصاء
     */
    public function statistics()
    {
        $department = Department::where('department_type', 'statistics')->first();

        if (!$department) {
            abort(404, 'قسم الإحصاء غير موجود');
        }

        $managers = DepartmentManager::where('department_id', $department->id)->get();
        $employees = Employee::where('department_id', $department->id)->get();

        $stats = [
            'managers_count' => $managers->count(),
            'employees_count' => $employees->count(),
        ];

        return view('admin.departments.statistics.dashboard', compact('department', 'managers', 'employees', 'stats'));
    }
}
