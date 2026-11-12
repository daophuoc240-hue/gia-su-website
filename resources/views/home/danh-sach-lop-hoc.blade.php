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
    <div style="background: #ffffff; padding: 1.4rem; border-radius: 16px; border: 1px solid #cbd5e1; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 2rem;">
        <form method="GET" action="{{ route('danh-sach-lop-hoc') }}" style="display: flex; flex-direction: column; gap: 1rem;">
            <!-- Hàng 1: 4 ô lọc dàn đều chuẩn tỉ lệ -->
            <div style="display: grid; grid-template-columns: 1.3fr 1fr 1.15fr 1.15fr; gap: 1rem;">
                <div>
                    <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: block;">Môn học</label>
                    <input type="text" name="mon_hoc" class="form-control" placeholder="Toán, Lý, Tiếng Anh..." value="{{ request('mon_hoc') }}" style="width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 0.65rem 0.9rem;">
                </div>
                <div>
                    <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: block;">Khối lớp</label>
                    <select name="khoi_lop" class="form-select" style="width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 0.65rem 0.9rem;">
                        <option value="">Tất cả khối lớp</option>
                        @foreach(['Lớp 1','Lớp 2','Lớp 3','Lớp 4','Lớp 5','Lớp 6','Lớp 7','Lớp 8','Lớp 9','Lớp 10','Lớp 11','Lớp 12'] as $kl)
                            <option value="{{ $kl }}" {{ request('khoi_lop') === $kl ? 'selected' : '' }}>{{ $kl }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: block;">Tỉnh / Thành Phố</label>
                    <select name="tinh_thanh" class="form-select select-tinh-thanh" data-selected-tinh="{{ request('tinh_thanh') }}" style="width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 0.65rem 0.9rem;">
                        <option value="">-- Tất cả Tỉnh / Thành --</option>
                        @foreach(\App\Helpers\DiaDiem::getTinhThanhList() as $tinh)
                            <option value="{{ $tinh }}" {{ request('tinh_thanh') === $tinh ? 'selected' : '' }}>{{ $tinh }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: block;">Quận / Huyện / TP</label>
                    <select name="quan_huyen" class="form-select select-quan-huyen" data-selected-quan="{{ request('quan_huyen') }}" style="width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 0.65rem 0.9rem;">
                        <option value="">-- Tất cả Quận / Huyện --</option>
                        @if(request('tinh_thanh'))
                            @foreach(\App\Helpers\DiaDiem::getQuanHuyenByTinh(request('tinh_thanh')) as $quan)
                                <option value="{{ $quan }}" {{ request('quan_huyen') === $quan ? 'selected' : '' }}>{{ $quan }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <!-- Hàng 2: Nút tìm kiếm & Xóa lọc căn phải -->
            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; align-items: center; border-top: 1px dashed #e2e8f0; padding-top: 0.8rem;">
                <a href="{{ route('danh-sach-lop-hoc') }}" class="btn btn-outline" style="padding: 0.65rem 1.3rem; border-radius: 10px; font-size: 0.88rem;">
                    <i class="fas fa-redo"></i> Xóa Bộ Lọc
                </a>
                <button type="submit" class="btn btn-primary" style="padding: 0.65rem 1.6rem; border-radius: 10px; font-size: 0.88rem; font-weight: 700;">
                    <i class="fas fa-search"></i> Tìm Kiếm Lớp Học
                </button>
            </div>
        </form>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.8rem; align-items: stretch;">
        @forelse($lop_hocs as $lop)
        <div class="glass-card" style="border-radius: 18px; padding: 1.8rem; background: #ffffff; display: flex; flex-direction: column; height: 100%; box-sizing: border-box; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            {{-- Hàng 1: Badge môn khối & Học phí cố định chiều cao --}}
            <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem; margin-bottom: 0.85rem; height: 32px;">
                <span class="badge badge-info" style="font-size: 0.82rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 58%; display: inline-block;" title="{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}">
                    {{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}
                </span>
                <span style="font-weight: 800; color: #2563eb; font-size: 1.05rem; white-space: nowrap; flex-shrink: 0;">
                    {{ number_format($lop->hoc_phi) }} đ/tháng
                </span>
            </div>

            {{-- Hàng 2: Tiêu đề cố định chính xác 2 dòng, không thò thụt --}}
            <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin-bottom: 0.75rem; line-height: 1.4; height: 2.8em; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;" title="Tuyển gia sư dạy {{ $lop->mon_hoc }} {{ $lop->khoi_lop }}">
                Tuyển gia sư dạy {{ $lop->mon_hoc }} {{ $lop->khoi_lop }}
            </h3>

            {{-- Hàng 3: Danh sách thông tin chi tiết đồng đều từng dòng --}}
            <div style="font-size: 0.86rem; color: #475569; line-height: 1.6; margin-bottom: 1.2rem; flex: 1 1 auto; display: flex; flex-direction: column; justify-content: flex-start; gap: 0.35rem;">
                <div style="height: 2.8em; line-height: 1.4; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;" title="{{ $lop->dia_chi_day }}">
                    📍 <strong>Địa chỉ:</strong> {{ $lop->dia_chi_day }}
                </div>
                <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    🗓️ <strong>Số buổi:</strong> {{ $lop->so_buoi_trung_binh }} buổi/tuần
                </div>
                <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $lop->thoi_gian_day }}">
                    ⏰ <strong>Thời gian:</strong> {{ $lop->thoi_gian_day }}
                </div>
                <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $lop->yeu_cau_gia_su }}">
                    📝 <strong>Yêu cầu:</strong> {{ Str::limit($lop->yeu_cau_gia_su, 48) }}
                </div>
            </div>

            {{-- Hàng 4: Nút bấm luôn luôn nằm ngang hàng ở đáy thẻ --}}
            <div style="margin-top: auto; padding-top: 0.8rem; border-top: 1px solid #f1f5f9;">
                <a href="{{ route('chi-tiet-lop-hoc', $lop->id) }}" class="btn btn-primary btn-sm btn-block" style="border-radius: 10px; width: 100%; padding: 0.65rem; font-size: 0.88rem;">
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
