<x-layout.admin>
    <div class="panel">
        <div class="mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">إعدادات الموقع</h5>
        </div>

        @if (session('success'))
            <div class="mb-5 flex items-center p-3.5 rounded text-success bg-success-light dark:bg-success-dark-light">
                <span class="ltr:pr-2 rtl:pl-2">
                    <strong class="ltr:mr-1 rtl:ml-1">نجح!</strong>{{ session('success') }}
                </span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-5 flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
                <span class="ltr:pr-2 rtl:pl-2">
                    <strong class="ltr:mr-1 rtl:ml-1">خطأ!</strong>{{ session('error') }}
                </span>
            </div>
        @endif

        <div class="mb-5">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                <div class="panel">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">بيانات الموقع</h5>
                    </div>

                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-5">
                            <!-- اسم الموقع -->
                            <div>
                                <label for="site_name" class="form-label">اسم الموقع <span class="text-danger">*</span></label>
                                <input type="text" class="form-input" id="site_name" name="site_name" value="{{ old('site_name', $settings->site_name) }}" required>
                                @error('site_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- شعار الموقع -->
                            <div>
                                <label for="site_logo" class="form-label">شعار الموقع</label>
                                @if($settings->site_logo)
                                    <div class="mb-3">
                                        <img src="{{ Storage::url($settings->site_logo) }}" alt="الشعار الحالي" class="w-32 h-32 object-contain border rounded">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">الشعار الحالي</p>
                                    </div>
                                @endif
                                <input type="file" class="form-input" id="site_logo" name="site_logo" accept="image/*">
                                <div class="text-xs text-gray-500 mt-1">يمكن رفع صور JPG, PNG, GIF, SVG (حجم أقصى 2MB)</div>
                                @error('site_logo')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-2 rtl:space-x-reverse mt-8">
                            <button type="submit" class="btn btn-primary">
                                <svg class="w-5 h-5 ltr:mr-2 rtl:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                حفظ الإعدادات
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
                                <h6 class="font-semibold text-gray-800 dark:text-white">اسم الموقع</h6>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    سيظهر اسم الموقع في السايدبار والهيدر وجميع صفحات النظام.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h6 class="font-semibold text-gray-800 dark:text-white">شعار الموقع</h6>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    سيظهر الشعار في السايدبار. يمكن رفع صورة جديدة لاستبدال الشعار الحالي.
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
                                <h6 class="font-semibold text-gray-800 dark:text-white">تحديث فوري</h6>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    التغييرات ستظهر فوراً في جميع صفحات النظام بعد الحفظ.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
