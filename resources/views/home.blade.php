@extends('layout.app')

@section('title')
    الرئيسية
@endsection

@push('styles')
<style>
    :root {
        --background-color: #ffffff;
        --default-color: #314862;
        --heading-color: #13447f;
        --accent-color: #065cc2;
        --surface-color: #ffffff;
        --contrast-color: #ffffff;
        --primary-color: #4361ee;
        --secondary-color: #f8f9fa;
        --accent-color: #3a0ca3;
        --text-color: #2b2d42;
        --light-text: #6c757d;
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --hover-shadow: 0 15px 35px rgba(67, 97, 238, 0.15);
        --transition: all 0.3s ease;
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .animate-on-scroll.animated { 
        opacity: 1; 
        transform: translateY(0); 
    }

    .hero-image-wrapper {
        transform: perspective(1000px) rotateY(-5deg);
        transition: transform 1s ease;
    }

    .hero-image-wrapper.animated { 
        transform: perspective(1000px) rotateY(0deg); 
    }

    .service { 
        transition: transform 0.5s ease; 
    }

    .service.animated { 
        transform: translateY(-10px); 
    }

    .categories {
        background-color: #fff;
    }

    .category {
        transition: transform 0.5s ease, box-shadow 0.5s ease;
    }
    .category.animated {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }

    /* courses */
    .course-card {
        background: white;
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: var(--card-shadow);
        height: 100%;
    }

    .course-card:hover { 
        transform: translateY(-5px); 
        box-shadow: var(--hover-shadow); 
    }

    .course-image { 
        position: relative; 
        overflow: hidden; 
    }

    .course-image img {
        background-color: #4a6886;
        width: 100%; height: 220px;
        object-fit: cover;
        transition: var(--transition);
    }

    .course-card:hover .course-image img { 
        transform: scale(1.05); 
    }

    .course-badge {
        position: absolute; top: 15px; right: 15px;
        background: var(--default-color); color: white;
        padding: 5px 12px; border-radius: 50px;
        font-size: 0.8rem; font-weight: 500;
    }
    .course-content { 
        padding: 1.5rem; 
    }

    .course-title {
        font-weight: 700; 
        font-size: 1.4rem;
        margin-bottom: 0.8rem; 
        color: var(--text-color);
    }

    .course-description { 
        color: var(--light-text); 
        margin-bottom: 1.5rem; 
        line-height: 1.6; 
    }

    .course-meta { 
        display: flex; 
        justify-content: center; 
        margin-bottom: 1.5rem; 
        font-size: 0.9rem; 
    }

    .meta-item { 
        display: flex; 
        align-items: center; 
        color: var(--light-text); 
    }

    .meta-item i { 
        margin-right: 5px; 
        color: var(--primary-color); 
    }

    .btn-enroll {
        background: var(--primary-color); color: white;
        padding: 5px 5px; border-radius: 50px;
        font-weight: 500; transition: var(--transition);
        display: inline-flex; align-items: center; justify-content: center;
        text-decoration: none; border: 2px solid var(--primary-color);
    }
    .btn-enroll:hover {
        background: transparent; color: var(--primary-color);
        transform: translateY(-2px);
    }
    .btn-enroll i { 
        margin-left: 8px; 
        transition: var(--transition); 
    }

    .btn-enroll:hover i { 
        transform: translateX(4px); 
    }

    .rating { 
        color: #ffc107; 
        margin-bottom: 0.8rem; 
    }

    .price { 
        font-weight: 700; 
        font-size: 1.2rem; 
        color: var(--accent-color); 
        margin-bottom: 1rem; 
    }

    .randomProducts { 
        background-color: #1a3046; 
    }

    /* values section */
    .values .card {
        transition: var(--transition);
    }

    .values .card:hover {
        box-shadow: var(--hover-shadow);
        border: 2px solid #065cc2;
        transform: translateY(-7px);
    }

    /* Enhanced Testimonials Section */
    .testimonials-section {
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }
    
    .testimonials-section::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        border-radius: 50%;
        opacity: 0.1;
        z-index: 0;
    }
    
    .testimonials-section::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, #ff6b6b 0%, #ff8e8e 100%);
        border-radius: 50%;
        opacity: 0.1;
        z-index: 0;
    }
    
    .testimonials-heading {
        position: relative;
        z-index: 1;
        margin-bottom: 3rem;
    }
    
    .testimonials-heading i {
        background: linear-gradient(135deg, var(--primary-color) 0%, #8f94fb 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2.5rem;
        margin-bottom: 1rem;
        display: inline-block;
    }
    
    .testimonials-heading h1 {
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: 0.5rem;
    }
    
    .testimonials-heading p {
        color: #6c757d;
        font-size: 1.1rem;
    }
    
    .testimonial-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: none;
        box-shadow: var(--card-shadow);
        height: 100%;
        position: relative;
        z-index: 1;
    }
    
    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--hover-shadow);
    }
    
    .testimonial-content {
        padding: 2rem;
        position: relative;
    }
    
    .quote-icon {
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 3rem;
        opacity: 0.1;
        color: var(--primary-color);
    }
    
    .user-image {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin: 0 auto 1rem;
        display: block;
    }
    
    .user-content h5 {
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }
    
    .user-content p {
        line-height: 1.8;
        color: #555;
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .testimonial-ratings {
        margin-bottom: 1.5rem;
    }
    
    .testimonial-ratings i {
        color: #ffc107;
        text-shadow: 0 2px 5px rgba(255, 193, 7, 0.3);
    }
    
    .testimonial-nav {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
    
    .testimonial-nav-btn {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ddd;
        margin: 0 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .testimonial-nav-btn.active {
        background: var(--primary-color);
        transform: scale(1.3);
    }
    
    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .testimonial-card {
            margin-bottom: 2rem;
        }
        
        .testimonials-heading h1 {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section py-2">
            <div class="row justify-content-center align-items-center g-3">
                <div class="col-md-6 col-lg-5 order-md-1">
                    <div class="hero-text text-end animate-on-scroll">
                        <h6 class="text-primary mb-3 fw-bold" style="letter-spacing: 1px;">أحدث صيحات التسوق</h6>
                        <hh2 class="display-5 fw-bold mb-4" style="line-height: 1.3; color: #2c3e50;">
                            <span class="typing-animation">اكتشف عالمًا من الأناقة</span>
                        </hh2>
                        <p class="lead text-muted mb-4" style="line-height: 1.8">
                            مع بيكسوق، استمتع بأحدث الموديلات، العطور الفاخرة، الإكسسوارات الأنيقة والإلكترونيات المميزة بأسعار مناسبة. نضمن لك جودة عالية، شحنًا سريعًا وآمنًا، مع ضمان استرداد أموالك .
                        </p>
                        <div class="d-flex gap-3 justify-content-start">
                            <a href="#categories" class="btn btn-dark px-4 py-3 rounded-1 fw-bold">
                                ابدأ التسوق الآن <i class="fas fa-arrow-left ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Hero Image Column -->
                <div class="col-md-6 col-lg-5 order-md-0">
                    <div class="hero-image-container p-3">
                        <div class="hero-image-wrapper animate-on-scroll">
                            <img src="{{ asset('assets/shoping-3.png')}}" alt="متجر بيكسوق" class="hero-img img-fluid" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services mt-5 bg-dark">
        <div class="container">
            <div class="row justify-content-center align-items-center g-3">
                <div class="col-md-6 col-lg-4">
                    <div class="service p-3 animate-on-scroll">
                        <i class="fas fa-truck fs-3 text-info"></i>
                        <h5 class="service-title d-inline-block ms-2">شحن سريع</h5>
                        <p class="service-description mt-2">استمتع بشحن سريع وآمن لجميع طلباتك.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service p-3 animate-on-scroll">
                        <i class="fas fa-bolt fs-3 text-info"></i>
                        <h5 class="service-title d-inline-block ms-2">توصيل سريع</h5>
                        <p class="service-description mt-2">احصل على طلباتك بأسرع وقت ممكن مع خدمة التوصيل السريع لدينا.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service p-3 animate-on-scroll">
                        <i class="fa-solid fa-dollar-sign fs-3 text-info"></i>
                        <h5 class="service-title d-inline-block ms-2">الدفع عند الاستلام</h5>
                        <p class="service-description mt-2">ادفع عند استلام طلبك بكل سهولة وأمان.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="container" id="categories">
        <div class="categories py-5 pb-5">
            <div class="main-title text-center animate-on-scroll">
                <i class="fa-solid fa-layer-group fs-2 text-info"></i>
                <h1 class="display-4 fw-bold mt-2">أصناف المنتجات</h1>
                <p class="text-secondary">اكتشف منتجاتنا المتنوعة من خلال التصنيفات</p>  
            </div>
            <div>
                <div class="row justify-content-center align-items-center g-3 mt-5">
                    @foreach ($categories as $category)
                        <div class="col-6 col-md-6 col-lg-4 mb-4">
                            <div class="category card h-100 border-0 shadow-sm overflow-hidden animate-on-scroll">
                                <div class="category-image overflow-hidden">
                                    <img src="{{ Storage::url($category->image)}}" alt="{{ $category->name }}" class="img-fluid w-100 h-auto object-fit-cover" loading="lazy">
                                </div>
                                <div class="category-text text-center p-4">
                                    <h3 class="text-dark mb-0 fs-5 fw-semibold">{{ $category->name }}</h3>
                                    <a href="{{ route('products_category', $category)}}" class="stretched-link"></a>
                                </div>
                                <div class="w-75 mx-auto">
                                    <p class="text-secondary ">{{ Str::limit($category->description, 80) }}</p>
                                </div>
                                <div class="text-center text-primary mb-3">
                                    <small>{{ $category->products->count() }} منتوج</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>  
    
    <!-- Values Section -->
    <section class="values py-5 bg-light animate-on-scroll">
        <div class="container py-4">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto animate-on-scroll" data-aos="fade-up">
                    <h2 class="display-5 fw-bold mb-4">قيمنا الأساسية</h2>
                    <p class="lead text-muted">الأساس الذي تقوم عليه رؤيتنا وخدمتنا في بيكسوق</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4 animate-on-scroll" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-medal text-primary fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">الجودة</h4>
                            <p class="text-muted">نحرص على تقديم منتجات عالية الجودة من أفضل الموردين العالميين والمحليين.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 animate-on-scroll" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-shield-alt text-primary fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">الثقة</h4>
                            <p class="text-muted">نضمن لأعضائنا تجربة تسوق آمنة وشفافية كاملة في المعاملات.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 animate-on-scroll" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-headset text-primary fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">الدعم</h4>
                            <p class="text-muted">فريق دعم عملائنا متاح على مدار الساعة لمساعدتك في كل استفسار.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Random Products -->
    <div class="randomProducts text-light animate-on-scroll">
        <div class="container-fluid py-4 pb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="text-center mt-3 mb-4 animate-on-scroll">
                <i class="fa fa-box-open fs-2 text-info"></i>
                <h1 class="display-4 fw-bold mt-2">بعض منتجاتنا</h1>
                <p class="text-secondary">اكتشف منتجاتنا المتنوعة</p> 
            </div>
            <div class="row g-4 justify-content-center mt-4 animate-on-scroll">
                @foreach ($randomProducts as $product)
                    <div class="col-12 col-lg-3 col-md-3 mb-4 text-center animate-on-scroll" data-aos="fade-up" data-aos-delay="100">
                        <div class="course-card">
                            <div class="course-image">
                                <img src="{{ Storage::url($product->images->first()->path)}}" alt="{{ $product->name}}" class="img-fluid">
                                <div class="course-badge">{{ $product->category->name }}</div>
                            </div>
                            <div class="course-content">
                                <h3 class="course-title text-dark-25">{{ $product->name }}</h3>
                                {{-- discount display --}}
                                @if ($product->old_price > $product->price)
                                    <span class="badge bg-success mb-2">خصم {{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%</span>
                                @endif
                                <div class="course-meta">
                                    <div class="meta-item">
                                        <i class="fa fa-dollar-sign"></i>
                                        <span>{{ $product->price }} درهم</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="#" class="btn-enroll" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">
                                        اطلب الان <i class="fas fa-arrow-left me-3"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Course Item -->
                @endforeach
            </div>
        </div>
    </div>

    <!-- Enhanced Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="testimonials-heading text-center animate-on-scroll">
                <i class="fas fa-comments"></i>
                <h1 class="display-5 fw-bold mb-3">ماذا قالوا عنا</h1>
                <p class="text-secondary fs-5">اكتشف آراء عملائنا حول منتجاتنا وخدماتنا</p>
            </div>
            
            <div class="row justify-content-center mt-5">
                @foreach ($testimonials as $testimonial)
                    <div class="col-md-6 col-lg-4 mb-4 animate-on-scroll">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <i class="fas fa-quote-left quote-icon"></i>
                                <div class="user-content text-center">
                                    <h5 class="fw-bold mb-1">{{ $testimonial->full_name }}</h5>
                                    <p class="mb-3">{{ $testimonial->comment }}</p>
                                    <div class="testimonial-ratings">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $testimonial->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="testimonial-nav">
                <div class="testimonial-nav-btn active"></div>
                <div class="testimonial-nav-btn"></div>
                <div class="testimonial-nav-btn"></div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-labelledby="loginRequiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-5 p-4">
            <div class="modal-body text-center">
                <p class="fs-5 text-dark fw-semibold mb-3">يجب تسجيل الدخول أولاً حتى تتمكن من استخدام هذه الميزة</p>
                <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                <p class="text-muted">يرجى تسجيل الدخول إلى حسابك للمتابعة.</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <a href="{{ route('auth.login') }}" class="btn btn-primary px-4">تسجيل الدخول</a>
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">إلغاء</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollElements = document.querySelectorAll('.animate-on-scroll');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        scrollElements.forEach(element => { observer.observe(element); });
        const categoryCards = document.querySelectorAll('.category');
        categoryCards.forEach((card, index) => { card.style.transitionDelay = `${index * 0.1}s`; });
        const serviceItems = document.querySelectorAll('.service');
        serviceItems.forEach((item, index) => { item.style.transitionDelay = `${index * 0.2}s`; });
        
        // Testimonial navigation functionality
        const testimonialNavBtns = document.querySelectorAll('.testimonial-nav-btn');
        testimonialNavBtns.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                testimonialNavBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                // You can add carousel functionality here if needed
            });
        });
    });
</script>
@endpush