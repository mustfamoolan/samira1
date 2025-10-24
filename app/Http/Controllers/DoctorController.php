<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();

        // تحضير البيانات للجدول
        $doctorsData = $doctors->map(function ($doctor) {
            return [
                $doctor->name,
                $doctor->phone,
                $doctor->created_at->format('Y-m-d'),
                $doctor->is_active ? 'نشط' : 'غير نشط',
                '' // عمود الإجراءات
            ];
        })->toArray();

        return view('admin.doctors.index', compact('doctors', 'doctorsData'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:doctors,phone',
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
            $data['photo'] = $request->file('photo')->store('doctor-photos', 'public');
        }

        Doctor::create($data);
        return redirect()->route('admin.doctors.index')->with('success', 'تم إنشاء الطبيب بنجاح');
    }

    public function show(Doctor $doctor)
    {
        return view('admin.doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:doctors,phone,' . $doctor->id,
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
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $request->file('photo')->store('doctor-photos', 'public');
        }

        $doctor->update($data);
        return redirect()->route('admin.doctors.index')->with('success', 'تم تحديث الطبيب بنجاح');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'تم حذف الطبيب بنجاح');
    }

    public function dashboard()
    {
        $doctor = auth('doctor')->user();
        return view('doctor.dashboard', compact('doctor'));
    }
}
