<!DOCTYPE html>
<html lang="vi" style="color-scheme: light !important;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="description" content="Trung Tâm Kết Nối Gia Sư - Hệ Thống Dạy Kèm Chuyên Nghiệp">
    <title>@yield('title', 'Xác Thực') | Gia Sư Tri Thức</title>
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #ffffff !important;
            color: #0f172a !important;
            min-height: 100vh;
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
        }
        @media (max-width: 992px) {
            .split-auth-container { flex-direction: column; }
            .split-hero { padding: 2.5rem 1.5rem; }
            .split-form { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>