<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Sự Cố Máy Chủ | Gia Sư Tri Thức</title>
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body style="background:#f8fafc; color:#0f172a; font-family:'Plus Jakarta Sans',sans-serif;">
<div style="min-height:100vh; display:flex; align-items:center; justify-content:center; text-align:center; padding:2rem;">
    <div class="glass-card" style="padding:3.5rem 2.5rem; max-width:540px; border-radius:24px; background:#ffffff; box-shadow:0 20px 40px rgba(0,0,0,0.06);">
        <div style="font-size:5rem; margin-bottom:0.8rem;">⚙️</div>
        <h1 style="font-size:3.8rem; font-weight:800; color:#f59e0b; margin:0 0 0.4rem;">500</h1>
        <h2 style="font-size:1.35rem; font-weight:700; color:#0f172a; margin-bottom:0.8rem;">Đang Xử Lý Hệ Thống</h2>
        <p style="color:#64748b; font-size:0.95rem; line-height:1.6; margin-bottom:2rem;">
            Hệ thống đang thực hiện tác vụ bảo trì hoặc gặp trục trặc tạm thời. Đội ngũ kỹ thuật đã được thông báo và đang xử lý.
        </p>
        <div style="display:flex; gap:0.8rem; justify-content:center;">
            <a href="{{ url('/') }}" class="btn btn-primary" style="border-radius:12px; padding:0.75rem 1.6rem;">
                <i class="fas fa-home" style="margin-right:6px;"></i> Về Trang Chủ
            </a>
            <button onclick="window.location.reload()" class="btn btn-outline" style="border-radius:12px; padding:0.75rem 1.6rem;">
                <i class="fas fa-sync-alt" style="margin-right:6px;"></i> Tải Lại Trang
            </button>
        </div>
    </div>
</div>
</body>
</html>
