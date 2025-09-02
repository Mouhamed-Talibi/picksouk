@extends('layout.app')

@section('title')
    اتصل بنا
@endsection

@section('content')
    <!-- Contact Us Section -->
    <section class="contact-us py-5">
        <div class="container">
            <div class="row mb-5" data-aos="fade-up">
                <div class="col-12 text-center">
                    <span class="text-primary fw-semibold small">الدعم والمساعدة</span>
                    <h2 class="display-5 fw-bold mb-3">اتصل بنا</h2>
                    <p class="lead text-muted">نحن هنا للإجابة على استفساراتك وتلقي ملاحظاتك</p>
                    <hr class="text-primary mx-auto mb-4" style="height: 3px; width: 70px;">
                </div>
            </div>
            
            <div class="row g-5">
                <!-- Contact Form -->
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                    <div class="contact-card">
                        <div class="contact-header">
                            <h3 class="mb-0"><i class="fas fa-envelope ms-3"></i>أرسل رسالة</h3>
                        </div>
                        <div class="contact-form">
                            <form  action="{{ route('send_message')}}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">الاسم الكامل</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ Auth::user()->name ?? old('name')}}">
                                        @error('name')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">البريد الإلكتروني</label>
                                        <input type="email"  name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ Auth::user()->email ?? old('email')}}">
                                        @error('email')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">الرسالة</label>
                                    <textarea  name="message" class="form-control @error('message') is-invalid @enderror" id="message" rows="5" placeholder="اكتب رسالتك هنا..."></textarea>
                                        @error('message')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-paper-plane ms-2"></i>إرسال الرسالة</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="contact-info">
                        <h3 class="mb-4 text-center"><i class="fas fa-info-circle ms-3"></i>معلومات التواصل</h3>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">العنوان</h5>
                                <p class="mb-0">اكادير , المغرب</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">رقم الهاتف</h5>
                                <p class="mb-0" dir="ltr">+212 06 80 67 08 98</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">البريد الإلكتروني</h5>
                                <p class="mb-0">picksouk.contact@gmail.com</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">ساعات العمل</h5>
                                <p class="mb-0">طيلة الاسبوع </p>
                            </div>
                        </div>
                        
                        <!-- Social Media Links -->
                        <div class="social-links">
                            <a href="https://www.facebook.com/share/1GhYQJWtjP/?mibextid=wwXIfr" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/picksouk?igsh=eXZuNzF4bjg0dnNp&utm_source=qr" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://wa.me/+2120680670898" class="social-icon" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Map Section -->
            <div class="row mt-5" data-aos="fade-up" data-aos-delay="300">
                <div class="col-12">
                    <div class="map-container">
                        <!-- Google Map Embed -->
                        <iframe
                            width="100%"
                            height="100%"
                            src="https://maps.google.com/maps?q=Morocco&output=embed"
                            frameborder="0"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                            </iframe>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #f8f9fa;
            --accent-color: #ff6b35;
        }
        
        .contact-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        
        .contact-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0a58ca 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .contact-form {
            padding: 2rem;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 0.8rem 1.2rem;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        
        .contact-info {
            padding: 2rem;
            background: white;
            border-radius: 15px;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 10px;
            background: var(--secondary-color);
            transition: all 0.3s;
        }
        
        .info-item:hover {
            background: #e9ecef;
            transform: translateX(-5px);
        }
        
        .info-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            margin-left: 15px;
            font-size: 1.2rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0a58ca 100%);
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        }
        
        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            height: 300px;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 2rem;
        }
        
        .social-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--secondary-color);
            color: var(--primary-color);
            border-radius: 50%;
            font-size: 1.2rem;
            transition: all 0.3s;
        }
        
        .social-icon:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .contact-card, .contact-info {
                margin-bottom: 2rem;
            }
        }
    </style>
@endpush