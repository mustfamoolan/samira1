<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();

        // تحضير البيانات للجدول
        $adminsData = $admins->map(function ($admin) {
            return [
                $admin->name,
                $admin->phone,
                $admin->created_at->format('Y-m-d'),
                $admin->is_active ? 'نشط' : 'غير نشط',
                '' // عمود الإجراءات
            ];
        })->toArray();

        return view('admin.admins.index', compact('admins', 'adminsData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:admins,phone',
            'password' => 'required|string|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_active' => $request->has('is_active')
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('admin-photos', 'public');
        }

        Admin::create($data);

        return redirect()->route('admin.admins.index')->with('success', 'تم إنشاء المدير بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:admins,phone,' . $admin->id,
            'password' => 'nullable|string|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'is_active' => $request->has('is_active')
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            // حذف الصورة القديمة
            if ($admin->photo) {
                Storage::disk('public')->delete($admin->photo);
            }
            $data['photo'] = $request->file('photo')->store('admin-photos', 'public');
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')->with('success', 'تم تحديث المدير بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        // حذف الصورة إذا كانت موجودة
        if ($admin->photo) {
            Storage::disk('public')->delete($admin->photo);
        }

        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'تم حذف المدير بنجاح');
    }

    /**
     * لوحة تحكم المدير العام
     */
    public function dashboard()
    {
        $stats = [
            'departments_count' => \App\Models\Department::count(),
            'admins_count' => Admin::count(),
            'department_managers_count' => \App\Models\DepartmentManager::count(),
            'employees_count' => \App\Models\Employee::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
