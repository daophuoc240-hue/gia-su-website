@extends('layouts.app')
@section('title', 'Hồ Sơ Gia Sư')
@section('page-title', 'Hồ Sơ Cá Nhân Gia Sư')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
<p class="nav-section-title">Hồ Sơ & Lớp Học</p>
<div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
<div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
<div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@endsection

@push('head')
<style>
.avatar-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 1.2rem;
}
.avatar-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #2563eb;
    box-shadow: 0 8px 24px rgba(37,99,235,0.28);
    transition: all 0.3s ease;
    display: block;
}
.avatar-overlay {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: rgba(0,0,0,0.48);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    cursor: pointer;
    transition: opacity 0.25s ease;
    gap: 3px;
}
.avatar-wrapper:hover .avatar-overlay { opacity: 1; }
.avatar-wrapper:hover .avatar-img { filter: brightness(0.75); }
.avatar-overlay span {
    color: #fff;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.4px;
}
.avatar-overlay i { color: #fff; font-size: 1.2rem; }
.online-dot {
    position: absolute;
    bottom: 6px; right: 6px;
    background: #10b981;
    border: 3px solid #ffffff;
    width: 22px; height: 22px;
    border-radius: 50%;
    box-shadow: 0 2px 6px rgba(16,185,129,0.4);
}
.fee-input-wrap {
    position: relative;
}
.fee-input-wrap .prefix {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    font-weight: 600;
    font-size: 0.9rem;
    pointer-events: none;
}
.fee-input-wrap input {
    padding-left: 42px;
}
</style>
@endpush

@section('content')
<div style="display: grid; grid-template-columns: 320px 1fr; gap: 1.8rem; align-items: start;">

    {{-- ===== Profile Overview Card ===== --}}
    <div class="glass-card" style="padding: 2rem; text-align: center; border-radius: 20px;">
        {{-- Avatar with upload --}}
        <div class="avatar-wrapper" onclick="document.getElementById('avatar-input').click()" title="Nhấn để đổi ảnh đại diện">
            <img id="avatar-preview"
                 src="{{ $ho_so?->avatar_url ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=300&q=80' }}"
                 alt="Ảnh đại diện" class="avatar-img">
            <div class="avatar-overlay">
                <i class="fas fa-camera"></i>
                <span>Đổi ảnh</span>
            </div>
            <span class="online-dot"></span>
        </div>

        {{-- Hidden file input (in main form) --}}
        <input type="file" id="avatar-input" name="avatar" accept="image/*"
               style="display:none;" form="ho-so-form"
               onchange="previewAvatar(this)">
        <p style="font-size:0.74rem; color:#94a3b8; margin-top:-0.5rem; margin-bottom:1rem;">Nhấn vào ảnh để thay đổi (JPG, PNG, tối đa 5MB)</p>

        <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 0.2rem;">{{ $user->ho_ten }}</h3>
        <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 1rem;">📧 {{ $user->email }}</p>

        @if($ho_so)
            @if($ho_so->trang_thai_duyet === 'da_duyet')
                <span class="badge badge-success" style="font-size: 0.85rem; padding: 0.45rem 1.1rem; border-radius: 20px;">✅ Đã Kiểm Duyệt</span>
            @elseif($ho_so->trang_thai_duyet === 'cho_duyet')
                <span class="badge badge-warning" style="font-size: 0.85rem; padding: 0.45rem 1.1rem; border-radius: 20px;">⏳ Đang Chờ Duyệt</span>
            @else
                <span class="badge badge-danger" style="font-size: 0.85rem; padding: 0.45rem 1.1rem; border-radius: 20px;">❌ Đã Từ Chối</span>
            @endif
        @else
            <span class="badge badge-warning" style="font-size: 0.85rem; padding: 0.45rem 1.1rem; border-radius: 20px;">⚠️ Chưa Tạo Hồ Sơ</span>
        @endif

        <div class="divider" style="margin: 1.4rem 0;"></div>

        <div style="text-align: left; font-size: 0.88rem; color: #334155; line-height: 1.8;">
            <div style="margin-bottom: 0.6rem;">🎓 <strong>Trường học:</strong><br><span style="color: #0f172a; font-weight: 600;">{{ $ho_so->truong_hoc ?? 'Chưa cập nhật' }}</span></div>
            <div style="margin-bottom: 0.6rem;">📖 <strong>Chuyên ngành:</strong><br><span style="color: #0f172a; font-weight: 600;">{{ $ho_so->chuyen_nganh ?? 'Chưa cập nhật' }}</span></div>
            @if($ho_so?->mon_day)
            <div style="margin-bottom: 0.6rem;">📚 <strong>Môn dạy:</strong><br><span style="color: #2563eb; font-weight: 700;">{{ $ho_so->mon_day }}</span></div>
            @endif
            @if($ho_so?->hoc_phi_theo_gio)
            <div style="margin-bottom: 0.6rem;">💰 <strong>Học phí/buổi:</strong><br><span style="color: #0f172a; font-weight: 700;">{{ number_format($ho_so->hoc_phi_theo_gio) }}đ</span></div>
            @endif
            <div style="margin-bottom: 0.6rem;">📍 <strong>Khu vực dạy:</strong><br><span style="color: #0f172a; font-weight: 600;">{{ $ho_so->khu_vuc_nhan_day ?? 'Chưa cập nhật' }}</span></div>
            <div>📞 <strong>Điện thoại:</strong><br><span style="color: #0f172a; font-weight: 600;">{{ $user->so_dien_thoai ?? 'Chưa cập nhật' }}</span></div>
        </div>

        @if($ho_so?->so_lop_da_day)
        <div class="divider" style="margin: 1.2rem 0;"></div>
        <div style="display: flex; justify-content: center; gap: 1.5rem;">
            <div style="text-align:center;">
                <div style="font-size:1.5rem; font-weight:800; color:#2563eb;">{{ $ho_so->so_lop_da_day }}</div>
                <div style="font-size:0.72rem; color:#64748b;">Lớp đã dạy</div>
            </div>
        </div>
        @endif
    </div>

    {{-- ===== Edit Form Card ===== --}}
    <div class="glass-card" style="padding: 2.4rem; border-radius: 20px; background: #ffffff;">
        <div style="border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1.8rem;">
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #0f172a; margin-bottom: 0.3rem;">📝 Cập Nhật Thông Tin Hồ Sơ</h3>
            <p style="font-size: 0.88rem; color: #64748b;">Cung cấp đầy đủ thông tin để hồ sơ được duyệt nhanh nhất và thu hút phụ huynh.</p>
        </div>

        <form id="ho-so-form" method="POST" action="{{ route('giasu.ho-so.cap-nhat') }}" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.4rem; margin-bottom: 0.5rem;">
                <div class="form-group">
                    <label class="form-label">🎓 Trường Học</label>
                    <input type="text" name="truong_hoc" class="form-control {{ $errors->has('truong_hoc') ? 'is-invalid' : '' }}"
                           value="{{ old('truong_hoc', $ho_so->truong_hoc ?? '') }}" required
                           placeholder="Ví dụ: ĐH Sư Phạm, ĐH KHTN...">
                    @error('truong_hoc')<span class="error-msg">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">📖 Chuyên Ngành</label>
                    <input type="text" name="chuyen_nganh" class="form-control {{ $errors->has('chuyen_nganh') ? 'is-invalid' : '' }}"
                           value="{{ old('chuyen_nganh', $ho_so->chuyen_nganh ?? '') }}" required
                           placeholder="Ví dụ: Sư phạm Toán, Tiếng Anh...">
                    @error('chuyen_nganh')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.4rem; margin-bottom: 0.5rem;">
                <div class="form-group">
                    <label class="form-label">📚 Môn Dạy Chính</label>
                    <input type="text" name="mon_day" class="form-control"
                           value="{{ old('mon_day', $ho_so->mon_day ?? '') }}"
                           placeholder="Ví dụ: Toán, Tiếng Anh, Vật Lý...">
                </div>

                <div class="form-group">
                    <label class="form-label">💰 Học Phí (đ / buổi)</label>
                    <div class="fee-input-wrap">
                        <span class="prefix">₫</span>
                        <input type="number" name="hoc_phi_theo_gio" class="form-control"
                               value="{{ old('hoc_phi_theo_gio', $ho_so->hoc_phi_theo_gio ?? '') }}"
                               placeholder="Ví dụ: 150000" min="0" step="10000">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">📍 Khu Vực Nhận Dạy (Quận / Huyện)</label>
                <input type="text" name="khu_vuc_nhan_day" class="form-control {{ $errors->has('khu_vuc_nhan_day') ? 'is-invalid' : '' }}"
                       value="{{ old('khu_vuc_nhan_day', $ho_so->khu_vuc_nhan_day ?? '') }}" required
                       placeholder="Ví dụ: Quận 1, Quận 3, Thủ Đức, Bình Thạnh...">
                @error('khu_vuc_nhan_day')<span class="error-msg">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom: 1.8rem;">
                <label class="form-label">💡 Kinh Nghiệm Giảng Dạy & Thành Tích</label>
                <textarea name="kinh_nghiem" class="form-control {{ $errors->has('kinh_nghiem') ? 'is-invalid' : '' }}"
                          rows="5" required
                          placeholder="Mô tả chi tiết thành tích học tập, giải thưởng, kinh nghiệm dạy kèm, phương pháp truyền đạt...">{{ old('kinh_nghiem', $ho_so->kinh_nghiem ?? '') }}</textarea>
                @error('kinh_nghiem')<span class="error-msg">{{ $message }}</span>@enderror
            </div>

            {{-- Documents --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.4rem; margin-bottom: 1.8rem;">
                <div class="form-group">
                    <label class="form-label">🎓 Bằng Cấp / Chứng Chỉ <span style="color:#94a3b8;">(không bắt buộc)</span></label>
                    <input type="file" name="bang_cap" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                    @if($ho_so?->bang_cap)
                    <p style="font-size:0.77rem; color:#10b981; margin-top:4px;">✓ Đã có file. Upload mới để thay.</p>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-label">🪪 Thẻ Sinh Viên / CCCD <span style="color:#94a3b8;">(không bắt buộc)</span></label>
                    <input type="file" name="the_sinh_vien" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                    @if($ho_so?->the_sinh_vien)
                    <p style="font-size:0.77rem; color:#10b981; margin-top:4px;">✓ Đã có file. Upload mới để thay.</p>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="padding: 0.95rem; font-size: 1rem; border-radius: 12px;">
                <i class="fas fa-save" style="margin-right: 0.5rem;"></i> Lưu Thông Tin & Gửi Phê Duyệt
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        if (file.size > 5 * 1024 * 1024) {
            alert('Ảnh quá lớn! Vui lòng chọn ảnh dưới 5MB.');
            input.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').src = e.target.result;
            // Show toast
            const toast = document.createElement('div');
            toast.style.cssText = 'position:fixed;bottom:1.5rem;right:1.5rem;background:#10b981;color:#fff;padding:0.85rem 1.5rem;border-radius:12px;font-size:0.9rem;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(16,185,129,0.35);animation:slideUp 0.3s ease;';
            toast.innerHTML = '<i class="fas fa-check-circle" style="margin-right:8px;"></i> Ảnh đã chọn! Nhấn Lưu để cập nhật.';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3500);
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
@endsection