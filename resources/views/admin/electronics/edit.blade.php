@extends('layout.admin')

@section('title')
    Edit {{ $product->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10 col-md-6">
                <form action="{{ route('admin.electronics.update', $product->id) }}" class="shadow p-3 mt-4" method="POST" enctype="multipart/form-data">
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
                                        <i class="fas fa-mobile-screen text-secondary fs-5"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control border-start-1 @error('name') is-invalid @enderror" 
                                        placeholder="Enter electronic name" value="{{ old('name', $product->name) }}">
                                </div>
                                @error('name')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- description title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-plug-circle-bolt fs-5 text-secondary"></i>
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
                                        placeholder="Enter category description"
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

                            <!-- ram title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-hard-drive fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="ram" class="form-control border-start-1 @error('ram') is-invalid @enderror" 
                                        placeholder="Enter eletronic ram" value="{{ old('ram', $product->electronicsDetails->ram) }}">
                                </div>
                                @error('ram')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- rom title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-hard-drive fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="rom" class="form-control border-start-1 @error('rom') is-invalid @enderror" 
                                        placeholder="Enter eletronic storage" value="{{ old('rom', $product->electronicsDetails->storage) }}">
                                </div>
                                @error('rom')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- processor title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-microchip fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="processor" class="form-control border-start-1 @error('processor') is-invalid @enderror" 
                                        placeholder="Enter processor name" value="{{ old('processor', $product->electronicsDetails->processor) }}">
                                </div>
                                @error('processor')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- camera title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-camera fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="camera" class="form-control border-start-1 @error('camera') is-invalid @enderror" 
                                        placeholder="Enter camera description" value="{{ old('camera', $product->electronicsDetails->camera) }}">
                                </div>
                                @error('camera')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- weight title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-weight fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="weight" class="form-control border-start-1 @error('weight') is-invalid @enderror" 
                                        placeholder="Enter product weight" value="{{ old('weight', $product->electronicsDetails->weight) }}">
                                </div>
                                @error('weight')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- screen_size title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-desktop fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="screen_size" class="form-control border-start-1 @error('screen_size') is-invalid @enderror" 
                                        placeholder="Enter product screen size" value="{{ old('screen_size', $product->electronicsDetails->screen_size) }}">
                                </div>
                                @error('screen_size')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- brand title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-code-branch fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="brand" class="form-control border-start-1 @error('brand') is-invalid @enderror" 
                                        placeholder="Enter product brand" value="{{ old('brand', $product->electronicsDetails->brand) }}">
                                </div>
                                @error('brand')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- operating_system -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-brands fa-windows fs-5 text-secondary"></i>
                                    </span>
                                    <select name="operating_system" id="" class="form-select">
                                        <option value="" class="form-control border-start-1 @error('operating_system') is-invalid @enderror">Select Product Operating system</option>
                                            <option value="android" {{ $product->electronicsDetails->operating_system == "android" ? 'selected' : ''}}>Android</option>
                                            <option value="ios" {{ $product->electronicsDetails->operating_system == "ios" ? 'selected' : ''}}>Ios</option>
                                            <option value="windous" {{ $product->electronicsDetails->operating_system == "windous" ? 'selected' : ''}}>Windous</option>
                                            <option value="linux" {{ $product->electronicsDetails->operating_system == "linux" ? 'selected' : ''}}>Linux</option>
                                    </select>
                                </div>
                                @error('operating_system')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100">Updaete {{ $product->name }}</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection