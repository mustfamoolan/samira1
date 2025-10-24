<x-layout.admin>
    <div class="panel">
        <div class="mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">تعديل الحقنة</h5>
        </div>

        <div class="mb-5">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                <div class="panel">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">بيانات الحقنة</h5>
                    </div>

                    <form action="{{ route('admin.injections.update', $injection->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                            <!-- اسم الحقنة -->
                            <div>
                                <label for="name" class="form-label">اسم الحقنة <span class="text-danger">*</span></label>
                                <input type="text" class="form-input" id="name" name="name" value="{{ old('name', $injection->name) }}" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- الحالة -->
                            <div>
                                <label for="is_active" class="form-label">الحالة</label>
                                <div class="flex items-center mt-2">
                                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $injection->is_active) ? 'checked' : '' }} class="form-checkbox">
                                    <label for="is_active" class="mr-2">نشط</label>
                                </div>
                            </div>

                            <!-- الوصف -->
                            <div class="lg:col-span-2">
                                <label for="description" class="form-label">الوصف</label>
                                <textarea class="form-input" id="description" name="description" rows="4" placeholder="وصف مفصل للحقنة...">{{ old('description', $injection->description) }}</textarea>
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
                                تحديث الحقنة
                            </button>
                        </div>
                    </form>
                </div>

                <div class="panel">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">معلومات الحقنة</h5>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <span class="font-medium text-gray-700 dark:text-gray-300">تاريخ الإنشاء:</span>
                            <span class="text-gray-600 dark:text-gray-400">{{ $injection->created_at->format('Y-m-d H:i') }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <span class="font-medium text-gray-700 dark:text-gray-300">آخر تحديث:</span>
                            <span class="text-gray-600 dark:text-gray-400">{{ $injection->updated_at->format('Y-m-d H:i') }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <span class="font-medium text-gray-700 dark:text-gray-300">الحالة الحالية:</span>
                            <span class="px-2 py-1 text-xs rounded-full {{ $injection->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $injection->is_active ? 'نشط' : 'غير نشط' }}
                            </span>
                        </div>

                        @if($injection->patients()->count() > 0)
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium text-blue-800 dark:text-blue-200">
                                    مرتبط بـ {{ $injection->patients()->count() }} مريض
                                </span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
