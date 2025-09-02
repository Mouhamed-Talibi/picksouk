@extends('layout.admin')

@section('title')
    Categories Management
@endsection

@push('styles')
<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #6f42c1;
        --success-color: #1cc88a;
        --danger-color: #e74a3b;
        --warning-color: #f6c23e;
        --info-color: #36b9cc;
        --light-bg: #f8f9fc;
        --deep-black: #2e2e2e;
    }
    
    .categories-container {
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
        color: var(--deep-black);
        border-radius: 10px 10px 0 0 !important;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: #3a5fc8;
        border-color: #3a5fc8;
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
    
    .category-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .category-icon {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    .products-count {
        font-weight: 600;
        color: var(--primary-color);
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
    
    .status-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 0.5rem;
    }
    
    .status-active {
        background-color: var(--success-color);
    }
    
    .status-inactive {
        background-color: var(--danger-color);
    }
    
    .empty-state {
        padding: 3rem;
        text-align: center;
        background: #fff;
        border-radius: 10px;
    }
    
    .empty-state i {
        font-size: 5rem;
        color: #ddd;
        margin-bottom: 1.5rem;
    }
    
    .trashed-table {
        opacity: 0.8;
    }
    
    .trashed-table tr {
        transition: opacity 0.3s ease;
    }
    
    .trashed-table tr:hover {
        opacity: 1;
    }
    
    .badge-trash {
        background-color: #6c757d;
        color: white;
    }
    
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .category-img, .category-icon {
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
        
        .action-text {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid categories-container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-tags me-2"></i>Categories Management
        </h1>
        <a href="{{ route('admin.add_category') }}" class="btn btn-primary d-inline-flex align-items-center">
            <i class="fas fa-plus btn-icon me-2"></i>
            <span class="btn-text">Add New Category</span>
        </a>
    </div>

    <!-- Main Categories Card -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
            <div class="header-actions d-flex align-items-center">
                <div class="search-box me-3">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search categories..." id="searchInput">
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item" href="#">All Categories</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="categoriesTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Products</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>
                                @if($category->image)
                                    <img src="{{ Storage::url($category->image) }}" 
                                        alt="{{ $category->name }}"
                                        class="category-img">
                                @else
                                    <div class="category-icon">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ $category->name }}</div>
                                <small class="text-muted">Slug: {{ $category->slug }}</small>
                            </td>
                            <td>
                                <div class="text-muted">{{ Str::limit($category->description, 60) }}</div>
                            </td>
                            <td>
                                <span class="products-count">{{ $category->products->count() ?? 0 }}</span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.edit_category', $category->id) }}" 
                                        class="btn btn-sm btn-outline-primary action-btn me-2"
                                        title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger action-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $category->id }}"
                                        title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-tags"></i>
                                    <h3 class="h5 mb-3">No Categories Found</h3>
                                    <p class="mb-4">Start by adding your first category to organize products</p>
                                    <a href="{{ route('admin.add_category') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Add Category
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($categories->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} categories</div>
                    <nav aria-label="Page navigation">
                        {{ $categories->links() }}
                    </nav>
                </div>
            @endif
        </div>
    </div>

    <!-- Trashed Categories Card -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-trash-alt me-2"></i>Trashed Categories
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover trashed-table" id="trashedTable">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Products</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trashedCategories as $category)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $category->name }}</div>
                                <small class="text-muted">Slug: {{ $category->slug }}</small>
                            </td>
                            <td>
                                <div class="text-muted">{{ Str::limit($category->description, 40) }}</div>
                            </td>
                            <td>
                                <span class="badge badge-trash">{{ $category->products_count ?? 0 }}</span>
                            </td>
                            <td>
                                {{ $category->deleted_at->format('M d, Y h:i A') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.restore_category', $category->id)}}" 
                                    class="btn btn-sm btn-outline-success me-2"
                                    title="Restore">
                                    <i class="fas fa-trash-restore me-1"></i>
                                    <span class="action-text">Restore</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-trash-alt"></i>
                                    <h3 class="h5 mb-3">No Trashed Categories</h3>
                                    <p class="mb-4">Deleted categories will appear here</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modals -->
@foreach ($categories as $category)
<div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                @if($category->image)
                    <img src="{{ Storage::url($category->image) }}" 
                            alt="{{ $category->name }}"
                            class="category-img mb-3" style="width: 80px; height: 80px;">
                @else
                    <div class="category-icon mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-tag"></i>
                    </div>
                @endif
                <h4 class="mt-3">Delete {{ $category->name }}?</h4>
                <p class="mt-3">
                    Are you sure you want to delete this category? This action will move it to trash.
                </p>
                @if(($category->products->count() ?? 0) > 0)
                <div class="alert alert-warning mt-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This category contains {{ $category->products->count() }} products. These products will be uncategorized.
                </div>
                @endif
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.destroy_category', $category) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete Category
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
    // Enable Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchText = this.value.toLowerCase();
                const rows = document.querySelectorAll('#categoriesTable tbody tr');
                
                rows.forEach(row => {
                    const categoryName = row.querySelector('td:nth-child(2) .fw-bold').textContent.toLowerCase();
                    const categorySlug = row.querySelector('td:nth-child(2) .text-muted').textContent.toLowerCase();
                    
                    if (categoryName.includes(searchText) || categorySlug.includes(searchText)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
        
        // Filter functionality
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const filterType = this.textContent.trim();
                const rows = document.querySelectorAll('#categoriesTable tbody tr');
                
                rows.forEach(row => {
                    const productCount = parseInt(row.querySelector('td:nth-child(4) .products-count').textContent);
                    const status = row.querySelector('td:nth-child(5)').textContent.trim();
                    
                    if (filterType === 'All Categories') {
                        row.style.display = '';
                    } else if (filterType === 'With Products' && productCount > 0) {
                        row.style.display = '';
                    } else if (filterType === 'Without Products' && productCount === 0) {
                        row.style.display = '';
                    } else if (filterType === 'Active' && status.includes('Active')) {
                        row.style.display = '';
                    } else if (filterType === 'Inactive' && status.includes('Inactive')) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush