<x-layout.default>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">لوحة التحكم</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>المدير العام</span>
            </li>
        </ul>

        <div class="pt-5">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <h2 class="text-xl font-bold">مرحباً {{ auth('admin')->user()->name }}</h2>
                <p class="text-white-dark">مستشفى العيون - نظام الإدارة</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
                <!-- Departments -->
                <div class="panel h-full">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">الأقسام</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg class="w-5 h-5 opacity-70" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0">
                                <li><a href="{{ route('admin.departments.index') }}">عرض الكل</a></li>
                                <li><a href="{{ route('admin.departments.create') }}">إضافة جديد</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div
                            class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ $stats['departments_count'] ?? 0 }}</div>
                        <div class="badge bg-white/30">قسم</div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                            <path
                                d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path opacity="0.5" d="M10 16H6" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                            <path opacity="0.5" d="M14 16H12.5" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                            <path opacity="0.5" d="M2 10L22 10" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                        <a href="{{ route('admin.departments.index') }}" class="text-primary hover:underline">عرض الأقسام</a>
                    </div>
                </div>

                <!-- Doctors -->
                <div class="panel h-full">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">الأطباء</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg class="w-5 h-5 opacity-70" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0">
                                <li><a href="{{ route('admin.doctors.index') }}">عرض الكل</a></li>
                                <li><a href="{{ route('admin.doctors.create') }}">إضافة جديد</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ \App\Models\Doctor::count() }}</div>
                        <div class="badge bg-white/30">طبيب</div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                            <path opacity="0.5"
                                d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z"
                                stroke="currentColor" stroke-width="1.5" />
                        </svg>
                        <a href="{{ route('admin.doctors.index') }}" class="text-success hover:underline">عرض الأطباء</a>
                    </div>
                </div>

                <!-- Patients -->
                <div class="panel h-full">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">المرضى</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg class="w-5 h-5 opacity-70" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0">
                                <li><a href="{{ route('admin.patients.index') }}">عرض الكل</a></li>
                                <li><a href="{{ route('admin.patients.create') }}">إضافة جديد</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ \App\Models\Patient::count() }}</div>
                        <div class="badge bg-white/30">مريض</div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                            <path
                                d="M15.5 7.5C15.5 9.433 13.933 11 12 11C10.067 11 8.5 9.433 8.5 7.5C8.5 5.567 10.067 4 12 4C13.933 4 15.5 5.567 15.5 7.5Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path opacity="0.5"
                                d="M19.5 7.5C19.5 8.88071 18.3807 10 17 10C15.6193 10 14.5 8.88071 14.5 7.5C14.5 6.11929 15.6193 5 17 5C18.3807 5 19.5 6.11929 19.5 7.5Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path opacity="0.5"
                                d="M4.5 7.5C4.5 8.88071 5.61929 10 7 10C8.38071 10 9.5 8.88071 9.5 7.5C9.5 6.11929 8.38071 5 7 5C5.61929 5 4.5 6.11929 4.5 7.5Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path
                                d="M18 16.5C18 18.433 15.3137 20 12 20C8.68629 20 6 18.433 6 16.5C6 14.567 8.68629 13 12 13C15.3137 13 18 14.567 18 16.5Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path opacity="0.5"
                                d="M22 16.5C22 17.8807 20.2091 19 18 19C17.2947 19 16.6257 18.8764 16.0383 18.6545C16.6457 18.0779 17 17.3233 17 16.5C17 15.6767 16.6457 14.9221 16.0383 14.3455C16.6257 14.1236 17.2947 14 18 14C20.2091 14 22 15.1193 22 16.5Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path opacity="0.5"
                                d="M2 16.5C2 17.8807 3.79086 19 6 19C6.70531 19 7.37433 18.8764 7.96173 18.6545C7.35428 18.0779 7 17.3233 7 16.5C7 15.6767 7.35428 14.9221 7.96173 14.3455C7.37433 14.1236 6.70531 14 6 14C3.79086 14 2 15.1193 2 16.5Z"
                                stroke="currentColor" stroke-width="1.5" />
                        </svg>
                        <a href="{{ route('admin.patients.index') }}" class="text-info hover:underline">عرض المرضى</a>
                    </div>
                </div>

                <!-- Admins -->
                <div class="panel h-full">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">الإدارة</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg class="w-5 h-5 opacity-70" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0">
                                <li><a href="{{ route('admin.admins.index') }}">عرض الكل</a></li>
                                <li><a href="{{ route('admin.admins.create') }}">إضافة جديد</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ $stats['admins_count'] ?? 0 }}</div>
                        <div class="badge bg-white/30">مدير</div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                            <path opacity="0.5"
                                d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z"
                                stroke="currentColor" stroke-width="1.5" />
                        </svg>
                        <a href="{{ route('admin.admins.index') }}" class="text-primary hover:underline">عرض المديرين</a>
                    </div>
                </div>

                <!-- Department Managers -->
                <div class="panel h-full">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">مسؤولي الأقسام</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg class="w-5 h-5 opacity-70" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0">
                                <li><a href="{{ route('admin.department-managers.index') }}">عرض الكل</a></li>
                                <li><a href="{{ route('admin.department-managers.create') }}">إضافة جديد</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ $stats['department_managers_count'] ?? 0 }}</div>
                        <div class="badge bg-white/30">مسؤول</div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                            <path opacity="0.5" d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12Z" stroke="currentColor" stroke-width="1.5" />
                            <path d="M12 6V18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M15 9.5C15 8.11929 13.6569 7 12 7C10.3431 7 9 8.11929 9 9.5C9 10.8807 10.3431 12 12 12C13.6569 12 15 13.1193 15 14.5C15 15.8807 13.6569 17 12 17C10.3431 17 9 15.8807 9 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <a href="{{ route('admin.department-managers.index') }}" class="text-warning hover:underline">عرض المسؤولين</a>
                    </div>
                </div>

                <!-- Employees -->
                <div class="panel h-full">
                    <div class="flex justify-between">
                        <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">الموظفون</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                            <a href="javascript:;" @click="toggle">
                                <svg class="w-5 h-5 opacity-70" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <circle cx="19" cy="12" r="2" stroke="currentColor"
                                        stroke-width="1.5" />
                                </svg>
                            </a>
                            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                class="ltr:right-0 rtl:left-0">
                                <li><a href="{{ route('admin.employees.index') }}">عرض الكل</a></li>
                                <li><a href="{{ route('admin.employees.create') }}">إضافة جديد</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ $stats['employees_count'] ?? 0 }}</div>
                        <div class="badge bg-white/30">موظف</div>
                    </div>
                    <div class="flex items-center font-semibold mt-5">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                            <circle cx="10" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                            <path opacity="0.5"
                                d="M18 17.5C18 19.9853 18 22 10 22C2 22 2 19.9853 2 17.5C2 15.0147 5.58172 13 10 13C14.4183 13 18 15.0147 18 17.5Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path
                                d="M21 10H19M19 10H17M19 10L19 8M19 10L19 12"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <a href="{{ route('admin.employees.index') }}" class="text-info hover:underline">عرض الموظفين</a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="panel">
                <div class="mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light mb-2">إجراءات سريعة</h5>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                    <a href="{{ route('admin.patients.create') }}"
                        class="flex items-center justify-center btn btn-primary gap-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                            <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        إضافة مريض جديد
                    </a>
                    <a href="{{ route('admin.doctors.create') }}"
                        class="flex items-center justify-center btn btn-success gap-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                            <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        إضافة طبيب
                    </a>
                    <a href="{{ route('admin.admins.create') }}"
                        class="flex items-center justify-center btn btn-primary gap-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                            <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        إضافة مدير عام
                    </a>
                    <a href="{{ route('admin.department-managers.create') }}"
                        class="flex items-center justify-center btn btn-warning gap-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                            <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        إضافة مسؤول قسم
                    </a>
                    <a href="{{ route('admin.employees.create') }}"
                        class="flex items-center justify-center btn btn-info gap-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                            <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        إضافة موظف
                    </a>
                    <a href="{{ route('admin.departments.create') }}"
                        class="flex items-center justify-center btn btn-secondary gap-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                            <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        إضافة قسم
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout.default>

