@extends('layout.app')

@section('title')
    الصفحة الرئيسية
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
        /* Testimonials Section */
        .testimonials {
            padding: 5rem 0;
        }
        
        .testimonial-img {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            height: 100%;
        }
        
        .testimonial-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .testimonial-form {
            /* background: white; */
            padding: 2.5rem;
            border-radius: 16px;
            /* box-shadow: var(--card-shadow); */
            height: 100%;
        }
        
        .testimonial-form .form-control {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            transition: var(--transition);
        }
        
        .testimonial-form .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }
        
        .testimonial-form textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        
        .rating-input {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
            direction: ltr;
        }
        
        .rating-input input {
            display: none;
        }
        
        .rating-input label {
            cursor: pointer;
            font-size: 2rem;
            color: #ddd;
            transition: var(--transition);
            margin: 0 0.1rem;
        }
        
        .rating-input input:checked ~ label,
        .rating-input label:hover,
        .rating-input label:hover ~ label {
            color: #ffc107;
        }
        
        .rating-input input:checked + label {
            color: #ffc107;
        }
        
        .btn-submit {
            background: var(--primary-color);
            color: white;
            padding: 0.50rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            border: 2px solid var(--primary-color);
            width: 100%;
            margin-top: 1rem;
        }
        
        .btn-submit:hover {
            background: transparent;
            color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .testimonial-img {
                height: 400px;
                margin-bottom: 2rem;
            }
        }
        
        @media (max-width: 576px) {
            .testimonial-form {
                padding: 1.5rem;
            }
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
    </style>
@endpush

@section('content')
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section py-2" data-aos="fade-up">
            <div class="row justify-content-center align-items-center g-3">
                <div class="col-md-6 col-lg-5 order-md-1" data-aos="fade-right" data-aos-delay="100">
                    <div class="hero-text text-end">
                        <h6 class="text-primary mb-3 fw-bold" style="letter-spacing: 1px;" data-aos="fade-left" data-aos-delay="200">أحدث صيحات التسوق</h6>
                        <h1 class="display-4 fw-bold mb-4" style="line-height: 1.3; color: #2c3e50;" data-aos="zoom-in" data-aos-delay="300">
                            <span class="typing-animation">
                                اكتشف عالمًا من الأناقة والابتكار
                            </span>
                        </h1>
                        <p class="lead text-muted mb-4" style="line-height: 1.8" data-aos="fade-up" data-aos-delay="400">
                            مع بيكسوق، استمتع بأحدث الموديلات، العطور الفاخرة، الإكسسوارات الأنيقة والإلكترونيات المميزة بأسعار مناسبة. نضمن لك جودة عالية، شحنًا سريعًا وآمنًا، مع ضمان استرداد أموالك .
                        </p>
                        <div class="d-flex gap-3 justify-content-start" data-aos="fade-up" data-aos-delay="500">
                            <a href="#categories" class="btn btn-dark px-4 py-3 rounded-1 fw-bold">
                                ابدأ التسوق الآن <i class="fas fa-arrow-left ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Hero Image Column -->
                <div class="col-md-6 col-lg-5 order-md-0" data-aos="zoom-in-left" data-aos-delay="200">
                    <div class="hero-image-container p-3">
                        <div class="hero-image-wrapper">
                            <img src="{{ asset('assets/shoping-2.png')}}" alt="متجر بيكسوق" class="hero-img img-fluid" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services mt-5" id="services" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center align-items-center g-3">
                <div class="col-md-6 col-lg-4" data-aos="flip-left" data-aos-delay="100">
                    <div class="service p-3">
                        <i class="fas fa-truck fs-3 text-info" aria-hidden="true"></i>
                        <h5 class="service-title d-inline-block ms-2">شحن سريع</h5>
                        <p class="service-description mt-2">استمتع بشحن سريع وآمن لجميع طلباتك.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="flip-up" data-aos-delay="200">
                    <div class="service p-3">
                        <i class="fas fa-bolt fs-3 text-info" aria-hidden="true"></i>
                        <h5 class="service-title d-inline-block ms-2">توصيل سريع</h5>
                        <p class="service-description mt-2">احصل على طلباتك بأسرع وقت ممكن مع خدمة التوصيل السريع لدينا.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="flip-right" data-aos-delay="300">
                    <div class="service p-3">
                        <i class="fa-solid fa-dollar-sign fs-3 text-info" aria-hidden="true"></i>
                        <h5 class="service-title d-inline-block ms-2">الدفع عند الاستلام</h5>
                        <p class="service-description mt-2">ادفع عند استلام طلبك بكل سهولة وأمان.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Best Selling Products -->
    <div class="best-selling-pro py-5" data-aos="fade-up">
        <div class="container">
            <div class="main-title mt-5 text-center" data-aos="zoom-in">
                <h2 class="display-5 fw-bold">المنتجات الأكثر <span style="color: #2c3e50;">مبيعاً</span></h2>
                <hr class="w-25 mx-auto text-info">
            </div>
            <div class="products mt-5">
                <div class="row justify-content-center g-3 g-md-4">
                    @foreach($bestSellingProducts as $item)
                        <div class="col-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="product h-100">
                                <div class="product-image">
                                    <img src="{{ Storage::url($item->product->images->get(2)->path )}}" alt="{{ $item->product->name}}" class="img-fluid" loading="lazy">
                                </div>
                                <div class="product-details text-center p-3">
                                    <strong class="text-secondary d-block">{{ $item->product->category->name}}</strong>
                                    <h3 class="mt-2 h5">{{ $item->product->name }}</h3>
                                    {{-- discount display --}}
                                    @if ($item->product->old_price > $item->product->price)
                                        <span class="badge bg-info text-dark mb-2">خصم {{ round((($item->product->old_price - $item->product->price) / $item->product->old_price) * 100) }}%</span>
                                    @endif
                                    {{-- price --}}
                                    <p class="price mt-2">{{ number_format($item->product->price, 2) }} درهم</p>
                                </div>
                                <a href="{{ route('app.show_product', $item->product->id) }}" class="stretched-link" aria-label="عرض تفاصيل المنتج"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <section class="values py-5 bg-light">
        <div class="container py-4">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto" data-aos="fade-up">
                    <h2 class="display-5 fw-bold mb-4">قيمنا الأساسية</h2>
                    <p class="lead text-muted">الأساس الذي تقوم عليه رؤيتنا وخدمتنا في بيكسوق</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
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
                
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
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
                
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
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

    {{-- categories --}}
    <div class="categories py-5 pb-5" id="categories" data-aos="fade-up">
        <div class="main-title text-center" data-aos="zoom-in">
            <i class="fa-solid fa-layer-group fs-2 text-info"></i>
            <h1 class="display-4 fw-bold mt-2">أصناف المنتجات</h1>
            <p class="text-secondary">اكتشف منتجاتنا المتنوعة من خلال التصنيفات</p>  
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center g-3 mt-5">
                {{-- display categories --}}
                @foreach ($categories as $category)
                    <div class="col-6 col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                        <div class="category card h-100 border-0 shadow-sm overflow-hidden">
                            <div class="category-image overflow-hidden">
                                <img 
                                    src="{{ Storage::url($category->image)}}" 
                                    alt="{{ $category->name }}"
                                    class="img-fluid w-100 h-auto object-fit-cover"
                                    loading="lazy"
                                >
                            </div>
                            <div class="category-text text-center p-4">
                                <h3 class="text-dark mb-0 fs-5 fw-semibold">{{ $category->name }}</h3>
                                <a href="{{ route('app.show_category_products', $category)}}" class="stretched-link" aria-label="View {{ $category->name }}"></a>
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

    <!-- Testimonials Section -->
    <div class="testimonials py-5 animate-on-scroll">
        <div class="container">
            <div class="row justify-content-center align-items-stretch">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="testimonial-img animate-on-scroll">
                        <img src="{{ asset('assets/satisfied-customer.jpg')}}" alt="تجربة العملاء" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="testimonial-form animate-on-scroll">
                        <div class="text-center mb-5">
                            <i class="fas fa-comments fs-2 text-info mb-3"></i>
                            <h2 class="fw-bold">شاركنا تجربتك</h2>
                            <p class="text-muted">رأيك يهمنا! شاركنا تجربتك مع منتجاتنا وخدماتنا</p>
                        </div>
                        
                        <form action="{{ route('testimonials.store')}}" method="POST" class="animate-on-scroll">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="full_name" class="form-label">الاسم الكامل</label>
                                    <input type="text" class="form-control border-start-1 @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', Auth::user()->name ?? '') }}" placeholder="أدخل اسمك الكامل">
                                    @error('full_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control border-start-1 @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', Auth::user()->email ?? '') }}" placeholder="أدخل بريدك الإلكتروني">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label d-block text-center border-start-1 @error('rating') is-invalid @enderror">التقييم</label>
                                <div class="rating-input">
                                    <input type="radio" id="star5" name="rating" value="5">
                                    <label for="star5">★</label>
                                    <input type="radio" id="star4" name="rating" value="4">
                                    <label for="star4">★</label>
                                    <input type="radio" id="star3" name="rating" value="3">
                                    <label for="star3">★</label>
                                    <input type="radio" id="star2" name="rating" value="2">
                                    <label for="star2">★</label>
                                    <input type="radio" id="star1" name="rating" value="1">
                                    <label for="star1">★</label>
                                </div>
                                @error('rating')
                                    <p class="text-danger text-center">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="comment" class="form-label">التعليق</label>
                                <textarea class="form-control border-start-1 @error('comment') is-invalid @enderror" id="comment" {{ old('comment') }} name="comment" rows="4" placeholder="أخبرنا عن تجربتك مع منتجاتنا..."></textarea>
                                @error('comment')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn-submit">
                                إرسال التقييم <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
