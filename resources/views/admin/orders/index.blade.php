@extends('layout.admin')

@section('title')
    Orders Management
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orders Management</h1>
    </div>

    @if ($orders->isEmpty())
        <div class="card empty-state">
            <div class="card-body">
                <i class="fas fa-tshirt"></i>
                <h3 class="h5 mb-3">No Orders Found</h3>
                <p class="mb-4">There are no orders in the system yet.</p>
            </div>
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">Orders List</h6>
                <div class="header-actions d-flex align-items-center">
                    <!-- Status Filter Buttons -->
                    <div class="btn-group me-3" role="group" aria-label="Order status filter">
                        <button type="button" class="btn btn-sm btn-outline-primary filter-option active" data-filter="all">
                            <i class="fas fa-list me-1"></i> All
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-warning filter-option" data-filter="processing">
                            <i class="fas fa-cog me-1"></i> Processing
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-success filter-option" data-filter="delivered">
                            <i class="fas fa-truck me-1"></i> Delivered
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger filter-option" data-filter="cancelled">
                            <i class="fas fa-times-circle me-1"></i> Cancelled
                        </button>
                    </div>
                    
                    <!-- Search Box -->
                    <div class="search-box me-3">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search orders..." id="searchInput">
                    </div>
                    
                    <!-- Quick Actions Dropdown -->
                    <div class="dropdown quick-actions-dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="quickActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bolt me-1"></i> Quick Actions
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="quickActionsDropdown">
                            <li>
                                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteCancelledModal">
                                    <i class="fas fa-trash me-2"></i> Delete Cancelled Orders
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="ordersTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Client</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr data-status="{{ strtolower($order->status) }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($order->product && $order->product->images->isNotEmpty())
                                            <img src="{{ Storage::url($order->product->images->first()->path) }}" 
                                                    class="product-img me-3" 
                                                    alt="{{ $order->product->name }}">
                                        @else
                                            <div class="product-img-placeholder me-3">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $order->product->name ?? 'Unknown Product' }}</div>
                                            <small class="text-muted">Order #{{ $order->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->product->category->name ?? 'Uncategorized' }}</td>
                                <td>{{ $order->client_name ?? 'Unknown' }}</td>
                                <td>${{ number_format($order->product->price ?? 0, 2) }}</td>
                                <td>{{ $order->quantity ?? 1 }}</td>
                                <td>
                                    @php
                                        $status = ucfirst($order->status);
                                        if($order->status === "processing") {
                                            $statusClass = 'bg-warning';
                                        } elseif($order->status === "delivered") {
                                            $statusClass = 'bg-success';
                                        } elseif($order->status === "cancelled") {
                                            $statusClass = 'bg-danger';
                                        } else {
                                            $statusClass = 'bg-info';
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }} status-badge">{{ $status }}</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                                        <button type="button" class="btn btn-sm btn-outline-success action-btn me-1" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deliverModal-{{ $order->id }}" 
                                                title="Mark as Delivered">
                                            <i class="fas fa-truck"></i>
                                        </button>
                                        @endif
                                        
                                        <button type="button" class="btn btn-sm btn-outline-danger action-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal-{{ $order->id }}" 
                                                title="Delete">
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
                @if($orders->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} results
                        </div>
                        <nav aria-label="Page navigation">
                            {{ $orders->links() }}
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>

<!-- Delete Cancelled Orders Modal -->
<div class="modal fade" id="deleteCancelledModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
        <div class="text-center p-4">
            <h2>Confirm Deleting Cancelled Orders</h2>
            <hr class="w-50 mx-auto">
        </div>

        <div class="text-center mt-3 p-3">
            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
            <p class="mt-3">
                You are about to delete all orders with the status "cancelled". This action cannot be undone.
            </p>
            <div class="alert alert-info mt-3">
                <i class="fas fa-info-circle me-2"></i>
                Please confirm that you want to proceed with this action.
            </div>
        </div>

        <div class="text-center mt-3 mb-4 p-3">
            <div class="d-flex justify-content-center">
                <!-- Cancel button -->
                <button type="button" 
                        class="text-success border-0 me-3 fw-bold" 
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <!-- Confirm button -->
                <form action="{{ route('admin.orders.delete_cancelled')}}" 
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-danger btn-sm px-4 py-2">
                        <i class="fas fa-trash me-1"></i> Confirm Deletion
                    </button>
                </form>
            </div>
        </div>

        </div>
    </div>
</div>

<!-- Delete Confirmation Modals -->
@foreach ($orders as $order)
<div class="modal fade" id="deleteModal-{{ $order->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                    You are about to delete order #{{ $order->id }}. This action cannot be undone.
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
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

