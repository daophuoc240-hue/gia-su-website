@extends('layouts.app')
@section('title', 'Chi Tiết Hồ Sơ')
@section('page-title', 'Chi Tiết Hồ Sơ Gia Sư')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-line"></i></span> Tổng Quan</a></div>
<p class="nav-section-title">Quản Lý</p>
<div class="nav-item"><a href="{{ route('admin.tai-khoan.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản</a></div>
<div class="nav-item"><a href="{{ route('admin.ho-so.index') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư</a></div>
<div class="nav-item"><a href="{{ route('admin.lop-hoc.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span> Lớp Học</a></div>
@endsection
@section('content')
<div class="page-header">
    <a href="{{ route('admin.ho-so.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại</a>
</div>
<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
    <div class="glass-card" style="padding:1.5rem;">
        <h3 style="font-size:1rem; font-weight:700; margin-bottom:1.2rem;">👤 Thông Tin Gia Sư</h3>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.82rem;">Họ Tên</span><br><strong>{{ $ho_so->taiKhoan->ho_ten }}</strong></div>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.82rem;">Email</span><br>{{ $ho_so->taiKhoan->email }}</div>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.82rem;">Số Điện Thoại</span><br>{{ $ho_so->taiKhoan->so_dien_thoai ?? 'Chưa cập nhật' }}</div>
        <div class="divider"></div>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.82rem;">Trường Học</span><br><strong>{{ $ho_so->truong_hoc }}</strong></div>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.82rem;">Chuyên Ngành</span><br>{{ $ho_so->chuyen_nganh }}</div>
        <div style="margin-bottom:0.8rem;"><span style="color:var(--text-muted); font-size:0.82rem;">Khu Vực Nhận Dạy</span><br>{{ $ho_so->khu_vuc_nhan_day }}</div>
        <div><span style="color:var(--text-muted); font-size:0.82rem;">Kinh Nghiệm</span><br><p style="margin-top:0.3rem; font-size:0.9rem;">{{ $ho_so->kinh_nghiem }}</p></div>
    </div>
    <div>
        <div class="glass-card" style="padding:1.5rem; margin-bottom:1rem;">
            <h3 style="font-size:1rem; font-weight:700; margin-bottom:1rem;">📄 Trạng Thái Hồ Sơ</h3>
            @if($ho_so->trang_thai_duyet === 'cho_duyet')
                <span class="badge badge-warning" style="font-size:0.9rem; padding:0.5rem 1rem;">⏳ Đang chờ kiểm duyệt</span>
            @elseif($ho_so->trang_thai_duyet === 'da_duyet')
                <span class="badge badge-success" style="font-size:0.9rem; padding:0.5rem 1rem;">✅ Đã được duyệt</span>
            @else
                <span class="badge badge-danger" style="font-size:0.9rem; padding:0.5rem 1rem;">❌ Đã từ chối</span>
                @if($ho_so->ly_do_tu_choi)
                <div style="margin-top:1rem; padding:0.8rem; background:rgba(245,87,108,0.1); border-radius:var(--radius-sm); border:1px solid rgba(245,87,108,0.2);">
                    <p style="font-size:0.85rem; color:#f5576c;"><strong>Lý do:</strong> {{ $ho_so->ly_do_tu_choi }}</p>
                </div>
                @endif
            @endif
        </div>
        @if($ho_so->trang_thai_duyet === 'cho_duyet')
        <div class="glass-card" style="padding:1.5rem;">
            <h3 style="font-size:1rem; font-weight:700; margin-bottom:1rem;">⚡ Hành Động</h3>
            <form method="POST" action="{{ route('admin.ho-so.duyet', $ho_so->id) }}" style="margin-bottom:0.75rem;">
                @csrf
                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> ✅ Duyệt Hồ Sơ</button>
            </form>
            <form method="POST" action="{{ route('admin.ho-so.tu-choi', $ho_so->id) }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Lý do từ chối (bắt buộc)</label>
                    <textarea name="ly_do" class="form-control" rows="3" placeholder="Nhập lý do từ chối..." required></textarea>
                </div>
                <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-times"></i> ❌ Từ Chối Hồ Sơ</button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
