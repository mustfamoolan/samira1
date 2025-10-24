<x-layout.default>
    <div class="panel">
        <div class="mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">{{ $department->name }}</h5>
            <p class="text-gray-600 dark:text-gray-400">{{ $department->description }}</p>
        </div>

        <!-- إحصائيات سريعة -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold">{{ $stats['managers_count'] }}</h3>
                        <p class="text-blue-100">مسؤولي القسم</p>
                    </div>
                    <div class="text-blue-200">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold">{{ $stats['employees_count'] }}</h3>
                        <p class="text-green-100">الموظفين</p>
                    </div>
                    <div class="text-green-200">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold">{{ $stats['patients_count'] }}</h3>
                        <p class="text-purple-100">إجمالي المرضى</p>
                    </div>
                    <div class="text-purple-200">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold">{{ $stats['pending_patients'] }}</h3>
                        <p class="text-orange-100">مرضى في الانتظار</p>
                    </div>
                    <div class="text-orange-200">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- معلومات القسم -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- مسؤولي القسم -->
            <div class="panel">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="font-semibold text-lg dark:text-white-light">مسؤولي القسم</h5>
                    <span class="badge bg-primary">{{ $managers->count() }}</span>
                </div>
                @if($managers->count() > 0)
                    <div class="space-y-3">
                        @foreach($managers as $manager)
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <div class="flex items-center">
                                    @if($manager->photo)
                                        <img src="{{ Storage::url($manager->photo) }}" alt="{{ $manager->name }}" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold">
                                            {{ substr($manager->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div class="mr-3">
                                        <h6 class="font-semibold">{{ $manager->name }}</h6>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $manager->phone }}</p>
                                    </div>
                                </div>
                                <span class="badge {{ $manager->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $manager->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p>لا يوجد مسؤولي قسم حالياً</p>
                    </div>
                @endif
            </div>

            <!-- الموظفين -->
            <div class="panel">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="font-semibold text-lg dark:text-white-light">الموظفين</h5>
                    <span class="badge bg-success">{{ $employees->count() }}</span>
                </div>
                @if($employees->count() > 0)
                    <div class="space-y-3">
                        @foreach($employees->take(5) as $employee)
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <div class="flex items-center">
                                    @if($employee->photo)
                                        <img src="{{ Storage::url($employee->photo) }}" alt="{{ $employee->name }}" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-success flex items-center justify-center text-white font-bold">
                                            {{ substr($employee->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div class="mr-3">
                                        <h6 class="font-semibold">{{ $employee->name }}</h6>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $employee->phone }}</p>
                                    </div>
                                </div>
                                <span class="badge {{ $employee->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $employee->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </div>
                        @endforeach
                        @if($employees->count() > 5)
                            <div class="text-center">
                                <a href="{{ route('admin.employees.index') }}" class="btn btn-outline-primary btn-sm">
                                    عرض جميع الموظفين ({{ $employees->count() }})
                                </a>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                        </svg>
                        <p>لا يوجد موظفين حالياً</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- إحصائيات المرضى -->
        @if(isset($patients) && $patients->count() > 0)
            <div class="panel mt-6">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="font-semibold text-lg dark:text-white-light">إحصائيات المرضى</h5>
                    <span class="badge bg-purple-500">{{ $patients->count() }}</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <h3 class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['pending_patients'] }}</h3>
                        <p class="text-blue-600 dark:text-blue-400">في الانتظار</p>
                    </div>
                    <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <h3 class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stats['completed_patients'] }}</h3>
                        <p class="text-green-600 dark:text-green-400">مكتمل</p>
                    </div>
                    <div class="text-center p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                        <h3 class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $patients->where('status', 'review')->count() }}</h3>
                        <p class="text-yellow-600 dark:text-yellow-400">قيد المراجعة</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- روابط سريعة -->
        <div class="panel mt-6">
            <h5 class="font-semibold text-lg dark:text-white-light mb-4">روابط سريعة</h5>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.department-managers.index') }}" class="btn btn-outline-primary">
                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    إدارة المسؤولين
                </a>
                <a href="{{ route('admin.employees.index') }}" class="btn btn-outline-success">
                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                    </svg>
                    إدارة الموظفين
                </a>
                <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-purple">
                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                    </svg>
                    إدارة المرضى
                </a>
                <a href="{{ route('admin.departments.edit', $department->id) }}" class="btn btn-outline-warning">
                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                    </svg>
                    تعديل القسم
                </a>
            </div>
        </div>
    </div>
</x-layout.default>
