<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentManager;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DepartmentManagerController extends Controller
{
    public function index()
    {
        $managers = DepartmentManager::with('department')->get();

        // تحضير البيانات للجدول
        $managersData = $managers->map(function ($manager) {
            return [
                $manager->name,
                $manager->phone,
                $manager->department->name,
                $manager->created_at->format('Y-m-d'),
                $manager->is_active ? 'نشط' : 'غير نشط',
                '' // عمود الإجراءات
            ];
        })->toArray();

        return view('admin.department-managers.index', compact('managers', 'managersData'));
    }

    public function create()
    {
        $departments = Department::where('is_active', true)->get();
        return view('admin.department-managers.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:department_managers,phone',
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
            $data['photo'] = $request->file('photo')->store('manager-photos', 'public');
        }

        DepartmentManager::create($data);
        return redirect()->route('admin.department-managers.index')->with('success', 'تم إنشاء مسؤول القسم بنجاح');
    }

    public function show(DepartmentManager $departmentManager)
    {
        $departmentManager->load('department');
        return view('admin.department-managers.show', compact('departmentManager'));
    }

    public function edit(DepartmentManager $departmentManager)
    {
        $departments = Department::where('is_active', true)->get();
        return view('admin.department-managers.edit', compact('departmentManager', 'departments'));
    }

    public function update(Request $request, DepartmentManager $departmentManager)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:department_managers,phone,' . $departmentManager->id,
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
            if ($departmentManager->photo) {
                Storage::disk('public')->delete($departmentManager->photo);
            }
            $data['photo'] = $request->file('photo')->store('manager-photos', 'public');
        }

        $departmentManager->update($data);
        return redirect()->route('admin.department-managers.index')->with('success', 'تم تحديث مسؤول القسم بنجاح');
    }

    public function destroy(DepartmentManager $departmentManager)
    {
        if ($departmentManager->photo) {
            Storage::disk('public')->delete($departmentManager->photo);
        }
        $departmentManager->delete();
        return redirect()->route('admin.department-managers.index')->with('success', 'تم حذف مسؤول القسم بنجاح');
    }

    public function dashboard()
    {
        $manager = auth('department_manager')->user();
        $department = $manager->department;
        $stats = [
            'employees_count' => $department->employees()->count(),
        ];

        // توجيه حسب نوع القسم
        switch($department->department_type) {
            case 'consultation':
                // توجيه مسؤولي الاستشارية مباشرة لصفحة المرضى
                return redirect()->route('consultation.patients.index');
            case 'vision_test':
                return view('departments.vision-test.dashboard', compact('manager', 'department', 'stats'));
            case 'pharmacy':
                return view('departments.pharmacy.dashboard', compact('manager', 'department', 'stats'));
            case 'accounting':
                return view('departments.accounting.dashboard', compact('manager', 'department', 'stats'));
            case 'operations':
                return view('departments.operations.dashboard', compact('manager', 'department', 'stats'));
            case 'bookings':
                return view('departments.bookings.dashboard', compact('manager', 'department', 'stats'));
            case 'injection':
                return view('departments.injection.dashboard', compact('manager', 'department', 'stats'));
            case 'statistics':
                return view('departments.statistics.dashboard', compact('manager', 'department', 'stats'));
            default:
                abort(404, 'القسم غير موجود');
        }
    }
}
