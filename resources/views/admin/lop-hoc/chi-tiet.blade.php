@extends('layouts.app')
@section('title', 'Chi Tiết Lớp Học - Admin')
@section('page-title', 'Chi Tiết Lớp Học')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-line"></i></span> Dashboard</a></div>
<p class="nav-section-title">Quản Lý</p>
<div class="nav-item"><a href="{{ route('admin.tai-khoan.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản</a></div>
<div class="nav-item"><a href="{{ route('admin.ho-so.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư</a></div>
<div class="nav-item"><a href="{{ route('admin.lop-hoc.index') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span> Lớp Học</a></div>
@endsection
@section('content')
<div class="page-header">
    <a href="{{ route('admin.lop-hoc.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại</a>
    <div style="display:flex; gap:0.75rem;">
        <a href="{{ route('admin.lop-hoc.sua', $lop->id) }}" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i> Sửa</a>
        @if($lop->trang_thai === 'dang_tim')
        <a href="{{ route('admin.lop-hoc.phan-cong', $lop->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-user-check"></i> Phân Công</a>
        @endif
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
    <div class="glass-card" style="padding:1.5rem;">
        <h3 style="font-size:1rem; font-weight:700; margin-bottom:1.2rem;">📋 Thông Tin Lớp</h3>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Môn Học</span><br><strong style="font-size:1.1rem;">{{ $lop->mon_hoc }}</strong></div>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Khối Lớp</span><br>{{ $lop->khoi_lop }}</div>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Số Buổi / Tuần</span><br>{{ $lop->so_buoi_tuan }} buổi</div>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Địa Chỉ Dạy</span><br>{{ $lop->dia_chi_day }}</div>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Học Phí</span><br><strong style="color:#fda085; font-size:1.1rem;">{{ number_format($lop->muc_hoc_phi) }}đ/buổi</strong></div>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Trạng Thái</span><br><span class="badge badge-{{ $lop->trang_thai_class }}">{{ $lop->trang_thai_label }}</span></div>
        @if($lop->yeu_cau_them)
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Yêu Cầu Thêm</span><br><em>{{ $lop->yeu_cau_them }}</em></div>
        @endif
    </div>

    <div>
        <div class="glass-card" style="padding:1.5rem; margin-bottom:1rem;">
            <h3 style="font-size:1rem; font-weight:700; margin-bottom:1rem;">👤 Học Viên</h3>
            <div style="font-weight:700;">{{ $lop->hocVien->ho_ten }}</div>
            <div style="font-size:0.85rem; color:var(--text-muted);">{{ $lop->hocVien->email }}</div>
            <div style="font-size:0.85rem; color:var(--text-muted);">{{ $lop->hocVien->so_dien_thoai }}</div>
        </div>

        @if($lop->giaSu)
        <div class="glass-card" style="padding:1.5rem; background:rgba(79,172,254,0.08); border-color:rgba(79,172,254,0.2);">
            <h3 style="font-size:1rem; font-weight:700; margin-bottom:1rem; color:#4facfe;">✅ Gia Sư Phụ Trách</h3>
            <div style="font-weight:700;">{{ $lop->giaSu->ho_ten }}</div>
            <div style="font-size:0.85rem; color:var(--text-muted);">{{ $lop->giaSu->email }}</div>
            <div style="font-size:0.85rem; color:var(--text-muted);">{{ $lop->giaSu->so_dien_thoai }}</div>
        </div>
        @endif

        <div class="glass-card" style="padding:1.5rem; margin-top:1rem;">
            <h3 style="font-size:1rem; font-weight:700; margin-bottom:1rem;">📝 Lịch Sử Đăng Ký ({{ $lop->dangKyNhanLops->count() }})</h3>
            @forelse($lop->dangKyNhanLops as $dk)
            <div style="padding:0.6rem 0; border-bottom:1px solid rgba(255,255,255,0.06); display:flex; justify-content:space-between;">
                <div>
                    <div style="font-weight:600; font-size:0.9rem;">{{ $dk->giaSu->ho_ten }}</div>
                    <div style="font-size:0.75rem; color:var(--text-muted);">{{ $dk->created_at->format('d/m/Y') }}</div>
                </div>
                <span class="badge {{ $dk->trang_thai === 'da_duyet' ? 'badge-success' : ($dk->trang_thai === 'tu_choi' ? 'badge-danger' : 'badge-warning') }}">
                    {{ $dk->trang_thai_label }}
                </span>
            </div>
            @empty
            <p style="color:var(--text-muted); font-size:0.85rem;">Chưa có đăng ký nào.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
