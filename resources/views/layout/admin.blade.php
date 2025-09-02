<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- csrf-token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- fav icon --}}
    <link rel="icon" href="{{ asset('assets/picksouk.jpg') }}" type="image/png">
    {{-- google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Relief:wght@400;700&family=Inconsolata:wght@200..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">


    {{-- title --}}
    <title>
        Picksouk - @yield('title')
    </title>

    {{-- bootstrap link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    {{-- font awesom --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    {{-- style stack --}}
    @stack('styles')
</head>
<body>
    {{-- loader --}}
    <div id="loader" class="loader-container">
        <div class="loader"></div>
        <p>Loading Luxoria, Please Wait..</p>
    </div>

    {{-- content site --}}
    <div id="content">
        <!-- Flash messages component -->
        <x-flashbacks />

        {{-- main content --}}
        <div class="wrapper d-flex">
            <!-- Sidebar -->
            <aside class="sidebar col-md-3 col-lg-2 d-md-block">
                <div class="sidebar-header">
                    <h4>Luxoria</h4>
                    <hr class="text-primary">
                </div>
                <ul class="nav flex-column px-3">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center py-3 px-4 rounded-3 transition-all 
                                {{ request()->routeIs('admin.dashboard') ? 'active bg-primary-soft text-dark fw-semibold' : 'text-light' }}" 
                                href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 fs-5 me-3"></i> <!-- Larger icon -->
                            <span class="flex-grow-1">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-hover">  <!-- Added dropdown-hover class -->
                        <a class="nav-link dropdown-toggle d-flex align-items-center px-4 py-3 rounded-3" 
                        href="#" 
                        id="categoriesDropdown" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                            <i class="bi bi-tags fs-5 me-2"></i> <!-- Updated icon to bi-tags -->
                            <span class="flex-grow-1">Categories</span>
                            <i class="bi bi-chevron-down ms-auto transition-all"></i> <!-- Added arrow icon -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-2 overflow-hidden" 
                            aria-labelledby="categoriesDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-3 px-4 hover-bg-primary-soft transition-all" 
                                href="{{ route('admin.add_category') }}">
                                    <i class="bi bi-plus-circle-fill text-primary me-3 fs-5"></i> <!-- Filled icon -->
                                    <div>
                                        <span class="d-block fw-semibold">New Category</span> <!-- Bold text -->
                                        <small class="text-muted">Add a new product category</small> <!-- Description -->
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li> <!-- Better divider -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-3 px-4 hover-bg-primary-soft transition-all" 
                                href="{{ route('admin.categories')}}">
                                    <i class="bi bi-card-checklist text-primary me-3 fs-5"></i> <!-- Updated icon -->
                                    <div>
                                        <span class="d-block fw-semibold">Categories List</span>
                                        <small class="text-muted">View all categories</small>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown dropdown-hover">
                        <a class="nav-link dropdown-toggle d-flex align-items-center px-4 py-3 rounded-3" 
                        href="#" 
                        id="productsDropdown" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                            <i class="bi bi-box-seam fs-5 me-3"></i> <!-- More appropriate product icon -->
                            <span class="flex-grow-1">Products</span>
                            <i class="bi bi-chevron-down ms-auto transition-all"></i> <!-- Animated chevron -->
                            <span class="active-indicator bg-primary rounded-pill ms-2"></span> <!-- Active state indicator -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-2" 
                            aria-labelledby="productsDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center px-3 py-2 rounded-2 mb-1 hover-bg-primary-soft transition-all" 
                                href="{{ route('admin.add_products') }}">
                                    <i class="bi bi-plus-circle-fill text-primary me-3"></i> <!-- Filled icon -->
                                    <div>
                                        <span class="d-block fw-semibold">New Product</span>
                                        <small class="text-muted">Add new inventory item</small> <!-- Help text -->
                                    </div>
                                    <i class="bi bi-arrow-right-short text-muted ms-auto"></i> <!-- Right arrow -->
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center px-3 py-2 rounded-2 hover-bg-primary-soft transition-all" 
                                href="{{ route('admin.products') }}">
                                    <i class="bi bi-card-checklist text-primary me-3"></i> <!-- Better list icon -->
                                    <div>
                                        <span class="d-block fw-semibold">Product List</span>
                                        <small class="text-muted">Manage all products</small>
                                    </div>
                                    <span class="badge bg-primary-soft text-primary ms-auto">{{ \App\Models\Product::count() }}</span> <!-- Item count -->
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center py-3 px-4 rounded-3 transition-all 
                                {{ request()->routeIs('admin.testimonials.index') ? 'active bg-primary-soft text-dark fw-semibold' : 'text-light' }}" 
                                href="{{ route('admin.testimonials.index') }}">
                            <i class="bi bi-speedometer2 fs-5 me-3"></i> <!-- Larger icon -->
                            <span class="flex-grow-1">Testimonials</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center py-3 px-4 rounded-3 transition-all 
                                {{ request()->routeIs('admin.users.index') ? 'active bg-primary-soft text-dark fw-semibold' : 'text-light' }}" 
                                href="{{ route('admin.users.index') }}">
                            <i class="bi bi-speedometer2 fs-5 me-3"></i> <!-- Larger icon -->
                            <span class="flex-grow-1">Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center py-3 px-4 rounded-3 transition-all 
                                {{ request()->routeIs('admin.payments.index') ? 'active bg-primary-soft text-dark fw-semibold' : 'text-light' }}" 
                                href="{{ route('admin.payments.index') }}">
                            <i class="bi bi-speedometer2 fs-5 me-3"></i> <!-- Larger icon -->
                            <span class="flex-grow-1">Payments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center py-3 px-4 rounded-3 transition-all 
                                {{ request()->routeIs('admin.orders.index') ? 'active bg-primary-soft text-dark fw-semibold' : 'text-light' }}" 
                                href="{{ route('admin.orders.index') }}">
                            <i class="bi bi-speedometer2 fs-5 me-3"></i> <!-- Larger icon -->
                            <span class="flex-grow-1">Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center py-3 px-4 rounded-3 transition-all 
                                {{ request()->routeIs('admin.messages.index') ? 'active bg-primary-soft text-dark fw-semibold' : 'text-light' }}" 
                                href="{{ route('admin.messages.index') }}">
                            <i class="bi bi-speedometer2 fs-5 me-3"></i> <!-- Larger icon -->
                            <span class="flex-grow-1">Messages</span>
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Main Content -->
            <div class="main-content w-100">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg top-navbar mb-4 shadow-none">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none" id="sidebarToggle">
                            <i class="fa-solid fa-list text-dark fs-4"></i>
                        </button>

                        <div class="d-flex ms-auto align-items-center">
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>
                                        <img src="{{ asset('assets/user.png ')}}" alt="" class="img-fluid rounded-circle"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <li><a class="dropdown-item" href="">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <!-- Logout Modal -->
                            <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 text-center p-4">
                                        <!-- Icon and Message -->
                                        <div class="modal-icon-wrapper my-4">
                                            <div class="logout-icon bg-soft-danger text-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
                                                <i class="fa-solid fa-right-from-bracket fa-2x"></i>
                                            </div>
                                            <h5 class="fw-bold mb-3">Ready to Leave?</h5>
                                            <p class="text-muted px-3">Are you sure you want to log out of your account?</p>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-center gap-3 mb-2">
                                            <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <form action="{{ route('auth.logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger px-4">
                                                    <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                {{-- page content --}}
                @yield('content')

            </div>
            <!-- Overlay for mobile sidebar -->
            <div class="overlay"></div>
        </div>
    </div>


    @stack('scripts')


    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    {{-- loader js --}}
    <script src="{{ asset('js/loader.js') }}"></script>
    {{-- sidebar js --}}
    <script src="{{ asset('js/sidebar.js')}}"></script>
</body>
</html>