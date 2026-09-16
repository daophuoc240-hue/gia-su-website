@extends('layouts.app')
@section('title', 'Dashboard Quản Trị Viên')
@section('page-title', 'Dashboard Quản Trị')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item">
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-chart-line"></i></span> Dashboard
    </a>
</div>
<p class="nav-section-title">Quản Lý</p>
<div class="nav-item">
    <a href="{{ route('admin.tai-khoan.index') }}" class="nav-link {{ request()->routeIs('admin.tai-khoan*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('admin.ho-so.index') }}" class="nav-link {{ request()->routeIs('admin.ho-so*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư
        @if(isset() && ['ho_so_cho_duyet'] > 0)
            <span class="nav-badge">{{ ['ho_so_cho_duyet'] }}</span>
        @endif
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('admin.lop-hoc.index') }}" class="nav-link {{ request()->routeIs('admin.lop-hoc*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span> Lớp Học
    </a>
</div>
@endsection

@section('content')
<!-- Welcome Banner Card -->
<div style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%); border-radius: 20px; padding: 2rem 2.2rem; color: #ffffff; margin-bottom: 2rem; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.25);">
    <div style="position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.15); padding: 0.35rem 0.9rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700; margin-bottom: 0.8rem; border: 1px solid rgba(255,255,255,0.25);">
                👑 QUẢN TRỊ VIÊN HỆ THỐNG
            </div>
            <h2 style="font-size: 1.6rem; font-weight: 800; margin-bottom: 0.4rem;">Tổng Quan Điều Hành Hệ Thống</h2>
            <p style="font-size: 0.95rem; color: rgba(255,255,255,0.85); max-width: 600px;">
                Quản lý người dùng, kiểm duyệt hồ sơ gia sư và điều phối phân công lớp học trên toàn bộ trung tâm.
            </p>
        </div>
        <div style="display: flex; gap: 0.8rem;">
            <a href="{{ route('admin.ho-so.index') }}" class="btn" style="background: #2563eb !important; color: #ffffff !important; font-weight: 800; padding: 0.85rem 1.4rem; border-radius: 12px;">
                <i class="fas fa-user-check" style="margin-right: 0.4rem;"></i> Duyệt Hồ Sơ ({{ ['ho_so_cho_duyet'] }})
            </a>
        </div>
    </div>
</div>

{{-- 6 Stat Cards Grid --}}
<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-card-icon purple"><i class="fas fa-users"></i></div>
        <div>
            <div class="stat-card-value">{{ ['tong_tai_khoan'] }}</div>
            <div class="stat-card-label">Tổng tài khoản</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon blue"><i class="fas fa-chalkboard-teacher"></i></div>
        <div>
            <div class="stat-card-value">{{ ['tong_gia_su'] }}</div>
            <div class="stat-card-label">Gia sư đã đăng ký</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon orange"><i class="fas fa-user-graduate"></i></div>
        <div>
            <div class="stat-card-value">{{ ['tong_hoc_vien'] }}</div>
            <div class="stat-card-label">Học viên / Phụ huynh</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon red"><i class="fas fa-clock"></i></div>
        <div>
            <div class="stat-card-value">{{ ['ho_so_cho_duyet'] }}</div>
            <div class="stat-card-label">Hồ sơ chờ duyệt</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon orange"><i class="fas fa-search"></i></div>
        <div>
            <div class="stat-card-value">{{ ['lop_dang_tim'] }}</div>
            <div class="stat-card-label">Lớp đang tìm gia sư</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon green"><i class="fas fa-check-circle"></i></div>
        <div>
            <div class="stat-card-value">{{ ['lop_da_co_gia_su'] }}</div>
            <div class="stat-card-label">Lớp đã ghép thành công</div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
    {{-- Lớp mới nhất --}}
    <div class="glass-card" style="padding: 1.8rem;">
        <div class="page-header" style="margin-bottom: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
            <div>
                <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a;">📋 Lớp Học Mới Nhất</h3>
                <p style="font-size: 0.82rem; color: #64748b;">Các lớp vừa được yêu cầu</p>
            </div>
            <a href="{{ route('admin.lop-hoc.index') }}" class="btn btn-outline btn-sm">Xem tất cả</a>
        </div>
        @forelse( as )
        <div style="padding: 0.9rem 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">{{ ->mon_hoc }} - {{ ->khoi_lop }}</div>
                <div style="font-size: 0.82rem; color: #64748b;">Học viên: {{ ->hocVien->ho_ten }} • {{ number_format(->muc_hoc_phi) }} đ/buổi</div>
            </div>
            <span class="badge badge-{{ ->trang_thai === 'dang_tim' ? 'warning' : 'success' }}">
                {{ ->trang_thai_label }}
            </span>
        </div>
        @empty
        <div class="empty-state" style="padding: 2rem;">
            <div class="empty-state-icon">📭</div>
            <p>Chưa có lớp học nào</p>
        </div>
        @endforelse
    </div>

    {{-- Hồ sơ chờ duyệt --}}
    <div class="glass-card" style="padding: 1.8rem;">
        <div class="page-header" style="margin-bottom: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
            <div>
                <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a;">👤 Hồ Sơ Gia Sư Chờ Duyệt</h3>
                <p style="font-size: 0.82rem; color: #64748b;">Cần xem xét phê duyệt ngay</p>
            </div>
            <a href="{{ route('admin.ho-so.index') }}" class="btn btn-outline btn-sm">Xem tất cả</a>
        </div>
        @forelse( as )
        <div style="padding: 0.9rem 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">{{ ->taiKhoan->ho_ten }}</div>
                <div style="font-size: 0.82rem; color: #64748b;">{{ ->chuyen_nganh }} • {{ ->truong_hoc }}</div>
            </div>
            <a href="{{ route('admin.ho-so.chi-tiet', ->id) }}" class="btn btn-primary btn-sm">Duyệt ngay</a>
        </div>
        @empty
        <div class="empty-state" style="padding: 2rem;">
            <div class="empty-state-icon" style="font-size: 2.5rem;">✅</div>
            <h4 style="font-size: 1rem;">Không có hồ sơ chờ duyệt</h4>
            <p style="font-size: 0.82rem;">Tất cả hồ sơ gia sư đã được xử lý xong!</p>
        </div>
        @endforelse
    </div>
</div>
@endsection