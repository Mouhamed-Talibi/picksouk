@extends('layout.admin')

@section('title')
    Edit {{ $product->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10 col-md-6">
                <form action="{{ route('admin.clothes.update', $product->id) }}" class="shadow p-3 mt-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h2 class="text-center mb-3">Edit <span class="text-primary">{{ $product->name }}</span></h2>
                    {{-- form input --}}
                    <div class="form-input mt-3">
                        <div class="form-group mt-4">
                            <!-- Name Input -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-tshirt text-secondary fs-5"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control border-start-1 @error('name') is-invalid @enderror" 
                                        placeholder="Enter product name" value="{{ old('name', $product->name) }}">
                                </div>
                                @error('name')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- description title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-shirt fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="description_title" class="form-control border-start-1 @error('description_title') is-invalid @enderror" 
                                        placeholder="Enter description title" value="{{ old('description_title', $product->description_title) }}">
                                </div>
                                @error('description_title')
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
                                    >{{ old('description', $product->description) }}</textarea>
                                </div>
                                @error('description')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- stock -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-cubes-stacked fs-5 text-secondary"></i>
                                    </span>
                                    <input type="number" name="stock" class="form-control border-start-1 @error('stock') is-invalid @enderror" 
                                        placeholder="Enter stock" value="{{ old('stock', $product->stock) }}">
                                </div>
                                @error('stock')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- price -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-money-check-dollar fs-5 text-secondary"></i>
                                    </span>
                                    <input type="number" name="price" class="form-control border-start-1 @error('price') is-invalid @enderror" 
                                        placeholder="Enter price" value="{{ old('price', $product->price) }}">
                                </div>
                                @error('price')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- price -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-money-check-dollar fs-5 text-secondary"></i>
                                    </span>
                                    <input type="number" name="old_price" class="form-control border-start-1 @error('old_price') is-invalid @enderror" 
                                        placeholder="Enter old_price" value="{{ old('old_price', $product->old_price) }}">
                                </div>
                                @error('old_price')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- category_id -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-tag fs-5 text-secondary"></i>
                                    </span>
                                    <select name="category_id" id="" class="form-select">
                                        <option value="" class="form-control border-start-1 @error('category_id') is-invalid @enderror">Select Product Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id}}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- gender -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-mars-and-venus fs-5 text-secondary"></i>
                                    </span>
                                    <select name="gender" id="" class="form-select">
                                        <option value="" class="form-control border-start-1 @error('gender') is-invalid @enderror">Product For</option>
                                        <option value="kids" class="form-control border-start-1" {{ old('age_group',$product->clothesDetails->age_group ) === "kids" ? "selected" : "" }} >Kids</option>
                                        <option value="girls" class="form-control border-start-1" {{ old('age_group',$product->clothesDetails->age_group ) === "girls" ? "selected" : "" }}>Girls</option>
                                        <option value="boys" class="form-control border-start-1" {{ old('age_group',$product->clothesDetails->age_group ) === "boys" ? "selected" : "" }}>Boys</option>
                                        <option value="men" class="form-control border-start-1" {{ old('age_group',$product->clothesDetails->age_group ) === "men" ? "selected" : "" }}>Men</option>
                                        <option value="women" class="form-control border-start-1" {{ old('age_group',$product->clothesDetails->age_group ) === "women" ? "selected" : "" }}>Women</option>
                                    </select>
                                </div>
                                @error('gender')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- brand title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-shoe-prints fs-5 text-secondary"></i>	
                                    </span>
                                    <input type="text" name="brand" class="form-control border-start-1 @error('brand') is-invalid @enderror" 
                                        placeholder="Enter product brand" value="{{ old('brand', $product->clothesDetails->brand) }}">
                                </div>
                                @error('brand')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- age -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-users fs-5 text-secondary"></i>	
                                    </span>
                                    <input type="text" name="age" class="form-control border-start-1 @error('age') is-invalid @enderror" 
                                        placeholder="Enter product age" value="{{ old('age', $product->clothesDetails->age) }}">
                                </div>
                                @error('age')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- size title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-ruler fs-5 text-secondary"></i>	
                                    </span>
                                    <input type="text" name="size" class="form-control border-start-1 @error('size') is-invalid @enderror" 
                                        placeholder="Enter product size" value="{{ old('size', $product->clothesDetails->size) }}">
                                </div>
                                @error('size')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100">Update Product</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection