@extends('layout.admin')

@section('title')
    Testimonials Management
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
    
    .users-container {
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
    
    .status-badge {
        padding: 0.35rem 0.65rem;
        border-radius: 0.35rem;
        font-weight: 600;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        background-color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1rem;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    .view-btn {
        color: var(--primary-color);
        text-decoration: none;
        display: inline-flex;
        border: none;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .view-btn:hover {
        color: #3a5fc8;
        transform: translateY(-2px);
    }
    
    .role-badge {
        padding: 0.35rem 0.65rem;
        border-radius: 0.35rem;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-admin {
        background-color: var(--primary-color);
        color: white;
    }
    
    .badge-user {
        background-color: var(--success-color);
        color: white;
    }
    
    .badge-moderator {
        background-color: var(--info-color);
        color: white;
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
    
    .user-status {
        display: inline-flex;
        align-items: center;
    }
    
    .status-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 0.5rem;
    }
    
    .status-active {
        background-color: var(--success-color);
    }
    
    .status-inactive {
        background-color: var(--danger-color);
    }
    
    .status-pending {
        background-color: var(--warning-color);
    }
    
    .pagination-info {
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    .comment-full {
        white-space: normal;
        word-wrap: break-word;
    }
    
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            font-size: 0.875rem;
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
        
        .btn-text {
            display: none;
        }
        
        .btn-icon {
            margin-right: 0 !important;
        }
        
        .testimonial-comment {
            max-width: 150px;
        }
    }
    
    @media (max-width: 576px) {
        .table th, .table td {
            padding: 0.5rem 0.7rem;
        }
        
        .role-badge, .status-badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid users-container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Testimonials Management</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">Testimonials List</h6>
            <div class="header-actions d-flex align-items-center">
                <div class="search-box me-3">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search testimonials..." id="searchInput">
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item filter-option" href="#" data-status="all">All Testimonials</a></li>
                        <li><a class="dropdown-item filter-option" href="#" data-status="pending">Pending</a></li>
                        <li><a class="dropdown-item filter-option" href="#" data-status="accepted">Accepted</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item filter-option" href="#" data-status="rejected">Rejected</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="testimonialsTable">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonials as $testimonial)
                            <tr data-status="{{ $testimonial->status ?? 'pending' }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">
                                            {{ substr($testimonial->full_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $testimonial->full_name }}</div>
                                            <small class="text-muted">ID: {{ $testimonial->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $testimonial->email }}</td>
                                <td>
                                    <div class="testimonial-comment" title="{{ $testimonial->comment }}">
                                        {{ $testimonial->comment }}
                                    </div>
                                </td>
                                <td>{{ $testimonial->created_at->format('M d, Y') }}</td>
                                <td>
                                    @if(isset($testimonial->status))
                                        @if($testimonial->status === 'accepted')
                                            <span class="badge bg-success">Accepted</span>
                                        @elseif($testimonial->status === 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @if ($testimonial->status === 'accepted')
                                            <span class="text-success me-3" title="Already Accepted">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        @endif
                                        @if ($testimonial->status === 'pending')
                                            <button class="view-btn me-3" title="Accept Testimonial" data-bs-toggle="modal" data-bs-target="#acceptModal-{{ $testimonial->id }}">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        @endif
                                        <a href="{{ route('admin.testimonials.delete', $testimonial)}}" class="text-danger action-btn" title="Reject Testimonial" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $testimonial->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($testimonials->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="pagination-info">
                        Showing {{ $testimonials->firstItem() }} to {{ $testimonials->lastItem() }} of {{ $testimonials->total() }} testimonials
                    </div>
                    <nav aria-label="Page navigation">
                        {{ $testimonials->links() }}
                    </nav>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Accept Testimonial Modals -->
@foreach ($testimonials as $testimonial)
<div class="modal fade" id="acceptModal-{{ $testimonial->id }}" tabindex="-1" aria-labelledby="acceptModalLabel-{{ $testimonial->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acceptModalLabel-{{ $testimonial->id }}">Accept Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="user-avatar mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                    {{ substr($testimonial->full_name, 0, 1) }}
                </div>
                <h4 class="mt-3">Accept testimonial from {{ $testimonial->full_name }}?</h4>
                <div class="comment-full bg-light p-3 mt-3 rounded">
                    <strong>Comment:</strong>
                    <p class="mt-2 mb-0">{{ $testimonial->comment }}</p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.testimonials.accept', $testimonial) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i> Accept Testimonial
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Delete Confirmation Modals -->
@foreach ($testimonials as $testimonial)
<div class="modal fade" id="deleteModal-{{ $testimonial->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $testimonial->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $testimonial->id }}">Confirm Testimonial Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="user-avatar mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                    {{ substr($testimonial->full_name, 0, 1) }}
                </div>
                <h4 class="mt-3">Delete testimonial from {{ $testimonial->full_name }}?</h4>
                <p class="mt-3">
                    Are you sure you want to delete this testimonial? This action cannot be undone.
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.testimonials.delete', $testimonial)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete Testimonial
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
        const rows = document.querySelectorAll('#testimonialsTable tbody tr');
        
        rows.forEach(row => {
            const userName = row.querySelector('td:first-child .fw-bold').textContent.toLowerCase();
            const userEmail = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const comment = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            
            if (userName.includes(searchText) || userEmail.includes(searchText) || comment.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Status filter functionality
    document.querySelectorAll('.filter-option').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const filterStatus = this.getAttribute('data-status');
            const rows = document.querySelectorAll('#testimonialsTable tbody tr');
            
            rows.forEach(row => {
                const testimonialStatus = row.getAttribute('data-status');
                
                if (filterStatus === 'all' || testimonialStatus === filterStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush