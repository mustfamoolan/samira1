<x-layout.default>
    <script src="/assets/js/simple-datatables.js"></script>

    <div x-data="managersTable">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline">لوحة التحكم</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>مسؤولي الأقسام</span>
            </li>
        </ul>

        <div class="pt-5">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">قائمة مسؤولي الأقسام</h5>
                    <a href="{{ route('admin.department-managers.create') }}" class="btn btn-primary">
                        <svg class="w-4 h-4 ltr:mr-2 rtl:ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                            <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        إضافة مسؤول وحدة جديد
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

                <table id="managersTable" class="whitespace-nowrap"></table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("managersTable", () => ({
                datatable: null,
                init() {
                    this.datatable = new simpleDatatables.DataTable('#managersTable', {
                        data: {
                            headings: ['الاسم', 'رقم الهاتف', 'القسم', 'تاريخ الإنشاء', 'الحالة', 'الإجراءات'],
                            data: {!! json_encode($managersData) !!}
                        },
                        searchable: true,
                        perPage: 10,
                        perPageSelect: [10, 20, 30, 50, 100],
                        columns: [{
                                select: 0,
                                render: (data, cell, row) => {
                                    const manager = {!! json_encode($managers) !!}[row.dataIndex];
                                    const photo = manager.photo ?
                                        `<img class="w-9 h-9 rounded-full ltr:mr-2 rtl:ml-2 object-cover" src="/storage/${manager.photo}" alt="صورة المسؤول" />` :
                                        `<div class="w-9 h-9 rounded-full bg-info flex items-center justify-center text-white font-bold ltr:mr-2 rtl:ml-2">${data.charAt(0)}</div>`;
                                    return `<div class="flex items-center w-max">${photo}${data}</div>`;
                                },
                                sort: "asc"
                            },
                            {
                                select: 3,
                                render: (data, cell, row) => {
                                    return this.formatDate(data);
                                },
                            },
                            {
                                select: 4,
                                render: (data, cell, row) => {
                                    const manager = {!! json_encode($managers) !!}[row.dataIndex];
                                    const statusClass = manager.is_active ? 'success' : 'danger';
                                    const statusText = manager.is_active ? 'نشط' : 'غير نشط';
                                    return `<span class="badge bg-${statusClass}">${statusText}</span>`;
                                },
                            },
                            {
                                select: 5,
                                sortable: false,
                                render: (data, cell, row) => {
                                    const manager = {!! json_encode($managers) !!}[row.dataIndex];
                                    return `<div class="flex items-center">
                                            <a href="/admin/department-managers/${manager.id}/edit" class="ltr:mr-2 rtl:ml-2" x-tooltip="تعديل">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5">
                                                    <path d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z" stroke="currentColor" stroke-width="1.5" />
                                                    <path opacity="0.5" d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015" stroke="currentColor" stroke-width="1.5" />
                                                </svg>
                                            </a>
                                            <button type="button" onclick="deleteManager(${manager.id})" x-tooltip="حذف">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                                    <path opacity="0.5" d="M9.17065 4C9.58249 2.83481 10.6937 2 11.9999 2C13.3062 2 14.4174 2.83481 14.8292 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                </svg>
                                            </button>
                                        </div>`;
                                },
                            }
                        ],
                        firstLast: true,
                        firstText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        lastText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        prevText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        nextText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        labels: {
                            perPage: "{select}"
                        },
                        layout: {
                            top: "{search}",
                            bottom: "{info}{select}{pager}",
                        },
                    });
                },

                formatDate(date) {
                    if (date) {
                        const dt = new Date(date);
                        const month = dt.getMonth() + 1 < 10 ? '0' + (dt.getMonth() + 1) : dt.getMonth() + 1;
                        const day = dt.getDate() < 10 ? '0' + dt.getDate() : dt.getDate();
                        return day + '/' + month + '/' + dt.getFullYear();
                    }
                    return '';
                }
            }));
        });

        function deleteManager(id) {
            if (confirm('هل أنت متأكد من حذف هذا مسؤول القسم؟')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('admin.department-managers.destroy', '') }}/${id}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</x-layout.default>

