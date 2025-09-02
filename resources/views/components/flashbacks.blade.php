<div class="flash-messages-container">
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-body text-center p-5">
                    <div class="icon-container bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-check-circle text-success fs-1"></i>
                    </div>
                    <p class="text-muted mb-4">{{ session('success') }}</p>
                    <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">حسنا</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-body text-center p-5">
                    <div class="icon-container bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-exclamation-circle text-danger fs-1"></i>
                    </div>
                    <p class="text-muted mb-4">{{ session('error') }}</p>
                    <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">حسنا</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Modal -->
    <div class="modal fade" id="warningModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-body text-center p-5">
                    <div class="icon-container bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-exclamation-triangle text-warning fs-1"></i>
                    </div>
                    <p class="text-muted mb-4">{{ session('warning') }}</p>
                    <button type="button" class="btn btn-warning px-4" data-bs-dismiss="modal">حسنا</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                new bootstrap.Modal(document.getElementById('successModal')).show();
            @endif

            @if(session('error'))
                new bootstrap.Modal(document.getElementById('errorModal')).show();
            @endif

            @if(session('warning'))
                new bootstrap.Modal(document.getElementById('warningModal')).show();
            @endif
        });
    </script>
@endpush