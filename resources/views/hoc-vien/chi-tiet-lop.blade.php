@extends('layouts.app')
@section('title', 'Chi Tiết Lớp Học')
@section('page-title', 'Chi Tiết Lớp Học')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('hocvien.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a></div>
<p class="nav-section-title">Tìm Gia Sư</p>
<div class="nav-item"><a href="{{ route('hocvien.tao-yeu-cau') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-plus-circle"></i></span> Tạo Yêu Cầu Mới</a></div>
<div class="nav-item"><a href="{{ route('hocvien.danh-sach-lop') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-list"></i></span> Danh Sách Lớp</a></div>
@endsection
@section('content')
<div class="page-header">
    <a href="{{ route('hocvien.danh-sach-lop') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại</a>
</div>

<div style="display:grid; grid-template-columns:1.2fr 1fr; gap:1.5rem;">
    {{-- Thông tin lớp --}}
    <div class="glass-card" style="padding:1.5rem;">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1.5rem;">
            <h3 style="font-size:1.1rem; font-weight:700;">📋 Thông Tin Lớp</h3>
            <span class="badge badge-{{ $lop->trang_thai_class }}" style="font-size:0.88rem; padding:0.4rem 0.9rem;">{{ $lop->trang_thai_label }}</span>
        </div>
        <div style="margin-bottom:1rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Môn Học</span><br><strong style="font-size:1.1rem;">{{ $lop->mon_hoc }}</strong></div>
        <div style="margin-bottom:1rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Khối Lớp</span><br><strong>{{ $lop->khoi_lop }}</strong></div>
        <div style="margin-bottom:1rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Số Buổi / Tuần</span><br>{{ $lop->so_buoi_tuan }} buổi</div>
        <div style="margin-bottom:1rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Địa Chỉ Dạy</span><br>{{ $lop->dia_chi_day }}</div>
        <div style="margin-bottom:1rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Mức Học Phí</span><br><strong style="color:#fda085; font-size:1.1rem;">{{ number_format($lop->muc_hoc_phi) }}đ/buổi</strong></div>
        @if($lop->yeu_cau_them)
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Yêu Cầu Thêm</span><br><em style="font-size:0.9rem;">{{ $lop->yeu_cau_them }}</em></div>
        @endif
        <div class="divider"></div>
        <div style="font-size:0.78rem; color:var(--text-muted);">Tạo lúc: {{ $lop->created_at->format('d/m/Y H:i') }}</div>
    </div>

    {{-- Thông tin gia sư / ứng viên --}}
    <div>
        @if($lop->trang_thai === 'da_co_gia_su' && $lop->giaSu)
        <div class="glass-card" style="padding:1.5rem; margin-bottom:1rem; background:rgba(79,172,254,0.08); border-color:rgba(79,172,254,0.2);">
            <h3 style="font-size:1rem; font-weight:700; margin-bottom:1rem; color:#4facfe;">✅ Gia Sư Được Phân Công</h3>
            <div style="margin-bottom:0.6rem; font-weight:700; font-size:1.05rem;">{{ $lop->giaSu->ho_ten }}</div>
            <div style="font-size:0.85rem; color:var(--text-secondary);">📧 {{ $lop->giaSu->email }}</div>
            <div style="font-size:0.85rem; color:var(--text-secondary);">📞 {{ $lop->giaSu->so_dien_thoai }}</div>
            @if($lop->giaSu->hoSoGiaSu)
            <div class="divider"></div>
            <div style="font-size:0.85rem; color:var(--text-secondary);">🎓 {{ $lop->giaSu->hoSoGiaSu->truong_hoc }}</div>
            <div style="font-size:0.85rem; color:var(--text-secondary);">📚 {{ $lop->giaSu->hoSoGiaSu->chuyen_nganh }}</div>
            @endif
        </div>
        @elseif($lop->trang_thai === 'dang_tim')
        <div class="glass-card" style="padding:1.5rem; margin-bottom:1rem;">
            <h3 style="font-size:1rem; font-weight:700; margin-bottom:1rem;">👨‍🏫 Gia Sư Đã Đăng Ký ({{ $lop->dangKyNhanLops->count() }})</h3>
            @forelse($lop->dangKyNhanLops as $dk)
            <div style="padding:0.7rem 0; border-bottom:1px solid rgba(255,255,255,0.06);">
                <div style="font-weight:600; color:var(--text-primary);">{{ $dk->giaSu->ho_ten }}</div>
                <div style="font-size:0.78rem; color:var(--text-muted);">Đăng ký: {{ $dk->created_at->format('d/m/Y') }}</div>
            </div>
            @empty
            <div class="empty-state" style="padding:1rem;">
                <div class="empty-state-icon">👨‍🏫</div>
                <p>Chưa có gia sư đăng ký</p>
            </div>
            @endforelse
        </div>

        <form method="POST" action="{{ route('hocvien.huy-lop', $lop->id) }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Bạn chắc chắn muốn hủy yêu cầu này?')">
                <i class="fas fa-times"></i> Hủy Yêu Cầu
            </button>
        </form>
        @endif
    </div>
</div>
@endsection
