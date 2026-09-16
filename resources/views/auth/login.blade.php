@extends('layouts.auth')

@section('title', 'Đăng Nhập')

@section('content')
<div class="auth-card" style="position:relative; overflow:hidden; background-color: #ffffff !important; background: #ffffff !important; border: 1px solid #cbd5e1 !important; box-shadow: 0 20px 50px rgba(37, 99, 235, 0.12) !important; color: #0f172a !important; border-radius: 24px; padding: 2.8rem 2.4rem; width: 100%; max-width: 460px;">
    
    <!-- Top Accent Rainbow Bar -->
    <div style="position:absolute; top:0; left:0; right:0; height:6px; background: linear-gradient(90deg, #2563eb 0%, #7c3aed 50%, #06b6d4 100%);"></div>

    <div class="auth-brand" style="text-align:center; margin-bottom: 2rem;">
        <div style="display:inline-flex; align-items:center; gap:0.4rem; background:#eff6ff; color:#2563eb; padding:0.35rem 0.85rem; border-radius:20px; font-size:0.8rem; font-weight:700; margin-bottom:1.2rem; border:1px solid #bfdbfe;">
            <span>⭐</span> HỆ THỐNG GIA SƯ CHẤT LƯỢNG CAO
        </div>
        <div class="brand-icon" style="width: 76px; height: 76px; background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%); border-radius: 22px; display: inline-flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #ffffff; margin: 0 auto 1rem; box-shadow: 0 10px 25px rgba(37,99,235,0.3);">🎓</div>
        <h1 style="font-size: 1.55rem; font-weight: 800; color: #0f172a !important; margin-bottom: 0.4rem; letter-spacing:-0.02em;">TRUNG TÂM KẾT NỐI GIA SƯ</h1>
        <p style="font-size: 0.92rem; color: #475569 !important; font-weight: 500;">Cổng Thông Tin & Quản Lý Dạy Kèm Chuyên Nghiệp</p>
    </div>

    @if($errors->any())
        <div class="alert alert-error" style="background-color: #fef2f2 !important; color: #991b1b !important; border: 1px solid #fecaca !important; padding: 0.9rem; border-radius: 10px; margin-bottom: 1.2rem; font-size:0.9rem;">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success" style="background-color: #f0fdf4 !important; color: #166534 !important; border: 1px solid #bbf7d0 !important; padding: 0.9rem; border-radius: 10px; margin-bottom: 1.2rem; font-size:0.9rem;">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="form-group" style="margin-bottom: 1.3rem;">
            <label class="form-label" for="email" style="display:block; font-size:0.88rem; font-weight:700; color: #1e293b !important; margin-bottom: 0.45rem;">
                <i class="fas fa-envelope" style="margin-right:0.4rem; color:#2563eb;"></i>Email Đăng Nhập
            </label>
            <input type="email"
                   id="email"
                   name="email"
                   class="form-control"
                   placeholder="Nhập địa chỉ email..."
                   value="{{ old('email') }}"
                   required
                   style="width:100%; padding: 0.85rem 1.1rem; background-color: #ffffff !important; background: #ffffff !important; border: 2px solid #cbd5e1 !important; color: #0f172a !important; font-size:0.95rem; border-radius:10px;">
        </div>

        <div class="form-group" style="margin-bottom: 1.3rem;">
            <label class="form-label" for="password" style="display:block; font-size:0.88rem; font-weight:700; color: #1e293b !important; margin-bottom: 0.45rem;">
                <i class="fas fa-lock" style="margin-right:0.4rem; color:#2563eb;"></i>Mật Khẩu
            </label>
            <div style="position:relative;">
                <input type="password"
                       id="password"
                       name="password"
                       class="form-control"
                       placeholder="Nhập mật khẩu..."
                       required
                       style="width:100%; padding: 0.85rem 3rem 0.85rem 1.1rem; background-color: #ffffff !important; background: #ffffff !important; border: 2px solid #cbd5e1 !important; color: #0f172a !important; font-size:0.95rem; border-radius:10px;">
                <button type="button"
                        onclick="togglePassword('password', this)"
                        style="position:absolute; right:0.8rem; top:50%; transform:translateY(-50%); background:none; border:none; color:#64748b; cursor:pointer; font-size:1rem;">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.6rem;">
            <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; font-size:0.88rem; color: #334155 !important; font-weight:600;">
                <input type="checkbox" name="remember" id="remember" class="form-check-input" style="width:16px; height:16px; accent-color:#2563eb;">
                Ghi nhớ đăng nhập
            </label>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-lg" style="width:100%; padding: 0.95rem; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important; color: #ffffff !important; font-weight:800; font-size:1.02rem; border:none; border-radius:12px; cursor:pointer; box-shadow: 0 6px 18px rgba(37,99,235,0.35);">
            <i class="fas fa-sign-in-alt"></i> Đăng Nhập Hệ Thống
        </button>
    </form>

    <div class="divider" style="height:1px; background:#e2e8f0; margin: 1.6rem 0;"></div>

    <p style="text-align:center; font-size:0.92rem; color: #475569 !important; font-weight:500;">
        Chưa có tài khoản?
        <a href="{{ route('register') }}" style="color: #2563eb !important; font-weight:700; text-decoration:none;">
            Đăng ký ngay
        </a>
    </p>
</div>

<script>
function togglePassword(fieldId, btn) {
    const field = document.getElementById(fieldId);
    const icon  = btn.querySelector('i');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
@endsection