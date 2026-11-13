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
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Lịch học</span><br><strong style="color:#2563eb;">🗓️ {{ $lop->thoi_gian_hoc ?: ($lop->so_buoi_tuan . ' buổi/tuần') }}</strong></div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Địa chỉ dạy</span><br>{{ $lop->dia_chi_day }}</div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Học phí</span><br><strong style="color:#fda085;">{{ $lop->hoc_phi_hien_thi }}</strong></div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Học viên</span><br>{{ $lop->hocVien->ho_ten }}</div>
    </div>
</div>

{{-- Thông báo nếu đang chờ gia sư xem lịch rảnh --}}
@if(isset($cho_xac_nhan) && $cho_xac_nhan->count() > 0)
<div class="glass-card" style="padding:1.2rem; margin-bottom:1.5rem; background:#fffdf5; border-left:4px solid #f59e0b;">
    <div style="font-weight:700; color:#b45309; margin-bottom:0.3rem;">
        ⏳ Đang chờ Gia sư xác nhận lịch rảnh:
    </div>
    @foreach($cho_xac_nhan as $cxn)
    <div style="font-size:0.88rem; color:#78350f;">
        • Học viên đã gửi yêu cầu tới Gia sư <strong>{{ $cxn->giaSu->ho_ten }}</strong>. Gia sư đang kiểm tra khung giờ học để xác nhận trước khi gửi lên Ban Quản Trị phê duyệt.
    </div>
    @endforeach
</div>
@endif

{{-- Danh sách gia sư đăng ký --}}
<div class="glass-card" style="padding:1.5rem;">
    <h3 style="font-size:1rem; font-weight:700; margin-bottom:1rem;">👨‍🏫 Danh Sách Gia Sư Sẵn Sàng Nhận Lớp ({{ $dang_kys->count() }})</h3>

    @forelse($dang_kys as $dk)
    <div style="padding:1.2rem; background:rgba(255,255,255,0.04); border-radius:var(--radius-sm); border:1px solid rgba(255,255,255,0.08); margin-bottom:1rem;">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:1rem;">
            <div style="flex:1;">
                <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:0.5rem; flex-wrap:wrap;">
                    <div style="font-size:1rem; font-weight:700; color:var(--text-primary);">{{ $dk->giaSu->ho_ten }}</div>
                    @if($dk->giaSu->hoSoGiaSu)
                    <span style="font-size:0.78rem; font-weight:700; color:#d97706; background:#fffbeb; padding:2px 8px; border-radius:10px; border:1px solid #fef3c7;">
                        ⭐ {{ number_format($dk->giaSu->hoSoGiaSu->diem_trung_binh, 1) }} ({{ $dk->giaSu->hoSoGiaSu->so_luot_danh_gia }} đánh giá)
                    </span>
                    @endif
                    @if(str_contains($dk->gioi_thieu_ban_than, 'xác nhận rảnh') || $lop->gia_su_id === $dk->gia_su_id)
                    <span style="background:#dcfce7; color:#15803d; font-size:0.75rem; font-weight:700; padding:2px 8px; border-radius:10px; border:1px solid #bbf7d0;">
                        ✓ Gia sư đã xác nhận rảnh & sẵn sàng nhận lớp
                    </span>
                    @endif
                </div>
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
