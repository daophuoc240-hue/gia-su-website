<!DOCTYPE html>
<html lang="vi" style="color-scheme: light !important;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="description" content="Trung Tâm Kết Nối Gia Sư - Hệ Thống Dạy Kèm Chuyên Nghiệp">
    <title>@yield('title', 'Xác Thực') | Gia Sư Tri Thức</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body, button, input, select, textarea, .btn {
            font-family: 'Be Vietnam Pro', 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        }
        body {
            background-color: #ffffff !important;
            color: #0f172a !important;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }
        .split-auth-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }
        .split-hero {
            flex: 1.1;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 40%, #1e3a8a 100%);
            color: #ffffff;
            padding: 4rem 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .split-hero::before {
            content: '';
            position: absolute;
            top: -20%; right: -20%;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(59,130,246,0.3) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
        }
        .split-form {
            flex: 0.9;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            position: relative;
        }
        .auth-back-btn {
            position: absolute;
            top: 2rem;
            right: 2.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            color: #1e3a8a;
            font-size: 0.92rem;
            font-weight: 700;
            text-decoration: none;
            padding: 0.55rem 1.25rem;
            background: #eff6ff;
            border: 1.5px solid #93c5fd;
            border-radius: 9999px;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.12);
            z-index: 10;
        }
        .auth-back-btn i {
            color: #2563eb;
            font-size: 0.88rem;
            transition: transform 0.2s ease, color 0.2s ease;
        }
        .auth-back-btn:hover {
            background: #2563eb !important;
            border-color: #2563eb !important;
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.32);
        }
        .auth-back-btn:hover i {
            color: #ffffff !important;
            transform: translateX(-4px);
        }
        @media (max-width: 992px) {
            .split-auth-container { flex-direction: column; }
            .split-hero { padding: 2.5rem 1.5rem; }
            .split-form { padding: 2rem 1.5rem; position: relative; }
            .auth-back-btn {
                top: 1.2rem;
                right: 1.2rem;
                font-size: 0.85rem;
                padding: 0.45rem 1rem;
            }
        }
    </style>
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ secure_asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/png" href="{{ secure_asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ secure_asset('apple-touch-icon.png') }}">
</head>
<body>
    @yield('content')
</body>
</html>