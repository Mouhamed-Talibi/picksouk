@extends('layout.admin')

@section('title')
    New Health and beauty
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10 col-md-6">
                <form action="{{ route('admin.health_beauty.store') }}" class="shadow p-3 mt-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center mb-3">New Health and beauty products</h2>
                    {{-- form input --}}
                    <div class="form-input mt-3">
                        <div class="form-group mt-4">
                            <!-- Name Input -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-spa text-secondary fs-5"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control border-start-1 @error('name') is-invalid @enderror" 
                                        placeholder="Enter product name" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- description title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-soap fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="description_title" class="form-control border-start-1 @error('description_title') is-invalid @enderror" 
                                        placeholder="Enter description title" value="{{ old('description_title') }}">
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
                                    >{{ old('description') }}</textarea>
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
                                        placeholder="Enter stock" value="{{ old('stock') }}">
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
                                        placeholder="Enter price" value="{{ old('price') }}">
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
                                        placeholder="Enter old_price" value="{{ old('old_price') }}">
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
                                            <option value="{{ $category->id}}" {{ old('category_id' == $category->id ?? 'selected' )}}>{{ $category->name}}</option>
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
                                        <option value="male" class="form-control border-start-1">Male</option>
                                        <option value="female" class="form-control border-start-1">Female</option>
                                        <option value="both" class="form-control border-start-1">Both</option>
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
                                        placeholder="Enter product brand" value="{{ old('brand') }}">
                                </div>
                                @error('brand')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- skin_type -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-users fs-5 text-secondary"></i>	
                                    </span>
                                    <input type="text" name="skin_type" class="form-control border-start-1 @error('skin_type') is-invalid @enderror" 
                                        placeholder="Enter product skin type" value="{{ old('skin_type') }}">
                                </div>
                                @error('skin_type')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- has_fragrance title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-ruler fs-5 text-secondary"></i>	
                                    </span>
                                    <input type="text" name="has_fragrance" class="form-control border-start-1 @error('has_fragrance') is-invalid @enderror" 
                                        placeholder="Is the product has fragrance ?" value="{{ old('has_fragrance') }}">
                                </div>
                                @error('has_fragrance')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- images Input -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-images text-secondary"></i>
                                    </span>
                                    <input type="file" name="images[]" multiple class="form-control border-start-1 @error('images') is-invalid @enderror" 
                                        placeholder="Enter categroy image">
                                </div>
                                @if ($errors->has('images.*'))
                                    @foreach ($errors->get('images.*') as $messages)
                                        @foreach ($messages as $message)
                                            <div class="text-danger mt-2 small">{{ $message }}</div>
                                        @endforeach
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100">Create Product</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection