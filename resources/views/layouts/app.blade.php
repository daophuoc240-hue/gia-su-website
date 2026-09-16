<!DOCTYPE html>
<html lang="vi" style="color-scheme: light !important;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Website Kết Nối Trung Tâm Gia Sư - Hệ thống quản lý và kết nối gia sư chuyên nghiệp">
    <title>@yield('title', 'Hệ Thống Gia Sư') | Gia Sư Tri Thức</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @stack('styles')
</head>
<body style="background-color: #f8fafc !important; color: #0f172a !important; margin:0; padding:0;">
<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">🎓</div>
            <div class="brand-name">Gia Sư Tri Thức</div>
            <div class="brand-role">
                @auth
                    @if(auth()->user()->vai_tro === 'admin') Quản Trị Viên
                    @elseif(auth()->user()->vai_tro === 'giasu') Gia Sư
                    @else Học Viên / Phụ Huynh
                    @endif
                @endauth
            </div>
        </div>

        <nav class="sidebar-nav">
            @yield('sidebar-nav')
        </nav>

        <div class="sidebar-footer">
            <div style="display:flex; align-items:center; gap:0.8rem; margin-bottom:0.8rem; padding:0.6rem; background:#f8fafc; border-radius:10px; border:1px solid #e2e8f0;">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" alt="Avatar" style="width:36px; height:36px; border-radius:50%; object-fit:cover;">
                <div style="overflow:hidden;">
                    <div style="font-weight:700; font-size:0.85rem; color:#0f172a; white-space:nowrap; text-overflow:ellipsis; overflow:hidden;">{{ auth()->user()->ho_ten ?? 'Người Dùng' }}</div>
                    <div style="font-size:0.72rem; color:#64748b;">{{ auth()->user()->email ?? '' }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline btn-block btn-sm" style="color:#ef4444; border-color:#fca5a5; background:#fff;">
                    <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <header class="topbar">
            <div style="display:flex; align-items:center; gap:1rem;">
                <button class="btn btn-outline btn-sm d-md-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                    <div style="font-size:0.78rem; color:#64748b;">Hệ thống Kết nối & Quản lý Gia sư Chuyên nghiệp</div>
                </div>
            </div>
            <div class="topbar-actions">
                @auth
                <div style="display:flex; align-items:center; gap:0.8rem; background:#f1f5f9; padding:0.4rem 0.9rem; border-radius:20px; border:1px solid #e2e8f0;">
                    <span style="font-size:0.82rem; font-weight:700; color:#2563eb;">🟢 Đang hoạt động</span>
                    <span style="font-size:0.82rem; color:#475569;">{{ auth()->user()->ho_ten }}</span>
                </div>
                @endauth
            </div>
        </header>

        <div class="page-content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ session('warning') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script>
document.getElementById('sidebarToggle')?.addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('open');
});
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => {
        el.style.transition = 'opacity 0.5s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 500);
    });
}, 5000);
</script>
@stack('scripts')
</body>
</html>