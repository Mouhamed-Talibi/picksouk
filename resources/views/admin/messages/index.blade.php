@extends('layout.admin')

@section('title')
    Messages
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Messages</h1>
    </div>

    @if ($messages->isEmpty())
        <div class="card empty-state">
            <div class="card-body">
                <i class="fas fa-envelope-open-text"></i>
                <h3 class="h5 mb-3">No Messages Found</h3>
            </div>
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="m-0 font-weight-bold text-primary">Messages</h6>
                <div class="header-actions d-flex align-items-center">
                    <div class="search-box me-3">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search Messages..." id="searchInput">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="MessagesTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->message }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($messages->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} results
                        </div>
                        <nav aria-label="Page navigation">
                            {{ $messages->links() }}
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
        const rows = document.querySelectorAll('#MessagesTable tbody tr');
        const noResultsMessage = document.createElement('div');

        // Create a "no results" message
        noResultsMessage.className = 'alert alert-info text-center mt-3';
        noResultsMessage.style.display = 'none';
        noResultsMessage.innerHTML = '<i class="fas fa-search me-2"></i> No messages found matching your search';
        document.querySelector('.table-responsive').appendChild(noResultsMessage);

        function applySearch() {
            const searchText = searchInput.value.toLowerCase().trim();
            let hasVisibleRows = false;

            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                if (rowText.includes(searchText)) {
                    row.style.display = '';
                    hasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            });

            noResultsMessage.style.display = hasVisibleRows ? 'none' : 'block';
        }

        if (searchInput) {
            searchInput.addEventListener('keyup', applySearch);
        }
    });
</script>
@endpush

<style>
    :root {
        --primary-color: #4e73df;
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
        .table th, .table td {
            padding: 0.5rem 0.7rem;
        }
    }
</style>
