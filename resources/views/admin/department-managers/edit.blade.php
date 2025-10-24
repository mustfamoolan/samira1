<x-layout.default>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline">لوحة التحكم</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <a href="{{ route('admin.department-managers.index') }}" class="text-primary hover:underline">مسؤولي الأقسام</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>تعديل مسؤول القسم</span>
            </li>
        </ul>

        <div class="pt-5">
            <div class="panel">
                <div class="mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">تعديل مسؤول القسم: {{ $departmentManager->name }}</h5>
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

                <form method="POST" action="{{ route('admin.department-managers.update', $departmentManager->id) }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="name">الاسم <span class="text-danger">*</span></label>
                            <input id="name" name="name" type="text" placeholder="أدخل اسم مسؤول القسم"
                                   class="form-input" value="{{ old('name', $departmentManager->name) }}" required />
                        </div>

                        <div>
                            <label for="phone">رقم الهاتف <span class="text-danger">*</span></label>
                            <input id="phone" name="phone" type="text" placeholder="أدخل رقم الهاتف"
                                   class="form-input" value="{{ old('phone', $departmentManager->phone) }}" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password">كلمة المرور الجديدة</label>
                            <input id="password" name="password" type="password" placeholder="اتركها فارغة إذا لم ترد تغييرها"
                                   class="form-input" />
                        </div>

                        <div>
                            <label for="password_confirmation">تأكيد كلمة المرور الجديدة</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                   placeholder="أعد إدخال كلمة المرور الجديدة" class="form-input" />
                        </div>
                    </div>

                    <div>
                        <label for="department_id">القسم <span class="text-danger">*</span></label>
                        <select id="department_id" name="department_id" class="form-select" required>
                            <option value="">اختر القسم</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}"
                                        {{ old('department_id', $departmentManager->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="photo">الصورة الشخصية</label>
                        <input id="photo" name="photo" type="file" accept="image/*"
                               class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20" />
                        <p class="text-xs text-gray-500 mt-1">الصيغ المسموحة: JPG, PNG, GIF. الحد الأقصى: 2MB</p>

                        @if($departmentManager->photo)
                            <div class="mt-3">
                                <p class="text-sm text-gray-600 mb-2">الصورة الحالية:</p>
                                <img src="{{ Storage::url($departmentManager->photo) }}" alt="صورة المسؤول"
                                     class="w-20 h-20 rounded-full object-cover border-2 border-gray-200" />
                            </div>
                        @endif
                    </div>

                    <div>
                        <label class="flex cursor-pointer items-center">
                            <input type="checkbox" name="is_active" value="1" class="form-checkbox"
                                   {{ old('is_active', $departmentManager->is_active) ? 'checked' : '' }} />
                            <span class="text-white-dark">الحساب نشط</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.department-managers.index') }}" class="btn btn-outline-danger">
                            إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-4 h-4 ltr:mr-2 rtl:ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z" stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5" d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            حفظ التعديلات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.default>

