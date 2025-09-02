@extends('layout.app')

@section('title')
    نتائج البحث
@endsection

@section('content')
<div class="container py-5">
    <div class="text-center">
        <i class="fas fa-list fs-1 text-info mb-3"></i>
        <h2 class="mb-4 display-5 fw-bold">نتائج البحث</h2>
    </div>
    <hr class="text-primary mx-auto w-50">

    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <!-- Product Image -->
                    @if($product->images->isNotEmpty())
                        <img src="{{ Storage::url($product->images->first()->path) }}" 
                            class="card-img-top p-3" 
                            style="height: 250px; object-fit: contain;" 
                            alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/250x250?text=No+Image" 
                            class="card-img-top p-3" 
                            style="height: 250px; object-fit: contain;" 
                            alt="no image">
                    @endif

                    <!-- Card Body -->
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted mb-2">
                            {{ Str::limit($product->description, 60) }}
                        </p>
                        <p class="fw-bold">{{ number_format($product->price, 2) }} درهم</p>

                        <!-- Link to product page -->
                        <a href="{{ route('app.show_product', $product->id) }}" 
                        class="btn btn-outline-primary w-100">
                            عرض التفاصيل
                        </a>
                    </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
