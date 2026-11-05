@extends('layouts.public')

@section('title', 'Danh Sách Lớp Học Mới - Gia Sư Tri Thức')

@section('content')

<div style="background: #eff6ff; padding: 3rem 0; border-bottom: 1px solid #e2e8f0; margin-bottom: 3rem;">
    <div class="container">
        <h1 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem;">📚 Danh Sách Lớp Học Mới Cần Gia Sư</h1>
        <p style="color: #64748b; font-size: 1rem;">Cập nhật liên tục các lớp dạy kèm từ phụ huynh toàn quốc.</p>
    </div>
</div>

<div class="container" style="margin-bottom: 4rem;">
    <!-- Filter Form -->
    <form method="GET" action="{{ route('danh-sach-lop-hoc') }}" class="filter-bar" style="box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
        <input type="text" name="mon_hoc" class="form-control" placeholder="Môn học (Toán, Lý, Tiếng Anh...)" value="{{ request('mon_hoc') }}">
        <select name="khoi_lop" class="form-select" style="max-width: 180px;">
            <option value="">Tất cả khối lớp</option>
            @foreach(['Lớp 1','Lớp 2','Lớp 3','Lớp 4','Lớp 5','Lớp 6','Lớp 7','Lớp 8','Lớp 9','Lớp 10','Lớp 11','Lớp 12'] as $kl)
                <option value="{{ $kl }}" {{ request('khoi_lop') === $kl ? 'selected' : '' }}>{{ $kl }}</option>
            @endforeach
        </select>
        <input type="text" name="dia_chi" list="danh-sach-khu-vuc-lop" class="form-control" placeholder="Quận/Huyện, Tỉnh/Thành..." value="{{ request('dia_chi') }}" style="max-width: 250px;">
        <datalist id="danh-sach-khu-vuc-lop">
            <option value="Quận 1">TP. Hồ Chí Minh - Quận 1</option>
            <option value="Quận 3">TP. Hồ Chí Minh - Quận 3</option>
            <option value="Quận 5">TP. Hồ Chí Minh - Quận 5</option>
            <option value="Quận 7">TP. Hồ Chí Minh - Quận 7</option>
            <option value="Quận 10">TP. Hồ Chí Minh - Quận 10</option>
            <option value="Bình Thạnh">TP. Hồ Chí Minh - Bình Thạnh</option>
            <option value="Gò Vấp">TP. Hồ Chí Minh - Gò Vấp</option>
            <option value="Tân Bình">TP. Hồ Chí Minh - Tân Bình</option>
            <option value="Phú Nhuận">TP. Hồ Chí Minh - Phú Nhuận</option>
            <option value="Thủ Đức">TP. Hồ Chí Minh - TP. Thủ Đức</option>
            <option value="TP. Hồ Chí Minh">TP. Hồ Chí Minh (Toàn thành phố)</option>
            <option value="Cầu Giấy">Hà Nội - Quận Cầu Giấy</option>
            <option value="Ba Đình">Hà Nội - Quận Ba Đình</option>
            <option value="Đống Đa">Hà Nội - Quận Đống Đa</option>
            <option value="Thanh Xuân">Hà Nội - Quận Thanh Xuân</option>
            <option value="Hà Nội">Hà Nội (Toàn thành phố)</option>
            <option value="Hải Châu">Đà Nẵng - Quận Hải Châu</option>
            <option value="Ninh Kiều">Cần Thơ - Quận Ninh Kiều</option>
            <option value="Huế">Thừa Thiên Huế - TP. Huế</option>
            <option value="Hải Phòng">Hải Phòng</option>
        </datalist>
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm Lớp</button>
        <a href="{{ route('danh-sach-lop-hoc') }}" class="btn btn-outline"><i class="fas fa-times"></i> Xóa lọc</a>
    </form>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.8rem;">
        @forelse($lop_hocs as $lop)
        <div class="glass-card" style="border-radius: 18px; padding: 1.8rem; background: #ffffff;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <span class="badge badge-info" style="font-size: 0.85rem;">{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}</span>
                <span style="font-weight: 800; color: #2563eb; font-size: 1.1rem;">{{ number_format($lop->hoc_phi) }} đ/tháng</span>
            </div>
            <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a; margin-bottom: 0.8rem; line-height: 1.4;">
                Tuyển gia sư dạy {{ $lop->mon_hoc }} {{ $lop->khoi_lop }}
            </h3>
            <div style="font-size: 0.88rem; color: #64748b; line-height: 1.8; margin-bottom: 1.4rem;">
                <div>📍 <strong>Địa chỉ:</strong> {{ $lop->dia_chi_day }}</div>
                <div>🗓️ <strong>Số buổi:</strong> {{ $lop->so_buoi_trung_binh }} buổi/tuần</div>
                <div>⏰ <strong>Thời gian:</strong> {{ $lop->thoi_gian_day }}</div>
                <div>📝 <strong>Yêu cầu:</strong> {{ Str::limit($lop->yeu_cau_gia_su, 65) }}</div>
            </div>
            <a href="{{ route('chi-tiet-lop-hoc', $lop->id) }}" class="btn btn-primary btn-sm btn-block" style="border-radius: 10px;">
                <i class="fas fa-paper-plane"></i> Xem Chi Tiết & Đăng Ký Dạy
            </a>
        </div>
        @empty
        <div style="grid-column: span 3; text-align: center; padding: 4rem 2rem; background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0;">
            <div style="font-size: 3rem; margin-bottom: 1rem;">📚</div>
            <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a;">Không có lớp học phù hợp</h3>
            <p style="color: #64748b;">Vui lòng thử chọn tiêu chí tìm kiếm khác.</p>
        </div>
        @endforelse
    </div>

    <div style="margin-top: 2rem;">
        {{ $lop_hocs->withQueryString()->links() }}
    </div>
</div>

@endsection
