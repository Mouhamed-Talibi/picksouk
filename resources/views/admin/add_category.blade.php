@extends('layout.admin')

    @section('title')
        Add Category
    @endsection

    @section('content')
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 col-md-6">
                    <form action="{{ route('admin.insert_category') }}" class="shadow p-3 mt-4" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h2 class="text-center mb-3">Add Category</h2>
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
                                            placeholder="Enter categroy name" value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description Input -->
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa-solid fa-align-left fs-5 text-secondary"></i> <!-- Best for description -->
                                        </span>
                                        <textarea 
                                            name="description" 
                                            class="form-control border-start-1 @error('description') is-invalid @enderror" 
                                            placeholder="Enter category description"
                                        >{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Name Input -->
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fa-solid fa-images text-secondary"></i>
                                        </span>
                                        <input type="file" name="image" class="form-control border-start-1 @error('image') is-invalid @enderror" 
                                            placeholder="Enter categroy image" value="{{ old('image') }}">
                                    </div>
                                    @error('image')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 w-100">Add Category</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection