<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('home');
Route::view('/analytics', 'analytics');
Route::view('/finance', 'finance');
Route::view('/crypto', 'crypto');

Route::view('/apps/chat', 'apps.chat');
Route::view('/apps/mailbox', 'apps.mailbox');
Route::view('/apps/todolist', 'apps.todolist');
Route::view('/apps/notes', 'apps.notes');
Route::view('/apps/scrumboard', 'apps.scrumboard');
Route::view('/apps/contacts', 'apps.contacts');
Route::view('/apps/calendar', 'apps.calendar');

Route::view('/apps/invoice/list', 'apps.invoice.list');
Route::view('/apps/invoice/preview', 'apps.invoice.preview');
Route::view('/apps/invoice/add', 'apps.invoice.add');
Route::view('/apps/invoice/edit', 'apps.invoice.edit');

Route::view('/components/tabs', 'ui-components.tabs');
Route::view('/components/accordions', 'ui-components.accordions');
Route::view('/components/modals', 'ui-components.modals');
Route::view('/components/cards', 'ui-components.cards');
Route::view('/components/carousel', 'ui-components.carousel');
Route::view('/components/countdown', 'ui-components.countdown');
Route::view('/components/counter', 'ui-components.counter');
Route::view('/components/sweetalert', 'ui-components.sweetalert');
Route::view('/components/timeline', 'ui-components.timeline');
Route::view('/components/notifications', 'ui-components.notifications');
Route::view('/components/media-object', 'ui-components.media-object');
Route::view('/components/list-group', 'ui-components.list-group');
Route::view('/components/pricing-table', 'ui-components.pricing-table');
Route::view('/components/lightbox', 'ui-components.lightbox');

Route::view('/elements/alerts', 'elements.alerts');
Route::view('/elements/avatar', 'elements.avatar');
Route::view('/elements/badges', 'elements.badges');
Route::view('/elements/breadcrumbs', 'elements.breadcrumbs');
Route::view('/elements/buttons', 'elements.buttons');
Route::view('/elements/buttons-group', 'elements.buttons-group');
Route::view('/elements/color-library', 'elements.color-library');
Route::view('/elements/dropdown', 'elements.dropdown');
Route::view('/elements/infobox', 'elements.infobox');
Route::view('/elements/jumbotron', 'elements.jumbotron');
Route::view('/elements/loader', 'elements.loader');
Route::view('/elements/pagination', 'elements.pagination');
Route::view('/elements/popovers', 'elements.popovers');
Route::view('/elements/progress-bar', 'elements.progress-bar');
Route::view('/elements/search', 'elements.search');
Route::view('/elements/tooltips', 'elements.tooltips');
Route::view('/elements/treeview', 'elements.treeview');
Route::view('/elements/typography', 'elements.typography');

Route::view('/charts', 'charts');
Route::view('/widgets', 'widgets');
Route::view('/font-icons', 'font-icons');
Route::view('/dragndrop', 'dragndrop');

Route::view('/tables', 'tables');

Route::view('/datatables/advanced', 'datatables.advanced');
Route::view('/datatables/alt-pagination', 'datatables.alt-pagination');
Route::view('/datatables/basic', 'datatables.basic');
Route::view('/datatables/checkbox', 'datatables.checkbox');
Route::view('/datatables/clone-header', 'datatables.clone-header');
Route::view('/datatables/column-chooser', 'datatables.column-chooser');
Route::view('/datatables/export', 'datatables.export');
Route::view('/datatables/multi-column', 'datatables.multi-column');
Route::view('/datatables/multiple-tables', 'datatables.multiple-tables');
Route::view('/datatables/order-sorting', 'datatables.order-sorting');
Route::view('/datatables/range-search', 'datatables.range-search');
Route::view('/datatables/skin', 'datatables.skin');
Route::view('/datatables/sticky-header', 'datatables.sticky-header');

