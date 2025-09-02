<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    
    <!-- أيقونة الموقع -->
    <link rel="icon" href="{{ asset('assets/luxoria-1.png') }}" type="image/png" />

    <!-- العنوان -->
    <title>بيكسوق - تأكيد البريد الإلكتروني</title>

    <!-- بوتستراب CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- خط أيقونات فايت أوسوم -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- CSS مخصص -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>
<body style="background-color: #f8f9fa; min-height: 100vh; display: flex; align-items: center; justify-content: center; text-align: right;">

    <!-- المحتوى الرئيسي -->
    <div class="bg-white p-5 rounded-4 shadow-lg" style="max-width: 500px; width: 100%;">

        <!-- الأيقونة المركزية -->
        <div class="mb-4">
            <i class="fas fa-envelope-circle-check fa-4x text-primary"></i>
        </div>

        <!-- العنوان -->
        <h2 class="mb-3">تأكيد <span class="text-primary">البريد الإلكتروني</span></h2>

        <!-- الرسالة -->
        <p class="text-secondary mb-2">
            لقد أرسلنا لك رابط التحقق. <br /> يرجى التحقق من صندوق بريدك الإلكتروني لتفعيل حسابك.
        </p>

        <!-- ملاحظة -->
        <small class="text-danger d-block mb-1">إذا لم تصله، تحقق من مجلد الرسائل المزعجة أو البريد غير المرغوب فيه.</small>
        <small class="text-muted">بيكسوق - تأكيد البريد الإلكتروني</small>
    </div>

    <!-- بوتستراب جافاسكريبت -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <!-- جافاسكريبت مخصص -->
    <script src="{{ asset('js/loader.js') }}"></script>
</body>
</html>
