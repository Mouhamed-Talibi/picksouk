@extends('layout.admin')

@section('title')
    {{ $user->name }} - User Details
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
    }
    
    .user-details-container {
        padding: 20px;
    }
    
    .user-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 10px;
        color: white;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .user-header::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .user-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(0, 0, 0, 0.1);
    }
    
    .avatar-placeholder {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        font-weight: bold;
        border: 4px solid white;
    }
    
    .stats-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        transition: transform 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
    }
    
    .stats-icon {
        font-size: 2rem;
        opacity: 0.7;
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
    
    .order-status-completed {
        background-color: var(--success-color);
        color: white;
    }
    
    .order-status-pending {
        background-color: var(--warning-color);
        color: white;
    }
    
    .order-status-cancelled {
        background-color: var(--danger-color);
        color: white;
    }
    
    .order-status-processing {
        background-color: var(--info-color);
        color: white;
    }
    
    .product-img {
        width: 50px;
        height: 50px;
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
    
    .info-item {
        padding: 0.5rem 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #5a5c69;
        min-width: 120px;
    }
    
    .activity-timeline {
        position: relative;
        padding-left: 2rem;
    }
    
    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e3e6f0;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -2rem;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: var(--primary-color);
        border: 2px solid white;
        box-shadow: 0 0 0 3px var(--primary-color);
    }
    
    .timeline-date {
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    @media (max-width: 768px) {
        .user-header {
            text-align: center;
            padding: 1.5rem;
        }
        
        .user-avatar, .avatar-placeholder {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }
        
        .stats-card {
            margin-bottom: 1rem;
        }
        
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .info-item {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .info-label {
            margin-bottom: 0.5rem;
        }
    }
    
    @media (max-width: 576px) {
        .user-details-container {
            padding: 15px;
        }
        
        .table th, .table td {
            padding: 0.5rem 0.7rem;
        }
        
        .action-btn {
            width: 28px;
            height: 28px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid user-details-container">
    <!-- User Header -->
    <div class="user-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    @if($user->profile_photo)
                        <img src="{{ Storage::url($user->profile_photo) }}" class="user-avatar me-4" alt="{{ $user->name }}">
                    @else
                        <div class="avatar-placeholder me-4">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <h1 class="h2 mb-1">{{ $user->name }}</h1>
                        <p class="mb-1">Member since {{ $user->created_at->format('F j, Y') }}</p>
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-envelope me-1"></i> {{ $user->email }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="#" class="btn btn-outline-light">
                    <i class="fas fa-envelope me-1"></i> Message
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="row mb-4 justify-content-center">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user->orders->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart stats-icon text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-left-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Spent</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format($user->orders->sum('total_amount'), 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign stats-icon text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-left-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Last Order</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                @if($user->orders->count() > 0)
                                    {{ $user->orders->sortByDesc('created_at')->first()->created_at->diffForHumans() }}
                                @else
                                    No orders yet
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar stats-icon text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Order History</h6>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="orderFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="orderFilterDropdown">
                    <li><a class="dropdown-item" href="#">All Orders</a></li>
                    <li><a class="dropdown-item" href="#">Completed</a></li>
                    <li><a class="dropdown-item" href="#">Pending</a></li>
                    <li><a class="dropdown-item" href="#">Cancelled</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            @if($user->orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="ordersTable">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('M j, Y') }}</td>
                                    <td>${{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        @php
                                            $statusClass = 'order-status-pending';
                                            if($order->status === 'completed') {
                                                $statusClass = 'order-status-completed';
                                            } elseif($order->status === 'cancelled') {
                                                $statusClass = 'order-status-cancelled';
                                            } elseif($order->status === 'processing') {
                                                $statusClass = 'order-status-processing';
                                            }
                                        @endphp
                                        <span class="badge {{ $statusClass }} status-badge">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary action-btn" title="View Order">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <h5>No Orders Found</h5>
                    <p class="text-muted">This user hasn't placed any orders yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Order filter functionality
        document.querySelectorAll('#orderFilterDropdown + .dropdown-menu .dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const filterType = this.textContent.trim();
                const rows = document.querySelectorAll('#ordersTable tbody tr');
                
                rows.forEach(row => {
                    const status = row.querySelector('td:nth-child(5) .badge').textContent.trim();
                    
                    if (filterType === 'All Orders' || status.toLowerCase() === filterType.toLowerCase()) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush