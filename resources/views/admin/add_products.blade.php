@extends('layout.admin')

    @section('title')
        Add Product
    @endsection

    @section('content')
        <div class="container">
            <div class="row justify-content-center align-items-center g-3">
                <div class="col-md-6 col-lg-3">
                    <div class="card p-3 border">
                        <i class="fas fa-spray-can-sparkles text-center fs-1 mb-2"></i>
                        <a href="{{ route('admin.parfums.create') }}" class="block group text-primary btn" style="text-decoration-line: underline">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="fs-4">
                                        New Parfum
                                    </p>
                                </div>
                            </div>
                        </a>
                        <p class="text-secondary text-center">Add a new fragrance to your collection</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card p-3 border">
                        <i class="fas fa-laptop text-center fs-1 mb-2"></i>
                        <a href="{{ route('admin.electronics.create') }}" class="block group text-primary btn" style="text-decoration-line: underline">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="fs-4">
                                        New electronics
                                    </p>
                                </div>
                            </div>
                        </a>
                        <p class="text-secondary text-center">Add a new fragrance to your collection</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card p-3 border">
                        <i class="fas fa-tshirt text-center fs-1 mb-2"></i>
                        <a href="{{ route('admin.clothes.create') }}" class="block group text-primary btn" style="text-decoration-line: underline">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="fs-4">
                                        New Clothes
                                    </p>
                                </div>
                            </div>
                        </a>
                        <p class="text-secondary text-center">Add a new fragrance to your collection</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card p-3 border">
                        <i class="fa-solid fa-user-nurse text-center fs-1 mb-2"></i>
                        <a href="{{ route('admin.health_beauty.create') }}" class="block group text-primary btn" style="text-decoration-line: underline">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="fs-4">
                                        New Health & beauty
                                    </p>
                                </div>
                            </div>
                        </a>
                        <p class="text-secondary text-center">Add a new fragrance to your collection</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card p-3 border">
                        <i class="fa-solid fa-bag-shopping text-center fs-1 mb-2"></i>
                        <a href="{{ route('admin.bags.create') }}" class="block group text-primary btn" style="text-decoration-line: underline">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="fs-4">
                                        New Bags
                                    </p>
                                </div>
                            </div>
                        </a>
                        <p class="text-secondary text-center">Add a new fragrance to your collection</p>
                    </div>
                </div>
            </div>
        </div>
    @endsection