@extends('layout.admin')

    @section('title')
        Dashboard
    @endsection

    @section('content')
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-6 col-md-6 col-lg-4">
                    <div class="card border border-1 shadow-lg rounded-4 overflow-hidden bg-gradient-primary">
                        <div class="card-body p-4 position-relative">
                            <!-- Background decorative element -->
                            <div class="position-absolute end-0 top-1 opacity-10 me-3">
                                <i class="fa-solid fa-users fa-2x text-primary"></i>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-start">
                                <!-- Text content -->
                                <div class="text-start">
                                    <p class="text-dark-50 mb-1 fw-semibold small">TOTAL USERS</p>
                                    <h2 class="text-dark mb-0 fw-bold display-6">{{ $totalUsers ?? 0 }}</h2>
                                    <!-- Optional growth indicator -->
                                    <div class="d-flex align-items-center mt-2">
                                        @if ( $usersGrowth > 0 )
                                            <span class="badge bg-white text-success rounded-pill px-2 py-1">
                                                <i class="fas fa-arrow-up me-1 small"></i> {{ $usersGrowth }}%
                                            </span>
                                        @endif
                                        @if ( $usersGrowth <= 0 )
                                            <span class="badge bg-white text-danger rounded-pill px-2 py-1">
                                                <i class="fas fa-arrow-down me-1 small"></i> {{ abs($usersGrowth) }}%
                                            </span>
                                        @endif
                                        <span class="text-dark-50 small ms-2">Than Last Week</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- orders total --}}
                <div class="col-6 col-md-6 col-lg-4">
                    <div class="card border border-1 shadow-lg rounded-4 overflow-hidden bg-gradient-primary">
                        <div class="card-body p-4 position-relative">
                            <!-- Background decorative element -->
                            <div class="position-absolute end-0 top-1 opacity-10 me-3">
                                <i class="fa-solid fa-cart-flatbed fa-2x text-primary"></i>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-start">
                                <!-- Text content -->
                                <div class="text-start">
                                    <p class="text-dark-50 mb-1 fw-semibold small">TOTAL ORDERS</p>
                                    <h2 class="text-dark mb-0 fw-bold display-6">{{ $totalOrders ?? 0 }}</h2>
                                    <!-- Optional growth indicator -->
                                    <div class="d-flex align-items-center mt-2">
                                        @if($ordersGrowth > 0)
                                            <span class="badge bg-white text-success rounded-pill px-2 py-1">
                                                <i class="fas fa-arrow-up me-1 small"></i> {{ $ordersGrowth }}%
                                            </span>
                                        @endif
                                        @if($ordersGrowth <= 0)
                                            <span class="badge bg-white text-danger rounded-pill px-2 py-1">
                                                <i class="fas fa-arrow-down me-1 small"></i> {{ $ordersGrowth }}%
                                            </span>
                                        @endif
                                        <span class="text-dark-50 small ms-2">Than Last Week</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- products total --}}
                <div class="col-6 col-md-6 col-lg-4">
                    <div class="card border border-1 shadow-lg rounded-4 overflow-hidden bg-gradient-primary">
                        <div class="card-body p-4 position-relative">
                            <!-- Background decorative element -->
                            <div class="position-absolute end-0 top-1 opacity-10 me-3">
                                <i class="fas fa-box-open fa-2x text-primary"></i>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-start">
                                <!-- Text content -->
                                <div class="text-start">
                                    <p class="text-dark-50 mb-1 fw-semibold small">TOTAL PRODUCTS</p>
                                    <h2 class="text-dark mb-0 fw-bold display-6">{{ $totalProducts ?? 0 }}</h2>
                                    <!-- Optional growth indicator -->
                                    <div class="d-flex align-items-center mt-2">
                                        @if($productsGrowth > 0)
                                            <span class="badge bg-white text-success rounded-pill px-2 py-1">
                                                <i class="fas fa-arrow-up me-1 small"></i> {{ $productsGrowth }}%
                                            </span>
                                        @endif
                                        @if($productsGrowth <= 0)
                                            <span class="badge bg-white text-danger rounded-pill px-2 py-1">
                                                <i class="fas fa-arrow-down me-1 small"></i> {{ $productsGrowth }}%
                                            </span>
                                        @endif
                                        <span class="text-dark-50 small ms-2">Than Last Week</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Last Registered Users --}}
            <div class="row justify-content-between align-items-center mt-4">
                <div class="col-12">
                    <h3>
                        <i class="fa-solid fa-users text-info"></i>
                        Last Registered Users
                    </h3 classs="mb-3">

                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Total Orders</th>
                        </thead>
                        <tbody>
                            @foreach ($lastRegisteredUsers as $user)
                                <tr>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->orders->count()}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h3 class="mt-4 mb-3">
                    <i class="fa-solid fa-sliders text-info"></i>
                    Quick Actions
                </h3>
                <div class="col-12 col-lg-3 col-md-3">
                    <div class="action border border-left-secondary p-3 rounded-4 text-center">
                        <i class="fa-solid fa-plus fs-2"></i>
                        <h2>
                            <a href="{{ route('admin.add_products')}}" class="btn">Create Product</a>
                        </h2>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-md-3">
                    <div class="action border border-left-secondary p-3 rounded-4 text-center">
                        <i class="fas fa-users-cog fs-2"></i>
                        <h2>
                            <a href="{{ route('admin.users.index')}}" class="btn">Manage Users</a>
                        </h2>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-md-3">
                    <div class="action border border-left-secondary p-3 rounded-4 text-center">
                        <i class="fa-solid fa-layer-group fs-2"></i>
                        <h2>
                            <a href="{{ route('admin.add_category')}}" class="btn">New Category</a>
                        </h2>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-md-3">
                    <div class="action border border-left-secondary p-3 rounded-4 text-center">
                        <i class="fa-solid fa-cart-flatbed fs-2"></i>
                        <h2>
                            <a href="{{ route('admin.orders.index')}}" class="btn">Manage Orders</a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    @endsection