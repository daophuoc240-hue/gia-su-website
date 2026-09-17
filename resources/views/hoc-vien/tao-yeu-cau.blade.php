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
                    <input type="number" name="so_buoi_tuan" class="form-control" value="{{ old('so_buoi_tuan', 2) }}" min="1" max="7" required placeholder="Số buổi...">
                </div>
                <div>
                    <label class="form-label">💰 Mức Học Phí (VNĐ / Buổi)</label>
                    <input type="number" name="muc_hoc_phi" class="form-control" value="{{ old('muc_hoc_phi', 150000) }}" min="10000" step="10000" required placeholder="Mức học phí...">
                </div>
            </div>

            <div style="margin-bottom: 1.3rem;">
                <label class="form-label">📍 Địa Chỉ Dạy Học Trực Tiếp</label>
                <input type="text" name="dia_chi_day" class="form-control" value="{{ old('dia_chi_day') }}" required placeholder="Nhập địa chỉ nhà, tên đường, Phường/Xã, Quận/Huyện...">
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