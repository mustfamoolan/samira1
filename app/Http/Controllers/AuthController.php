<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\DepartmentManager;
use App\Models\Employee;
use App\Models\Doctor;

class AuthController extends Controller
{
    /**
     * تسجيل دخول موحد - يتعرف تلقائياً على نوع المستخدم
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $phone = $request->phone;
        $password = $request->password;

        // محاولة تسجيل الدخول كمدير عام
        $admin = Admin::where('phone', $phone)->where('is_active', true)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard')->with('success', 'مرحباً ' . $admin->name);
        }

        // محاولة تسجيل الدخول كطبيب
        $doctor = Doctor::where('phone', $phone)->where('is_active', true)->first();
        if ($doctor && Hash::check($password, $doctor->password)) {
            Auth::guard('doctor')->login($doctor);
            return redirect()->route('doctor.dashboard')->with('success', 'مرحباً د. ' . $doctor->name);
        }

        // محاولة تسجيل الدخول كمسؤول قسم
        $manager = DepartmentManager::where('phone', $phone)->where('is_active', true)->first();
        if ($manager && Hash::check($password, $manager->password)) {
            Auth::guard('department_manager')->login($manager);
            return redirect()->route('department-manager.dashboard')->with('success', 'مرحباً ' . $manager->name);
        }

        // محاولة تسجيل الدخول كموظف
        $employee = Employee::where('phone', $phone)->where('is_active', true)->first();
        if ($employee && Hash::check($password, $employee->password)) {
            Auth::guard('employee')->login($employee);
            return redirect()->route('employee.dashboard')->with('success', 'مرحباً ' . $employee->name);
        }

        // إذا لم يتم العثور على المستخدم أو كانت كلمة المرور خاطئة
        return back()->withErrors(['phone' => 'رقم الهاتف أو كلمة المرور غير صحيحة، أو الحساب غير مفعّل'])->withInput();
    }

    /**
     * تسجيل الخروج الموحد
     */
    public function logout()
    {
        // فحص أي guard مسجل الدخول وتسجيل الخروج منه
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('doctor')->check()) {
            Auth::guard('doctor')->logout();
        } elseif (Auth::guard('department_manager')->check()) {
            Auth::guard('department_manager')->logout();
        } elseif (Auth::guard('employee')->check()) {
            Auth::guard('employee')->logout();
        }

        return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح');
    }

    // ================================================
    // الدوال القديمة للتوافق مع الأكواد السابقة
    // يمكن حذفها لاحقاً
    // ================================================

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح');
    }

    public function departmentManagerLogout()
    {
        Auth::guard('department_manager')->logout();
        return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح');
    }

    public function employeeLogout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح');
    }

    public function doctorLogout()
    {
        Auth::guard('doctor')->logout();
        return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
