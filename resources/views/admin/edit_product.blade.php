@extends('layout.admin')

    @section('title')
        Edit Product
    @endsection

    @section('content')
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 col-md-6">
                    <form action="{{ route('admin.update_product', $product->id) }}" class="shadow p-3 mt-4" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h2 class="text-center mb-3">Edit - {{ $product->name }}</h2>
                        {{-- form input --}}
                        <div class="form-input mt-3">
                            <div class="form-group mt-4">
                                <!-- Name Input -->
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa-solid fa-tag fs-5 text-secondary"></i>
                                        </span>
                                        <input type="name" name="name" class="form-control border-start-1 @error('name') is-invalid @enderror" 
                                            placeholder="Enter product name" value="{{ $product->name ?? old('name') }}">
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description Input -->
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa-solid fa-align-left fs-5 text-secondary"></i>
                                        </span>
                                        <textarea 
                                            name="description" 
                                            class="form-control border-start-1 @error('description') is-invalid @enderror" 
                                            placeholder="Enter product description"
                                        >{{ $product->description ?? old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category Input -->
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa-solid fa-tag fs-5 text-secondary"></i>
                                        </span>
                                        <select name="category" id="" class="form-select">
                                            <option value="" class="text-secondary border-start-1 @error('category') is-invalid @enderror">Select product category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" 
                                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Price Input -->
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa-solid fa-euro-sign fs-5 text-secondary"></i>
                                        </span>
                                        <input type="number" name="price" class="form-control border-start-1 @error('price') is-invalid @enderror" 
                                            placeholder="Enter product price" value="{{ $product->price ?? old('price') }}" step="0.5" min="1">
                                    </div>
                                    @error('price')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Stock Input -->
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa-solid fa-boxes-stacked fs-5 text-secondary"></i>
                                        </span>
                                        <input type="number" name="stock" class="form-control border-start-1 @error('stock') is-invalid @enderror" 
                                            placeholder="Enter product stock" value="{{ $product->stock ?? old('stock') }}" min="1">
                                    </div>
                                    @error('stock')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image Input -->
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa-solid fa-images text-secondary"></i>
                                        </span>
                                        <input type="file" name="image" class="form-control border-start-1 @error('image') is-invalid @enderror" 
                                            placeholder="Enter product image" value="{{ old('image') }}">
                                    </div>
                                    <img src="{{ Storage::url($product->image )}}" alt="" class="img-fluid w-50 h-50 mt-2 mb-2">
                                    @error('image')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 w-100">Update product</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection