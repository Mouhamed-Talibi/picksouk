<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد البريد الإلكتروني - بيكسوق</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Tajawal', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            color: #333;
            direction: rtl;
            line-height: 1.6;
            padding: 20px 0;
        }
        
        .email-wrapper {
            max-width: 650px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        }
        
        .email-header {
            background: linear-gradient(135deg, #2c3e50 0%, #4a6580 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            display: inline-block;
        }
        
        .logo-accent {
            color: #8db596;
        }
        
        .email-title {
            font-size: 26px;
            margin: 8px 0;
            font-weight: 700;
        }
        
        .email-body {
            padding: 40px;
        }
        
        .welcome-text {
            font-size: 20px;
            margin-bottom: 25px;
            color: #2c3e50;
            font-weight: 500;
        }
        
        .message-box {
            background-color: #f8f9fa;
            border-right: 4px solid #8db596;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            background: #f4f9ff;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
        }
        
        .user-icon {
            background: #8db596;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 15px;
            color: white;
            font-size: 22px;
        }
        
        .user-details {
            flex: 1;
        }
        
        .user-name {
            font-weight: 700;
            color: #2c3e50;
            font-size: 18px;
        }
        
        .user-email {
            color: #007bff;
            font-weight: 500;
        }
        
        .btn-container {
            text-align: center;
            margin: 35px 0 15px 0;
        }
        
        .confirm-btn {
            display: inline-block;
            padding: 16px 45px;
            background: linear-gradient(to left, #8db596, #6ba46b);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(139, 181, 150, 0.4);
            transition: all 0.3s ease;
        }
        
        .confirm-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(139, 181, 150, 0.6);
        }
        
        .link-alternative {
            text-align: center;
            margin: 25px 0;
            font-size: 14px;
            color: #6c757d;
        }
        
        .copy-link {
            display: inline-block;
            background: #f1f8ff;
            padding: 10px 20px;
            border-radius: 6px;
            color: #007bff;
            text-decoration: none;
            font-family: monospace;
            font-size: 13px;
            margin-top: 10px;
            word-break: break-all;
        }
        
        .email-footer {
            background-color: #f8f9fa;
            padding: 25px;
            text-align: center;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 14px;
        }
        
        .social-links {
            margin: 15px 0;
        }
        
        .social-link {
            display: inline-block;
            margin: 0 8px;
            width: 40px;
            height: 40px;
            background: #e9ecef;
            border-radius: 50%;
            line-height: 40px;
            text-align: center;
            color: #2c3e50;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background: #8db596;
            color: white;
            transform: translateY(-3px);
        }
        
        .warning-note {
            background: #fff4f4;
            border: 1px solid #ffdfdf;
            padding: 15px;
            border-radius: 8px;
            margin-top: 25px;
            font-size: 13px;
            color: #dc3545;
        }
        
        .spam-note {
            background: #fffbea;
            border: 1px solid #ffe58f;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            font-size: 13px;
            color: #856404;
        }
        
        .highlight {
            font-weight: 700;
            color: #2c3e50;
        }
        
        @media (max-width: 650px) {
            .email-body {
                padding: 25px;
            }
            
            .email-header {
                padding: 25px 15px;
            }
            
            .confirm-btn {
                padding: 14px 35px;
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-header">
            <div class="logo">بيك<span class="logo-accent">سوق</span></div>
            <h1 class="email-title">تأكيد البريد الإلكتروني</h1>
            <p>نحن سعداء بانضمامك إلى منصتنا</p>
        </div>
        
        <div class="email-body">
            <p class="welcome-text">مرحباً <span class="highlight">{{ $name }}</span>،</p>
            
            <p>شكراً لتسجيلك في <span class="highlight">بيكسوق</span>! نحن متحمسون لوجودك معنا.</p>
            
            <div class="user-info">
                <div class="user-icon">👤</div>
                <div class="user-details">
                    <div class="user-name">{{ $name }}</div>
                    <div class="user-email">{{ $email }}</div>
                </div>
            </div>
            
            <div class="message-box">
                <p>لبدء استخدام حسابك، يرجى تأكيد عنوان بريدك الإلكتروني بالنقر على الزر أدناه:</p>
            </div>
            
            <div class="btn-container">
                <a href="{{ $link }}" class="confirm-btn">تأكيد بريدي الإلكتروني</a>
            </div>
            
            <div class="link-alternative">
                <p>إذا كان الزر لا يعمل، يمكنك نسخ الرابط أدناه ولصقه في متصفحك:</p>
                <a href="{{ $link }}" class="copy-link">{{ $link }}</a>
            </div>
            
            <div class="warning-note">
                <p>⏳ ينتهي رابط التأكيد خلال 24 ساعة لأسباب أمنية.</p>
                <p>إذا لم تقم بإنشاء هذا الحساب، يمكنك تجاهل هذه الرسالة.</p>
            </div>

            <div class="spam-note">
                📩 ملاحظة: إذا لم تجد الرسالة في البريد الوارد (Inbox)، يرجى التحقق من مجلد <strong>البريد المزعج (Spam)</strong>.
            </div>
        </div>
        
        <div class="email-footer">
            <p>إذا كنت بحاجة إلى مساعدة، لا تتردد في التواصل معنا على 
                <a href="mailto:picksouck.contact@gmail.com" style="color: #007bff;">picksouck.contact@gmail.com</a>
            </p>
            
            <div class="social-links">
                <a href="#" class="social-link">f</a>
                <a href="#" class="social-link">t</a>
                <a href="#" class="social-link">in</a>
                <a href="#" class="social-link">ig</a>
            </div>
            
            <p>© {{ date('Y') }} بيكسوق. جميع الحقوق محفوظة.</p>
            <p>هذه رسالة تلقائية، يرجى عدم الرد عليها.</p>
        </div>
    </div>
</body>
</html>
