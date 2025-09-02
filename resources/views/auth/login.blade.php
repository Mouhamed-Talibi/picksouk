@extends('layout.app')

@section('title')
    تسجيل الدخول
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8 col-md-6">
                <form action="{{ route('auth.login') }}" class="shadow p-3" method="POST" dir="rtl" style="text-align: right;">
                    @csrf

                    {{-- صورة النموذج --}}
                    <div class="form-image">
                        <img src="{{ asset('assets/login.jpg') }}" alt="" class="img-fluid rounded-3">
                    </div>
                    {{-- حقول الإدخال --}}
                    <div class="form-input mt-3">
                        <div class="form-group mt-4">
                            <!-- حقل البريد الإلكتروني -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-start-0">
                                        <i class="fa-solid fa-envelope fs-5 text-secondary"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control border-end-1 @error('email') is-invalid @enderror" 
                                        placeholder="بريدك الإلكتروني" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- حقل كلمة المرور -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-start-0">
                                        <i class="fa-solid fa-key fs-5 text-secondary"></i>
                                    </span>
                                    <input type="password" 
                                        name="password" 
                                        id="password"
                                        class="form-control border-end-1 @error('password') is-invalid @enderror" 
                                        placeholder="كلمة المرور">
                                    <span class="input-group-text bg-white border-start-0" style="cursor: pointer;" onclick="togglePassword()">
                                        <i class="fa-solid fa-eye text-secondary" id="toggleIcon"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <a href="#" class="text-info float-start">نسيت كلمة المرور؟</a>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100">تسجيل الدخول</button>
                        <p class="text-center mt-3">
                            ليس لديك حساب؟ 
                            <a href="{{ route('auth.signup_form')}}" class="">سجل الآن</a>
                        </p>  
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.getElementById("toggleIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>
