@extends('layout.admin')

@section('title')
    Payments
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Payments</h1>
    </div>

    @if ($payments->isEmpty())
        <div class="card empty-state">
            <div class="card-body">
                <i class="fas fa-receipt"></i>
                <h3 class="h5 mb-3">No Payments Found</h3>
            </div>
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">Payments</h6>
                <div class="header-actions d-flex align-items-center">
                    <div class="search-box me-3">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search payments..." id="searchInput">
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item filter-option" href="#" data-filter="all">All</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="completed">Completed</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="pending">Pending</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="failed">Failed</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="paymentsTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Client</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $item)
                            <tr data-status="{{ $item->payment_status ?? 'pending' }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if(isset($item->product) && $item->product->images && $item->product->images->isNotEmpty())
                                            <img src="{{ Storage::url($item->product->images->first()->path) }}" class="product-img me-3" alt="{{ $item->product->name }}">
                                        @else
                                            <img src="/path/to/default-image.jpg" class="product-img me-3" alt="No image available">
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $item->product->name ?? 'N/A' }}</div>
                                            <small class="text-muted">ID: {{ $item->product_id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->client_name }}</td>
                                <td>{{ $item->order_price }} dh</td>
                                <td>{{ $item->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="" class="btn btn-sm btn-outline-primary action-btn me-2" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $item->id }}" title="Delete">
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
                @if($payments->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">Showing {{ $payments->firstItem() }} to {{ $payments->lastItem() }} of {{ $payments->total() }} results</div>
                        <nav aria-label="Page navigation">
                            {{ $payments->links() }}
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('#paymentsTable tbody tr');
        const filterOptions = document.querySelectorAll('.filter-option');
        const noResultsMessage = document.createElement('div');
        
        // Create a no results message element
        noResultsMessage.className = 'alert alert-info text-center mt-3';
        noResultsMessage.style.display = 'none';
        noResultsMessage.innerHTML = '<i class="fas fa-search me-2"></i> No payments found matching your search criteria';
        document.querySelector('.table-responsive').appendChild(noResultsMessage);
        
        let currentFilter = 'all';
        
        function applyFilters() {
            const searchText = searchInput.value.toLowerCase().trim();
            let hasVisibleRows = false;

            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                const productName = row.querySelector('td:first-child .fw-bold').textContent.toLowerCase();
                const clientName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const amount = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const statusText = row.querySelector('.badge').textContent.toLowerCase();
                const date = row.querySelector('td:nth-child(5)').textContent.toLowerCase();

                const matchesFilter = currentFilter === 'all' || status === currentFilter;
                const matchesSearch = searchText === '' || 
                    productName.includes(searchText) || 
                    clientName.includes(searchText) || 
                    amount.includes(searchText) || 
                    statusText.includes(searchText) || 
                    date.includes(searchText);

                if (matchesFilter && matchesSearch) {
                    row.style.display = '';
                    hasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            });

            noResultsMessage.style.display = hasVisibleRows ? 'none' : 'block';
        }

        // Search input event
        if (searchInput) {
            searchInput.addEventListener('keyup', applyFilters);
        }

        // Filter buttons
        filterOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                currentFilter = this.getAttribute('data-filter');

                filterOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');

                applyFilters();
            });
        });

        // Initialize with all filter
        document.querySelector('.filter-option[data-filter="all"]').classList.add('active');
    });
</script>
@endpush


<style>
    /* Your existing CSS remains the same */
    :root {
        --primary-color: #4e73df;
        --secondary-color: #6f42c1;
        --success-color: #1cc88a;
        --danger-color: #e74a3b;
        --warning-color: #f6c23e;
        --info-color: #36b9cc;
        --light-bg: #f8f9fc;
    }
    
    body {
        background-color: var(--light-bg);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: #3a5fc8;
        border-color: #3a5fc8;
    }
    
    .btn-success {
        background-color: var(--success-color);
        border-color: var(--success-color);
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
    
    .badge {
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

    /* Add active state for filter options */
    .filter-option.active {
        background-color: #4e73df;
        color: white;
    }
    
    /* Ensure consistent row display */
    #paymentsTable tbody tr {
        display: table-row;
    }
</style>