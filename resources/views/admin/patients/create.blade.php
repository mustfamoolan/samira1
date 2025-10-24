<x-layout.admin>
    <div class="panel">
        <div class="mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">إضافة مريض جديد</h5>
        </div>

        <div class="mb-5">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                <div class="panel">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">بيانات المريض</h5>
                    </div>

                    <form action="{{ route('admin.patients.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                            <!-- الاسم الرباعي -->
                            <div>
                                <label for="full_name" class="form-label">الاسم الرباعي <span class="text-danger">*</span></label>
                                <input type="text" class="form-input" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                                @error('full_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- الرقم الوطني -->
                            <div>
                                <label for="national_id" class="form-label">الرقم الوطني <span class="text-danger">*</span></label>
                                <input type="text" class="form-input" id="national_id" name="national_id" value="{{ old('national_id') }}" required>
                                @error('national_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- البلد -->
                            <div>
                                <label for="country" class="form-label">البلد</label>
                                <input type="text" class="form-input" id="country" name="country" value="{{ old('country', 'العراق') }}">
                                @error('country')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- المحافظة -->
                            <div>
                                <label for="province" class="form-label">المحافظة <span class="text-danger">*</span></label>
                                <input type="text" class="form-input" id="province" name="province" value="{{ old('province') }}" required>
                                @error('province')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- العمر -->
                            <div>
                                <label for="age" class="form-label">العمر <span class="text-danger">*</span></label>
                                <input type="number" class="form-input" id="age" name="age" value="{{ old('age') }}" min="1" max="150" required>
                                @error('age')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- رقم الهاتف -->
                            <div>
                                <label for="phone" class="form-label">رقم الهاتف <span class="text-danger">*</span></label>
                                <input type="text" class="form-input" id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- الجنس -->
                            <div>
                                <label for="gender" class="form-label">الجنس <span class="text-danger">*</span></label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">اختر الجنس</option>
                                    <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                    <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                                </select>
                                @error('gender')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- القطاع -->
                            <div>
                                <label for="sector" class="form-label">القطاع <span class="text-danger">*</span></label>
                                <select class="form-select" id="sector" name="sector" required>
                                    <option value="">اختر القطاع</option>
                                    <option value="حكومي" {{ old('sector') == 'حكومي' ? 'selected' : '' }}>حكومي</option>
                                    <option value="عتبة" {{ old('sector') == 'عتبة' ? 'selected' : '' }}>عتبة</option>
                                </select>
                                @error('sector')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- جهة العين -->
                            <div>
                                <label for="eye_side" class="form-label">جهة العين</label>
                                <select class="form-select" id="eye_side" name="eye_side">
                                    <option value="">اختر جهة العين</option>
                                    <option value="يمين" {{ old('eye_side') == 'يمين' ? 'selected' : '' }}>يمين</option>
                                    <option value="يسار" {{ old('eye_side') == 'يسار' ? 'selected' : '' }}>يسار</option>
                                    <option value="يمين+يسار" {{ old('eye_side') == 'يمين+يسار' ? 'selected' : '' }}>يمين+يسار</option>
                                </select>
                                @error('eye_side')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- رسوم الباص -->
                            <div>
                                <label for="bus_fee" class="form-label">رسوم الباص</label>
                                <input type="text" class="form-input" id="bus_fee" name="bus_fee" value="{{ old('bus_fee') }}">
                                @error('bus_fee')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- الطبيب -->
                            <div>
                                <label for="doctor_id" class="form-label">الطبيب <span class="text-danger">*</span></label>
                                <select class="form-select" id="doctor_id" name="doctor_id" required>
                                    <option value="">اختر الطبيب</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- الحالة -->
                            <div>
                                <label for="status" class="form-label">الحالة <span class="text-danger">*</span></label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">اختر الحالة</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                    <option value="complete" {{ old('status') == 'complete' ? 'selected' : '' }}>مكتمل</option>
                                    <option value="review" {{ old('status') == 'review' ? 'selected' : '' }}>مراجعة</option>
                                </select>
                                @error('status')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ملف التشخيص -->
                            <div>
                                <label for="diagnosis_file" class="form-label">ملف التشخيص <span class="text-danger">*</span></label>
                                <input type="file" class="form-input" id="diagnosis_file" name="diagnosis_file" accept=".pdf,.jpg,.jpeg,.png" required>
                                <div class="text-xs text-gray-500 mt-1">يمكن رفع ملفات PDF أو صور (JPG, PNG)</div>
                                @error('diagnosis_file')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ملف السونار -->
                            <div>
                                <label for="sonar_file" class="form-label">ملف السونار</label>
                                <input type="file" class="form-input" id="sonar_file" name="sonar_file" accept=".pdf,.jpg,.jpeg,.png">
                                <div class="text-xs text-gray-500 mt-1">يمكن رفع ملفات PDF أو صور (JPG, PNG)</div>
                                @error('sonar_file')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- الحقنة -->
                            <div>
                                <label for="injection_id" class="form-label">الحقنة</label>
                                <select class="form-select" id="injection_id" name="injection_id">
                                    <option value="">اختر الحقنة</option>
                                    @foreach($injections as $injection)
                                        <option value="{{ $injection->id }}" {{ old('injection_id') == $injection->id ? 'selected' : '' }}>
                                            {{ $injection->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('injection_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- الجرعة الكلية -->
                            <div>
                                <label for="total_dose" class="form-label">الجرعة الكلية</label>
                                <input type="number" class="form-input" id="total_dose" name="total_dose" value="{{ old('total_dose') }}" min="0">
                                <div class="text-xs text-gray-500 mt-1">عدد الجرعات المطلوبة</div>
                                @error('total_dose')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- الجرعة المتبقية -->
                            <div>
                                <label for="remaining_dose" class="form-label">الجرعة المتبقية</label>
                                <input type="number" class="form-input" id="remaining_dose" name="remaining_dose" value="{{ old('remaining_dose') }}" min="0" readonly>
                                <div class="text-xs text-gray-500 mt-1">سيتم حسابها تلقائياً</div>
                                @error('remaining_dose')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-2 rtl:space-x-reverse mt-8">
                            <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-danger">
                                إلغاء
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <svg class="w-5 h-5 ltr:mr-2 rtl:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                إضافة المريض
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // حساب الجرعة المتبقية تلقائياً
        document.getElementById('total_dose').addEventListener('input', function() {
            const totalDose = this.value;
            const remainingDoseField = document.getElementById('remaining_dose');

            if (totalDose && totalDose > 0) {
                remainingDoseField.value = totalDose;
            } else {
                remainingDoseField.value = '';
            }
        });
    </script>
</x-layout.admin>
