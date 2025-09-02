@extends('layout.app')

@section('title')
    تفاصيل المنتج
@endsection

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center align-items-start g-4">
            <!-- Product Images Column -->
            <div class="col-md-6 col-lg-6">
                <!-- Main Carousel -->
                <div id="productCarousel" class="carousel slide shadow-sm rounded" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <div class="carousel-indicators-container mb-2">
                        <div class="d-flex justify-content-center flex-wrap">
                            @foreach($product->images as $key => $image)
                                <button type="button" 
                                    data-bs-target="#productCarousel" 
                                    data-bs-slide-to="{{ $key }}" 
                                    class="mx-1 {{ $key === 0 ? 'active' : '' }}"
                                    aria-current="{{ $key === 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $key + 1 }}">
                                    <img src="{{ Storage::url($image->path) }}" 
                                        alt="Thumbnail {{ $key + 1 }}"
                                        class="img-thumbnail carousel-thumbnail"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                </button>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Slides -->
                    <div class="carousel-inner ratio ratio-1x1 bg-light rounded">
                        @foreach($product->images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ Storage::url($image->path) }}" 
                                    class="d-block w-100 img-fluid p-3"
                                    style="object-fit: contain; max-height: 500px;"
                                    alt="{{ $product->name }} - Image {{ $key + 1 }}"
                                    loading="lazy">
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            
            <!-- Product Details Column -->
            <div class="col-md-6 col-lg-5">
                <div class="product-details p-3">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"> الرئيسية/</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $product->category->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ol>
                    </nav>
                    
                    <!-- Product Name -->
                    <h1 class="h2 mb-3">{{ $product->name }}</h1>

                    <!-- Price Section -->
                    <div class="d-flex align-items-center mb-3">
                        @if($product->old_price > $product->price)
                            <del class="text-danger h6 me-2 mb-0">
                                {{ number_format($product->old_price, 2) }} درهم
                            </del>
                        @endif
                        <span class="h5 text-success mb-0 me-2">
                            {{ number_format($product->price, 2) }} درهم
                        </span>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <h3 class="h5 mb-3 mt-3">{{ $product->description_title}}</h3>
                        <p class="text-secondary">{{ $product->description }}</p>
                    </div>

                    <!-- Add to Cart -->
                    <div class="mb-4">
                        <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">
                            <i class="fas fa-shopping-cart me-2"></i>
                            إضافة إلى السلة
                        </button>
                    </div>

                    <!-- Product Meta -->
                    <div class="product-meta border-top pt-3">
                        <div class="row small">

                            {{-- ===== General Product Info ===== --}}
                            @if(!empty($product->category->name))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">القسم:</span>
                                        <span>{{ $product->category->name }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- ================= PARFUM DETAILS ================= --}}
                            {{-- Brand --}}
                            @if(!empty($product->parfumDetails->mark))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الماركة:</span>
                                        <span>{{ $product->parfumDetails->mark }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Volume --}}
                            @if(!empty($product->parfumDetails->volume))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الحجم:</span>
                                        <span>{{ $product->parfumDetails->volume }} ml</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Gender --}}
                            @if(!empty($product->parfumDetails->gender))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الجنس:</span>
                                        <span>{{ $product->parfumDetails->gender == 'male' ? 'الرجال' : 'النساء' }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- ================= ELECTRONICS DETAILS ================= --}}
                            {{-- Brand --}}
                            @if(!empty($product->electronicsDetails->brand))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الماركة:</span>
                                        <span>{{ $product->electronicsDetails->brand }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- RAM --}}
                            @if(!empty($product->electronicsDetails->ram))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الرام:</span>
                                        <span>{{ $product->electronicsDetails->ram }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Storage --}}
                            @if(!empty($product->electronicsDetails->storage))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">مساحة التخزين:</span>
                                        <span>{{ $product->electronicsDetails->storage }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Operating System --}}
                            @if(!empty($product->electronicsDetails->operating_system))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">نظام التشغيل:</span>
                                        <span>{{ $product->electronicsDetails->operating_system }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Screen Size --}}
                            @if(!empty($product->electronicsDetails->screen_size))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">حجم الشاشة:</span>
                                        <span>{{ $product->electronicsDetails->screen_size }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Processor --}}
                            @if(!empty($product->electronicsDetails->processor))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">المعالج:</span>
                                        <span>{{ $product->electronicsDetails->processor }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Weight --}}
                            @if(!empty($product->electronicsDetails->weight))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الوزن:</span>
                                        <span>{{ $product->electronicsDetails->weight }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- ================= CLOTHES DETAILS ================= --}}
                            {{-- Brand --}}
                            @if(!empty($product->clothesDetails->brand))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الماركة:</span>
                                        <span>{{ $product->clothesDetails->brand }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Sizes --}}
                            @if(!empty($product->clothesDetails->size))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الأحجام المتوفرة:</span>
                                        <span>{{ $product->clothesDetails->size }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Age --}}
                            @if(!empty($product->clothesDetails->age))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الفئة العمرية:</span>
                                        <span>{{ $product->clothesDetails->age }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Age Group --}}
                            @if(!empty($product->clothesDetails->age_group))
                            <div class="col-6">
                                <div class="mb-2">
                                        <span class="text-muted">الفئة:</span>
                                        @switch($product->clothesDetails->age_group)
                                            @case('boys') الشباب @break
                                            @case('kids') الاطفال @break
                                            @case('men') الرجال @break
                                            @case('girls') الشابات @break
                                            @case('women') النساء @break
                                        @endswitch
                                    </div>
                                </div>
                            @endif

                            {{-- ================= HEALTH AND BEAUTY DETAILS ================= --}}
                            {{-- brand --}}
                            @if(!empty($product->health_beauty_Details->brand))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الماركة:</span>
                                        <span>{{ $product->health_beauty_Details->brand }}</span>
                                    </div>
                                </div>
                            @endif
                            {{-- skin_type --}}
                            @if(!empty($product->health_beauty_Details->skin_type))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">نوع البشرة:</span>
                                        <span>{{ $product->health_beauty_Details->skin_type }}</span>
                                    </div>
                                </div>
                            @endif
                            {{-- has_fragrance --}}
                            @if(!empty($product->health_beauty_Details->has_fragrance))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الرائحة :</span>
                                        <span class="text-success">{{ $product->health_beauty_Details->has_fragrance }}</span>
                                    </div>
                                </div>
                            @endif
                            {{-- gender --}}
                            @if(!empty($product->health_beauty_Details->gender))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">خاص ب :</span>
                                        <span>{{ $product->health_beauty_Details->gender === "male" ? 'الرجال' : "" }}</span>
                                        <span>{{ $product->health_beauty_Details->gender === "female" ? 'النساء' : "" }}</span>
                                        <span>{{ $product->health_beauty_Details->gender === "both" ? 'الرجال و النساء' : "" }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- ================= Bags DETAILS ================= --}}
                            {{-- brand --}}
                            @if(!empty($product->bagsDetails->brand))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الماركة :</span>
                                        <span>{{ $product->bagsDetails->brand }}</span>
                                    </div>
                                </div>
                            @endif
                            {{-- size --}}
                            @if(!empty($product->bagsDetails->size))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">السعة :</span>
                                        <span>{{ $product->bagsDetails->size }}</span>
                                    </div>
                                </div>
                            @endif
                            {{-- weight --}}
                            @if(!empty($product->bagsDetails->weight))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">الوزن :</span>
                                        <span>{{ $product->bagsDetails->weight }}</span>
                                    </div>
                                </div>
                            @endif
                            {{-- external material --}}
                            @if(!empty($product->bagsDetails->external_material))
                                <div class="col-6">
                                    <div class="mb-2">
                                        <span class="text-muted">المادة الخارجية :</span>
                                        <span>{{ $product->bagsDetails->external_material }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

@section('scripts')
<script>
    // Quantity increment/decrement
    document.getElementById('increment').addEventListener('click', function() {
        const quantityInput = document.getElementById('quantity');
        let quantity = parseInt(quantityInput.value);
        if (quantity < 10) {
            quantityInput.value = quantity + 1;
        }
    });
    
    document.getElementById('decrement').addEventListener('click', function() {
        const quantityInput = document.getElementById('quantity');
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantityInput.value = quantity - 1;
        }
    });
    
    // Image zoom functionality
    document.querySelectorAll('.carousel-inner img').forEach(img => {
        img.addEventListener('click', function() {
            this.classList.toggle('zoom-img');
        });
    });

    $(document).ready(function() {
        $('#city').select2({
            placeholder: "ابحث عن مدينتك",
            allowClear: true
        });
    });
</script>

<style>
    /* Custom styles for the carousel */
    .carousel-thumbnail {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }
    
    .carousel-thumbnail:hover,
    .carousel-thumbnail.active {
        opacity: 1;
        border-color: #a0aec4 !important;
    }
    
    .carousel-indicators-container {
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 10px;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 8%;
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-size: 50%;
    }
    
    .zoom-img {
        transform: scale(1.5);
        cursor: zoom-out;
        z-index: 1000;
        position: relative;
        transition: transform 0.3s ease;
    }
    
    .rating-stars {
        font-size: 1.2rem;
    }
    
    @media (max-width: 768px) {
        .carousel-inner {
            max-height: 300px;
        }
    }
</style>
@endsection