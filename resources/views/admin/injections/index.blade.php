<x-layout.admin>
    <div class="panel">
        <div class="mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">إدارة الحقن</h5>
        </div>
        <div class="mb-5">
            <a href="{{ route('admin.injections.create') }}" class="btn btn-primary">
                <svg class="w-5 h-5 ltr:mr-2 rtl:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                إضافة حقنة جديدة
            </a>
        </div>
        <div class="table-responsive">
            <table id="injectionsTable" class="table-hover">
                <thead>
                    <tr>
                        <th>اسم الحقنة</th>
                        <th>الوصف</th>
                        <th>تاريخ الإنشاء</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- سيتم ملؤها بواسطة JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('assets/js/simple-datatables.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // بيانات الحقن
            const injectionsData = @json($injectionsData);

            // إضافة أزرار الإجراءات
            injectionsData.forEach((injection, index) => {
                const actionsHtml = `
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                        <a href="/admin/injections/${injection.id}/edit" class="btn btn-sm btn-outline-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            تعديل
                        </a>
                        <button onclick="deleteInjection(${injection.id})" class="btn btn-sm btn-outline-danger">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            حذف
                        </button>
                    </div>
                `;
                injectionsData[index][4] = actionsHtml;
            });

            // إنشاء الجدول
            this.datatable = new simpleDatatables.DataTable('#injectionsTable', {
                data: {
                    headings: ['اسم الحقنة', 'الوصف', 'تاريخ الإنشاء', 'الحالة', 'الإجراءات'],
                    data: injectionsData
                },
                searchable: true,
                perPage: 10,
                perPageSelect: [10, 20, 30, 50, 100],
                labels: {
                    placeholder: 'بحث...',
                    perPage: 'عدد السجلات لكل صفحة',
                    noRows: 'لا توجد سجلات',
                    info: 'عرض {start} إلى {end} من {rows} سجل'
                }
            });
        });

        // دالة حذف الحقنة
        function deleteInjection(id) {
            if (confirm('هل أنت متأكد من حذف هذه الحقنة؟')) {
                fetch(`/admin/injections/${id}`, {
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
                        alert('حدث خطأ أثناء حذف الحقنة');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء حذف الحقنة');
                });
            }
        }
    </script>
</x-layout.admin>
