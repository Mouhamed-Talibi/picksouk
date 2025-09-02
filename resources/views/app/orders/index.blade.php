@extends('layout.app')

@section('title')
    طلباتي
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            
            <!-- Page Header -->
            <div class="text-center mb-3">
                <i class="fas fa-cog fa-spin text-info fs-1 mb-3"></i>
                <h1 class="display-2 fw-bold">طلباتي</h1>
                <hr class="w-25 mx-auto">
            </div>

            <!-- Table view for large screens -->
            <div class="col-12 d-none d-lg-block">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>اسم الزبون</th>
                            <th>اسم المنتوج</th>
                            <th>العنوان</th>
                            <th>رقم الهاتف</th>
                            <th>المدينة</th>
                            <th>الكمية</th>
                            <th>الثمن الاجمالي</th>
                            <th>حالة الطلب</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($userOrders as $order)
                            <tr>
                                <td>{{ $order->client_name }}</td>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->client_address }}</td>
                                <td>{{ $order->client_phone }}</td>
                                <td>{{ $order->city }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total_price }} درهم</td>
                                <td>
                                    @if ($order->status === 'processing')
                                        <span class="badge bg-info">قيد المعالجة</span>
                                    @elseif ($order->status === 'delivered')
                                        <span class="badge bg-success">تم التوصيل</span>
                                    @elseif ($order->status === 'cancelled')
                                        <span class="badge bg-danger">تم الإلغاء</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Trigger Modal -->
                                    <button class="btn text-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#cancelModal{{ $order->id }}">
                                        <i class="fa-solid fa-ban"></i> الغاء الطلب
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted fw-bold">
                                    لا توجد لديك أي طلبات حالياً
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Cards view for small/medium screens -->
            <div class="col-12 d-lg-none">
                <div class="row g-3">
                    @forelse ($userOrders as $order)
                        <div class="col-12">
                            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                                
                                <!-- Card Header -->
                                <div class="card-header bg-gradient-primary text-white py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 fw-bold">
                                            <i class="bi bi-person-badge-fill me-2"></i>
                                        </h5>
                                        <span class="badge bg-white text-primary rounded-pill fs-6">
                                            <i class="bi bi-receipt me-1"></i> #{{ $order->id }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Card Body -->
                                <div class="card-body">
                                    
                                    <!-- Product Info -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                            <i class="bi bi-phone fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-muted small">المنتج</h6>
                                            <p class="mb-0 fw-bold">{{ $order->product_name }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Address -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-circle bg-danger bg-opacity-10 text-danger me-3">
                                            <i class="bi bi-pin-map-fill fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-muted small">العنوان</h6>
                                            <p class="mb-0 fw-bold">{{ $order->client_address }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Contact & City -->
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-circle bg-success bg-opacity-10 text-success me-2">
                                                    <i class="bi bi-telephone-fill fs-5"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-muted small">الهاتف</h6>
                                                    <p class="mb-0 fw-bold">{{ $order->client_phone }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-circle bg-info bg-opacity-10 text-info me-2">
                                                    <i class="bi bi-building fs-5"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-muted small">المدينة</h6>
                                                    <p class="mb-0 fw-bold">{{ $order->city }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Quantity & Total -->
                                    <div class="row">
                                        <div class="col-4 mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-circle bg-warning bg-opacity-10 text-warning me-2">
                                                    <i class="bi bi-box-seam fs-5"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-muted small">الكمية</h6>
                                                    <p class="mb-0 fw-bold">{{ $order->quantity }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8 mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-circle bg-success bg-opacity-10 text-success me-2">
                                                    <i class="bi bi-currency-exchange fs-5"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-muted small">المجموع</h6>
                                                    <p class="mb-0 fw-bold">{{ $order->total_price }} درهم</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status + Cancel -->
                                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-circle bg-success bg-opacity-10 text-success me-2">
                                                <i class="bi bi-check-circle-fill fs-5"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-muted small">الحالة</h6>
                                                @if ($order->status === "processing")
                                                    <span class="badge bg-warning rounded-pill px-3 py-1">قيد المعالجة</span>
                                                @elseif ($order->status === "delivered")
                                                    <span class="badge bg-success rounded-pill px-3 py-1">تم التوصيل</span>
                                                @elseif ($order->status === "cancelled")
                                                    <span class="badge bg-danger rounded-pill px-3 py-1">تم الإلغاء</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Trigger Modal -->
                                        <button class="btn btn-sm btn-outline-danger rounded-pill" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#cancelModal{{ $order->id }}">
                                            <i class="fa-solid fa-ban"></i> الغاء الطلب
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty 
                        <div class="d-flex flex-column align-items-center justify-content-center border border-1 rounded-4 p-5 my-5 bg-light shadow-sm">
                            <i class="fa-solid fa-box-open fs-1 text-warning mb-3"></i>
                            <h3 class="fw-bold text-center text-dark mb-2">لا توجد لديك أي طلبات حالياً</h3>
                            <p class="text-center text-muted mb-0">يمكنك تصفح منتجاتنا وإضافة طلبك الأول الآن!</p>
                            <a href="" class="btn btn-outline-primary mt-3">تصفح الان</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Shared Modals (one per order) -->
            @foreach ($userOrders as $order)
                <div class="modal fade" id="cancelModal{{ $order->id }}" tabindex="-1" 
                    aria-labelledby="cancelModalLabel{{ $order->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 rounded-4 overflow-hidden">
                            
                            <!-- Modal Header -->
                            <div class="modal-header bg-light-danger border-0 py-4">
                                <div class="text-center w-100">
                                    <div class="icon-circle bg-danger bg-opacity-10 text-danger mx-auto mb-3">
                                        <i class="fa-solid fa-ban"></i>
                                    </div>
                                    <h3 class="modal-title text-danger fw-bold" id="cancelModalLabel{{ $order->id }}">
                                        تأكيد إلغاء الطلب
                                    </h3>
                                </div>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body py-4 text-center">
                                <p class="fs-5 mb-4">
                                    هل أنت متأكد من رغبتك في إلغاء هذا الطلب؟
                                    <br>
                                    <span class="text-muted small">هذا الإجراء لا يمكن التراجع عنه</span>
                                </p>
                                
                                <div class="d-flex gap-2 justify-content-end">
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">
                                        <i class="bi bi-arrow-return-left me-1"></i> تراجع
                                    </button>
                                    <form action="{{ route('app.orders.cancel', $order) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-pill px-3">
                                            <i class="bi bi-trash3-fill me-1"></i> تأكيد الإلغاء
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

<!-- Extra CSS -->
<style>
    .icon-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
    }
    
    .rounded-4 {
        border-radius: 1rem !important;
    }
</style>
