<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không Tìm Thấy Trang | Gia Sư Tri Thức</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ secure_asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/png" href="{{ secure_asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ secure_asset('apple-touch-icon.png') }}">
</head>
<body style="background:#f8fafc; color:#0f172a; font-family:'Be Vietnam Pro', 'Inter', sans-serif;">
<div style="min-height:100vh; display:flex; align-items:center; justify-content:center; text-align:center; padding:2rem;">
    <div class="glass-card" style="padding:3.5rem 2.5rem; max-width:540px; border-radius:24px; background:#ffffff; box-shadow:0 20px 40px rgba(0,0,0,0.06);">
        <div style="font-size:5rem; margin-bottom:0.8rem;">🔍</div>
        <h1 style="font-size:3.8rem; font-weight:800; color:#2563eb; margin:0 0 0.4rem;">404</h1>
        <h2 style="font-size:1.35rem; font-weight:700; color:#0f172a; margin-bottom:0.8rem;">Trang Không Tồn Tại</h2>
        <p style="color:#64748b; font-size:0.95rem; line-height:1.6; margin-bottom:2rem;">
            Đường dẫn bạn vừa truy cập không tồn tại hoặc đã được chuyển sang địa chỉ khác trong hệ thống <strong>Gia Sư Tri Thức</strong>.
        </p>
        <div style="display:flex; gap:0.8rem; justify-content:center; flex-wrap:wrap;">
            <a href="{{ url('/') }}" class="btn btn-primary" style="border-radius:12px; padding:0.75rem 1.6rem;">
                <i class="fas fa-home" style="margin-right:6px;"></i> Về Trang Chủ
            </a>
            <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-outline" style="border-radius:12px; padding:0.75rem 1.6rem;">
                <i class="fas fa-chalkboard-teacher" style="margin-right:6px;"></i> Tìm Gia Sư
            </a>
        </div>
    </div>
</div>
</body>
</html>
