<x-layout.department>
    @php
        $user = auth('employee')->user() ?? auth('department_manager')->user();
        $department = $user->department ?? null;
    @endphp

    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">لوحة التحكم</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>{{ $department->name ?? 'الوحدة' }}</span>
            </li>
        </ul>

        <div class="pt-5">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <h2 class="text-xl font-bold">مرحباً {{ $user->name ?? 'مستخدم' }}</h2>
                <p class="text-white-dark">{{ $department->name ?? 'الوحدة' }} - {{ $department->description ?? 'نظام إدارة الوحدة' }}</p>
            </div>

            <!-- Department Info -->
            <div class="panel">
                <div class="mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">{{ $department->name ?? 'الوحدة' }}</h5>
                    <p class="text-gray-600 dark:text-gray-400">{{ $department->description ?? 'وصف الوحدة غير متوفر' }}</p>
                </div>

                <div class="text-center py-12">
                    <div class="mb-6">
                        <svg class="w-24 h-24 mx-auto text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">قيد التطوير</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-lg">هذه الوحدة قيد التطوير حالياً. سيتم إضافة المزيد من الميزات قريباً.</p>
                </div>

                <!-- User Info -->
                <div class="mt-8 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <h6 class="font-semibold mb-2">معلومات المستخدم:</h6>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-gray-600 dark:text-gray-400">الاسم:</span>
                            <span class="font-semibold">{{ $user->name ?? 'غير محدد' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-400">رقم الهاتف:</span>
                            <span class="font-semibold">{{ $user->phone ?? 'غير محدد' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-400">نوع المستخدم:</span>
                            <span class="font-semibold">
                                @if(auth('employee')->check())
                                    موظف
                                @elseif(auth('department_manager')->check())
                                    مسؤول وحدة
                                @endif
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-400">الوحدة:</span>
                            <span class="font-semibold">{{ $department->name ?? 'غير محدد' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.department>
