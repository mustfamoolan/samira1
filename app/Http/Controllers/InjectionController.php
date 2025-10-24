<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Injection;
use Illuminate\Support\Facades\Storage;

class InjectionController extends Controller
{
    public function index()
    {
        $injections = Injection::latest()->get();

        // تحضير البيانات للجدول
        $injectionsData = [];
        foreach ($injections as $injection) {
            $injectionsData[] = [
                $injection->name,
                $injection->description ?? 'لا يوجد وصف',
                $injection->created_at->format('Y-m-d'),
                $injection->is_active ? 'نشط' : 'غير نشط',
                '' // عمود الإجراءات
            ];
        }

        return view('admin.injections.index', compact('injections', 'injectionsData'));
    }

    public function create()
    {
        return view('admin.injections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        Injection::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.injections.index')->with('success', 'تم إضافة الحقنة بنجاح');
    }

    public function show(Injection $injection)
    {
        $injection->load('patients');
        return view('admin.injections.show', compact('injection'));
    }

    public function edit(Injection $injection)
    {
        return view('admin.injections.edit', compact('injection'));
    }

    public function update(Request $request, Injection $injection)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        $injection->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.injections.index')->with('success', 'تم تحديث الحقنة بنجاح');
    }

    public function destroy(Injection $injection)
    {
        // التحقق من وجود مرضى مرتبطين بهذه الحقنة
        if ($injection->patients()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'لا يمكن حذف هذه الحقنة لأنها مرتبطة بمرضى'
            ], 400);
        }

        $injection->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الحقنة بنجاح'
        ]);
    }
}
