<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Injection;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with(['doctor', 'injection'])->latest()->get();

        // تحضير البيانات للجدول
        $patientsData = [];
        foreach ($patients as $patient) {
            $patientsData[] = [
                $patient->full_name,
                $patient->national_id,
                $patient->age,
                $patient->gender,
                $patient->province,
                $patient->doctor ? $patient->doctor->name : 'غير محدد',
                $patient->status,
                $patient->injection ? $patient->injection->name : 'لا يوجد',
                $patient->remaining_dose ?? 'غير محدد',
                '' // سيتم ملؤها في JavaScript
            ];
        }

        return view('admin.patients.index', compact('patients', 'patientsData'));
    }

    public function create()
    {
        $doctors = Doctor::where('is_active', true)->get();
        $injections = Injection::where('is_active', true)->get();
        return view('admin.patients.create', compact('doctors', 'injections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id' => 'required|string|unique:patients,national_id',
            'country' => 'nullable|string|max:100',
            'province' => 'required|string|max:100',
            'age' => 'required|integer|min:1|max:150',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:ذكر,أنثى',
            'sector' => 'required|in:حكومي,عتبة',
            'eye_side' => 'nullable|in:يمين,يسار,يمين+يسار',
            'bus_fee' => 'nullable|string|max:100',
            'doctor_id' => 'required|exists:doctors,id',
            'status' => 'required|in:pending,complete,review',
            'diagnosis_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // ملف التشخيص إجباري
            'sonar_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // ملف السونار اختياري
            'injection_id' => 'nullable|exists:injections,id',
            'total_dose' => 'nullable|integer|min:0',
            'remaining_dose' => 'nullable|integer|min:0'
        ]);

        $data = $request->all();
        if (empty($data['country'])) {
            $data['country'] = 'العراق';
        }

        // رفع ملف التشخيص
        if ($request->hasFile('diagnosis_file')) {
            $data['diagnosis_file'] = $request->file('diagnosis_file')->store('patient-diagnosis', 'public');
        }

        // رفع ملف السونار
        if ($request->hasFile('sonar_file')) {
            $data['sonar_file'] = $request->file('sonar_file')->store('patient-sonar', 'public');
        }

        // إذا تم اختيار حقنة، اجعل الجرعة المتبقية تساوي الجرعة الكلية
        if ($request->injection_id && $request->total_dose) {
            $data['remaining_dose'] = $request->total_dose;
        }

        Patient::create($data);
        return redirect()->route('admin.patients.index')->with('success', 'تم إضافة المريض بنجاح');
    }

    public function show(Patient $patient)
    {
        $patient->load(['doctor', 'injection']);
        return view('admin.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        $doctors = Doctor::where('is_active', true)->get();
        $injections = Injection::where('is_active', true)->get();
        return view('admin.patients.edit', compact('patient', 'doctors', 'injections'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id' => 'required|string|unique:patients,national_id,' . $patient->id,
            'country' => 'nullable|string|max:100',
            'province' => 'required|string|max:100',
            'age' => 'required|integer|min:1|max:150',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:ذكر,أنثى',
            'sector' => 'required|in:حكومي,عتبة',
            'eye_side' => 'nullable|in:يمين,يسار,يمين+يسار',
            'bus_fee' => 'nullable|string|max:100',
            'doctor_id' => 'required|exists:doctors,id',
            'status' => 'required|in:pending,complete,review',
            'diagnosis_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'sonar_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'injection_id' => 'nullable|exists:injections,id',
            'total_dose' => 'nullable|integer|min:0',
            'remaining_dose' => 'nullable|integer|min:0'
        ]);

        $data = $request->all();
        if (empty($data['country'])) {
            $data['country'] = 'العراق';
        }

        // رفع ملف التشخيص الجديد
        if ($request->hasFile('diagnosis_file')) {
            // حذف الملف القديم
            if ($patient->diagnosis_file) {
                Storage::disk('public')->delete($patient->diagnosis_file);
            }
            $data['diagnosis_file'] = $request->file('diagnosis_file')->store('patient-diagnosis', 'public');
        }

        // رفع ملف السونار الجديد
        if ($request->hasFile('sonar_file')) {
            // حذف الملف القديم
            if ($patient->sonar_file) {
                Storage::disk('public')->delete($patient->sonar_file);
            }
            $data['sonar_file'] = $request->file('sonar_file')->store('patient-sonar', 'public');
        }

        // إذا تم اختيار حقنة، اجعل الجرعة المتبقية تساوي الجرعة الكلية
        if ($request->injection_id && $request->total_dose) {
            $data['remaining_dose'] = $request->total_dose;
        }

        $patient->update($data);
        return redirect()->route('admin.patients.index')->with('success', 'تم تحديث بيانات المريض بنجاح');
    }

    public function destroy(Patient $patient)
    {
        // حذف الملفات المرتبطة
        if ($patient->diagnosis_file) {
            Storage::disk('public')->delete($patient->diagnosis_file);
        }
        if ($patient->sonar_file) {
            Storage::disk('public')->delete($patient->sonar_file);
        }

        $patient->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف المريض بنجاح'
        ]);
    }

    // Methods for Consultation Department
    public function indexConsultation()
    {
        $patients = Patient::with(['doctor', 'injection'])->latest()->get();

        // تحضير البيانات للجدول
        $patientsData = [];
        foreach ($patients as $patient) {
            $patientsData[] = [
                $patient->full_name,
                $patient->national_id,
                $patient->age,
                $patient->gender,
                $patient->province,
                $patient->doctor ? $patient->doctor->name : 'غير محدد',
                $patient->status,
                $patient->injection ? $patient->injection->name : 'لا يوجد',
                $patient->remaining_dose ?? 'غير محدد',
                '' // سيتم ملؤها في JavaScript
            ];
        }

        return view('departments.consultation.patients.index', compact('patients', 'patientsData'));
    }

    public function createConsultation()
    {
        $doctors = Doctor::where('is_active', true)->get();
        $injections = Injection::where('is_active', true)->get();
        return view('departments.consultation.patients.create', compact('doctors', 'injections'));
    }

    public function storeConsultation(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id' => 'required|string|unique:patients,national_id',
            'country' => 'nullable|string|max:100',
            'province' => 'required|string|max:100',
            'age' => 'required|integer|min:1|max:150',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:ذكر,أنثى',
            'sector' => 'required|in:حكومي,عتبة',
            'eye_side' => 'nullable|in:يمين,يسار,يمين+يسار',
            'bus_fee' => 'nullable|string|max:100',
            'doctor_id' => 'required|exists:doctors,id',
            'status' => 'required|in:pending,complete,review',
            'diagnosis_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'sonar_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'injection_id' => 'nullable|exists:injections,id',
            'total_dose' => 'nullable|integer|min:0',
            'remaining_dose' => 'nullable|integer|min:0'
        ]);

        $data = $request->all();
        if (empty($data['country'])) {
            $data['country'] = 'العراق';
        }

        // رفع ملف التشخيص
        if ($request->hasFile('diagnosis_file')) {
            $data['diagnosis_file'] = $request->file('diagnosis_file')->store('patient-diagnosis', 'public');
        }

        // رفع ملف السونار
        if ($request->hasFile('sonar_file')) {
            $data['sonar_file'] = $request->file('sonar_file')->store('patient-sonar', 'public');
        }

        // إذا تم اختيار حقنة، اجعل الجرعة المتبقية تساوي الجرعة الكلية
        if ($request->injection_id && $request->total_dose) {
            $data['remaining_dose'] = $request->total_dose;
        }

        Patient::create($data);
        return redirect()->route('consultation.patients.index')->with('success', 'تم إضافة المريض بنجاح');
    }

    public function editConsultation(Patient $patient)
    {
        $doctors = Doctor::where('is_active', true)->get();
        $injections = Injection::where('is_active', true)->get();
        return view('departments.consultation.patients.edit', compact('patient', 'doctors', 'injections'));
    }

    public function updateConsultation(Request $request, Patient $patient)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id' => 'required|string|unique:patients,national_id,' . $patient->id,
            'country' => 'nullable|string|max:100',
            'province' => 'required|string|max:100',
            'age' => 'required|integer|min:1|max:150',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:ذكر,أنثى',
            'sector' => 'required|in:حكومي,عتبة',
            'eye_side' => 'nullable|in:يمين,يسار,يمين+يسار',
            'bus_fee' => 'nullable|string|max:100',
            'doctor_id' => 'required|exists:doctors,id',
            'status' => 'required|in:pending,complete,review',
            'diagnosis_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'sonar_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'injection_id' => 'nullable|exists:injections,id',
            'total_dose' => 'nullable|integer|min:0',
            'remaining_dose' => 'nullable|integer|min:0'
        ]);

        $data = $request->all();
        if (empty($data['country'])) {
            $data['country'] = 'العراق';
        }

        // رفع ملف التشخيص الجديد
        if ($request->hasFile('diagnosis_file')) {
            // حذف الملف القديم
            if ($patient->diagnosis_file) {
                Storage::disk('public')->delete($patient->diagnosis_file);
            }
            $data['diagnosis_file'] = $request->file('diagnosis_file')->store('patient-diagnosis', 'public');
        }

        // رفع ملف السونار الجديد
        if ($request->hasFile('sonar_file')) {
            // حذف الملف القديم
            if ($patient->sonar_file) {
                Storage::disk('public')->delete($patient->sonar_file);
            }
            $data['sonar_file'] = $request->file('sonar_file')->store('patient-sonar', 'public');
        }

        // إذا تم اختيار حقنة، اجعل الجرعة المتبقية تساوي الجرعة الكلية
        if ($request->injection_id && $request->total_dose) {
            $data['remaining_dose'] = $request->total_dose;
        }

        $patient->update($data);
        return redirect()->route('consultation.patients.index')->with('success', 'تم تحديث بيانات المريض بنجاح');
    }

    public function destroyConsultation(Patient $patient)
    {
        // حذف الملفات المرتبطة
        if ($patient->diagnosis_file) {
            Storage::disk('public')->delete($patient->diagnosis_file);
        }
        if ($patient->sonar_file) {
            Storage::disk('public')->delete($patient->sonar_file);
        }

        $patient->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف المريض بنجاح'
        ]);
    }
}
