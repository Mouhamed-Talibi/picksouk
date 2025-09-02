<footer class="bg-dark text-white pb-4" dir="rtl">
    <div class="container">
        <div class="row gy-4 align-items-start justify-content-between">

            <!-- الشعار والوصف -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="text-center text-md-end">
                    <img src="{{ asset('assets/picksouk-no-bg.png') }}" alt="شعار بيكسوق" style="height: 130px; width:130px;" class="mb-3">
                    <p class="text-secondary">بيكسوق - وجهتك الأولى للمنتجات الفاخرة وتجربة تسوق استثنائية.</p>
                    <div class="social-icons mt-4 d-flex justify-content-center justify-content-md-start gap-3">
                        <a href="https://www.instagram.com/picksouk?igsh=eXZuNzF4bjg0dnNp&utm_source=qr" class=""><i class="fab fa-instagram fs-3"></i></a>
                        <a href="https://www.facebook.com/share/1GhYQJWtjP/?mibextid=wwXIfr" class=""><i class="fa-brands fa-facebook fs-3"></i></a>
                    </div>
                </div>
            </div>

            <!-- روابط سريعة -->
            <div class="quick-links col-6 col-md-6 col-lg-2">
                <h5 class="text-uppercase mb-4 text-md-end text-center">روابط سريعة</h5>
                <ul class="list-unstyled text-md-end text-center">
                    @auth
                        <li class="mb-2"><a href="{{ route('app.home')}}" class="text-decoration-none">الرئيسية</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">المنتجات</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">الأكثر مبيعاً</a></li>
                    @endauth
                    @guest
                        <li class="mb-2"><a href="{{ route('app.app')}}" class="text-decoration-none">الرئيسية</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">المنتجات</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none">الأكثر مبيعاً</a></li>
                    @endguest
                </ul>
            </div>

            <!-- خدمة العملاء -->
            <div class="customer-service col-6 col-md-6 col-lg-2">
                <h5 class="text-uppercase mb-4 text-md-end text-center">خدمة العملاء</h5>
                <ul class="list-unstyled text-md-end text-center">
                    <li class="mb-2"><a href="{{ route('app.my_orders')}}" class="text-decoration-none">تتبع الطلب</a></li>
                    <li class="mb-2"><a href="{{ route('app.contact_us')}}" class="text-decoration-none">تواصل معنا</a></li>
                </ul>
            </div>

            <!-- اتصل بنا -->
            <div class="col-12 col-md-6 col-lg-4">
                <h5 class="text-uppercase mb-4 text-md-end text-center">اتصل بنا</h5>
                <ul class="list-unstyled text-md-end text-center">
                    <li class="mb-2"><i class="fas fa-map-marker-alt text-info ms-2"></i>أكادير، المغرب</li>
                    <li class="mb-2 d-flex align-items-center">
                        <i class="fas fa-phone text-info ms-2"></i>
                        <span dir="ltr">+212 680670898</span>
                    </li>
                    <li><i class="fas fa-envelope text-info ms-2"></i>picksouk.contact@gmail.com</li>
                </ul>
            </div>
        </div>

        <hr class="my-4 bg-secondary">

        <!-- حقوق النشر -->
        <div class="text-center">
            <p class="text-light mb-0">&copy; {{ date('Y') }} <span class="text-info">بيكسوق</span>. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</footer>
