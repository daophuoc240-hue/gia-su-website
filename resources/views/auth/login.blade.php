@extends('layouts.auth')

@section('title', 'Đăng Nhập')

@section('content')
<div class="split-auth-container">
    <!-- Cột Trái: Hero Banner Giáo Dục Doanh Nghiệp -->
    <div class="split-hero">
        <div style="position:relative; z-index:2;">
            <div style="display:inline-flex; align-items:center; gap:0.6rem; background:rgba(255,255,255,0.12); backdrop-filter:blur(10px); padding:0.4rem 1rem; border-radius:30px; font-size:0.85rem; font-weight:600; border:1px solid rgba(255,255,255,0.2); margin-bottom:2rem;">
                <span style="font-size:1.1rem;">🎓</span> HỆ THỐNG KẾT NỐI GIA SƯ HÀNG ĐẦU
            </div>
            <h1 style="font-size:2.4rem; font-weight:800; line-height:1.25; margin-bottom:1.2rem; letter-spacing:-0.02em;">
                Nâng Tầm Tri Thức <br>
                <span style="background:linear-gradient(90deg, #60a5fa, #a78bfa); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">Kết Nối Tương Lai</span>
            </h1>
            <p style="font-size:1.05rem; color:rgba(255,255,255,0.8); line-height:1.6; max-width:480px; margin-bottom:2.5rem;">
                Nền tảng quản lý & kết nối dạy kèm chuyên nghiệp dành cho Học viên, Phụ huynh và Gia sư giỏi trên toàn quốc.
            </p>

            <!-- Cards Tính Năng Nổi Bật -->
            <div style="display:grid; gap:1.2rem; max-width:480px;">
                <div style="display:flex; align-items:center; gap:1rem; background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); padding:1rem 1.2rem; border-radius:14px;">
                    <div style="width:44px; height:44px; background:rgba(59,130,246,0.25); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; color:#60a5fa;">👨‍🏫</div>
                    <div>
                        <div style="font-weight:700; font-size:0.95rem; color:#ffffff;">Gia Sư Chất Lượng Cao</div>
                        <div style="font-size:0.82rem; color:rgba(255,255,255,0.7);">Hồ sơ kiểm duyệt kỹ càng từ các trường đại học hàng đầu</div>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:1rem; background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); padding:1rem 1.2rem; border-radius:14px;">
                    <div style="width:44px; height:44px; background:rgba(168,85,247,0.25); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; color:#c084fc;">📚</div>
                    <div>
                        <div style="font-weight:700; font-size:0.95rem; color:#ffffff;">Đa Dạng Môn Học & Khối Lớp</div>
                        <div style="font-size:0.82rem; color:rgba(255,255,255,0.7);">Từ tiểu học, THCS, THPT đến luyện thi Đại học & Ngoại ngữ</div>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:1rem; background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); padding:1rem 1.2rem; border-radius:14px;">
                    <div style="width:44px; height:44px; background:rgba(20,184,166,0.25); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; color:#2dd4bf;">⚡</div>
                    <div>
                        <div style="font-weight:700; font-size:0.95rem; color:#ffffff;">Phân Công & Khởi Tạo Nhanh</div>
                        <div style="font-size:0.82rem; color:rgba(255,255,255,0.7);">Tìm gia sư phù hợp chỉ trong vài thao tác đơn giản</div>
                    </div>
                </div>
            </div>
        </div>

        <div style="position:relative; z-index:2; margin-top:2rem; font-size:0.82rem; color:rgba(255,255,255,0.5);">
            © 2026 Gia Sư Connect. Tất cả quyền được bảo lưu.
        </div>
    </div>

    <!-- Cột Phải: Form Đăng Nhập Chuyên Nghiệp -->
    <div class="split-form">
        <div style="width:100%; max-width:400px;">
            <div style="margin-bottom:2rem;">
                <h2 style="font-size:1.75rem; font-weight:800; color:#0f172a; margin-bottom:0.5rem; letter-spacing:-0.02em;">Đăng Nhập</h2>
                <p style="font-size:0.92rem; color:#64748b; font-weight:500;">Vui lòng nhập thông tin để truy cập hệ thống</p>
            </div>

            @if($errors->any())
                <div style="background:#fef2f2; color:#991b1b; border:1px solid #fecaca; padding:0.85rem 1rem; border-radius:10px; margin-bottom:1.2rem; font-size:0.88rem; font-weight:600; display:flex; align-items:center; gap:0.6rem;">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if(session('success'))
                <div style="background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; padding:0.85rem 1rem; border-radius:10px; margin-bottom:1.2rem; font-size:0.88rem; font-weight:600; display:flex; align-items:center; gap:0.6rem;">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div style="margin-bottom:1.3rem;">
                    <label for="email" style="display:block; font-size:0.88rem; font-weight:700; color:#1e293b; margin-bottom:0.45rem;">
                        <i class="fas fa-envelope" style="margin-right:0.4rem; color:#2563eb;"></i>Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Nhập địa chỉ email..." style="width:100%; padding:0.85rem 1.1rem; background:#ffffff; border:2px solid #cbd5e1; color:#0f172a; font-size:0.95rem; border-radius:10px; font-family:inherit; box-sizing:border-box;">
                </div>

                <div style="margin-bottom:1.3rem;">
                    <label for="password" style="display:block; font-size:0.88rem; font-weight:700; color:#1e293b; margin-bottom:0.45rem;">
                        <i class="fas fa-lock" style="margin-right:0.4rem; color:#2563eb;"></i>Mật Khẩu
                    </label>
                    <div style="position:relative;">
                        <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu..." style="width:100%; padding:0.85rem 3rem 0.85rem 1.1rem; background:#ffffff; border:2px solid #cbd5e1; color:#0f172a; font-size:0.95rem; border-radius:10px; font-family:inherit; box-sizing:border-box;">
                        <button type="button" onclick="togglePassword('password', this)" style="position:absolute; right:0.8rem; top:50%; transform:translateY(-50%); background:none; border:none; color:#64748b; cursor:pointer; font-size:1rem;">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.6rem;">
                    <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; font-size:0.88rem; color:#334155; font-weight:600;">
                        <input type="checkbox" name="remember" id="remember" style="width:16px; height:16px; accent-color:#2563eb;">
                        Ghi nhớ đăng nhập
                    </label>
                </div>

                <button type="submit" style="width:100%; padding:0.95rem; background:linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color:#ffffff; font-weight:800; font-size:1rem; border:none; border-radius:10px; cursor:pointer; box-shadow:0 6px 18px rgba(37,99,235,0.35);">
                    <i class="fas fa-sign-in-alt" style="margin-right:0.5rem;"></i> Đăng Nhập Hệ Thống
                </button>
            </form>

            <div style="height:1px; background:#e2e8f0; margin:1.8rem 0;"></div>

            <p style="text-align:center; font-size:0.92rem; color:#64748b; font-weight:500;">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" style="color:#2563eb; font-weight:700; text-decoration:none;">
                    Đăng ký ngay
                </a>
            </p>
        </div>
    </div>
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