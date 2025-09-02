@extends('layout.admin')

@section('title')
    Edit {{ $parfum->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10 col-md-6">
                <form action="{{ route('admin.update_parfum', $parfum->id) }}" class="shadow p-3 mt-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h2 class="text-center mb-3">Edit <span class="text-primary">{{ $parfum->name }}</span> product</h2>
                    {{-- form input --}}
                    <div class="form-input mt-3">
                        <div class="form-group mt-4">
                            <!-- Name Input -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-tag fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control border-start-1 @error('name') is-invalid @enderror" 
                                        placeholder="Enter parfum name" value="{{ $parfum->name ?? old('name') }}">
                                </div>
                                @error('name')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- description title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-tag fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="description_title" class="form-control border-start-1 @error('description_title') is-invalid @enderror" 
                                        placeholder="Enter description title" value="{{ $parfum->description_title ?? old('description_title') }}">
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
                                    >{{ $parfum->description ?? old('description') }}</textarea>
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
                                        placeholder="Enter stock" value="{{$parfum->stock ?? old('stock') }}">
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
                                        placeholder="Enter price" value="{{$parfum->price ?? old('price') }}">
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
                                        placeholder="Enter old_price" value="{{$parfum->old_price ?? old('old_price') }}">
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
                                            <option value="{{ $category->id}}" {{ $parfum->category_id == $category->id ? 'selected' : old('category_id')}}>{{ $category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- mark title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-spray-can-sparkles fs-5 text-secondary"></i> 
                                    </span>
                                    <input type="text" name="mark" class="form-control border-start-1 @error('mark') is-invalid @enderror" 
                                        placeholder="Enter parfum mark" value="{{$parfum->parfumDetails->mark ?? old('mark') }}">
                                </div>
                                @error('mark')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- volume title -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-glass-water fs-5 text-secondary"></i>
                                    </span>
                                    <input type="number" name="volume" class="form-control border-start-1 @error('volume') is-invalid @enderror" 
                                        placeholder="Enter parfum volume" value="{{$parfum->parfumDetails->volume ?? old('volume') }}">
                                </div>
                                @error('volume')
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
                                        <option value="" class="form-control border-start-1 @error('gender') is-invalid @enderror">Select Parfum Gender</option>
                                        <option value="male" {{ $parfum->parfumDetails->gender == 'male' ? "selected" : old('gender')}}>Male</option>
                                        <option value="female" {{ $parfum->parfumDetails->gender == 'female' ? "selected" : old('gender')}}>Female</option>
                                    </select>
                                </div>
                                @error('gender')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100">Update Parfum</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection