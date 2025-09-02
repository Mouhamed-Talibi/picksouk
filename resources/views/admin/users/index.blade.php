@extends('layout.admin')

@section('title')
    Users Management
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
        <h1 class="h3 mb-0 text-gray-800">Users Management</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
            <div class="header-actions d-flex align-items-center">
                <div class="search-box me-3">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search users..." id="searchInput">
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item" href="#">All Users</a></li>
                        <li><a class="dropdown-item" href="#">Active</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Admins</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="usersTable">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joined At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $user->name }}</div>
                                            <small class="text-muted">ID: {{ $user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @php
                                        $role = 'user';
                                        $roleClass = 'badge-user';
                                        if($user->is_admin) {
                                            $role = 'Admin';
                                            $roleClass = 'badge-admin';
                                        } elseif($user->is_moderator) {
                                            $role = 'Moderator';
                                            $roleClass = 'badge-moderator';
                                        }
                                    @endphp
                                    <span class="role-badge {{ $roleClass }}">{{ $role }}</span>
                                </td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.users.user', $user)}}" class="view-btn me-3" title="View User">
                                            <i class="fas fa-eye me-1"></i>
                                            <span class="d-none d-md-inline">View</span>
                                        </a>
                                        <a href="{{ route('admin.users.delete', $user)}}" class="text-danger action-btn" title="Delete User" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $user->id }}">
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
            @if($users->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="pagination-info">
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
                    </div>
                    <nav aria-label="Page navigation">
                        {{ $users->links() }}
                    </nav>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modals -->
@foreach ($users as $user)
<div class="modal fade" id="deleteModal-{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm User Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="user-avatar mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <h4 class="mt-3">Delete {{ $user->name }}?</h4>
                <p class="mt-3">
                    Are you sure you want to delete this user account? This action cannot be undone and will permanently remove all user data.
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.users.delete', $user->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete User
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
        const rows = document.querySelectorAll('#usersTable tbody tr');
        
        rows.forEach(row => {
            const userName = row.querySelector('td:first-child .fw-bold').textContent.toLowerCase();
            const userEmail = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            
            if (userName.includes(searchText) || userEmail.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Role filter functionality
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const filterType = this.textContent.trim();
            const rows = document.querySelectorAll('#usersTable tbody tr');
            
            rows.forEach(row => {
                const userRole = row.querySelector('td:nth-child(3) .role-badge').textContent.trim();
                const userStatus = row.querySelector('td:nth-child(4)').textContent.trim();
                
                if (filterType === 'All Users' || 
                    userRole === filterType || 
                    userStatus === filterType) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush