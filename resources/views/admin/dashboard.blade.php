@extends('layouts.app')

@section('title', 'Dashboard - Quản Trị Viên')
@section('page-title', 'Dashboard Tổng Quan')

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
        @if(isset($stats) && $stats['ho_so_cho_duyet'] > 0)
            <span class="nav-badge">{{ $stats['ho_so_cho_duyet'] }}</span>
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
{{-- STATS ROW --}}
<div class="stat-cards">
    <div class="stat-card glass-card">
        <div class="stat-card-icon purple"><i class="fas fa-users"></i></div>
        <div class="stat-card-value">{{ $stats['tong_tai_khoan'] }}</div>
        <div class="stat-card-label">Tổng tài khoản</div>
    </div>
    <div class="stat-card glass-card">
        <div class="stat-card-icon blue"><i class="fas fa-chalkboard-teacher"></i></div>
        <div class="stat-card-value">{{ $stats['tong_gia_su'] }}</div>
        <div class="stat-card-label">Gia sư đã đăng ký</div>
    </div>
    <div class="stat-card glass-card">
        <div class="stat-card-icon orange"><i class="fas fa-user-graduate"></i></div>
        <div class="stat-card-value">{{ $stats['tong_hoc_vien'] }}</div>
        <div class="stat-card-label">Học viên / Phụ huynh</div>
    </div>
    <div class="stat-card glass-card">
        <div class="stat-card-icon red"><i class="fas fa-clock"></i></div>
        <div class="stat-card-value">{{ $stats['ho_so_cho_duyet'] }}</div>
        <div class="stat-card-label">Hồ sơ chờ duyệt</div>
    </div>
    <div class="stat-card glass-card">
        <div class="stat-card-icon orange"><i class="fas fa-search"></i></div>
        <div class="stat-card-value">{{ $stats['lop_dang_tim'] }}</div>
        <div class="stat-card-label">Lớp đang tìm gia sư</div>
    </div>
    <div class="stat-card glass-card">
        <div class="stat-card-icon blue"><i class="fas fa-check-circle"></i></div>
        <div class="stat-card-value">{{ $stats['lop_da_co_gia_su'] }}</div>
        <div class="stat-card-label">Lớp đã có gia sư</div>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; flex-wrap:wrap;">
    {{-- Lớp mới nhất --}}
    <div class="glass-card" style="padding:1.5rem;">
        <div class="page-header" style="margin-bottom:1rem;">
            <div>
                <h3 style="font-size:1rem; font-weight:700;">📋 Lớp Học Mới Nhất</h3>
                <p style="font-size:0.8rem; color:var(--text-muted);">5 lớp gần nhất</p>
            </div>
            <a href="{{ route('admin.lop-hoc.index') }}" class="btn btn-outline btn-sm">Xem tất cả</a>
        </div>
        @forelse($lop_moi_nhat as $lop)
        <div style="padding:0.8rem 0; border-bottom:1px solid rgba(255,255,255,0.06); display:flex; justify-content:space-between; align-items:center;">
            <div>
                <div style="font-size:0.9rem; font-weight:600; color:var(--text-primary);">{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}</div>
                <div style="font-size:0.78rem; color:var(--text-muted);">{{ $lop->hocVien->ho_ten }}</div>
            </div>
            <span class="badge badge-{{ $lop->trang_thai === 'dang_tim' ? 'warning' : 'success' }}">
                {{ $lop->trang_thai_label }}
            </span>
        </div>
        @empty
        <div class="empty-state" style="padding:1.5rem;">
            <div class="empty-state-icon">📭</div>
            <p>Chưa có lớp học nào</p>
        </div>
        @endforelse
    </div>

    {{-- Hồ sơ chờ duyệt --}}
    <div class="glass-card" style="padding:1.5rem;">
        <div class="page-header" style="margin-bottom:1rem;">
            <div>
                <h3 style="font-size:1rem; font-weight:700;">👤 Hồ Sơ Chờ Duyệt</h3>
                <p style="font-size:0.8rem; color:var(--text-muted);">Cần xem xét ngay</p>
            </div>
            <a href="{{ route('admin.ho-so.index') }}" class="btn btn-outline btn-sm">Xem tất cả</a>
        </div>
        @forelse($ho_so_moi as $hs)
        <div style="padding:0.8rem 0; border-bottom:1px solid rgba(255,255,255,0.06); display:flex; justify-content:space-between; align-items:center;">
            <div>
                <div style="font-size:0.9rem; font-weight:600; color:var(--text-primary);">{{ $hs->taiKhoan->ho_ten }}</div>
                <div style="font-size:0.78rem; color:var(--text-muted);">{{ $hs->chuyen_nganh }} • {{ $hs->truong_hoc }}</div>
            </div>
            <a href="{{ route('admin.ho-so.chi-tiet', $hs->id) }}" class="btn btn-primary btn-sm">Xem</a>
        </div>
        @empty
        <div class="empty-state" style="padding:1.5rem;">
            <div class="empty-state-icon">✅</div>
            <p>Không có hồ sơ chờ duyệt</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
