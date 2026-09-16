<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Không Có Quyền Truy Cập | Gia Sư Connect</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<div class="bg-animated"></div>
<div style="min-height:100vh; display:flex; align-items:center; justify-content:center; text-align:center; padding:2rem;">
    <div>
        <div style="font-size:5rem; margin-bottom:1rem; opacity:0.5;">🚫</div>
        <h1 style="font-size:4rem; font-weight:800; background:linear-gradient(135deg,#f5576c,#f093fb); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:0.5rem;">403</h1>
        <h2 style="font-size:1.3rem; color:var(--text-secondary); margin-bottom:1rem;">Không có quyền truy cập</h2>
        <p style="color:var(--text-muted); margin-bottom:2rem;">{{ $exception->getMessage() ?? 'Bạn không có quyền truy cập trang này.' }}</p>
        <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Quay Lại</a>
    </div>
</div>
</body>
</html>
