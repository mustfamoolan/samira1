<x-layout.default>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline">لوحة التحكم</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <a href="{{ route('admin.admins.index') }}" class="text-primary hover:underline">المديرين العامين</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>إضافة مدير</span>
            </li>
        </ul>

        <div class="pt-5">
            <div class="panel">
                <div class="mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">إضافة مدير</h5>
                </div>

                @if ($errors->any())
                    <div class="mb-5 flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
                        <span class="ltr:pr-2 rtl:pl-2">
                            <strong class="ltr:mr-1 rtl:ml-1">خطأ!</strong>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </span>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.admins.store') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="name">الاسم <span class="text-danger">*</span></label>
                            <input id="name" name="name" type="text" placeholder="أدخل اسم المدير العام"
                                   class="form-input" value="{{ old('name') }}" required />
                        </div>

                        <div>
                            <label for="phone">رقم الهاتف <span class="text-danger">*</span></label>
                            <input id="phone" name="phone" type="text" placeholder="أدخل رقم الهاتف"
                                   class="form-input" value="{{ old('phone') }}" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password">كلمة المرور <span class="text-danger">*</span></label>
                            <input id="password" name="password" type="password" placeholder="أدخل كلمة المرور"
                                   class="form-input" required />
                        </div>

                        <div>
                            <label for="password_confirmation">تأكيد كلمة المرور <span class="text-danger">*</span></label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                   placeholder="أعد إدخال كلمة المرور" class="form-input" required />
                        </div>
                    </div>

                    <div>
                        <label for="photo">الصورة الشخصية</label>
                        <input id="photo" name="photo" type="file" accept="image/*"
                               class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20" />
                        <p class="text-xs text-gray-500 mt-1">الصيغ المسموحة: JPG, PNG, GIF. الحد الأقصى: 2MB</p>
                    </div>

                    <div>
                        <label class="flex cursor-pointer items-center">
                            <input type="checkbox" name="is_active" value="1" class="form-checkbox"
                                   {{ old('is_active', true) ? 'checked' : '' }} />
                            <span class="text-white-dark">الحساب نشط</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-outline-danger">
                            إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-4 h-4 ltr:mr-2 rtl:ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            إضافة المدير العام
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.default>

