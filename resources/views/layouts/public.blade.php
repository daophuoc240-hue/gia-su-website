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
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}?v={{ file_exists(public_path('css/app.css')) ? filemtime(public_path('css/app.css')) : time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @stack('styles')
    
    <style>
        /* Public Layout Custom Enhancements */
        .pub-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
        }
        .pub-topbar {
            background: #0f172a;
            color: #cbd5e1;
            font-size: 0.8rem;
            padding: 0.45rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }
        .pub-topbar a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s;
        }
        .pub-topbar a:hover {
            color: #60a5fa;
        }
        .pub-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 0;
            gap: 1rem;
        }
        .pub-logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-size: 1.32rem;
            font-weight: 800;
            color: #0f172a;
            text-decoration: none;
            flex-shrink: 0;
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
            font-size: 1.25rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .pub-menu {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .pub-menu a {
            text-decoration: none;
            color: #475569;
            font-weight: 600;
            font-size: 0.92rem;
            padding: 0.5rem 0.9rem;
            border-radius: 10px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .pub-menu a:hover {
            color: #2563eb;
            background: #eff6ff;
        }
        .pub-menu a.active {
            color: #1d4ed8;
            background: #eff6ff;
            font-weight: 700;
        }
        .pub-mobile-toggle {
            display: none;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #0f172a;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }
        .pub-mobile-drawer {
            display: none;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 1rem 0;
        }
        .pub-mobile-drawer.open {
            display: block;
        }
        .pub-trust-bar {
            background: linear-gradient(90deg, #eff6ff 0%, #f8fafc 50%, #eff6ff 100%);
            border-top: 1px solid #dbeafe;
            border-bottom: 1px solid #dbeafe;
            padding: 1.8rem 0;
            margin-top: 4rem;
        }
        .pub-footer {
            background: #0f172a;
            color: #cbd5e1;
            padding: 4rem 0 2rem 0;
        }
        .pub-footer h4 {
            color: #ffffff;
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            position: relative;
        }
        .pub-footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .pub-footer a:hover {
            color: #ffffff;
        }
        .glass-card, .subject-card {
            min-width: 0;
        }
        .container {
            width: 90%;
            max-width: 1240px;
            margin: 0 auto;
        }
        /* Floating Quick Actions */
        .floating-support {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 999;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            align-items: flex-end;
        }
        .float-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.65rem 1.05rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.84rem;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.16);
            transition: all 0.22s ease;
        }
        .float-btn:hover {
            transform: translateY(-2px);
        }
        .float-btn-hotline {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            border: 1.5px solid #60a5fa;
        }
        .float-btn-top {
            width: 42px;
            height: 42px;
            padding: 0;
            justify-content: center;
            background: #ffffff;
            color: #1e293b;
            border: 1px solid #cbd5e1;
            cursor: pointer;
        }
        @media (max-width: 992px) {
            .pub-menu {
                display: none;
            }
            .pub-mobile-toggle {
                display: inline-flex;
            }
            .pub-footer-grid {
                grid-template-columns: 1fr 1fr !important;
            }
            .pub-trust-grid {
                grid-template-columns: 1fr 1fr !important;
            }
        }
        @media (max-width: 640px) {
            .pub-topbar-right {
                display: none;
            }
            .pub-footer-grid, .pub-trust-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ secure_asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/png" href="{{ secure_asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ secure_asset('apple-touch-icon.png') }}">
</head>
<body style="background-color: #f8fafc; color: #0f172a; margin: 0; font-family: 'Be Vietnam Pro', 'Inter', sans-serif;">

    <!-- Top Announcement Bar -->
    <div class="pub-topbar">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
            <div style="display: flex; align-items: center; gap: 0.9rem; flex-wrap: wrap;">
                <a href="tel:0394688031"><i class="fas fa-phone-volume" style="color: #60a5fa; margin-right: 0.3rem;"></i> Hotline tư vấn: <strong style="color: #fff;">0394.688.031</strong></a>
                <span style="opacity: 0.3;">|</span>
                <a href="mailto:support@giasutrithuc.vn"><i class="fas fa-envelope" style="color: #60a5fa; margin-right: 0.3rem;"></i> Email: <strong style="color: #fff;">support@giasutrithuc.vn</strong></a>
            </div>
            <div class="pub-topbar-right" style="display: flex; align-items: center; gap: 1rem;">
                <span><i class="fas fa-shield-alt" style="color: #10b981; margin-right: 0.3rem;"></i> 100% Hồ sơ kiểm duyệt</span>
                <span style="opacity: 0.3;">|</span>
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
                    <div style="font-size: 0.68rem; font-weight: 600; color: #64748b; letter-spacing: 0.4px;">Hệ Thống Kết Nối Uy Tín</div>
                </div>
            </a>

            <ul class="pub-menu">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="fas fa-home"></i> Trang Chủ</a></li>
                <li><a href="{{ route('danh-sach-gia-su') }}" class="{{ request()->routeIs('danh-sach-gia-su*') || request()->routeIs('chi-tiet-gia-su*') ? 'active' : '' }}"><i class="fas fa-user-graduate"></i> Gia Sư Uy Tín</a></li>
                <li><a href="{{ route('danh-sach-lop-hoc') }}" class="{{ request()->routeIs('danh-sach-lop-hoc*') || request()->routeIs('chi-tiet-lop-hoc*') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Lớp Học Mới</a></li>
                <li><a href="{{ route('tuyen-gia-su') }}" class="{{ request()->routeIs('tuyen-gia-su') ? 'active' : '' }}"><i class="fas fa-briefcase"></i> Tuyển Gia Sư</a></li>
                <li><a href="{{ route('kinh-nghiem') }}" class="{{ request()->routeIs('kinh-nghiem*') || request()->routeIs('bai-viet*') ? 'active' : '' }}"><i class="fas fa-book-reader"></i> Kinh Nghiệm</a></li>
                <li><a href="{{ route('lien-he') }}" class="{{ request()->routeIs('lien-he') ? 'active' : '' }}"><i class="fas fa-phone-alt"></i> Liên Hệ</a></li>
            </ul>

            <div style="display: flex; align-items: center; gap: 0.65rem;">
                @auth
                    <a href="{{ route('chat.index') }}" class="btn btn-outline btn-sm" title="Tin nhắn" style="position:relative; display:inline-flex; align-items:center; gap:0.4rem;">
                        <i class="fas fa-comments"></i> Chat
                        @php $unreadPub = auth()->user()->tinNhanChuaDocCount(); @endphp
                        @if($unreadPub > 0)
                            <span style="background:#ef4444; color:#fff; font-size:0.68rem; font-weight:800; border-radius:50%; min-width:16px; height:16px; display:inline-flex; align-items:center; justify-content:center; padding:0 2px;">{{ $unreadPub }}</span>
                        @endif
                    </a>

                    @if(auth()->user()->vai_tro === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm"><i class="fas fa-user-shield"></i> Quản Trị</a>
                    @elseif(auth()->user()->vai_tro === 'giasu')
                        <a href="{{ route('giasu.dashboard') }}" class="btn btn-primary btn-sm"><i class="fas fa-chalkboard-teacher"></i> Bàn Làm Việc Gia Sư</a>
                    @else
                        <a href="{{ route('hocvien.dashboard') }}" class="btn btn-primary btn-sm"><i class="fas fa-user"></i> Khu Vực Học Viên</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline btn-sm"><i class="fas fa-sign-in-alt"></i> Đăng Nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm"><i class="fas fa-user-plus"></i> Đăng Ký</a>
                @endauth

                <button type="button" class="pub-mobile-toggle" id="pubMobileMenuBtn" aria-label="Menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div class="pub-mobile-drawer" id="pubMobileDrawer">
            <div class="container" style="display: flex; flex-direction: column; gap: 0.4rem;">
                <a href="{{ route('home') }}" style="padding: 0.65rem 0.9rem; border-radius: 8px; text-decoration: none; font-weight: 600; color: {{ request()->routeIs('home') ? '#2563eb' : '#334155' }}; background: {{ request()->routeIs('home') ? '#eff6ff' : 'transparent' }};"><i class="fas fa-home" style="width:22px;"></i> Trang Chủ</a>
                <a href="{{ route('danh-sach-gia-su') }}" style="padding: 0.65rem 0.9rem; border-radius: 8px; text-decoration: none; font-weight: 600; color: {{ request()->routeIs('danh-sach-gia-su*') ? '#2563eb' : '#334155' }}; background: {{ request()->routeIs('danh-sach-gia-su*') ? '#eff6ff' : 'transparent' }};"><i class="fas fa-user-graduate" style="width:22px;"></i> Gia Sư Uy Tín</a>
                <a href="{{ route('danh-sach-lop-hoc') }}" style="padding: 0.65rem 0.9rem; border-radius: 8px; text-decoration: none; font-weight: 600; color: {{ request()->routeIs('danh-sach-lop-hoc*') ? '#2563eb' : '#334155' }}; background: {{ request()->routeIs('danh-sach-lop-hoc*') ? '#eff6ff' : 'transparent' }};"><i class="fas fa-chalkboard-teacher" style="width:22px;"></i> Lớp Học Mới</a>
                <a href="{{ route('gioi-thieu') }}" style="padding: 0.65rem 0.9rem; border-radius: 8px; text-decoration: none; font-weight: 600; color: {{ request()->routeIs('gioi-thieu') ? '#2563eb' : '#334155' }}; background: {{ request()->routeIs('gioi-thieu') ? '#eff6ff' : 'transparent' }};"><i class="fas fa-info-circle" style="width:22px;"></i> Giới Thiệu</a>
                <a href="{{ route('lien-he') }}" style="padding: 0.65rem 0.9rem; border-radius: 8px; text-decoration: none; font-weight: 600; color: {{ request()->routeIs('lien-he') ? '#2563eb' : '#334155' }}; background: {{ request()->routeIs('lien-he') ? '#eff6ff' : 'transparent' }};"><i class="fas fa-phone-alt" style="width:22px;"></i> Liên Hệ</a>
            </div>
        </div>
    </header>

    <!-- Main Dynamic Content -->
    <main>
        @yield('content')
    </main>

    <!-- Pre-Footer Market Guarantee Strip -->
    <div class="pub-trust-bar">
        <div class="container">
            <div class="pub-trust-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 0.9rem;">
                    <div style="width: 46px; height: 46px; border-radius: 12px; background: #dbeafe; color: #1d4ed8; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div>
                        <div style="font-weight: 800; font-size: 0.92rem; color: #0f172a;">100% Hồ Sơ Xác Thực</div>
                        <div style="font-size: 0.78rem; color: #64748b;">Kiểm duyệt bằng cấp & CCCD</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.9rem;">
                    <div style="width: 46px; height: 46px; border-radius: 12px; background: #dcfce7; color: #15803d; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div>
                        <div style="font-weight: 800; font-size: 0.92rem; color: #0f172a;">Học Thử 2 Buổi Đầu</div>
                        <div style="font-size: 0.78rem; color: #64748b;">Đánh giá sự phù hợp thực tế</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.9rem;">
                    <div style="width: 46px; height: 46px; border-radius: 12px; background: #fef3c7; color: #b45309; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div>
                        <div style="font-weight: 800; font-size: 0.92rem; color: #0f172a;">Đổi Gia Sư Miễn Phí</div>
                        <div style="font-size: 0.78rem; color: #64748b;">Nếu chưa hài lòng phương pháp</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.9rem;">
                    <div style="width: 46px; height: 46px; border-radius: 12px; background: #f3e8ff; color: #7e22ce; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div>
                        <div style="font-weight: 800; font-size: 0.92rem; color: #0f172a;">Tư Vấn Tận Tâm 24/7</div>
                        <div style="font-size: 0.78rem; color: #64748b;">Hỗ trợ nhanh trong 15 phút</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enterprise Public Footer -->
    <footer class="pub-footer">
        <div class="container">
            <div class="pub-footer-grid" style="display: grid; grid-template-columns: 1.8fr 1fr 1fr 1.4fr; gap: 2.5rem; margin-bottom: 3rem;">
                <div>
                    <div style="display: flex; align-items: center; gap: 0.6rem; font-size: 1.3rem; font-weight: 800; color: #ffffff; margin-bottom: 1rem;">
                        <i class="fas fa-graduation-cap" style="color: #3b82f6;"></i> Gia Sư Tri Thức
                    </div>
                    <p style="font-size: 0.9rem; color: #94a3b8; line-height: 1.7; margin-bottom: 1.2rem;">
                        Nền tảng kết nối trung tâm gia sư chuyên nghiệp hàng đầu. Mang đến giải pháp tìm gia sư giỏi, bài bản và hỗ trợ sinh viên, giáo viên nhận lớp dạy kèm uy tín toàn quốc.
                    </p>
                    <div style="display: flex; gap: 0.7rem;">
                        <a href="{{ route('lien-he') }}" title="Facebook" style="width:36px; height:36px; background:#1e293b; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ route('lien-he') }}" title="Youtube" style="width:36px; height:36px; background:#1e293b; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fab fa-youtube"></i></a>
                        <a href="{{ route('lien-he') }}" title="TikTok" style="width:36px; height:36px; background:#1e293b; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fab fa-tiktok"></i></a>
                        <a href="tel:0394688031" title="Gọi ngay" style="width:36px; height:36px; background:#2563eb; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fas fa-phone-alt"></i></a>
                    </div>
                </div>

                <div>
                    <h4>Dành Cho Phụ Huynh</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; line-height: 2.25; font-size: 0.9rem;">
                        <li><a href="{{ route('danh-sach-gia-su') }}">Tìm gia sư theo môn</a></li>
                        <li><a href="{{ route('home') }}#bang-gia-hoc-phi">Bảng giá học phí tham khảo</a></li>
                        <li><a href="{{ route('gioi-thieu') }}">Quy trình tuyển chọn gia sư</a></li>
                        <li><a href="{{ route('home') }}#cau-hoi-thuong-gap">Câu hỏi thường gặp (FAQ)</a></li>
                    </ul>
                </div>

                <div>
                    <h4>Dành Cho Gia Sư</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; line-height: 2.25; font-size: 0.9rem;">
                        <li><a href="{{ route('tuyen-gia-su') }}">Tuyển dụng gia sư</a></li>
                        <li><a href="{{ route('danh-sach-lop-hoc') }}">Danh sách lớp mới nhất</a></li>
                        <li><a href="{{ route('kinh-nghiem') }}">Góc kinh nghiệm & Cẩm nang</a></li>
                        <li><a href="{{ route('chinh-sach') }}">Chính sách & Khung học phí</a></li>
                    </ul>
                </div>

                <div>
                    <h4>Thông Tin Liên Hệ</h4>
                    <p style="font-size: 0.88rem; color: #94a3b8; line-height: 1.9; margin: 0;">
                        👨‍💼 <strong>Quản lý:</strong> Đào Bình Phước<br>
                        📍 <strong>Địa chỉ:</strong> Khu Đô Thị Đại Học, TP. Huế<br>
                        📞 <strong>Hotline / Zalo:</strong> <a href="tel:0394688031" style="color:#60a5fa; font-weight:700;">0394.688.031</a><br>
                        📧 <strong>Email:</strong> daophuoc240@gmail.com
                    </p>
                </div>
            </div>

            <div style="border-top: 1px solid #1e293b; padding-top: 1.6rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; font-size: 0.84rem; color: #64748b;">
                <div>© 2026 Gia Sư Tri Thức - Hệ Thống Kết Nối & Quản Lý Gia Sư Chuyên Nghiệp.</div>
                <div style="display: flex; gap: 1.2rem;">
                    <a href="{{ route('gioi-thieu') }}">Điều khoản sử dụng</a>
                    <a href="{{ route('lien-he') }}">Chính sách bảo mật</a>
                    <a href="{{ route('lien-he') }}">Hỗ trợ khách hàng</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Quick-Contact & Scroll Top -->
    <div class="floating-support">
        <button type="button" class="float-btn float-btn-top" id="scrollTopBtn" title="Lên đầu trang" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" style="display: none;">
            <i class="fas fa-arrow-up"></i>
        </button>
        <a href="tel:0394688031" class="float-btn float-btn-hotline" title="Gọi tư vấn miễn phí">
            <i class="fas fa-phone-alt"></i>
            <span>Tư vấn: 0394.688.031</span>
        </a>
    </div>

    <script src="{{ asset('js/dia-diem.js') }}"></script>
    <script>
        document.getElementById('pubMobileMenuBtn')?.addEventListener('click', function () {
            document.getElementById('pubMobileDrawer')?.classList.toggle('open');
        });
        window.addEventListener('scroll', function () {
            const btn = document.getElementById('scrollTopBtn');
            if (btn) {
                btn.style.display = window.scrollY > 350 ? 'inline-flex' : 'none';
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