<!-- Deliver Confirmation Modals -->
@foreach ($orders as $order)
@if($order->status !== 'delivered' && $order->status !== 'cancelled')
<div class="modal fade" id="deliverModal-{{ $order->id }}" tabindex="-1" aria-labelledby="deliverModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deliverModalLabel">Confirm Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-truck text-success" style="font-size: 3rem;"></i>
                <h4 class="mt-3">Mark Order as Delivered?</h4>
                <p class="mt-3">
                    Are you sure you want to mark order #{{ $order->id }} as delivered?
                </p>
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    This action will update the order status to "delivered".
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="delivered">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i> Confirm Delivery
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('#ordersTable tbody tr');
        const filterOptions = document.querySelectorAll('.filter-option');
        const noResultsMessage = document.createElement('div');
        
        // Create a no results message element
        noResultsMessage.className = 'alert alert-info text-center mt-3';
        noResultsMessage.style.display = 'none';
        noResultsMessage.innerHTML = '<i class="fas fa-search me-2"></i> No orders found matching your criteria';
        document.querySelector('.table-responsive').appendChild(noResultsMessage);
        
        let currentFilter = 'all';
        
        // Enhanced search functionality
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchText = this.value.toLowerCase().trim();
                filterRows(searchText, currentFilter);
            });
        }
        
        // Filter functionality
        filterOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const filter = this.getAttribute('data-filter');
                currentFilter = filter;
                
                // Remove active class from all options
                filterOptions.forEach(opt => opt.classList.remove('active'));
                
                // Add active class to clicked option
                this.classList.add('active');
                
                const searchText = searchInput ? searchInput.value.toLowerCase().trim() : '';
                filterRows(searchText, filter);
            });
        });
        
        // Function to filter rows based on search text and filter
        function filterRows(searchText, filter) {
            let hasVisibleRows = false;
            
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                
                // Check if row matches filter criteria
                const matchesFilter = filter === 'all' || status === filter;
                
                // Check if row matches search criteria
                let matchesSearch = true;
                if (searchText !== '') {
                    const productName = row.querySelector('td:first-child .fw-bold').textContent.toLowerCase();
                    const category = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const client = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    const price = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                    const quantity = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                    const statusText = row.querySelector('.status-badge').textContent.toLowerCase();
                    
                    matchesSearch = productName.includes(searchText) || 
                                    category.includes(searchText) || 
                                    client.includes(searchText) || 
                                    price.includes(searchText) || 
                                    quantity.includes(searchText) || 
                                    statusText.includes(searchText);
                }
                
                if (matchesFilter && matchesSearch) {
                    row.style.display = '';
                    hasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Show/hide no results message
            noResultsMessage.style.display = hasVisibleRows ? 'none' : 'block';
        }
        
        // Initialize with 'all' filter active
        document.querySelector('.filter-option[data-filter="all"]').classList.add('active');
    });
</script>
@endpush

<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #6f42c1;
        --success-color: #1cc88a;
        --danger-color: #e74a3b;
        --warning-color: #f6c23e;
        --info-color: #36b9cc;
        --light-bg: #f8f9fc;
    }

    .product-img-placeholder {
        width: 60px;
        height: 60px;
        background-color: #f8f9fc;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #b7b9cc;
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
    #productsTable tbody tr {
        display: table-row;
    }

    /* Enhanced Card Header Styles */
    .card-header {
        background: linear-gradient(135deg, #f8f9fc 0%, #fff 100%);
        border-bottom: 1px solid #e3e6f0;
        padding: 1rem 1.35rem;
    }
    
    /* Button Group Enhancement */
    .btn-group .btn-sm {
        padding: 0.35rem 0.75rem;
        font-size: 0.85rem;
        border-radius: 0.35rem;
        margin-right: 0.25rem;
    }
    
    .btn-group .btn-sm:last-child {
        margin-right: 0;
    }
    
    /* Search Box Enhancement */
    .search-box {
        position: relative;
        min-width: 250px;
    }
    
    .search-box input {
        padding-left: 2.5rem;
        border-radius: 20px;
        height: 38px;
        font-size: 0.9rem;
    }
    
    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #b7b9cc;
        font-size: 0.9rem;
    }
    
    /* Quick Actions Dropdown */
    .quick-actions-dropdown .btn {
        height: 38px;
        padding: 0.35rem 0.75rem;
        font-size: 0.85rem;
        border-radius: 0.35rem;
    }
    
    .dropdown-menu {
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: 1px solid #e3e6f0;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fc;
    }
    
    .dropdown-item.text-danger:hover {
        background-color: #f8d7da;
    }
    
    /* Active Filter State */
    .filter-option.active {
        background-color: #4e73df;
        color: white !important;
        border-color: #4e73df;
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .header-actions {
            margin-top: 1rem;
            width: 100%;
            flex-wrap: wrap;
        }
        
        .btn-group {
            margin-bottom: 0.5rem;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }
        
        .btn-group .btn-sm {
            margin-bottom: 0.25rem;
            flex: 1;
            min-width: 80px;
        }
        
        .search-box {
            min-width: auto;
            flex: 2;
            margin-right: 0.5rem !important;
            margin-bottom: 0.5rem;
        }
        
        .quick-actions-dropdown {
            flex: 1;
            min-width: 140px;
        }
    }
    
    @media (max-width: 576px) {
        .header-actions {
            flex-direction: column;
        }
        
        .search-box {
            width: 100%;
            margin-right: 0 !important;
            margin-bottom: 0.5rem;
        }
        
        .quick-actions-dropdown {
            width: 100%;
        }
        
        .quick-actions-dropdown .btn {
            width: 100%;
        }
    }
</style>