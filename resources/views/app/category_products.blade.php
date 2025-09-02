@extends('layout.app')

@section('title')
    منتجات {{ $category->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-3">
            @if (count($products) > 0)
                @foreach ($products as $product)
                    <div class="col-6 col-md-6 col-lg-3">
                        <div class="product h-100">
                            <div class="product-image">
                                <img src="{{ Storage::url($product->images->get(2)->path)}}" alt="{{ $product->name}}" class="img-fluid" loading="lazy">
                            </div>
                            <div class="product-details text-center p-3">
                                <strong class="text-secondary d-block">{{ $product->category->name}}</strong>
                                <h3 class="mt-2 h5">{{ $product->name }}</h3>
                                <div class="rating text-warning my-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <p class="price mt-2">{{ number_format($product->price, 2) }} درهم</p>
                            </div>
                            <a href="{{ route('app.show_product', $product->id) }}" class="stretched-link" aria-label="عرض تفاصيل المنتج"></a>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="text-center mt-4b">
                    <i class="fa-solid fa-clock fs-1 text-info"></i>
                    <h1 class="mt-2">قيد التحضير</h1>
                    <p class="mt-3">سيتم اضافة منتجات متعلقة بهذا التصنيف في اقرب وقت ممكن</p>
                </div>
            @endif
        </div>

        <div class="float-start pb-3">
            {{ $products->links() }}
        </div>
    </div>
@endsection