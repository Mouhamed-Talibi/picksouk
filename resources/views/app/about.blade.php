@extends('layout.app')

@section('title')
    من نحن
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
                    <h1 class="display-4 fw-bold text-primary mb-3">بيكسوق</h1>
                    <p class="lead text-muted">متجرك المتخصص في بيع جميع المنتجات من مختلف الأصناف بجودة فائقة وأسعار مناسبة</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-5">
        <div class="container">
            <div class="row gx-5 align-items-center justify-content-between">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <div class="row gx-2 gx-lg-3">
                        <div class="col-6">
                            <div class="mb-3">
                                <img class="img-fluid rounded shadow-lg" src="{{ asset('assets/about-3.jpg')}}" alt="فريق بيكسوق" data-aos="zoom-in" data-aos-delay="100">
                            </div>
                            <div class="mb-3">
                                <img class="img-fluid rounded shadow-lg" src="{{ asset('assets/about-1.jpg')}}" alt="منتجات بيكسوق" data-aos="zoom-in" data-aos-delay="300">
                            </div>
                        </div>
                        <div class="col-6 mt-5">
                            <div class="mb-3">
                                <img class="img-fluid rounded shadow-lg" src="{{ asset('assets/about-2.jpg')}}" alt="متجر بيكسوق" data-aos="zoom-in" data-aos-delay="200">
                            </div>
                            <div class="mb-3">
                                <img class="img-fluid rounded shadow-lg" src="{{ asset('assets/about-4.jpg')}}" alt="خدمة العملاء" data-aos="zoom-in" data-aos-delay="400">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-5" data-aos="fade-left">
                    <div class="ps-lg-4">
                        <span class="text-primary fw-semibold small">قصتنا</span>
                        <h2 class="display-5 fw-bold mb-4">من نحن</h2>
                        <hr class="text-primary mb-4" style="height: 3px; width: 70px;">
                        
                        <div class="mb-4" data-aos="fade-up" data-aos-delay="100">
                            <p class="mb-4">بيكسوق متجرك المتخصص في بيع جميع المنتجات من مختلف الأصناف، حيث نقدم تشكيلة واسعة من المنتجات عالية الجودة التي تلبي جميع احتياجاتك اليومية وتطلعاتك نحو حياة أكثر رفاهية.</p>
                        </div>
                        
                        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
                            <p class="mb-4">نسعى لأن نكون الوجهة الأولى للتسوق الإلكتروني في العالم العربي من خلال تقديم تجربة تسوق متميزة تجمع بين الجودة العالية، الأسعار التنافسية، والخدمة المثالية. نعمل على بناء شراكات مع أفضل الموردين المحليين والدوليين.</p>
                        </div>
                        
                        <div class="mb-4" data-aos="fade-up" data-aos-delay="300">
                            <p class="">نلتزم بمعايير الجودة العالمية في كل منتج نقدمه، ونسخر أحدث التقنيات لتسهيل عملية التسوق وجعلها أكثر متعة وأمانًا. ثقة عملائنا هي دافعنا الدائم للتطوير والتحسين المستمر.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto" data-aos="fade-up">
                    <h2 class="display-5 fw-bold mb-4">قيمنا الأساسية</h2>
                    <p class="lead text-muted">الأساس الذي تقوم عليه رؤيتنا وخدمتنا في بيكسوق</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-medal text-primary fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">الجودة</h4>
                            <p class="text-muted">نحرص على تقديم منتجات عالية الجودة من أفضل الموردين العالميين والمحليين.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-shield-alt text-primary fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">الثقة</h4>
                            <p class="text-muted">نضمن لأعضائنا تجربة تسوق آمنة وشفافية كاملة في المعاملات.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-headset text-primary fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">الدعم</h4>
                            <p class="text-muted">فريق دعم عملائنا متاح على مدار الساعة لمساعدتك في كل استفسار.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection