<x-layout.department>
    <div class="panel">
        <div class="panel-header">
            <h5 class="text-lg font-semibold">ملف المريض</h5>
        </div>
        <div class="panel-body">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-semibold">الاسم الرباعي:</label>
                    <p>{{ $patient->full_name }}</p>
                </div>
                <div>
                    <label class="font-semibold">الرقم الوطني:</label>
                    <p>{{ $patient->national_id }}</p>
                </div>
                <div>
                    <label class="font-semibold">العمر:</label>
                    <p>{{ $patient->age }} سنة</p>
                </div>
                <div>
                    <label class="font-semibold">الجنس:</label>
                    <p>{{ $patient->gender }}</p>
                </div>
                <div>
                    <label class="font-semibold">رقم الهاتف:</label>
                    <p>{{ $patient->phone }}</p>
                </div>
                <div>
                    <label class="font-semibold">المحافظة:</label>
                    <p>{{ $patient->province }}</p>
                </div>
                <div>
                    <label class="font-semibold">القطاع:</label>
                    <p>{{ $patient->sector }}</p>
                </div>
                <div>
                    <label class="font-semibold">الطبيب:</label>
                    <p>{{ $patient->doctor->name ?? 'غير محدد' }}</p>
                </div>
                @if($patient->bus_fee)
                <div>
                    <label class="font-semibold">رسوم الباص:</label>
                    <p>{{ $patient->bus_fee }}</p>
                </div>
                @endif
                @if($patient->diagnosis_file)
                <div>
                    <label class="font-semibold">ملف التشخيص:</label>
                    <p>
                        <a href="{{ Storage::url($patient->diagnosis_file) }}" target="_blank" class="text-primary hover:underline">
                            عرض الملف
                        </a>
                    </p>
                </div>
                @endif
                @if($patient->sonar_file)
                <div>
                    <label class="font-semibold">ملف السونار:</label>
                    <p>
                        <a href="{{ Storage::url($patient->sonar_file) }}" target="_blank" class="text-primary hover:underline">
                            عرض الملف
                        </a>
                    </p>
                </div>
                @endif
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('consultation.patients.edit', $patient->id) }}" class="btn btn-primary">
                    تعديل البيانات
                </a>
                <a href="{{ route('consultation.patients.index') }}" class="btn btn-secondary">
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>
</x-layout.department>
