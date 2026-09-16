@extends('layouts.app')
@section('title', 'Dashboard Gia Sư')
@section('page-title', 'Dashboard')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link {{ request()->routeIs('giasu.dashboard') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a></div>
<p class="nav-section-title">Hồ Sơ & Lớp Học</p>
<div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link {{ request()->routeIs('giasu.ho-so*') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
<div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link {{ request()->routeIs('giasu.tim-kiem-lop') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
<div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link {{ request()->routeIs('giasu.ket-qua') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@endsection
@section('content')
{{-- Thông báo hồ sơ --}}
@if(!$ho_so)
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle"></i>
    <span>Bạn chưa có hồ sơ gia sư. <a href="{{ route('giasu.ho-so') }}" style="color:#fda085; font-weight:600;">Cập nhật ngay →</a></span>
</div>
@elseif($ho_so->trang_thai_duyet === 'cho_duyet')
<div class="alert alert-warning">
    <i class="fas fa-clock"></i>
    <span>Hồ sơ của bạn đang chờ trung tâm kiểm duyệt. Bạn sẽ có thể đăng ký lớp sau khi được phê duyệt.</span>
</div>
@elseif($ho_so->trang_thai_duyet === 'tu_choi')
<div class="alert alert-error">
    <i class="fas fa-times-circle"></i>
    <span>Hồ sơ của bạn đã bị từ chối. Lý do: {{ $ho_so->ly_do_tu_choi }}. <a href="{{ route('giasu.ho-so') }}" style="color:#f5576c; font-weight:600;">Cập nhật lại →</a></span>
</div>
@else
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i>
    <span>Hồ sơ của bạn đã được phê duyệt! Bạn có thể đăng ký nhận lớp.</span>
</div>
@endif

{{-- Stats --}}
<div class="stat-cards" style="grid-template-columns:repeat(3,1fr);">
    <div class="stat-card glass-card">
        <div class="stat-card-icon orange"><i class="fas fa-hourglass-half"></i></div>
        <div class="stat-card-value">{{ $stats['cho_duyet'] }}</div>
        <div class="stat-card-label">Đang chờ duyệt</div>
    </div>
    <div class="stat-card glass-card">
        <div class="stat-card-icon blue"><i class="fas fa-check-circle"></i></div>
        <div class="stat-card-value">{{ $stats['da_duyet'] }}</div>
        <div class="stat-card-label">Lớp đã nhận</div>
    </div>
    <div class="stat-card glass-card">
        <div class="stat-card-icon red"><i class="fas fa-times-circle"></i></div>
        <div class="stat-card-value">{{ $stats['tu_choi'] }}</div>
        <div class="stat-card-label">Bị từ chối</div>
    </div>
</div>

{{-- Đăng ký gần đây --}}
<div class="glass-card" style="padding:1.5rem;">
    <div class="page-header" style="margin-bottom:1rem;">
        <h3 style="font-size:1rem; font-weight:700;">📋 Đăng Ký Gần Đây</h3>
        <a href="{{ route('giasu.ket-qua') }}" class="btn btn-outline btn-sm">Xem tất cả</a>
    </div>
    @forelse($dang_ky as $dk)
    <div style="padding:0.9rem 0; border-bottom:1px solid rgba(255,255,255,0.06); display:flex; justify-content:space-between; align-items:center;">
        <div>
            <div style="font-weight:600; color:var(--text-primary);">{{ $dk->lopHoc->mon_hoc }} - {{ $dk->lopHoc->khoi_lop }}</div>
            <div style="font-size:0.78rem; color:var(--text-muted);">📍 {{ $dk->lopHoc->dia_chi_day }}</div>
        </div>
        <span class="badge {{ $dk->trang_thai === 'da_duyet' ? 'badge-success' : ($dk->trang_thai === 'tu_choi' ? 'badge-danger' : 'badge-warning') }}">
            {{ $dk->trang_thai_label }}
        </span>
    </div>
    @empty
    <div class="empty-state" style="padding:1.5rem;">
        <div class="empty-state-icon">📭</div>
        <h4>Chưa có đăng ký nào</h4>
        <p><a href="{{ route('giasu.tim-kiem-lop') }}" style="color:var(--primary-start);">Tìm lớp để đăng ký →</a></p>
    </div>
    @endforelse
</div>
@endsection
