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
<div style="display: grid; grid-template-columns: 320px 1fr; gap: 1.8rem; align-items: start;">
    <!-- Profile Overview Card -->
    <div class="glass-card" style="padding: 2rem; text-align: center; border-radius: 20px;">
        <div style="position: relative; display: inline-block; margin-bottom: 1.2rem;">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80" alt="Gia sư Avatar" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; border: 4px solid #2563eb; box-shadow: 0 8px 20px rgba(37,99,235,0.25);">
            <span style="position: absolute; bottom: 4px; right: 4px; background: #10b981; border: 3px solid #ffffff; width: 20px; height: 20px; border-radius: 50%;"></span>
        </div>
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
            <div style="margin-bottom: 0.6rem;">🎓 <strong>Trường học:</strong> <br><span style="color: #0f172a; font-weight: 600;">{{ $ho_so->truong_hoc ?? 'Chưa cập nhật' }}</span></div>
            <div style="margin-bottom: 0.6rem;">📖 <strong>Chuyên ngành:</strong> <br><span style="color: #0f172a; font-weight: 600;">{{ $ho_so->chuyen_nganh ?? 'Chưa cập nhật' }}</span></div>
            <div style="margin-bottom: 0.6rem;">📍 <strong>Khu vực dạy:</strong> <br><span style="color: #0f172a; font-weight: 600;">{{ $ho_so->khu_vuc_nhan_day ?? 'Chưa cập nhật' }}</span></div>
            <div>📞 <strong>Điện thoại:</strong> <br><span style="color: #0f172a; font-weight: 600;">{{ $user->so_dien_thoai ?? 'Chưa cập nhật' }}</span></div>
        </div>
    </div>

    <!-- Edit Form Card -->
    <div class="glass-card" style="padding: 2.4rem; border-radius: 20px; background: #ffffff;">
        <div style="border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1.8rem;">
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #0f172a; margin-bottom: 0.3rem;">📝 Cập Nhật Thông Tin Hồ Sơ</h3>
            <p style="font-size: 0.88rem; color: #64748b;">Cung cấp đầy đủ trường học, chuyên ngành và kinh nghiệm để được duyệt nhận lớp nhanh nhất.</p>
        </div>

        <form method="POST" action="{{ route('giasu.ho-so.cap-nhat') }}" enctype="multipart/form-data">
            @csrf

            <!-- Form Row 1 -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.4rem; margin-bottom: 1.4rem;">
                <div style="display: flex; flex-direction: column;">
                    <label style="display: block; font-size: 0.88rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">
                        🎓 Trường Học Đang Theo Học / Đã Tốt Nghiệp
                    </label>
                    <input type="text" name="truong_hoc" class="form-control" value="{{ old('truong_hoc', $ho_so->truong_hoc ?? '') }}" required placeholder="Ví dụ: ĐH Sư Phạm, ĐH KHTN..." style="width: 100%; padding: 0.85rem 1.1rem; background: #ffffff; border: 2px solid #cbd5e1; border-radius: 10px; font-size: 0.95rem; color: #0f172a;">
                </div>

                <div style="display: flex; flex-direction: column;">
                    <label style="display: block; font-size: 0.88rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">
                        📖 Chuyên Ngành Đào Tạo
                    </label>
                    <input type="text" name="chuyen_nganh" class="form-control" value="{{ old('chuyen_nganh', $ho_so->chuyen_nganh ?? '') }}" required placeholder="Ví dụ: Sư phạm Toán, Tiếng Anh..." style="width: 100%; padding: 0.85rem 1.1rem; background: #ffffff; border: 2px solid #cbd5e1; border-radius: 10px; font-size: 0.95rem; color: #0f172a;">
                </div>
            </div>

            <!-- Form Row 2 -->
            <div style="display: flex; flex-direction: column; margin-bottom: 1.4rem;">
                <label style="display: block; font-size: 0.88rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">
                    📍 Khu Vực Nhận Dạy Kèm (Quận / Huyện)
                </label>
                <input type="text" name="khu_vuc_nhan_day" class="form-control" value="{{ old('khu_vuc_nhan_day', $ho_so->khu_vuc_nhan_day ?? '') }}" required placeholder="Ví dụ: Quận 1, Quận 3, Thủ Đức, Bình Thạnh..." style="width: 100%; padding: 0.85rem 1.1rem; background: #ffffff; border: 2px solid #cbd5e1; border-radius: 10px; font-size: 0.95rem; color: #0f172a;">
            </div>

            <!-- Form Row 3 -->
            <div style="display: flex; flex-direction: column; margin-bottom: 1.8rem;">
                <label style="display: block; font-size: 0.88rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">
                    💡 Kinh Nghiệm Giảng Dạy & Thành Tích Dạy Kèm
                </label>
                <textarea name="kinh_nghiem" class="form-control" rows="5" required placeholder="Mô tả chi tiết các thành tích học tập, giải thưởng, kinh nghiệm dạy kèm trước đây và phương pháp truyền đạt kiến thức..." style="width: 100%; padding: 0.85rem 1.1rem; background: #ffffff; border: 2px solid #cbd5e1; border-radius: 10px; font-size: 0.95rem; color: #0f172a; font-family: inherit;">{{ old('kinh_nghiem', $ho_so->kinh_nghiem ?? '') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block" style="width: 100%; padding: 1rem; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important; color: #ffffff !important; font-weight: 800; font-size: 1.05rem; border: none; border-radius: 12px; cursor: pointer; box-shadow: 0 6px 20px rgba(37,99,235,0.35);">
                <i class="fas fa-save" style="margin-right: 0.5rem;"></i> Lưu Thông Tin & Gửi Phê Duyệt
            </button>
        </form>
    </div>
</div>
@endsection