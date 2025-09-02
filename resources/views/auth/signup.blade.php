@extends('layout.app')

@section('title')
    تسجيل حساب جديد
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8 col-md-6">
                <form action="{{ route('auth.signup') }}" class="shadow p-3" method="POST" dir="rtl" style="text-align: right;">
                    @csrf

                    {{-- صورة النموذج --}}
                    <div class="form-image">
                        <img src="{{ asset('assets/login-1.jpg') }}" alt="" class="img-fluid rounded-3">
                    </div>
                    <div class="form-input mt-3">
                        <div class="form-group">
                            <!-- حقل الاسم -->
                            <div class="mb-4">  <!-- زيادة المسافة السفلية -->
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-start-0">
                                        <i class="fa-solid fa-user fs-5 text-secondary"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control border-end-1 @error('name') is-invalid @enderror" 
                                        placeholder="اسمك" value="{{ old('name') }}" autofocus>
                                </div>
                                @error('name')
                                    <div class="text-danger mt-2 small">{{ $message }}</div> 
                                @enderror
                            </div>

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

                            <!-- حقل الجنس -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-start-0">
                                        <i class="fa-solid fa-venus-mars fs-5 text-secondary"></i>
                                    </span>
                                    <select name="gender" class="form-select border-end-1 @error('gender') is-invalid @enderror">
                                        <option value="" disabled selected>اختر الجنس</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                                    </select>
                                </div>
                                @error('gender')
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
                                    <span class="input-group-text bg-white border-start-0" style="cursor: pointer;" onclick="togglePassword('password', 'toggleIcon')">
                                        <i class="fa-solid fa-eye text-secondary" id="toggleIcon"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- تأكيد كلمة المرور -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-start-0">
                                        <i class="fa-solid fa-key fs-5 text-secondary"></i>
                                    </span>
                                    <input type="password" 
                                        name="password_confirmation" 
                                        id="password_confirmation"
                                        class="form-control border-end-1" 
                                        placeholder="تأكيد كلمة المرور">
                                    <span class="input-group-text bg-white border-start-0" style="cursor: pointer;" onclick="togglePassword('password_confirmation', 'toggleIconConfirm')">
                                        <i class="fa-solid fa-eye text-secondary" id="toggleIconConfirm"></i>
                                    </span>
                                </div>
                                @error('password_confirmation')
                                    <div class="text-danger mt-2 small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 w-100">تسجيل</button>

                    <p class="text-center mt-3">
                        هل لديك حساب بالفعل؟ 
                        <a href="{{ route('auth.login_form')}}">تسجيل الدخول</a>
                    </p>  
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);

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