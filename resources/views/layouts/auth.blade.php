<!DOCTYPE html>
<html lang="vi" style="color-scheme: light !important;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="description" content="Trung Tâm Kết Nối Gia Sư - Hệ Thống Dạy Kèm Chuyên Nghiệp">
    <title>@yield('title', 'Xác Thực') | Gia Sư Connect</title>
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .edu-bg {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 0;
            overflow: hidden;
            background: linear-gradient(135deg, #eef2ff 0%, #ffffff 50%, #f0f9ff 100%) !important;
        }
        .edu-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.5;
        }
        .edu-shape-1 {
            top: -10%; left: -5%; width: 480px; height: 480px;
            background: #3b82f6;
        }
        .edu-shape-2 {
            bottom: -10%; right: -5%; width: 520px; height: 520px;
            background: #8b5cf6;
        }
        .edu-shape-3 {
            top: 40%; left: 70%; width: 320px; height: 320px;
            background: #06b6d4;
        }
        .floating-icon {
            position: absolute;
            font-size: 2.2rem;
            opacity: 0.35;
            user-select: none;
            animation: float 6s ease-in-out infinite alternate;
        }
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            100% { transform: translateY(-22px) rotate(12deg); }
        }
    </style>
</head>
<body style="background-color: #f8fafc !important; color: #0f172a !important; margin:0; padding:0; font-family: 'Inter', sans-serif;">
<div class="edu-bg">
    <div class="edu-shape edu-shape-1"></div>
    <div class="edu-shape edu-shape-2"></div>
    <div class="edu-shape edu-shape-3"></div>
    
    <!-- Floating Education Icons -->
    <div class="floating-icon" style="top: 10%; left: 8%; animation-delay: 0s;">📚</div>
    <div class="floating-icon" style="top: 75%; left: 10%; animation-delay: 1.5s;">✏️</div>
    <div class="floating-icon" style="top: 18%; right: 12%; animation-delay: 1s;">🎓</div>
    <div class="floating-icon" style="top: 78%; right: 14%; animation-delay: 2.5s;">📐</div>
    <div class="floating-icon" style="top: 45%; left: 6%; animation-delay: 2s;">⚛️</div>
    <div class="floating-icon" style="top: 48%; right: 7%; animation-delay: 0.5s;">💡</div>
</div>

<div class="auth-wrapper" style="position: relative; z-index: 1; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2.5rem 1rem;">
    @yield('content')
</div>
</body>
</html>