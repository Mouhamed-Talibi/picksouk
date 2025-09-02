<div dir="rtl">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/picksouk.jpg') }}" alt="Logo" width="70" height="70">
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas Menu -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">بيكسوق</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                
                <div class="offcanvas-body">
                    <!-- Main Navigation -->
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3 mb-3 mb-lg-0">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('app.home')}}">الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products')}}">منتوجاتنا</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                حولنا
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end text-end shadow border-0">
                                <li><a class="dropdown-item d-flex justify-content-end align-items-center py-3" href="{{ route('app.about_us')}}">
                                    <span>من نحن</span>
                                    <i class="bi bi-people-fill me-3"></i>
                                </a></li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li><a class="dropdown-item d-flex justify-content-end align-items-center py-3" href="{{ route('app.home')}}#services">
                                    <span>الخدمات</span>
                                    <i class="bi bi-gear-fill me-3"></i>
                                </a></li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li><a class="dropdown-item d-flex justify-content-end align-items-center py-3" href="{{ route('app.contact_us')}}">
                                    <span>اتصل بنا</span>
                                    <i class="bi bi-envelope-fill me-3"></i>
                                </a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('app.find_product')}}" method="POST" class="d-flex mt-2 mt-lg-0">
                                @csrf 
                                <div class="input-group">
                                    <input 
                                        type="text" 
                                        name="search_text" 
                                        class="form-control @error('search_text') is-invalid @enderror" 
                                        placeholder="ابحث عن منتجك" 
                                        value="{{ old('search_text') }}"
                                        required
                                    >
                                    @error('search_text')
                                        <div class="invalid-feedback d-block">
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        </div>
                                    @enderror
                                    <button type="submit" class="btn text-primary" >
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                        @endauth
                    </ul>

                    <!-- Auth Section -->
                    <div class="d-flex flex-column flex-lg-row align-items-center gap-3">
                        @auth
                            <div class="d-flex align-items-center gap-3">
                                <!-- Cart Icon -->
                                <a href="{{ route('app.my_orders')}}" class="btn position-relative p-2">
                                    <i class="fas fa-shopping-cart fs-5"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success" style="font-size: 0.6rem; padding: 0.25em 0.4em;">
                                        {{ Auth::user()->orders()->where('status', 'processing')->count() ?? 0}}
                                    </span>
                                </a>
                                
                                <!-- Logout Button -->
                                <button type="button" 
                                        class="btn btn-outline-danger rounded-circle p-0 d-flex align-items-center justify-content-center" 
                                        style="width: 2.5rem; height: 2.5rem;"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </div>
                        @endauth

                        @guest
                        <div class="d-flex flex-column flex-lg-row gap-3 w-100 justify-content-center">
                            <a href="{{ route('auth.login_form') }}" class="btn btn-outline-primary">تسجيل الدخول</a>
                            <a href="{{ route('auth.signup_form') }}" class="btn btn-primary">إنشاء حساب</a>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true" dir="rtl">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-sign-out-alt fa-3x text-danger mb-3"></i>
                    <h5 class="mb-3">تأكيد تسجيل الخروج</h5>
                    <p class="text-muted">سيتم إغلاق جلسة العمل الحالية</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">إلغاء</button>
                    <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger mx-2">تأكيد</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>