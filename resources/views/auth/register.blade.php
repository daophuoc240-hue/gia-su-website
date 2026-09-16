@extends('layouts.auth')

@section('title', 'Đăng Ký Tài Khoản')

@section('content')
<div class="auth-card glass-card" style="max-width:540px;">
    <div class="auth-brand">
        <div class="brand-icon">🎓</div>
        <h1>Tạo Tài Khoản</h1>
        <p>Tham gia vào hệ thống Gia Sư Connect</p>
    </div>

    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        {{-- Loại tài khoản --}}
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-user-tag" style="margin-right:0.4rem;"></i>Loại Tài Khoản
            </label>
            <div class="role-selector">
                <div class="role-option">
                    <input type="radio" id="role_giasu" name="vai_tro" value="giasu"
                           {{ old('vai_tro') === 'giasu' ? 'checked' : '' }}>
                    <label for="role_giasu">
                        <span class="role-icon">👨‍🏫</span>
                        <span class="role-name">Gia Sư</span>
                        <span class="role-desc">Tôi muốn nhận dạy</span>
                    </label>
                </div>
                <div class="role-option">
                    <input type="radio" id="role_hocvien" name="vai_tro" value="hocvien"
                           {{ old('vai_tro', 'hocvien') === 'hocvien' ? 'checked' : '' }}>
                    <label for="role_hocvien">
                        <span class="role-icon">👨‍👩‍👦</span>
                        <span class="role-name">Học Viên / Phụ Huynh</span>
                        <span class="role-desc">Tôi cần tìm gia sư</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="ho_ten">
                <i class="fas fa-user" style="margin-right:0.4rem;"></i>Họ và Tên
            </label>
            <input type="text"
                   id="ho_ten"
                   name="ho_ten"
                   class="form-control"
                   placeholder="Nhập họ và tên đầy đủ..."
                   value="{{ old('ho_ten') }}"
                   required>
        </div>

        <div class="form-group">
            <label class="form-label" for="reg_email">
                <i class="fas fa-envelope" style="margin-right:0.4rem;"></i>Email
            </label>
            <input type="email"
                   id="reg_email"
                   name="email"
                   class="form-control"
                   placeholder="Nhập địa chỉ email..."
                   value="{{ old('email') }}"
                   required>
        </div>

        <div class="form-group">
            <label class="form-label" for="so_dien_thoai">
                <i class="fas fa-phone" style="margin-right:0.4rem;"></i>Số Điện Thoại
            </label>
            <input type="tel"
                   id="so_dien_thoai"
                   name="so_dien_thoai"
                   class="form-control"
                   placeholder="Nhập số điện thoại..."
                   value="{{ old('so_dien_thoai') }}"
                   required>
        </div>

        <div class="form-group">
            <label class="form-label" for="reg_password">
                <i class="fas fa-lock" style="margin-right:0.4rem;"></i>Mật Khẩu
            </label>
            <input type="password"
                   id="reg_password"
                   name="password"
                   class="form-control"
                   placeholder="Tối thiểu 6 ký tự..."
                   required>
        </div>

        <div class="form-group">
            <label class="form-label" for="password_confirmation">
                <i class="fas fa-lock" style="margin-right:0.4rem;"></i>Xác Nhận Mật Khẩu
            </label>
            <input type="password"
                   id="password_confirmation"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="Nhập lại mật khẩu..."
                   required>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-lg">
            <i class="fas fa-user-plus"></i> Tạo Tài Khoản
        </button>
    </form>

    <div class="divider"></div>

    <p style="text-align:center; font-size:0.88rem; color:var(--text-secondary);">
        Đã có tài khoản?
        <a href="{{ route('login') }}" style="color:var(--primary-start); font-weight:600; text-decoration:none;">
            Đăng nhập ngay
        </a>
    </p>
</div>
@endsection
