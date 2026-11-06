@extends('layouts.auth')

@section('title', 'Đăng Ký Tài Khoản')

@section('content')
<div class="split-auth-container">
    <!-- Cột Trái: Hero Banner Giáo Dục Đăng Ký -->
    <div class="split-hero">
        <div style="position:relative; z-index:2;">
            <div style="display:inline-flex; align-items:center; gap:0.6rem; background:rgba(255,255,255,0.12); backdrop-filter:blur(10px); padding:0.4rem 1rem; border-radius:30px; font-size:0.85rem; font-weight:600; border:1px solid rgba(255,255,255,0.2); margin-bottom:2rem;">
                <span style="font-size:1.1rem;">✨</span> TẠO TÀI KHOẢN MIỄN PHÍ
            </div>
            <h1 style="font-size:2.3rem; font-weight:800; line-height:1.25; margin-bottom:1.2rem; letter-spacing:-0.02em;">
                Gia Nhập Cộng Đồng <br>
                <span style="background:linear-gradient(90deg, #60a5fa, #a78bfa); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">Gia Sư & Học Viên</span>
            </h1>
            <p style="font-size:1.02rem; color:rgba(255,255,255,0.8); line-height:1.6; max-width:480px; margin-bottom:2.5rem;">
                Trải nghiệm hệ thống kết nối dạy kèm hàng đầu. Đăng ký nhanh chóng, dễ dàng và hoàn toàn miễn phí.
            </p>

            <!-- Cards Tính Năng Đăng Ký -->
            <div style="display:grid; gap:1.2rem; max-width:480px;">
                <div style="display:flex; align-items:center; gap:1rem; background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); padding:1rem 1.2rem; border-radius:14px;">
                    <div style="width:44px; height:44px; background:rgba(59,130,246,0.25); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; color:#60a5fa;">👨‍🏫</div>
                    <div>
                        <div style="font-weight:700; font-size:0.95rem; color:#ffffff;">Dành Cho Gia Sư</div>
                        <div style="font-size:0.82rem; color:rgba(255,255,255,0.7);">Tiếp cận hàng trăm lớp học mới mỗi ngày với mức thù lao tốt nhất</div>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:1rem; background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); padding:1rem 1.2rem; border-radius:14px;">
                    <div style="width:44px; height:44px; background:rgba(168,85,247,0.25); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; color:#c084fc;">👨‍👩‍👦</div>
                    <div>
                        <div style="font-weight:700; font-size:0.95rem; color:#ffffff;">Dành Cho Học Viên / Phụ Huynh</div>
                        <div style="font-size:0.82rem; color:rgba(255,255,255,0.7);">Tìm kiếm gia sư tận tâm, giỏi chuyên môn phù hợp cho con em</div>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:1rem; background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); padding:1rem 1.2rem; border-radius:14px;">
                    <div style="width:44px; height:44px; background:rgba(20,184,166,0.25); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; color:#2dd4bf;">🛡️</div>
                    <div>
                        <div style="font-weight:700; font-size:0.95rem; color:#ffffff;">An Toàn & Minh Bạch</div>
                        <div style="font-size:0.82rem; color:rgba(255,255,255,0.7);">Bảo mật thông tin cá nhân và quy trình hỗ trợ 24/7</div>
                    </div>
                </div>
            </div>
        </div>

        <div style="position:relative; z-index:2; margin-top:2rem; font-size:0.82rem; color:rgba(255,255,255,0.5);">
            © 2026 Gia Sư Connect. Tất cả quyền được bảo lưu.
        </div>
    </div>

    <!-- Cột Phải: Form Đăng Ký Chuyên Nghiệp -->
    <div class="split-form" style="padding: 2.5rem;">
        <div style="width:100%; max-width:460px;">
            <div style="margin-bottom:1.8rem;">
                <h2 style="font-size:1.75rem; font-weight:800; color:#0f172a; margin-bottom:0.4rem; letter-spacing:-0.02em;">Tạo Tài Khoản</h2>
                <p style="font-size:0.92rem; color:#64748b; font-weight:500;">Điền thông tin bên dưới để bắt đầu sử dụng dịch vụ</p>
            </div>

            @if($errors->any())
                <div style="background:#fef2f2; color:#991b1b; border:1px solid #fecaca; padding:0.85rem 1rem; border-radius:10px; margin-bottom:1.2rem; font-size:0.88rem; font-weight:600;">
                    <i class="fas fa-exclamation-circle" style="margin-right:0.4rem;"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <!-- Chọn Vai Trò -->
                <div style="margin-bottom:1.4rem;">
                    <label style="display:block; font-size:0.88rem; font-weight:700; color:#1e293b; margin-bottom:0.5rem;">
                        <i class="fas fa-user-tag" style="margin-right:0.4rem; color:#2563eb;"></i>Bạn Là Ai?
                    </label>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.8rem;">
                        <label style="display:flex; flex-direction:column; align-items:center; padding:0.9rem; background:#f8fafc; border:2px solid #cbd5e1; border-radius:12px; cursor:pointer; text-align:center; transition:all 0.2s;" id="label_giasu">
                            <input type="radio" name="vai_tro" value="giasu" {{ old('vai_tro') === 'giasu' ? 'checked' : '' }} style="display:none;" onchange="updateRoleUI()">
                            <span style="font-size:1.6rem; margin-bottom:0.2rem;">👨‍🏫</span>
                            <span style="font-size:0.9rem; font-weight:800; color:#0f172a;">Gia Sư</span>
                            <span style="font-size:0.72rem; color:#64748b; font-weight:500;">Tôi muốn nhận dạy</span>
                        </label>
                        <label style="display:flex; flex-direction:column; align-items:center; padding:0.9rem; background:#eff6ff; border:2px solid #2563eb; border-radius:12px; cursor:pointer; text-align:center; transition:all 0.2s;" id="label_hocvien">
                            <input type="radio" name="vai_tro" value="hocvien" {{ old('vai_tro', 'hocvien') === 'hocvien' ? 'checked' : '' }} style="display:none;" onchange="updateRoleUI()">
                            <span style="font-size:1.6rem; margin-bottom:0.2rem;">👨‍👩‍👦</span>
                            <span style="font-size:0.9rem; font-weight:800; color:#0f172a;">Học Viên / Phụ Huynh</span>
                            <span style="font-size:0.72rem; color:#64748b; font-weight:500;">Tôi cần tìm gia sư</span>
                        </label>
                    </div>
                </div>

                <div style="margin-bottom:1.1rem;">
                    <label for="ho_ten" style="display:block; font-size:0.85rem; font-weight:700; color:#1e293b; margin-bottom:0.35rem;">Họ và Tên</label>
                    <input type="text" id="ho_ten" name="ho_ten" value="{{ old('ho_ten') }}" required placeholder="Nhập họ và tên đầy đủ..." style="width:100%; padding:0.8rem 1rem; background:#ffffff; border:2px solid #cbd5e1; color:#0f172a; font-size:0.92rem; border-radius:8px; font-family:inherit; box-sizing:border-box;">
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.8rem; margin-bottom:1.1rem;">
                    <div>
                        <label for="email" style="display:block; font-size:0.85rem; font-weight:700; color:#1e293b; margin-bottom:0.35rem;">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Địa chỉ email..." style="width:100%; padding:0.8rem 1rem; background:#ffffff; border:2px solid #cbd5e1; color:#0f172a; font-size:0.92rem; border-radius:8px; font-family:inherit; box-sizing:border-box;">
                    </div>
                    <div>
                        <label for="so_dien_thoai" style="display:block; font-size:0.85rem; font-weight:700; color:#1e293b; margin-bottom:0.35rem;">Số Điện Thoại</label>
                        <input type="tel" id="so_dien_thoai" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}" required placeholder="Số điện thoại..." style="width:100%; padding:0.8rem 1rem; background:#ffffff; border:2px solid #cbd5e1; color:#0f172a; font-size:0.92rem; border-radius:8px; font-family:inherit; box-sizing:border-box;">
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.8rem; margin-bottom:1.5rem;">
                    <div>
                        <label for="password" style="display:block; font-size:0.85rem; font-weight:700; color:#1e293b; margin-bottom:0.35rem;">Mật Khẩu</label>
                        <input type="password" id="password" name="password" required placeholder="Tối thiểu 6 ký tự..." style="width:100%; padding:0.8rem 1rem; background:#ffffff; border:2px solid #cbd5e1; color:#0f172a; font-size:0.92rem; border-radius:8px; font-family:inherit; box-sizing:border-box;">
                    </div>
                    <div>
                        <label for="password_confirmation" style="display:block; font-size:0.85rem; font-weight:700; color:#1e293b; margin-bottom:0.35rem;">Xác Nhận Mật Khẩu</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Nhập lại mật khẩu..." style="width:100%; padding:0.8rem 1rem; background:#ffffff; border:2px solid #cbd5e1; color:#0f172a; font-size:0.92rem; border-radius:8px; font-family:inherit; box-sizing:border-box;">
                    </div>
                </div>

                <button type="submit" style="width:100%; padding:0.9rem; background:linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color:#ffffff; font-weight:800; font-size:1rem; border:none; border-radius:10px; cursor:pointer; box-shadow:0 6px 18px rgba(37,99,235,0.35);">
                    <i class="fas fa-user-plus" style="margin-right:0.5rem;"></i> Đăng Ký Tài Khoản
                </button>
            </form>

            <div style="height:1px; background:#e2e8f0; margin:1.5rem 0;"></div>

            <p style="text-align:center; font-size:0.92rem; color:#64748b; font-weight:500;">
                Đã có tài khoản?
                <a href="{{ route('login') }}" style="color:#2563eb; font-weight:700; text-decoration:none;">
                    Đăng nhập ngay
                </a>
            </p>
        </div>
    </div>
</div>

<script>
function updateRoleUI() {
    const isGiaSu = document.querySelector('input[name="vai_tro"]:checked')?.value === 'giasu';
    const lGs = document.getElementById('label_giasu');
    const lHv = document.getElementById('label_hocvien');
    if (isGiaSu) {
        lGs.style.background = '#eff6ff'; lGs.style.borderColor = '#2563eb';
        lHv.style.background = '#f8fafc'; lHv.style.borderColor = '#cbd5e1';
    } else {
        lHv.style.background = '#eff6ff'; lHv.style.borderColor = '#2563eb';
        lGs.style.background = '#f8fafc'; lGs.style.borderColor = '#cbd5e1';
    }
}
</script>
@endsection