Route::view('/forms/basic', 'forms.basic');
Route::view('/forms/input-group', 'forms.input-group');
Route::view('/forms/layouts', 'forms.layouts');
Route::view('/forms/validation', 'forms.validation');
Route::view('/forms/input-mask', 'forms.input-mask');
Route::view('/forms/select2', 'forms.select2');
Route::view('/forms/touchspin', 'forms.touchspin');
Route::view('/forms/checkbox-radio', 'forms.checkbox-radio');
Route::view('/forms/switches', 'forms.switches');
Route::view('/forms/wizards', 'forms.wizards');
Route::view('/forms/file-upload', 'forms.file-upload');
Route::view('/forms/quill-editor', 'forms.quill-editor');
Route::view('/forms/markdown-editor', 'forms.markdown-editor');
Route::view('/forms/date-picker', 'forms.date-picker');
Route::view('/forms/clipboard', 'forms.clipboard');

Route::view('/users/profile', 'users.profile');
Route::view('/users/user-account-settings', 'users.user-account-settings');

Route::view('/pages/knowledge-base', 'pages.knowledge-base');
Route::view('/pages/contact-us-boxed', 'pages.contact-us-boxed');
Route::view('/pages/contact-us-cover', 'pages.contact-us-cover');
Route::view('/pages/faq', 'pages.faq');
Route::view('/pages/coming-soon-boxed', 'pages.coming-soon-boxed');
Route::view('/pages/coming-soon-cover', 'pages.coming-soon-cover');
Route::view('/pages/error404', 'pages.error404');
Route::view('/pages/error500', 'pages.error500');
Route::view('/pages/error503', 'pages.error503');
Route::view('/pages/maintenence', 'pages.maintenence');

Route::view('/auth/boxed-lockscreen', 'auth.boxed-lockscreen');
Route::view('/auth/boxed-signin', 'auth.boxed-signin');
Route::view('/auth/boxed-signup', 'auth.boxed-signup');
Route::view('/auth/boxed-password-reset', 'auth.boxed-password-reset');
Route::view('/auth/cover-login', 'auth.cover-login');
Route::view('/auth/cover-register', 'auth.cover-register');
Route::view('/auth/cover-lockscreen', 'auth.cover-lockscreen');
Route::view('/auth/cover-password-reset', 'auth.cover-password-reset');

// Hospital Management System Routes
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentManagerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\InjectionController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\DepartmentViewController;

