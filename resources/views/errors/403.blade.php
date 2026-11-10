<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Không Có Quyền Truy Cập | Gia Sư Tri Thức</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body style="background:#f8fafc; color:#0f172a; font-family:'Be Vietnam Pro', 'Inter', sans-serif;">
<div style="min-height:100vh; display:flex; align-items:center; justify-content:center; text-align:center; padding:2rem;">
    <div class="glass-card" style="padding:3.5rem 2.5rem; max-width:520px; border-radius:24px; background:#ffffff; box-shadow:0 20px 40px rgba(0,0,0,0.06);">
        <div style="font-size:4.5rem; margin-bottom:1rem;">🛡️</div>
        <h1 style="font-size:3.5rem; font-weight:800; color:#ef4444; margin:0 0 0.5rem;">403</h1>
        <h2 style="font-size:1.3rem; font-weight:700; color:#0f172a; margin-bottom:0.8rem;">Truy Cập Bị Từ Chối</h2>
        <p style="color:#64748b; font-size:0.95rem; line-height:1.6; margin-bottom:2rem;">
            Tài khoản của bạn không có đủ quyền để truy cập vào khu vực này. Vui lòng quay lại hoặc đăng nhập bằng tài khoản phù hợp.
        </p>
        <div style="display:flex; gap:0.8rem; justify-content:center;">
            <a href="{{ url('/') }}" class="btn btn-primary" style="border-radius:12px; padding:0.75rem 1.6rem;">
                <i class="fas fa-home" style="margin-right:6px;"></i> Về Trang Chủ
            </a>
            <a href="{{ url()->previous() }}" class="btn btn-outline" style="border-radius:12px; padding:0.75rem 1.6rem;">
                <i class="fas fa-arrow-left" style="margin-right:6px;"></i> Quay Lại
            </a>
        </div>
    </div>
</div>
</body>
</html>
