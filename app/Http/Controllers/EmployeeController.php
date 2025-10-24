<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')->get();

        // تحضير البيانات للجدول
        $employeesData = $employees->map(function ($employee) {
            return [
                $employee->name,
                $employee->phone,
                $employee->department->name,
                $employee->created_at->format('Y-m-d'),
                $employee->is_active ? 'نشط' : 'غير نشط',
                '' // عمود الإجراءات
            ];
        })->toArray();

        return view('admin.employees.index', compact('employees', 'employeesData'));
    }

    public function create()
    {
        $departments = Department::where('is_active', true)->get();
        return view('admin.employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:employees,phone',
            'password' => 'required|string|min:6',
            'department_id' => 'required|exists:departments,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
            'is_active' => $request->has('is_active')
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('employee-photos', 'public');
        }

        Employee::create($data);
        return redirect()->route('admin.employees.index')->with('success', 'تم إنشاء الموظف بنجاح');
    }

    public function show(Employee $employee)
    {
        $employee->load('department');
        return view('admin.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::where('is_active', true)->get();
        return view('admin.employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:employees,phone,' . $employee->id,
            'password' => 'nullable|string|min:6',
            'department_id' => 'required|exists:departments,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'department_id' => $request->department_id,
            'is_active' => $request->has('is_active')
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }
            $data['photo'] = $request->file('photo')->store('employee-photos', 'public');
        }

        $employee->update($data);
        return redirect()->route('admin.employees.index')->with('success', 'تم تحديث الموظف بنجاح');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->photo) {
            Storage::disk('public')->delete($employee->photo);
        }
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success', 'تم حذف الموظف بنجاح');
    }

    public function dashboard()
    {
        $employee = auth('employee')->user();
        $department = $employee->department;

        // توجيه حسب نوع القسم
        switch($department->department_type) {
            case 'consultation':
                // توجيه موظفي الاستشارية مباشرة لصفحة المرضى
                return redirect()->route('consultation.patients.index');
            case 'vision_test':
                return view('departments.vision-test.dashboard', compact('employee', 'department'));
            case 'pharmacy':
                return view('departments.pharmacy.dashboard', compact('employee', 'department'));
            case 'accounting':
                return view('departments.accounting.dashboard', compact('employee', 'department'));
            case 'operations':
                return view('departments.operations.dashboard', compact('employee', 'department'));
            case 'bookings':
                return view('departments.bookings.dashboard', compact('employee', 'department'));
            case 'injection':
                return view('departments.injection.dashboard', compact('employee', 'department'));
            case 'statistics':
                return view('departments.statistics.dashboard', compact('employee', 'department'));
            default:
                abort(404, 'القسم غير موجود');
        }
    }
}
