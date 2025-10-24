<x-layout.department>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="{{ route('consultation.dashboard') }}" class="text-primary hover:underline">لوحة التحكم</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <a href="{{ route('consultation.patients.index') }}" class="text-primary hover:underline">المرضى</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>تعديل المريض</span>
            </li>
        </ul>

        <div class="pt-5">
            <div class="panel">
                <div class="mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">تعديل بيانات المريض: {{ $patient->full_name }}</h5>
                </div>

                @if ($errors->any())
                    <div class="mb-5">
                        <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
                            <span class="ltr:pr-2 rtl:pl-2">
                                <strong class="ltr:mr-1 rtl:ml-1">خطأ!</strong>
                                <ul class="mt-1 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </span>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('consultation.patients.update', $patient->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- الاسم الرباعي -->
                        <div>
                            <label for="full_name" class="form-label">الاسم الرباعي <span class="text-danger">*</span></label>
                            <input type="text" class="form-input" id="full_name" name="full_name" value="{{ old('full_name', $patient->full_name) }}" required>
                        </div>

                        <!-- الرقم الوطني -->
                        <div>
                            <label for="national_id" class="form-label">الرقم الوطني <span class="text-danger">*</span></label>
                            <input type="text" class="form-input" id="national_id" name="national_id" value="{{ old('national_id', $patient->national_id) }}" required>
                        </div>

                        <!-- البلد -->
                        <div>
                            <label for="country" class="form-label">البلد</label>
                            <input type="text" class="form-input" id="country" name="country" value="{{ old('country', $patient->country) }}">
                        </div>

                        <!-- المحافظة -->
                        <div>
                            <label for="province" class="form-label">المحافظة <span class="text-danger">*</span></label>
                            <input type="text" class="form-input" id="province" name="province" value="{{ old('province', $patient->province) }}" required>
                        </div>

                        <!-- العمر -->
                        <div>
                            <label for="age" class="form-label">العمر <span class="text-danger">*</span></label>
                            <input type="number" class="form-input" id="age" name="age" value="{{ old('age', $patient->age) }}" min="1" max="150" required>
                        </div>

                        <!-- رقم الهاتف -->
                        <div>
                            <label for="phone" class="form-label">رقم الهاتف <span class="text-danger">*</span></label>
                            <input type="text" class="form-input" id="phone" name="phone" value="{{ old('phone', $patient->phone) }}" required>
                        </div>

                        <!-- الجنس -->
                        <div>
                            <label for="gender" class="form-label">الجنس <span class="text-danger">*</span></label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="">اختر الجنس</option>
                                <option value="ذكر" {{ old('gender', $patient->gender) == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                <option value="أنثى" {{ old('gender', $patient->gender) == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                            </select>
                        </div>

                        <!-- القطاع -->
                        <div>
                            <label for="sector" class="form-label">القطاع <span class="text-danger">*</span></label>
                            <select class="form-select" id="sector" name="sector" required>
                                <option value="">اختر القطاع</option>
                                <option value="حكومي" {{ old('sector', $patient->sector) == 'حكومي' ? 'selected' : '' }}>حكومي</option>
                                <option value="عتبة عام" {{ old('sector', $patient->sector) == 'عتبة عام' ? 'selected' : '' }}>عتبة عام</option>
                                <option value="عتبة خاص" {{ old('sector', $patient->sector) == 'عتبة خاص' ? 'selected' : '' }}>عتبة خاص</option>
                            </select>
                        </div>

                        <!-- رسوم الباص -->
                        <div>
                            <label for="bus_fee" class="form-label">رسوم الباص</label>
                            <input type="text" class="form-input" id="bus_fee" name="bus_fee" value="{{ old('bus_fee', $patient->bus_fee) }}">
                        </div>

                        <!-- الطبيب -->
                        <div>
                            <label for="doctor_id" class="form-label">الطبيب المحال إليه <span class="text-danger">*</span></label>
                            <select class="form-select" id="doctor_id" name="doctor_id" required>
                                <option value="">اختر الطبيب</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id', $patient->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ملف التشخيص -->
                        <div>
                            <label for="diagnosis_file" class="form-label">ملف التشخيص</label>
                            @if($patient->diagnosis_file)
                                <div class="mb-2">
                                    <a href="{{ Storage::url($patient->diagnosis_file) }}" target="_blank" class="text-primary hover:underline">
                                        عرض الملف الحالي
                                    </a>
                                </div>
                            @endif
                            <input type="file" class="form-input" id="diagnosis_file" name="diagnosis_file" accept=".pdf,.jpg,.jpeg,.png">
                            <div class="text-xs text-gray-500 mt-1">يمكن رفع ملفات PDF أو صور (JPG, PNG)</div>
                        </div>

                        <!-- ملف السونار -->
                        <div>
                            <label for="sonar_file" class="form-label">ملف السونار</label>
                            @if($patient->sonar_file)
                                <div class="mb-2">
                                    <a href="{{ Storage::url($patient->sonar_file) }}" target="_blank" class="text-primary hover:underline">
                                        عرض الملف الحالي
                                    </a>
                                </div>
                            @endif
                            <input type="file" class="form-input" id="sonar_file" name="sonar_file" accept=".pdf,.jpg,.jpeg,.png">
                            <div class="text-xs text-gray-500 mt-1">يمكن رفع ملفات PDF أو صور (JPG, PNG)</div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-2 rtl:space-x-reverse">
                        <a href="{{ route('consultation.patients.index') }}" class="btn btn-outline-danger">
                            إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            تحديث البيانات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.department>
