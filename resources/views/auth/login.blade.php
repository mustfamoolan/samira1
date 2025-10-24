<x-layout.auth>

    <div>
        <div class="absolute inset-0">
            <img src="/assets/images/auth/bg-gradient.png" alt="image" class="h-full w-full object-cover" />
        </div>
        <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">
            <img src="/assets/images/auth/coming-soon-object1.png" alt="image" class="absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2" />
            <img src="/assets/images/auth/coming-soon-object2.png" alt="image" class="absolute left-24 top-0 h-40 md:left-[30%]" />
            <img src="/assets/images/auth/coming-soon-object3.png" alt="image" class="absolute right-0 top-0 h-[300px]" />
            <img src="/assets/images/auth/polygon-object.svg" alt="image" class="absolute bottom-0 end-[28%]" />
            <div
                class="relative w-full max-w-[870px] rounded-md bg-[linear-gradient(45deg,#fff9f9_0%,rgba(255,255,255,0)_25%,rgba(255,255,255,0)_75%,_#fff9f9_100%)] p-2 dark:bg-[linear-gradient(52.22deg,#0E1726_0%,rgba(14,23,38,0)_18.66%,rgba(14,23,38,0)_51.04%,rgba(14,23,38,0)_80.07%,#0E1726_100%)]">
                <div class="relative flex flex-col justify-center rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 px-6 lg:min-h-[758px] py-20">
                    <div class="mx-auto w-full max-w-[440px]">
                        <div class="mb-10 text-center">
                            <h1 class="text-3xl font-extrabold uppercase !leading-snug text-primary md:text-4xl">تسجيل الدخول</h1>
                            <p class="text-base font-bold leading-normal text-white-dark">مستشفى العيون - نظام الإدارة الشامل</p>
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

                        <form class="space-y-5 dark:text-white" method="POST" action="{{ route('login.post') }}">
                            @csrf
                            <div>
                                <label for="phone">رقم الهاتف</label>
                                <div class="relative text-white-dark">
                                    <input id="phone" name="phone" type="text" placeholder="أدخل رقم الهاتف"
                                           class="form-input ps-10 placeholder:text-white-dark"
                                           value="{{ old('phone') }}" required autofocus />
                                    <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path opacity="0.5"
                                                d="M1.5 6C1.5 3.87868 1.5 2.81802 2.15901 2.15901C2.81802 1.5 3.87868 1.5 6 1.5H12C14.1213 1.5 15.182 1.5 15.841 2.15901C16.5 2.81802 16.5 3.87868 16.5 6V12C16.5 14.1213 16.5 15.182 15.841 15.841C15.182 16.5 14.1213 16.5 12 16.5H6C3.87868 16.5 2.81802 16.5 2.15901 15.841C1.5 15.182 1.5 14.1213 1.5 12V6Z"
                                                fill="currentColor" />
                                            <path d="M11.1111 7.05556C11.1111 8.47778 9.97778 9.61111 8.55556 9.61111C7.13333 9.61111 6 8.47778 6 7.05556C6 5.63333 7.13333 4.5 8.55556 4.5C9.97778 4.5 11.1111 5.63333 11.1111 7.05556Z" fill="currentColor" />
                                            <path d="M13.5 13.5C13.5 12.4 11.6667 11.5 8.55556 11.5C5.44444 11.5 3.61111 12.4 3.61111 13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label for="password">كلمة المرور</label>
                                <div class="relative text-white-dark">
                                    <input id="password" name="password" type="password" placeholder="أدخل كلمة المرور"
                                           class="form-input ps-10 placeholder:text-white-dark" required />
                                    <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path opacity="0.5"
                                                d="M1.5 12C1.5 9.87868 1.5 8.81802 2.15901 8.15901C2.81802 7.5 3.87868 7.5 6 7.5H12C14.1213 7.5 15.182 7.5 15.841 8.15901C16.5 8.81802 16.5 9.87868 16.5 12C16.5 14.1213 16.5 15.182 15.841 15.841C15.182 16.5 14.1213 16.5 12 16.5H6C3.87868 16.5 2.81802 16.5 2.15901 15.841C1.5 15.182 1.5 14.1213 1.5 12Z"
                                                fill="currentColor" />
                                            <path d="M6 12.75C6.41421 12.75 6.75 12.4142 6.75 12C6.75 11.5858 6.41421 11.25 6 11.25C5.58579 11.25 5.25 11.5858 5.25 12C5.25 12.4142 5.58579 12.75 6 12.75Z" fill="currentColor" />
                                            <path d="M9 12.75C9.41421 12.75 9.75 12.4142 9.75 12C9.75 11.5858 9.41421 11.25 9 11.25C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75Z" fill="currentColor" />
                                            <path d="M12.75 12C12.75 12.4142 12.4142 12.75 12 12.75C11.5858 12.75 11.25 12.4142 11.25 12C11.25 11.5858 11.5858 11.25 12 11.25C12.4142 11.25 12.75 11.5858 12.75 12Z" fill="currentColor" />
                                            <path
                                                d="M5.0625 6C5.0625 3.82538 6.82538 2.0625 9 2.0625C11.1746 2.0625 12.9375 3.82538 12.9375 6V7.50268C13.363 7.50665 13.7351 7.51651 14.0625 7.54096V6C14.0625 3.20406 11.7959 0.9375 9 0.9375C6.20406 0.9375 3.9375 3.20406 3.9375 6V7.54096C4.26488 7.51651 4.63698 7.50665 5.0625 7.50268V6Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                تسجيل الدخول
                            </button>
                        </form>

                        <div class="text-center dark:text-white mt-10">
                            <div class="mb-4">
                                <p class="text-sm text-white-dark font-semibold mb-2">النظام يدعم:</p>
                                <div class="flex flex-wrap justify-center gap-2">
                                    <span class="badge bg-primary">المدير العام</span>
                                    <span class="badge bg-success">الأطباء</span>
                                    <span class="badge bg-info">مسؤولي الأقسام</span>
                                    <span class="badge bg-warning">الموظفين</span>
                                </div>
                            </div>
                            <p class="text-xs text-white-dark mt-4">بيانات تجريبية - مدير عام:</p>
                            <p class="text-xs text-white-dark">رقم الهاتف: <strong>1234567890</strong> | كلمة المرور: <strong>123456</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.auth>

