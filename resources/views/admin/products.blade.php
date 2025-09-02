@extends('layout.admin')

@section('title')
    Products Management
@endsection

@section('content')
    <div class="container-fluid py-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 fw-bold mb-0" style="color: var(--deep-black);">
                <i class="fa-solid fa-boxes-stacked me-2"></i>Products Management
            </h1>
            <a href="{{ route('admin.add_products') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>Add New Product
            </a>
        </div>

        <!-- Main Products Table -->
        <div class="card shadow-sm mb-5">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 80px;">Image</th>
                                <th scope="col">Product</th>
                                <th scope="col">Category</th>
                                <th scope="col" class="text-end">Price</th>
                                <th scope="col" class="text-center">Stock</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td>
                                    @if($product->images)
                                        <img src="{{ Storage::url($product->images->get(2)->path) }}" 
                                            alt="{{ $product->name }}"
                                            class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light" 
                                            style="width: 60px; height: 60px;">
                                            <i class="fa-solid fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $product->name }}</div>
                                    <div class="small text-muted">{{ Str::limit($product->description, 50) }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                </td>
                                <td class="text-end fw-semibold">
                                    {{ number_format($product->price, 2) }} Mad
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $product->stock > 10 ? 'bg-success' : 'bg-warning' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('admin.edit_product', $product->id) }}" 
                                            class="btn btn-sm btn-outline-primary"
                                            title="Edit" data-bs-toggle="tooltip">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $product->id }}"
                                            title="Delete" data-bs-toggle="tooltip">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete <strong>{{ $product->name }}</strong>? This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.destroy_product', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                                        <h5 class="fw-semibold">No Products Found</h5>
                                        <p class="text-muted">Start by adding your first product</p>
                                        <a href="{{ route('admin.add_product') }}" class="btn btn-primary mt-2">
                                            <i class="fa-solid fa-plus me-2"></i>Add Product
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination -->
            @if($products->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Trashed Products Section -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fa-solid fa-trash-can me-2"></i>Trashed Products
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Deleted At</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trashedProducts as $product)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $product->name }}</div>
                                    <div class="small text-muted">{{ Str::limit($product->description, 50) }}</div>
                                </td>
                                <td>
                                    {{ $product->deleted_at->format('M d, Y h:i A') }}
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.restore_product', $product->id)}}" 
                                        class="btn btn-sm btn-outline-success"
                                        title="Restore" data-bs-toggle="tooltip">
                                        <i class="fa-solid fa-trash-can-arrow-up me-1"></i>Restore
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fa-solid fa-trash-can fa-3x text-muted mb-3"></i>
                                        <h5 class="fw-semibold">No Trashed Products</h5>
                                        <p class="text-muted">Deleted products will appear here</p>
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
@endsection

@section('scripts')
<script>
    // Enable Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection