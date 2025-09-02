@extends('layout.app')

@section('title')
    {{ $category->name }}
@endsection

@push('styles')
<style>
    .product-card {
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    
    .product-image-container {
        height: 200px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    .product-image {
        max-height: 90%;
        max-width:95%;
        object-fit: contain;
        transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-image {
        transform: scale(1.05);
    }
    
    .product-price-tag {
        position: absolute;
        bottom: 10px;
        left: 10px;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 700;
        color: #acafad;
        font-size: 0.9rem;
    }
    
    .card-body {
        padding: 1.2rem;
    }
    
    .product-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.8rem;
        color: #2c3e50;
    }
    
    .btn-details {
        background: #3498db;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
        margin-bottom: 0.5rem;
    }
    
    .btn-details:hover {
        background: #2980b9;
        transform: translateY(-2px);
        color: #e9ecef;
    }
    
    .btn-cart {
        background: #f8f9fa;
        color: #2c3e50;
        border: 1px solid #e9ecef;
        border-radius: 6px;
        padding: 0.4rem 0.8rem;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
    }
    
    .btn-cart:hover {
        background: #2c3e50;
        color: white;
        border-color: #2c3e50;
    }
    
    .category-header {
        position: relative;
        padding-bottom: 1rem;
        margin-bottom: 2.5rem;
    }
    
    .category-header:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(to right, #3498db, #2ecc71);
        border-radius: 3px;
    }
    
    .empty-state {
        padding: 3rem;
        text-align: center;
        background: #f8f9fa;
        border-radius: 12px;
    }
    
    .empty-state i {
        font-size: 3rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
        .product-image-container {
            height: 180px;
        }
        
        .card-body {
            padding: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="category-header text-center">
        <h1 class="display-5 fw-bold text-dark mb-2">{{ $category->name }}</h1>
        <p class="text-muted">اكتشف مجموعة منتوجاتنا من  {{ $category->name }}</p>
    </div>

    @if(empty($productsCategory))
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <h3 class="text-muted">No products available</h3>
            <p class="text-muted">There are no products in this category at the moment.</p>
            <a href="{{ route('app.categories') }}" class="btn btn-primary mt-3">
                <i class="fas fa-arrow-left me-2"></i>Browse Other Categories
            </a>
        </div>
    @else
        <div class="row g-4">
            @foreach($productsCategory as $product)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card product-card h-100">
                        <div class="product-image-container">
                            @if($product->images && $product->images->count() > 0)
                                <img src="{{ Storage::url($product->images->get(2)->path)}}" 
                                        class="product-image" 
                                        alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/300x200.png?text=No+Image" 
                                        class="product-image" 
                                        alt="No Image">
                            @endif
                            <div class="product-price-tag">{{ $product->price }} درهم</div>
                        </div>

                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="product-title">{{ $product->name }}</h5>
                            
                            <div class="mt-auto">
                                <a href="{{ route('showProduct', $product)}}" class="btn btn-details">
                                    <i class="fas fa-info-circle me-1"></i> معرفة المزيد
                                </a>
                                <a href="#" class="btn btn-cart" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">
                                    <i class="fas fa-shopping-cart"></i> اضافة الى السلة
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($productsCategory->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $productsCategory->links() }}
            </div>
        @endif
    @endif
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