@extends('layouts.app')
@section('title', 'Hồ Sơ Gia Sư')
@section('page-title', 'Hồ Sơ Cá Nhân Gia Sư')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a></div>
<p class="nav-section-title">Hồ Sơ & Lớp Học</p>
<div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
<div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
<div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@endsection

@section('content')
<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.8rem;">
    <!-- Profile Overview Card -->
    <div>
        <div class="glass-card" style="padding: 2rem; text-align: center; margin-bottom: 1.5rem;">
            <div style="position: relative; display: inline-block; margin-bottom: 1rem;">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80" alt="Gia sư Avatar" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; border: 4px solid #2563eb; box-shadow: 0 8px 20px rgba(37,99,235,0.25);">
                <span style="position: absolute; bottom: 4px; right: 4px; background: #10b981; border: 3px solid #ffffff; width: 18px; height: 18px; border-radius: 50%;"></span>
            </div>
            <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 0.2rem;">{{ $user->ho_ten }}</h3>
            <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 0.8rem;">📧 {{ $user->email }}</p>
            
            @if($ho_so)
                @if($ho_so->trang_thai_duyet === 'da_duyet')
                    <span class="badge badge-success" style="font-size: 0.85rem; padding: 0.4rem 1rem;">✅ Đã Kiểm Duyệt</span>
                @elseif($ho_so->trang_thai_duyet === 'cho_duyet')
                    <span class="badge badge-warning" style="font-size: 0.85rem; padding: 0.4rem 1rem;">⏳ Đang Chờ Duyệt</span>
                @else
                    <span class="badge badge-danger" style="font-size: 0.85rem; padding: 0.4rem 1rem;">❌ Đã Từ Chối</span>
                @endif
            @else
                <span class="badge badge-warning" style="font-size: 0.85rem; padding: 0.4rem 1rem;">⚠️ Chưa Tạo Hồ Sơ</span>
            @endif

            <div class="divider"></div>

            <div style="text-align: left; font-size: 0.88rem; color: #334155;">
                <div style="margin-bottom: 0.8rem;">🎓 <strong>Trường học:</strong> {{ $ho_so->truong_hoc ?? 'Chưa cập nhật' }}</div>
                <div style="margin-bottom: 0.8rem;">📖 <strong>Chuyên ngành:</strong> {{ $ho_so->chuyen_nganh ?? 'Chưa cập nhật' }}</div>
                <div style="margin-bottom: 0.8rem;">📍 <strong>Khu vực dạy:</strong> {{ $ho_so->khu_vuc_nhan_day ?? 'Chưa cập nhật' }}</div>
                <div>📞 <strong>Điện thoại:</strong> {{ $user->so_dien_thoai ?? 'Chưa cập nhật' }}</div>
            </div>
        </div>
    </div>

    <!-- Edit Form Card -->
    <div class="glass-card" style="padding: 2.2rem;">
        <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 0.4rem;">📝 Cập Nhật Thông Tin Hồ Sơ</h3>
        <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 1.8rem;">Cung cấp chính xác trường học và kinh nghiệm giảng dạy để hồ sơ được duyệt nhanh chóng.</p>

        <form method="POST" action="{{ route('giasu.ho-so.cap-nhat') }}" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1.3rem;">
                <div>
                    <label class="form-label">🎓 Trường Học Đang Theo Học / Đã Tốt Nghiệp</label>
                    <input type="text" name="truong_hoc" class="form-control" value="{{ old('truong_hoc', $ho_so->truong_hoc ?? '') }}" required placeholder="Ví dụ: ĐH Sư Phạm, ĐH Bách Khoa...">
                </div>
                <div>
                    <label class="form-label">📖 Chuyên Ngành Đào Tạo</label>
                    <input type="text" name="chuyen_nganh" class="form-control" value="{{ old('chuyen_nganh', $ho_so->chuyen_nganh ?? '') }}" required placeholder="Ví dụ: Sư phạm Toán, Tiếng Anh...">
                </div>
            </div>

            <div style="margin-bottom: 1.3rem;">
                <label class="form-label">📍 Khu Vực Nhận Dạy Kèm (Quận / Huyện)</label>
                <input type="text" name="khu_vuc_nhan_day" class="form-control" value="{{ old('khu_vuc_nhan_day', $ho_so->khu_vuc_nhan_day ?? '') }}" required placeholder="Ví dụ: Quận 1, Quận 3, Thủ Đức, Bình Thạnh...">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label class="form-label">💡 Kinh Nghiệm Giảng Dạy & Thành Tích</label>
                <textarea name="kinh_nghiem" class="form-control" rows="5" required placeholder="Mô tả các thành tích học tập, giải thưởng, kinh nghiệm dạy kèm trước đây và phương pháp truyền đạt kiến thức...">{{ old('kinh_nghiem', $ho_so->kinh_nghiem ?? '') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block" style="border-radius: 12px;">
                <i class="fas fa-save"></i> Lưu & Gửi Hồ Sơ Phê Duyệt
            </button>
        </form>
    </div>
</div>
@endsection