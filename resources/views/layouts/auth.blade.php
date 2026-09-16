<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Đăng nhập vào Hệ Thống Kết Nối Trung Tâm Gia Sư">
    <title>@yield('title', 'Xác Thực') | Gia Sư Connect</title>
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<div class="bg-animated"></div>
<div class="auth-wrapper">
    @yield('content')
</div>
</body>
</html>
