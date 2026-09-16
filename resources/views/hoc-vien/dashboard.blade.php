@extends('layouts.app')
@section('title', 'Dashboard Học Viên')
@section('page-title', 'Dashboard')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('hocvien.dashboard') }}" class="nav-link {{ request()->routeIs('hocvien.dashboard') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a></div>
<p class="nav-section-title">Tìm Gia Sư</p>
<div class="nav-item"><a href="{{ route('hocvien.tao-yeu-cau') }}" class="nav-link {{ request()->routeIs('hocvien.tao-yeu-cau') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-plus-circle"></i></span> Tạo Yêu Cầu Mới</a></div>
<div class="nav-item"><a href="{{ route('hocvien.danh-sach-lop') }}" class="nav-link {{ request()->routeIs('hocvien.danh-sach-lop') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-list"></i></span> Danh Sách Lớp</a></div>
@endsection
@section('content')
<div class="stat-cards" style="grid-template-columns:repeat(4,1fr);">
    <div class="stat-card glass-card">
        <div class="stat-card-icon purple"><i class="fas fa-book-open"></i></div>
        <div class="stat-card-value">{{ $stats['tong_lop'] }}</div>
        <div class="stat-card-label">Tổng lớp đã tạo</div>
    </div>
    <div class="stat-card glass-card">
        <div class="stat-card-icon orange"><i class="fas fa-search"></i></div>
        <div class="stat-card-value">{{ $stats['dang_tim'] }}</div>
        <div class="stat-card-label">Đang tìm gia sư</div>
    </div>
    <div class="stat-card glass-card">
        <div class="stat-card-icon blue"><i class="fas fa-check-circle"></i></div>
        <div class="stat-card-value">{{ $stats['da_co_gia_su'] }}</div>
        <div class="stat-card-label">Đã có gia sư</div>
    </div>
    <div class="stat-card glass-card">
        <div class="stat-card-icon red"><i class="fas fa-flag-checkered"></i></div>
        <div class="stat-card-value">{{ $stats['hoan_thanh'] }}</div>
        <div class="stat-card-label">Hoàn thành</div>
    </div>
</div>

<div class="glass-card" style="padding:1.5rem;">
    <div class="page-header" style="margin-bottom:1rem;">
        <h3 style="font-size:1rem; font-weight:700;">📋 Lớp Học Gần Đây</h3>
        <a href="{{ route('hocvien.tao-yeu-cau') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tạo yêu cầu mới</a>
    </div>
    @forelse($lop_hocs as $lop)
    <a href="{{ route('hocvien.chi-tiet-lop', $lop->id) }}" style="text-decoration:none;">
        <div style="padding:1rem; background:rgba(255,255,255,0.04); border-radius:var(--radius-sm); margin-bottom:0.75rem; border:1px solid rgba(255,255,255,0.06); display:flex; justify-content:space-between; align-items:center; transition:var(--transition);" onmouseover="this.style.background='rgba(255,255,255,0.08)'" onmouseout="this.style.background='rgba(255,255,255,0.04)'">
            <div>
                <div style="font-weight:600; color:var(--text-primary);">{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}</div>
                <div style="font-size:0.78rem; color:var(--text-muted);">📍 {{ $lop->dia_chi_day }} • 💰 {{ number_format($lop->muc_hoc_phi) }}đ/buổi</div>
            </div>
            <span class="badge badge-{{ $lop->trang_thai_class }}">{{ $lop->trang_thai_label }}</span>
        </div>
    </a>
    @empty
    <div class="empty-state" style="padding:2rem;">
        <div class="empty-state-icon">📚</div>
        <h4>Chưa có lớp học nào</h4>
        <p><a href="{{ route('hocvien.tao-yeu-cau') }}" style="color:var(--primary-start);">Tạo yêu cầu tìm gia sư ngay →</a></p>
    </div>
    @endforelse
</div>
@endsection
