<!DOCTYPE html>
<html lang="vi" style="color-scheme: light !important;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Gia Sư Tri Thức - Nền Tảng Kết Nối Gia Sư Chất Lượng Cao & Tìm Lớp Học Uy Tín Toàn Quốc">
    <title>@yield('title', 'Gia Sư Tri Thức - Kết Nối Gia Sư Uy Tín')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}?v={{ file_exists(public_path('css/app.css')) ? filemtime(public_path('css/app.css')) : time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Public Layout Custom Enhancements */
        .pub-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }
        .pub-topbar {
            background: #0f172a;
            color: #94a3b8;
            font-size: 0.8rem;
            padding: 0.4rem 0;
        }
        .pub-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.9rem 0;
        }
        .pub-logo {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 1.35rem;
            font-weight: 800;
            color: #0f172a;
            text-decoration: none;
        }
        .pub-logo-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .pub-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .pub-menu a {
            text-decoration: none;
            color: #475569;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }
        .pub-menu a:hover, .pub-menu a.active {
            color: #2563eb;
        }
        .pub-footer {
            background: #0f172a;
            color: #cbd5e1;
            padding: 4rem 0 2rem 0;
            margin-top: 4rem;
        }
        .pub-footer h4 {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
        }
        .pub-footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .pub-footer a:hover {
            color: #ffffff;
        }
        .container {
            width: 90%;
            max-width: 1240px;
            margin: 0 auto;
        }
    </style>
</head>
<body style="background-color: #f8fafc; color: #0f172a; margin: 0; font-family: 'Plus Jakarta Sans', sans-serif;">

    <!-- Top Announcement Bar -->
    <div class="pub-topbar">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <span>📞 Hotline tư vấn: <strong>0394.688.031</strong></span>
                <span style="margin: 0 1rem; opacity: 0.4;">|</span>
                <span>📧 Email hỗ trợ: <strong>support@giasutrithuc.vn</strong></span>
            </div>
            <div>
                <span>⏰ Giờ làm việc: 8:00 - 21:00 (T2 - CN)</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="pub-header">
        <div class="container pub-nav">
            <a href="{{ route('home') }}" class="pub-logo">
                <div class="pub-logo-icon"><i class="fas fa-graduation-cap"></i></div>
                <div>
                    <div>Gia Sư Tri Thức</div>
                    <div style="font-size: 0.68rem; font-weight: 600; color: #64748b; letter-spacing: 0.5px;">Hệ Thống Kết Nối Uy Tín</div>
                </div>
            </a>

            <ul class="pub-menu">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="fas fa-home"></i> Trang Chủ</a></li>
                <li><a href="{{ route('danh-sach-gia-su') }}" class="{{ request()->routeIs('danh-sach-gia-su*') ? 'active' : '' }}"><i class="fas fa-user-graduate"></i> Gia Sư Uy Tín</a></li>
                <li><a href="{{ route('danh-sach-lop-hoc') }}" class="{{ request()->routeIs('danh-sach-lop-hoc*') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Lớp Học Mới</a></li>
                <li><a href="{{ route('gioi-thieu') }}" class="{{ request()->routeIs('gioi-thieu') ? 'active' : '' }}"><i class="fas fa-info-circle"></i> Giới Thiệu</a></li>
                <li><a href="{{ route('lien-he') }}" class="{{ request()->routeIs('lien-he') ? 'active' : '' }}"><i class="fas fa-phone-alt"></i> Liên Hệ</a></li>
            </ul>

            <div style="display: flex; align-items: center; gap: 0.8rem;">
                @auth
                    @if(auth()->user()->vai_tro === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm"><i class="fas fa-user-shield"></i> Trang Admin</a>
                    @elseif(auth()->user()->vai_tro === 'giasu')
                        <a href="{{ route('giasu.dashboard') }}" class="btn btn-primary btn-sm"><i class="fas fa-tachometer-alt"></i> Dashboard Gia Sư</a>
                    @else
                        <a href="{{ route('hocvien.dashboard') }}" class="btn btn-primary btn-sm"><i class="fas fa-user"></i> Dashboard Học Viên</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline btn-sm"><i class="fas fa-sign-in-alt"></i> Đăng Nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm"><i class="fas fa-user-plus"></i> Đăng Ký</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Dynamic Content -->
    <main>
        @yield('content')
    </main>

    <!-- Enterprise Public Footer -->
    <footer class="pub-footer">
        <div class="container">
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 2.5rem; margin-bottom: 3rem;">
                <div>
                    <div style="display: flex; align-items: center; gap: 0.6rem; font-size: 1.3rem; font-weight: 800; color: #ffffff; margin-bottom: 1rem;">
                        <i class="fas fa-graduation-cap" style="color: #3b82f6;"></i> Gia Sư Tri Thức
                    </div>
                    <p style="font-size: 0.9rem; color: #94a3b8; line-height: 1.7; margin-bottom: 1.2rem;">
                        Nền tảng kết nối trung tâm gia sư chuyên nghiệp hàng đầu. Mang đến giải pháp tìm gia sư giỏi, bài bản và hỗ trợ sinh viên, giáo viên nhận lớp dạy kèm uy tín toàn quốc.
                    </p>
                    <div style="display: flex; gap: 0.8rem;">
                        <a href="#" style="width:36px; height:36px; background:#1e293b; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="width:36px; height:36px; background:#1e293b; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fab fa-youtube"></i></a>
                        <a href="#" style="width:36px; height:36px; background:#1e293b; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <div>
                    <h4>Về Trung Tâm</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; line-height: 2.2; font-size: 0.9rem;">
                        <li><a href="{{ route('gioi-thieu') }}">Về chúng tôi</a></li>
                        <li><a href="{{ route('danh-sach-gia-su') }}">Đội ngũ gia sư</a></li>
                        <li><a href="{{ route('danh-sach-lop-hoc') }}">Lớp học đang tìm</a></li>
                        <li><a href="{{ route('lien-he') }}">Quy trình nhận lớp</a></li>
                    </ul>
                </div>

                <div>
                    <h4>Dành Cho Gia Sư</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; line-height: 2.2; font-size: 0.9rem;">
                        <li><a href="{{ route('register') }}">Đăng ký làm gia sư</a></li>
                        <li><a href="{{ route('danh-sach-lop-hoc') }}">Tìm lớp dạy kèm</a></li>
                        <li><a href="{{ route('login') }}">Cập nhật hồ sơ</a></li>
                        <li><a href="{{ route('lien-he') }}">Chính sách môi giới</a></li>
                    </ul>
                </div>

                <div>
                    <h4>Thông Tin Liên Hệ</h4>
                    <p style="font-size: 0.88rem; color: #94a3b8; line-height: 1.8;">
                        👨‍💼 <strong>Quản lý:</strong> Đào Bình Phước<br>
                        📍 <strong>Địa chỉ:</strong> Khu Đô Thị Đại Học, TP. Huế<br>
                        📞 <strong>Hotline:</strong> 0394.688.031<br>
                        📧 <strong>Email:</strong> daophuoc240@gmail.com
                    </p>
                </div>
            </div>

            <div style="border-top: 1px solid #1e293b; padding-top: 1.8rem; text-align: center; font-size: 0.85rem; color: #64748b;">
                © 2026 Gia Sư Tri Thức - Hệ Thống Kết Nối & Quản Lý Gia Sư Chuyên Nghiệp. Tất cả các quyền được bảo lưu.
            </div>
        </div>
    </footer>

</body>
</html>
