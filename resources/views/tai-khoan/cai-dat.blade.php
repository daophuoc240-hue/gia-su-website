@extends('layouts.app')
@section('title', 'Cài Đặt Tài Khoản')
@section('page-title', 'Cài Đặt & Bảo Mật Tài Khoản')

@section('sidebar-nav')
<p class="nav-section-title">Điều Hướng</p>
@if(auth()->user()->vai_tro === 'admin')
    <div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-line"></i></span> Tổng Quan</a></div>
    <div class="nav-item"><a href="{{ route('admin.tai-khoan.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản</a></div>
    <div class="nav-item"><a href="{{ route('admin.ho-so.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư</a></div>
    <div class="nav-item"><a href="{{ route('admin.lop-hoc.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span> Lớp Học</a></div>
@elseif(auth()->user()->vai_tro === 'giasu')
    <div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
    <div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
    <div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
    <div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@else
    <div class="nav-item"><a href="{{ route('hocvien.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
    <div class="nav-item"><a href="{{ route('hocvien.tao-yeu-cau') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-plus-circle"></i></span> Tạo Yêu Cầu Mới</a></div>
    <div class="nav-item"><a href="{{ route('hocvien.danh-sach-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-list"></i></span> Danh Sách Lớp</a></div>
@endif
<div class="nav-item"><a href="{{ route('tai-khoan.cai-dat') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-cog"></i></span> Cài Đặt Tài Khoản</a></div>
@endsection

@section('content')
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: start;">

    {{-- Form 1: Cập nhật thông tin --}}
    <div class="glass-card" style="padding: 2.2rem; border-radius: 20px; background: #ffffff;">
        <div style="border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin-bottom: 0.3rem;">
                👤 Thông Tin Tài Khoản
            </h3>
            <p style="font-size: 0.85rem; color: #64748b; margin: 0;">Cập nhật họ tên và số điện thoại liên hệ của bạn</p>
        </div>

        <form method="POST" action="{{ route('tai-khoan.thong-tin') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email đăng nhập</label>
                <input type="email" class="form-control" value="{{ $user->email }}" disabled style="background:#f8fafc; color:#64748b; cursor:not-allowed;">
                <span style="font-size: 0.75rem; color: #94a3b8; margin-top: 4px; display: block;">Email cố định dùng để xác thực hệ thống.</span>
            </div>

            <div class="form-group">
                <label class="form-label">Họ và tên</label>
                <input type="text" name="ho_ten" class="form-control" value="{{ old('ho_ten', $user->ho_ten) }}" required>
                @error('ho_ten')<span class="error-msg">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Số điện thoại liên hệ</label>
                <input type="text" name="so_dien_thoai" class="form-control" value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}" placeholder="Ví dụ: 0901234567">
                @error('so_dien_thoai')<span class="error-msg">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom: 1.8rem;">
                <label class="form-label">Vai trò trong hệ thống</label>
                <span class="badge badge-{{ $user->vai_tro === 'admin' ? 'danger' : ($user->vai_tro === 'giasu' ? 'info' : 'success') }}" style="font-size: 0.85rem; padding: 0.4rem 0.9rem;">
                    {{ $user->vai_tro === 'admin' ? 'Quản Trị Viên' : ($user->vai_tro === 'giasu' ? 'Gia Sư' : 'Học Viên / Phụ Huynh') }}
                </span>
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="border-radius: 12px;">
                <i class="fas fa-save" style="margin-right: 0.5rem;"></i> Lưu Thay Đổi
            </button>
        </form>
    </div>

    {{-- Form 2: Đổi mật khẩu --}}
    <div class="glass-card" style="padding: 2.2rem; border-radius: 20px; background: #ffffff;">
        <div style="border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin-bottom: 0.3rem;">
                🔒 Đổi Mật Khẩu
            </h3>
            <p style="font-size: 0.85rem; color: #64748b; margin: 0;">Bảo vệ an toàn tài khoản với mật khẩu mạnh</p>
        </div>

        <form method="POST" action="{{ route('tai-khoan.doi-mat-khau') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Mật khẩu hiện tại</label>
                <input type="password" name="mat_khau_cu" class="form-control" required placeholder="Nhập mật khẩu bạn đang dùng">
                @error('mat_khau_cu')<span class="error-msg">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Mật khẩu mới</label>
                <input type="password" name="mat_khau_moi" class="form-control" required placeholder="Tối thiểu 6 ký tự">
                @error('mat_khau_moi')<span class="error-msg">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom: 1.8rem;">
                <label class="form-label">Xác nhận mật khẩu mới</label>
                <input type="password" name="mat_khau_moi_confirmation" class="form-control" required placeholder="Nhập lại mật khẩu mới">
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="border-radius: 12px; background: linear-gradient(135deg, #059669, #10b981); border: none;">
                <i class="fas fa-key" style="margin-right: 0.5rem;"></i> Cập Nhật Mật Khẩu Mới
            </button>
        </form>
    </div>

</div>
@endsection
