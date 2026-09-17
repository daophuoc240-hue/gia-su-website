@extends('layouts.app')
@section('title', 'Phân Công Lớp')
@section('page-title', 'Phân Công Gia Sư')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-line"></i></span> Tổng Quan</a></div>
<p class="nav-section-title">Quản Lý</p>
<div class="nav-item"><a href="{{ route('admin.tai-khoan.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản</a></div>
<div class="nav-item"><a href="{{ route('admin.ho-so.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư</a></div>
<div class="nav-item"><a href="{{ route('admin.lop-hoc.index') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span> Lớp Học</a></div>
@endsection
@section('content')
<div class="page-header">
    <a href="{{ route('admin.lop-hoc.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại</a>
</div>

{{-- Thông tin lớp --}}
<div class="glass-card" style="padding:1.5rem; margin-bottom:1.5rem;">
    <h3 style="font-size:1rem; font-weight:700; margin-bottom:1rem;">📋 Thông Tin Lớp Học</h3>
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:1rem;">
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Môn học</span><br><strong>{{ $lop->mon_hoc }}</strong></div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Khối lớp</span><br><strong>{{ $lop->khoi_lop }}</strong></div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Số buổi/tuần</span><br><strong>{{ $lop->so_buoi_tuan }} buổi</strong></div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Địa chỉ dạy</span><br>{{ $lop->dia_chi_day }}</div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Học phí</span><br><strong style="color:#fda085;">{{ number_format($lop->muc_hoc_phi) }}đ/buổi</strong></div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Học viên</span><br>{{ $lop->hocVien->ho_ten }}</div>
    </div>
</div>

{{-- Danh sách gia sư đăng ký --}}
<div class="glass-card" style="padding:1.5rem;">
    <h3 style="font-size:1rem; font-weight:700; margin-bottom:1rem;">👨‍🏫 Gia Sư Đăng Ký Nhận Lớp ({{ $dang_kys->count() }})</h3>

    @forelse($dang_kys as $dk)
    <div style="padding:1.2rem; background:rgba(255,255,255,0.04); border-radius:var(--radius-sm); border:1px solid rgba(255,255,255,0.08); margin-bottom:1rem;">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:1rem;">
            <div style="flex:1;">
                <div style="font-size:1rem; font-weight:700; color:var(--text-primary); margin-bottom:0.5rem;">{{ $dk->giaSu->ho_ten }}</div>
                <div style="font-size:0.85rem; color:var(--text-secondary); margin-bottom:0.3rem;">
                    📧 {{ $dk->giaSu->email }} • 📞 {{ $dk->giaSu->so_dien_thoai }}
                </div>
                @if($dk->giaSu->hoSoGiaSu)
                <div style="font-size:0.85rem; color:var(--text-secondary); margin-bottom:0.3rem;">
                    🎓 {{ $dk->giaSu->hoSoGiaSu->truong_hoc }} - {{ $dk->giaSu->hoSoGiaSu->chuyen_nganh }}
                </div>
                <div style="font-size:0.85rem; color:var(--text-secondary); margin-bottom:0.3rem;">
                    📍 Khu vực: {{ $dk->giaSu->hoSoGiaSu->khu_vuc_nhan_day }}
                </div>
                @endif
                @if($dk->gioi_thieu_ban_than)
                <div style="margin-top:0.5rem; padding:0.6rem; background:rgba(102,126,234,0.08); border-radius:var(--radius-sm);">
                    <p style="font-size:0.85rem; color:var(--text-secondary); font-style:italic;">{{ $dk->gioi_thieu_ban_than }}</p>
                </div>
                @endif
                <div style="margin-top:0.5rem; font-size:0.78rem; color:var(--text-muted);">
                    Đăng ký lúc: {{ $dk->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
            <form method="POST" action="{{ route('admin.lop-hoc.xac-nhan-phan-cong', $lop->id) }}">
                @csrf
                <input type="hidden" name="dang_ky_id" value="{{ $dk->id }}">
                <button type="submit" class="btn btn-success" onclick="return confirm('Phân công {{ $dk->giaSu->ho_ten }} cho lớp này?')">
                    <i class="fas fa-user-check"></i> Chọn Gia Sư Này
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="empty-state-icon">👨‍🏫</div>
        <h4>Chưa có gia sư đăng ký nhận lớp này</h4>
        <p>Lớp đang chờ gia sư đăng ký</p>
    </div>
    @endforelse
</div>
@endsection
