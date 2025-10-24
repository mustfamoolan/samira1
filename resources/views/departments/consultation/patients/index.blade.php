<x-layout.department>
    <script src="/assets/js/simple-datatables.js"></script>

    <div x-data="patientsTable">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="{{ route('consultation.dashboard') }}" class="text-primary hover:underline">لوحة التحكم</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>المرضى</span>
            </li>
        </ul>

        <div class="pt-5">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">قائمة المرضى</h5>
                    <a href="{{ route('consultation.patients.create') }}" class="btn btn-primary">
                        <svg class="w-4 h-4 ltr:mr-2 rtl:ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                            <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        إضافة مريض جديد
                    </a>
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

                <table id="patientsTable" class="whitespace-nowrap"></table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("patientsTable", () => ({
                datatable: null,
                init() {
                    this.datatable = new simpleDatatables.DataTable('#patientsTable', {
                        data: {
                            headings: ['الاسم الرباعي', 'الرقم الوطني', 'العمر', 'الجنس', 'المحافظة', 'الطبيب', 'الحالة', 'الحقنة', 'الجرعة المتبقية', 'الإجراءات'],
                            data: {!! json_encode($patientsData) !!}
                        },
                        searchable: true,
                        perPage: 10,
                        perPageSelect: [10, 20, 30, 50, 100],
                        labels: {
                            placeholder: 'بحث...',
                            perPage: 'عدد السجلات لكل صفحة',
                            noRows: 'لا توجد سجلات',
                            info: 'عرض {start} إلى {end} من {rows} سجل'
                        },
                        columns: [{
                                select: 0,
                                sort: "asc"
                            },
                            {
                                select: 2,
                                render: (data, cell, row) => {
                                    return `${data} سنة`;
                                },
                            },
                            {
                                select: 3,
                                render: (data, cell, row) => {
                                    const genderClass = data === 'ذكر' ? 'primary' : 'success';
                                    return `<span class="badge bg-${genderClass}">${data}</span>`;
                                },
                            },
                            {
                                select: 6,
                                render: (data, cell, row) => {
                                    const patient = {!! json_encode($patients) !!}[row.dataIndex];
                                    let statusClass = 'warning';
                                    let statusText = 'قيد الانتظار';

                                    if (patient.status === 'complete') {
                                        statusClass = 'success';
                                        statusText = 'مكتمل';
                                    } else if (patient.status === 'review') {
                                        statusClass = 'info';
                                        statusText = 'مراجعة';
                                    }

                                    return `<span class="badge bg-${statusClass}">${statusText}</span>`;
                                },
                            },
                            {
                                select: 7,
                                render: (data, cell, row) => {
                                    return data || 'لا يوجد';
                                },
                            },
                            {
                                select: 8,
                                render: (data, cell, row) => {
                                    return data || 'غير محدد';
                                },
                            },
                            {
                                select: 9,
                                sortable: false,
                                render: (data, cell, row) => {
                                    const patient = {!! json_encode($patients) !!}[row.dataIndex];
                                    return `<div class="flex items-center">
                                            <a href="/consultation/patients/${patient.id}/edit" class="ltr:mr-2 rtl:ml-2" x-tooltip="تعديل">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5">
                                                    <path d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z" stroke="currentColor" stroke-width="1.5" />
                                                    <path opacity="0.5" d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015" stroke="currentColor" stroke-width="1.5" />
                                                </svg>
                                            </a>
                                            <button type="button" onclick="deletePatient(${patient.id})" x-tooltip="حذف">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                                    <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.7572 20.1907C5.8922 19.3815 5.8037 18.054 5.6267 15.3991L5.16675 8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path opacity="0.5" d="M6.5 6C6.55588 6 6.58382 6 6.60971 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.69532C8.44084 4.69149 8.44246 4.68767 8.44408 4.68384C8.50686 4.45938 8.53825 4.34716 8.5957 4.24197C8.71868 4.00527 8.93724 3.81029 9.20035 3.69281C9.30701 3.64555 9.41844 3.61175 9.64132 3.54415L9.65693 3.53956L9.75891 3.51068C10.4672 3.29944 10.8208 3.19382 11.1841 3.20357C11.5073 3.21226 11.8287 3.31084 12.1081 3.48817C12.4291 3.69014 12.6761 4.0003 12.8132 4.36436L12.8216 4.38338L12.8451 4.43939C12.9529 4.66556 13.0068 4.77864 13.0379 4.89494C13.1407 5.26568 13.1407 5.67084 13.0379 6.04157C13.0068 6.15788 12.9529 6.27096 12.8451 6.49712L12.8216 6.55314L12.8132 6.57215C12.6761 6.93622 12.4291 7.24638 12.1081 7.44835C11.8287 7.62568 11.5073 7.72426 11.1841 7.73295C10.8208 7.7427 10.4672 7.63708 9.75891 7.42584L9.65693 7.39696L9.64132 7.39237C9.41844 7.32477 9.30701 7.29097 9.20035 7.24371C8.93724 7.12623 8.71868 6.93125 8.5957 6.69455C8.53825 6.58936 8.50686 6.47714 8.44408 6.25268L8.44246 6.24885L8.44084 6.24502C8.15902 5.48543 7.43259 4.96185 6.60971 4.94098C6.58382 4.94034 6.55588 4.94034 6.5 4.94034C6.44412 4.94034 6.41618 4.94034 6.39029 4.94098C5.56741 4.96185 4.84098 5.48543 4.56078 6.24502C4.55916 6.24885 4.55754 6.25268 4.55592 6.25651C4.49314 6.48097 4.46175 6.59319 4.4043 6.69838C4.28132 6.93508 4.06276 7.13006 3.79965 7.24754C3.69299 7.2948 3.58156 7.3286 3.35868 7.3962L3.34307 7.40079L3.24109 7.42967C2.53279 7.64091 2.1792 7.74653 1.81588 7.73678C1.49274 7.72809 1.17132 7.62951 0.891914 7.45218C0.570936 7.25021 0.323864 6.94005 0.186832 6.57598L0.178406 6.55697L0.154882 6.50095C0.0471381 6.27479 -0.00673793 6.16171 -0.0378653 6.04541C0.0647147 5.67467 0.0647147 5.26951 -0.0378653 4.89877C-0.00673793 4.78247 0.0471381 4.66939 0.154882 4.44322L0.178406 4.38721L0.186832 4.36819C0.323864 4.00413 0.570936 3.69397 0.891914 3.492C1.17132 3.31466 1.49274 3.21608 1.81588 3.20739C2.1792 3.19764 2.53279 3.30326 3.24109 3.5145L3.34307 3.54338L3.35868 3.54797C3.58156 3.61557 3.69299 3.64937 3.79965 3.69663C4.06276 3.81411 4.28132 4.00909 4.4043 4.24579C4.46175 4.35098 4.49314 4.4632 4.55592 4.68766L4.55754 4.69149L4.55916 4.69532C4.84098 5.45491 5.56741 5.97849 6.39029 5.99936C6.41618 6 6.44412 6 6.5 6Z" stroke="currentColor" stroke-width="1.5" />
                                                </svg>
                                            </button>
                                        </div>`;
                                },
                            }
                        ]
                    });
                }
            }));
        });

        function deletePatient(id) {
            if (confirm('هل أنت متأكد من حذف هذا المريض؟')) {
                fetch(`/consultation/patients/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('حدث خطأ أثناء حذف المريض');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء حذف المريض');
                });
            }
        }
    </script>
</x-layout.department>
