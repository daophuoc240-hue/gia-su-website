@extends('layouts.app')
@section('title', 'Tạo Yêu Cầu Tìm Gia Sư')
@section('page-title', 'Đăng Bài Tìm Gia Sư Mới')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('hocvien.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
<p class="nav-section-title">Tìm Gia Sư</p>
<div class="nav-item"><a href="{{ route('hocvien.tao-yeu-cau') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-plus-circle"></i></span> Tạo Yêu Cầu Mới</a></div>
<div class="nav-item"><a href="{{ route('hocvien.danh-sach-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-list"></i></span> Danh Sách Lớp</a></div>
@endsection

@section('content')
<div style="max-width: 750px; margin: 0 auto;">
    <!-- Form Banner -->
    <div style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); border-radius: 20px; padding: 2rem; color: #ffffff; margin-bottom: 1.8rem; display: flex; justify-content: space-between; align-items: center; gap: 1.5rem; box-shadow: 0 10px 25px rgba(37,99,235,0.25);">
        <div>
            <div style="display:inline-flex; align-items:center; gap:0.4rem; background:rgba(255,255,255,0.2); padding:0.3rem 0.8rem; border-radius:20px; font-size:0.8rem; font-weight:700; margin-bottom:0.6rem;">
                📚 ĐĂNG BÀI TÌM GIA SƯ
            </div>
            <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 0.3rem;">Kết Nối Nhanh Với Gia Sư Giỏi</h2>
            <p style="font-size: 0.9rem; color: rgba(255,255,255,0.85);">Điền thông tin chi tiết về môn học, địa điểm và học phí để trung tâm chọn gia sư phù hợp nhất.</p>
        </div>
        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=250&q=80" alt="Learning" style="width:120px; height:85px; border-radius:12px; object-fit:cover; border:2px solid rgba(255,255,255,0.4);">
    </div>

    <div class="glass-card" style="padding: 2.2rem; border-radius: 20px;">
        <form method="POST" action="{{ route('hocvien.gui-yeu-cau') }}">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1.3rem;">
                <div>
                    <label class="form-label">📚 Môn Học Cần Tìm Gia Sư</label>
                    <input type="text" name="mon_hoc" class="form-control" value="{{ old('mon_hoc') }}" required placeholder="Ví dụ: Toán, Tiếng Anh, Vật Lý...">
                </div>
                <div>
                    <label class="form-label">🎓 Khối Lớp Học</label>
                    <select name="khoi_lop" class="form-select" required>
                        <option value="">-- Chọn khối lớp --</option>
                        @foreach(['Lớp 1','Lớp 2','Lớp 3','Lớp 4','Lớp 5','Lớp 6','Lớp 7','Lớp 8','Lớp 9','Lớp 10','Lớp 11','Lớp 12','Đại học / Khác'] as $kl)
                        <option value="{{ $kl }}" {{ old('khoi_lop') === $kl ? 'selected' : '' }}>{{ $kl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1.3rem;">
                <div>
                    <label class="form-label">⏱️ Số Buổi Học / Tuần</label>
                    <input type="number" id="so_buoi_tuan_input" name="so_buoi_tuan" class="form-control" value="{{ old('so_buoi_tuan', 3) }}" min="1" max="7" required placeholder="Số buổi...">
                </div>
                <div>
                    <label class="form-label">💰 Mức Học Phí (VNĐ / Buổi)</label>
                    <input type="number" name="muc_hoc_phi" class="form-control" value="{{ old('muc_hoc_phi', 150000) }}" min="10000" step="10000" required placeholder="Mức học phí...">
                </div>
            </div>

            {{-- Chọn lịch học chi tiết trong tuần (Theo yêu cầu giảng viên hướng dẫn) --}}
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 1.2rem; margin-bottom: 1.3rem;">
                <label class="form-label" style="margin-bottom: 0.6rem; display: flex; align-items: center; justify-content: space-between;">
                    <span><i class="fas fa-calendar-alt" style="color:#2563eb;"></i> <strong>Lịch Học Chi Tiết Trong Tuần</strong> <span style="color:#ef4444;">*</span></span>
                    <small style="color: #64748b; font-weight: normal;">Chọn các thứ có thể học</small>
                </label>
                <div style="display: flex; flex-wrap: wrap; gap: 0.6rem; margin-bottom: 0.9rem;">
                    @foreach(['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật'] as $thu)
                    <label style="cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; background: #ffffff; border: 1.5px solid #cbd5e1; padding: 0.45rem 0.85rem; border-radius: 10px; font-size: 0.88rem; font-weight: 600; user-select: none; transition: all 0.2s;">
                        <input type="checkbox" name="thu_hoc[]" value="{{ $thu }}" {{ in_array($thu, old('thu_hoc', ['Thứ 2', 'Thứ 4', 'Thứ 6'])) ? 'checked' : '' }} style="accent-color: #2563eb; width: 16px; height: 16px;">
                        <span>{{ $thu }}</span>
                    </label>
                    @endforeach
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label class="form-label" style="font-size: 0.82rem; margin-bottom: 0.3rem;">⏰ Ca học / Khung giờ học</label>
                        <select name="ca_hoc" class="form-select" style="font-size: 0.88rem;">
                            <option value="18:00 - 19:30" {{ old('ca_hoc') === '18:00 - 19:30' ? 'selected' : '' }}>18:00 - 19:30 (Tối phổ biến)</option>
                            <option value="19:30 - 21:00" {{ old('ca_hoc') === '19:30 - 21:00' ? 'selected' : '' }}>19:30 - 21:00 (Tối muộn)</option>
                            <option value="17:30 - 19:00" {{ old('ca_hoc') === '17:30 - 19:00' ? 'selected' : '' }}>17:30 - 19:00 (Đầu giờ tối)</option>
                            <option value="14:00 - 15:30" {{ old('ca_hoc') === '14:00 - 15:30' ? 'selected' : '' }}>14:00 - 15:30 (Chiều)</option>
                            <option value="08:30 - 10:00" {{ old('ca_hoc') === '08:30 - 10:00' ? 'selected' : '' }}>08:30 - 10:00 (Sáng cuối tuần)</option>
                            <option value="Linh hoạt theo thỏa thuận" {{ old('ca_hoc') === 'Linh hoạt theo thỏa thuận' ? 'selected' : '' }}>Linh hoạt theo thỏa thuận</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" style="font-size: 0.82rem; margin-bottom: 0.3rem;">✍️ Hoặc ghi chú lịch riêng (nếu có)</label>
                        <input type="text" name="thoi_gian_hoc" class="form-control" value="{{ old('thoi_gian_hoc') }}" placeholder="VD: T2-T4-T6 lúc 18h..." style="font-size: 0.88rem;">
                    </div>
                </div>
            </div>

            {{-- Địa điểm theo Huyện/Quận và Tỉnh/Thành phố --}}
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 1.2rem; margin-bottom: 1.3rem;">
                <label class="form-label" style="margin-bottom: 0.6rem;">
                    📍 <strong>Khu Vực & Địa Điểm Học (Tỉnh/Thành & Quận/Huyện)</strong> <span style="color:#ef4444;">*</span>
                </label>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 0.8rem;">
                    <div>
                        <label class="form-label" style="font-size: 0.82rem; margin-bottom: 0.3rem;">Tỉnh / Thành phố <span style="color:#ef4444;">*</span></label>
                        <select name="tinh_thanh" class="form-select" required style="font-size: 0.88rem;">
                            <option value="TP. Hồ Chí Minh" {{ old('tinh_thanh') === 'TP. Hồ Chí Minh' ? 'selected' : '' }}>TP. Hồ Chí Minh</option>
                            <option value="Hà Nội" {{ old('tinh_thanh') === 'Hà Nội' ? 'selected' : '' }}>Hà Nội</option>
                            <option value="Đà Nẵng" {{ old('tinh_thanh') === 'Đà Nẵng' ? 'selected' : '' }}>Đà Nẵng</option>
                            <option value="Hải Phòng" {{ old('tinh_thanh') === 'Hải Phòng' ? 'selected' : '' }}>Hải Phòng</option>
                            <option value="Cần Thơ" {{ old('tinh_thanh') === 'Cần Thơ' ? 'selected' : '' }}>Cần Thơ</option>
                            <option value="Thừa Thiên Huế" {{ old('tinh_thanh') === 'Thừa Thiên Huế' ? 'selected' : '' }}>Thừa Thiên Huế</option>
                            <option value="Bình Dương" {{ old('tinh_thanh') === 'Bình Dương' ? 'selected' : '' }}>Bình Dương</option>
                            <option value="Đồng Nai" {{ old('tinh_thanh') === 'Đồng Nai' ? 'selected' : '' }}>Đồng Nai</option>
                            <option value="Tỉnh / Thành khác" {{ old('tinh_thanh') === 'Tỉnh / Thành khác' ? 'selected' : '' }}>Tỉnh / Thành khác</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label" style="font-size: 0.82rem; margin-bottom: 0.3rem;">Quận / Huyện <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="quan_huyen" list="quan-huyen-goi-y" class="form-control" value="{{ old('quan_huyen') }}" required placeholder="Ví dụ: Quận 1, Bình Thạnh, Cầu Giấy..." style="font-size: 0.88rem;">
                        <datalist id="quan-huyen-goi-y">
                            <option value="Quận 1">
                            <option value="Quận 3">
                            <option value="Quận 5">
                            <option value="Quận 7">
                            <option value="Quận 10">
                            <option value="Quận Bình Thạnh">
                            <option value="Quận Gò Vấp">
                            <option value="Quận Tân Bình">
                            <option value="Quận Phú Nhuận">
                            <option value="TP. Thủ Đức">
                            <option value="Quận Cầu Giấy">
                            <option value="Quận Ba Đình">
                            <option value="Quận Đống Đa">
                            <option value="Quận Thanh Xuân">
                            <option value="Quận Hải Châu">
                            <option value="Quận Ninh Kiều">
                            <option value="TP. Huế">
                        </datalist>
                    </div>
                </div>
                <div>
                    <label class="form-label" style="font-size: 0.82rem; margin-bottom: 0.3rem;">Số nhà, tên đường, Phường/Xã (Tùy chọn)</label>
                    <input type="text" name="so_nha_duong" class="form-control" value="{{ old('so_nha_duong') }}" placeholder="VD: 123 Nguyễn Thị Minh Khai, Phường Bến Thành (hoặc để trống)" style="font-size: 0.88rem;">
                </div>
            </div>

            <div style="margin-bottom: 1.8rem;">
                <label class="form-label">📝 Yêu Cầu Thêm Cho Gia Sư (Tùy chọn)</label>
                <textarea name="yeu_cau_them" class="form-control" rows="4" placeholder="Mô tả chi tiết lực học của con em, thời gian rảnh học, yêu cầu gia sư Nam/Nữ, sinh viên hay giáo viên..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block" style="border-radius: 12px;">
                <i class="fas fa-paper-plane"></i> Đăng Yêu Cầu Tìm Gia Sư Ngay
            </button>
        </form>
    </div>
</div>
@endsection