<x-layout.admin>
    <div class="panel">
        <div class="mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">إضافة حقنة جديدة</h5>
        </div>

        <div class="mb-5">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                <div class="panel">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">بيانات الحقنة</h5>
                    </div>

                    <form action="{{ route('admin.injections.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                            <!-- اسم الحقنة -->
                            <div>
                                <label for="name" class="form-label">اسم الحقنة <span class="text-danger">*</span></label>
                                <input type="text" class="form-input" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- الحالة -->
                            <div>
                                <label for="is_active" class="form-label">الحالة</label>
                                <div class="flex items-center mt-2">
                                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="form-checkbox">
                                    <label for="is_active" class="mr-2">نشط</label>
                                </div>
                            </div>

                            <!-- الوصف -->
                            <div class="lg:col-span-2">
                                <label for="description" class="form-label">الوصف</label>
                                <textarea class="form-input" id="description" name="description" rows="4" placeholder="وصف مفصل للحقنة...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-2 rtl:space-x-reverse mt-8">
                            <a href="{{ route('admin.injections.index') }}" class="btn btn-outline-danger">
                                إلغاء
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <svg class="w-5 h-5 ltr:mr-2 rtl:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                إضافة الحقنة
                            </button>
                        </div>
                    </form>
                </div>

                <div class="panel">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">معلومات إضافية</h5>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-semibold text-gray-800 dark:text-white">نصائح مهمة</h6>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    تأكد من إدخال اسم الحقنة بشكل واضح ومفهوم لسهولة التعرف عليها من قبل الموظفين.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-semibold text-gray-800 dark:text-white">الوصف</h6>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    يمكنك إضافة وصف مفصل للحقنة لتوضيح استخدامها أو أي معلومات إضافية مهمة.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-semibold text-gray-800 dark:text-white">الحالة</h6>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    الحقن غير النشطة لن تظهر في قائمة الحقن المتاحة عند إضافة مريض جديد.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
