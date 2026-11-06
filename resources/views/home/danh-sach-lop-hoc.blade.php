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
        <select name="tinh_thanh" class="form-select select-tinh-thanh" data-selected-tinh="{{ request('tinh_thanh') }}" style="max-width: 195px;">
            <option value="">-- Tất cả Tỉnh / Thành --</option>
            @foreach(\App\Helpers\DiaDiem::getTinhThanhList() as $tinh)
                <option value="{{ $tinh }}" {{ request('tinh_thanh') === $tinh ? 'selected' : '' }}>{{ $tinh }}</option>
            @endforeach
        </select>
        <select name="quan_huyen" class="form-select select-quan-huyen" data-selected-quan="{{ request('quan_huyen') }}" style="max-width: 205px;">
            <option value="">-- Tất cả Quận / Huyện / TP --</option>
            @if(request('tinh_thanh'))
                @foreach(\App\Helpers\DiaDiem::getQuanHuyenByTinh(request('tinh_thanh')) as $quan)
                    <option value="{{ $quan }}" {{ request('quan_huyen') === $quan ? 'selected' : '' }}>{{ $quan }}</option>
                @endforeach
            @endif
        </select>
        <div style="display: flex; gap: 0.6rem; align-items: center; margin-left: auto; flex-shrink: 0;">
            <button type="submit" class="btn btn-primary" style="padding: 0.65rem 1.4rem; white-space: nowrap; border-radius: 10px;">
                <i class="fas fa-search"></i> Tìm Lớp
            </button>
            <a href="{{ route('danh-sach-lop-hoc') }}" class="btn btn-outline" style="padding: 0.65rem 1.1rem; white-space: nowrap; border-radius: 10px;">
                <i class="fas fa-times"></i> Xóa Lọc
            </a>
        </div>
    </form>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.8rem; align-items: stretch;">
        @forelse($lop_hocs as $lop)
        <div class="glass-card" style="border-radius: 18px; padding: 1.8rem; background: #ffffff; display: flex; flex-direction: column; height: 100%; box-sizing: border-box;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <span class="badge badge-info" style="font-size: 0.85rem;">{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}</span>
                <span style="font-weight: 800; color: #2563eb; font-size: 1.1rem; white-space: nowrap;">{{ number_format($lop->hoc_phi) }} đ/tháng</span>
            </div>
            <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a; margin-bottom: 0.8rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 2.8em;">
                Tuyển gia sư dạy {{ $lop->mon_hoc }} {{ $lop->khoi_lop }}
            </h3>
            <div style="font-size: 0.88rem; color: #64748b; line-height: 1.8; margin-bottom: 1.4rem; flex: 1 1 auto; display: flex; flex-direction: column; justify-content: flex-start; gap: 0.25rem;">
                <div style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 2.85em; line-height: 1.45;" title="{{ $lop->dia_chi_day }}">📍 <strong>Địa chỉ:</strong> {{ $lop->dia_chi_day }}</div>
                <div>🗓️ <strong>Số buổi:</strong> {{ $lop->so_buoi_trung_binh }} buổi/tuần</div>
                <div>⏰ <strong>Thời gian:</strong> {{ $lop->thoi_gian_day }}</div>
                <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $lop->yeu_cau_gia_su }}">📝 <strong>Yêu cầu:</strong> {{ Str::limit($lop->yeu_cau_gia_su, 65) }}</div>
            </div>
            <div style="margin-top: auto; padding-top: 0.8rem; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('chi-tiet-lop-hoc', $lop->id) }}" class="btn btn-primary btn-sm btn-block" style="border-radius: 10px; width: 100%;">
                    <i class="fas fa-paper-plane"></i> Xem Chi Tiết & Đăng Ký Dạy
                </a>
            </div>
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