// ================================
// تسجيل الدخول الموحد
// ================================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================================
// Admin Routes
// ================================
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Departments management
    Route::resource('departments', DepartmentController::class)->names([
        'index' => 'admin.departments.index',
        'create' => 'admin.departments.create',
        'store' => 'admin.departments.store',
        'show' => 'admin.departments.show',
        'edit' => 'admin.departments.edit',
        'update' => 'admin.departments.update',
        'destroy' => 'admin.departments.destroy',
    ]);

    // Admins management
    Route::resource('admins', AdminController::class)->names([
        'index' => 'admin.admins.index',
        'create' => 'admin.admins.create',
        'store' => 'admin.admins.store',
        'show' => 'admin.admins.show',
        'edit' => 'admin.admins.edit',
        'update' => 'admin.admins.update',
        'destroy' => 'admin.admins.destroy',
    ]);

    // Department Managers management
    Route::resource('department-managers', DepartmentManagerController::class)->names([
        'index' => 'admin.department-managers.index',
        'create' => 'admin.department-managers.create',
        'store' => 'admin.department-managers.store',
        'show' => 'admin.department-managers.show',
        'edit' => 'admin.department-managers.edit',
        'update' => 'admin.department-managers.update',
        'destroy' => 'admin.department-managers.destroy',
    ]);

    // Employees management
    Route::resource('employees', EmployeeController::class)->names([
        'index' => 'admin.employees.index',
        'create' => 'admin.employees.create',
        'store' => 'admin.employees.store',
        'show' => 'admin.employees.show',
        'edit' => 'admin.employees.edit',
        'update' => 'admin.employees.update',
        'destroy' => 'admin.employees.destroy',
    ]);

    // Doctors management
    Route::resource('doctors', DoctorController::class)->names([
        'index' => 'admin.doctors.index',
        'create' => 'admin.doctors.create',
        'store' => 'admin.doctors.store',
        'show' => 'admin.doctors.show',
        'edit' => 'admin.doctors.edit',
        'update' => 'admin.doctors.update',
        'destroy' => 'admin.doctors.destroy',
    ]);

    // Patients management
    Route::resource('patients', PatientController::class)->names([
        'index' => 'admin.patients.index',
        'create' => 'admin.patients.create',
        'store' => 'admin.patients.store',
        'show' => 'admin.patients.show',
        'edit' => 'admin.patients.edit',
        'update' => 'admin.patients.update',
        'destroy' => 'admin.patients.destroy',
    ]);

    // Injections management
    Route::resource('injections', InjectionController::class)->names([
        'index' => 'admin.injections.index',
        'create' => 'admin.injections.create',
        'store' => 'admin.injections.store',
        'show' => 'admin.injections.show',
        'edit' => 'admin.injections.edit',
        'update' => 'admin.injections.update',
        'destroy' => 'admin.injections.destroy',
    ]);

    // Site Settings
    Route::get('/settings', [SiteSettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('/settings', [SiteSettingController::class, 'update'])->name('admin.settings.update');

    // Department Views - عرض dashboard كل قسم
    Route::prefix('departments')->group(function () {
        Route::get('/consultation', [DepartmentViewController::class, 'consultation'])->name('admin.departments.consultation');
        Route::get('/vision-test', [DepartmentViewController::class, 'visionTest'])->name('admin.departments.vision-test');
        Route::get('/pharmacy', [DepartmentViewController::class, 'pharmacy'])->name('admin.departments.pharmacy');
        Route::get('/accounting', [DepartmentViewController::class, 'accounting'])->name('admin.departments.accounting');
        Route::get('/operations', [DepartmentViewController::class, 'operations'])->name('admin.departments.operations');
        Route::get('/bookings', [DepartmentViewController::class, 'bookings'])->name('admin.departments.bookings');
        Route::get('/injection', [DepartmentViewController::class, 'injection'])->name('admin.departments.injection');
        Route::get('/statistics', [DepartmentViewController::class, 'statistics'])->name('admin.departments.statistics');
    });
});

// Legacy logout routes for compatibility
Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');

// ================================
// Department Manager Routes
// ================================
Route::prefix('department-manager')->middleware(['department_manager'])->group(function () {
    Route::get('/dashboard', [DepartmentManagerController::class, 'dashboard'])->name('department-manager.dashboard');
});

Route::post('/department-manager/logout', [AuthController::class, 'departmentManagerLogout'])->name('department-manager.logout');

// ================================
// Employee Routes
// ================================
Route::prefix('employee')->middleware(['employee'])->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
});

Route::post('/employee/logout', [AuthController::class, 'employeeLogout'])->name('employee.logout');

// ================================
// Consultation Department Routes
// ================================
Route::prefix('consultation')->name('consultation.')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth('employee')->user() ?? auth('department_manager')->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $department = $user->department;
        if (!$department || $department->department_type !== 'consultation') {
            abort(403, 'ليس لديك صلاحية للوصول إلى هذا القسم');
        }

        return redirect()->route($user instanceof \App\Models\Employee ? 'employee.dashboard' : 'department-manager.dashboard');
    })->name('dashboard');

    Route::get('/patients', [PatientController::class, 'indexConsultation'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'createConsultation'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'storeConsultation'])->name('patients.store');
    Route::get('/patients/{patient}', [PatientController::class, 'showConsultation'])->name('patients.show');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'editConsultation'])->name('patients.edit');
    Route::put('/patients/{patient}', [PatientController::class, 'updateConsultation'])->name('patients.update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroyConsultation'])->name('patients.destroy');
    Route::post('/patients/check-national-id', [PatientController::class, 'checkNationalId'])->name('patients.check-national-id');
});

// ================================
// Doctor Routes
// ================================
Route::prefix('doctor')->middleware(['doctor'])->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
});

Route::post('/doctor/logout', [AuthController::class, 'doctorLogout'])->name('doctor.logout');
