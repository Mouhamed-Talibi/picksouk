@extends('layout.admin')

@section('title')
    Health and Beauty Management
@endsection

@push('styles')
<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #e83e8c;
        --success-color: #1cc88a;
        --danger-color: #e74a3b;
        --warning-color: #f6c23e;
        --info-color: #36b9cc;
        --light-bg: #f8f9fc;
    }
    
    .health-beauty-container {
        padding: 20px;
    }
    
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        margin-bottom: 1.5rem;
    }
    
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #e3e6f0;
        padding: 1rem 1.35rem;
        font-weight: 600;
        color: #5a5c69;
        border-radius: 10px 10px 0 0 !important;
    }
    
    .btn-primary {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }
    
    .btn-primary:hover {
        background-color: #d91a72;
        border-color: #d91a72;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        color: #5a5c69;
        padding: 0.75rem 1.2rem;
    }
    
    .table td {
        padding: 0.75rem 1.2rem;
        vertical-align: middle;
    }
    
    .status-badge {
        padding: 0.35rem 0.65rem;
        border-radius: 0.35rem;
        font-weight: 600;
    }
    
    .product-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    .pagination {
        margin-bottom: 0;
    }
    
    .empty-state {
        padding: 3rem;
        text-align: center;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    
    .empty-state i {
        font-size: 5rem;
        color: #ddd;
        margin-bottom: 1.5rem;
    }
    
    .search-box {
        position: relative;
    }
    
    .search-box input {
        padding-left: 2.5rem;
        border-radius: 20px;
    }
    
    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #b7b9cc;
    }
    
    .health-icon {
        background: linear-gradient(135deg, var(--secondary-color), #fd7e14);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    
    .rating {
        color: #ffc107;
        font-size: 0.9rem;
    }
    
    .category-badge {
        background-color: #f8f9fc;
        color: #5a5c69;
        border: 1px solid #e3e6f0;
        padding: 0.25rem 0.5rem;
        border-radius: 0.35rem;
        font-size: 0.75rem;
    }
    
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .product-img {
            width: 40px;
            height: 40px;
        }
        
        .action-btn {
            width: 28px;
            height: 28px;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .header-actions {
            margin-top: 1rem;
            width: 100%;
        }
        
        .search-box {
            width: 100%;
        }
    }
    
    @media (max-width: 576px) {
        .btn-text {
            display: none;
        }
        
        .btn-icon {
            margin-right: 0 !important;
        }
        
        .table th, .table td {
            padding: 0.5rem 0.7rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid health-beauty-container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Health & Beauty Management</h1>
        <a href="{{ route('admin.health_beauty.create') }}" class="btn btn-primary d-inline-flex align-items-center">
            <i class="fas fa-plus btn-icon me-2"></i>
            <span class="btn-text">Add New Product</span>
        </a>
    </div>

    @if ($health_beauty_products->isEmpty())
        <div class="card empty-state">
            <div class="card-body">
                <div class="health-icon">
                    <i class="fas fa-spa fa-2x"></i>
                </div>
                <h3 class="h5 mb-3">No Health & Beauty Products Found</h3>
                <p class="mb-4">Get started by adding your first health or beauty product to the inventory.</p>
                <a href="{{ route('admin.health_beauty_products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Create New Product
                </a>
            </div>
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">Health & Beauty Products</h6>
                <div class="header-actions d-flex align-items-center">
                    <div class="search-box me-3">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search products..." id="searchInput">
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item" href="#">All Products</a></li>
                            <li><a class="dropdown-item" href="#">Skincare</a></li>
                            <li><a class="dropdown-item" href="#">Haircare</a></li>
                            <li><a class="dropdown-item" href="#">Makeup</a></li>
                            <li><a class="dropdown-item" href="#">Fragrance</a></li>
                            <li><a class="dropdown-item" href="#">Wellness</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="productsTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($health_beauty_products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($product->images && $product->images->isNotEmpty())
                                            <img src="{{ Storage::url($product->images->first()->path) }}" class="product-img me-3" alt="{{ $product->name }}">
                                        @else
                                            <img src="/path/to/default-image.jpg" class="product-img me-3" alt="No image available">
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $product->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="category-badge">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                </td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $status = 'Available';
                                        $statusClass = 'bg-success';
                                        if(isset($product->stock)) {
                                            if($product->stock == 0) {
                                                $status = 'Out of Stock';
                                                $statusClass = 'bg-danger';
                                            } elseif($product->stock < 10) {
                                                $status = 'Low Stock';
                                                $statusClass = 'bg-warning';
                                            }
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }} status-badge">{{ $status }}</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.health_beauty.edit', $product)}}" class="btn btn-sm btn-outline-primary action-btn me-2" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $product->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($health_beauty_products->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">Showing {{ $health_beauty_products->firstItem() }} to {{ $health_beauty_products->lastItem() }} of {{ $health_beauty_products->total() }} results</div>
                        <nav aria-label="Page navigation">
                            {{ $health_beauty_products->links() }}
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modals -->
@foreach ($health_beauty_products as $product)
<div class="modal fade" id="deleteModal-{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-exclamation-circle text-danger" style="font-size: 3rem;"></i>
                <h4 class="mt-3">Are you sure?</h4>
                <p class="mt-3">
                    You are about to delete <span class="fw-bold">"{{ $product->name }}"</span>. This action cannot be undone.
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.destroy_product', $product->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script>
    // Basic search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const rows = document.querySelectorAll('#productsTable tbody tr');
        
        rows.forEach(row => {
            const productName = row.querySelector('td:first-child .fw-bold').textContent.toLowerCase();
            if (productName.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Category filter functionality
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.textContent.trim();
            const rows = document.querySelectorAll('#productsTable tbody tr');
            
            rows.forEach(row => {
                const rowCategory = row.querySelector('td:nth-child(2) .category-badge').textContent.trim();
                if (category === 'All Products' || rowCategory === category) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush