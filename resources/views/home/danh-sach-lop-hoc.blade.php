@extends('layouts.public')

@section('title', 'Danh Sách Lớp Học Mới - Gia Sư Tri Thức')

@section('content')

<div style="background: linear-gradient(180deg, #eff6ff 0%, #f8fafc 100%); padding: 2.8rem 0 2.4rem 0; border-bottom: 1px solid #e2e8f0; margin-bottom: 2.5rem;">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <span style="display: inline-block; background: #dbeafe; color: #1e40af; font-size: 0.78rem; font-weight: 800; padding: 0.3rem 0.85rem; border-radius: 50px; margin-bottom: 0.6rem;">
                CƠ HỘI NHẬN LỚP DẠY KÈM UY TÍN
            </span>
            <h1 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin: 0 0 0.4rem 0;">📚 Danh Sách Lớp Học Mới Cần Gia Sư</h1>
            <p style="color: #64748b; font-size: 0.96rem; margin: 0;">Cập nhật liên tục các lớp dạy kèm tại nhà & Online từ phụ huynh trên toàn quốc.</p>
        </div>
        <div style="background: #ffffff; padding: 0.9rem 1.3rem; border-radius: 14px; border: 1px solid #cbd5e1; display: flex; align-items: center; gap: 0.85rem; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
            <div style="width: 42px; height: 42px; border-radius: 10px; background: #dbeafe; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                <i class="fas fa-book-open"></i>
            </div>
            <div>
                <div style="font-size: 1.2rem; font-weight: 800; color: #0f172a;">{{ $lop_hocs->total() }} lớp đang mở</div>
                <div style="font-size: 0.76rem; color: #16a34a; font-weight: 600;">● Đang nhận hồ sơ ứng tuyển</div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-bottom: 4rem;">
    <!-- Filter Form -->
    <div style="background: #ffffff; padding: 1.5rem; border-radius: 18px; border: 1px solid #cbd5e1; box-shadow: 0 6px 24px rgba(15, 23, 42, 0.04); margin-bottom: 2.2rem;">
        <form method="GET" action="{{ route('danh-sach-lop-hoc') }}" style="display: flex; flex-direction: column; gap: 1rem;">
            <!-- Hàng 1: 4 ô lọc dàn đều chuẩn tỉ lệ 1:1:1:1 -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                <div>
                    <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: block;">📚 Môn học</label>
                    <input type="text" name="mon_hoc" class="form-control" placeholder="Toán, Lý, Tiếng Anh..." value="{{ request('mon_hoc') }}" style="width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 0.68rem 0.9rem; font-size: 0.9rem;">
                </div>
                <div>
                    <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: block;">🎯 Khối lớp</label>
                    <select name="khoi_lop" class="form-select" style="width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 0.68rem 0.9rem; font-size: 0.9rem;">
                        <option value="">Tất cả khối lớp</option>
                        @foreach(['Lớp 1','Lớp 2','Lớp 3','Lớp 4','Lớp 5','Lớp 6','Lớp 7','Lớp 8','Lớp 9','Lớp 10','Lớp 11','Lớp 12','Luyện Thi Đại Học'] as $kl)
                            <option value="{{ $kl }}" {{ request('khoi_lop') === $kl ? 'selected' : '' }}>{{ $kl }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: block;">🏙️ Tỉnh / Thành Phố</label>
                    <select name="tinh_thanh" class="form-select select-tinh-thanh" data-selected-tinh="{{ request('tinh_thanh') }}" style="width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 0.68rem 0.9rem; font-size: 0.9rem;">
                        <option value="">Tất cả Tỉnh / Thành</option>
                        @foreach(\App\Helpers\DiaDiem::getTinhThanhList() as $tinh)
                            <option value="{{ $tinh }}" {{ request('tinh_thanh') === $tinh ? 'selected' : '' }}>{{ $tinh }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: block;">📍 Quận / Huyện / TP</label>
                    <select name="quan_huyen" class="form-select select-quan-huyen" data-selected-quan="{{ request('quan_huyen') }}" style="width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 0.68rem 0.9rem; font-size: 0.9rem;">
                        <option value="">Tất cả Quận / Huyện</option>
                        @if(request('tinh_thanh'))
                            @foreach(\App\Helpers\DiaDiem::getQuanHuyenByTinh(request('tinh_thanh')) as $quan)
                                <option value="{{ $quan }}" {{ request('quan_huyen') === $quan ? 'selected' : '' }}>{{ $quan }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <!-- Hàng 2: Lọc nhanh môn học & Nút tìm kiếm -->
            <div style="display: flex; justify-content: space-between; gap: 0.85rem; align-items: center; border-top: 1px dashed #e2e8f0; padding-top: 0.9rem; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 0.45rem; flex-wrap: wrap;">
                    <span style="font-size: 0.78rem; font-weight: 700; color: #64748b;">Chuyên môn:</span>
                    @foreach(['Toán', 'Tiếng Anh', 'Vật Lý', 'Hóa Học', 'Ngữ Văn', 'Tiểu Học'] as $quickMon)
                        <a href="{{ route('danh-sach-lop-hoc', ['mon_hoc' => $quickMon]) }}"
                           style="font-size: 0.78rem; font-weight: 600; padding: 0.28rem 0.7rem; border-radius: 50px; text-decoration: none; border: 1px solid {{ request('mon_hoc') === $quickMon ? '#2563eb' : '#cbd5e1' }}; background: {{ request('mon_hoc') === $quickMon ? '#eff6ff' : '#f8fafc' }}; color: {{ request('mon_hoc') === $quickMon ? '#1d4ed8' : '#475569' }};">
                            {{ $quickMon }}
                        </a>
                    @endforeach
                </div>
                <div style="display: flex; gap: 0.65rem; align-items: center;">
                    <a href="{{ route('danh-sach-lop-hoc') }}" class="btn btn-outline" style="padding: 0.62rem 1.2rem; border-radius: 10px; font-size: 0.86rem;">
                        <i class="fas fa-redo"></i> Xóa Lọc
                    </a>
                    <button type="submit" class="btn btn-primary" style="padding: 0.62rem 1.5rem; border-radius: 10px; font-size: 0.86rem; font-weight: 700;">
                        <i class="fas fa-search"></i> Tìm Lớp Ngay
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Danh sách thẻ lớp học đồng đều 100% -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.75rem; align-items: stretch;">
        @forelse($lop_hocs as $lop)
        <div class="glass-card" style="border-radius: 20px; padding: 1.7rem; background: #ffffff; border: 1px solid #e2e8f0; display: flex; flex-direction: column; height: 100%; box-sizing: border-box; box-shadow: 0 6px 18px rgba(15, 23, 42, 0.03); transition: all 0.22s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='#93c5fd';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#e2e8f0';">
            {{-- Hàng 1: Mã lớp + Khối lớp & Học phí cố định 1 dòng (không bao giờ bị rớt dòng lệch chiều cao) --}}
            <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem; margin-bottom: 0.85rem; height: 30px;">
                <div style="display: flex; align-items: center; gap: 0.4rem; overflow: hidden; min-width: 0;">
                    <span style="font-size: 0.74rem; font-weight: 800; color: #1e40af; background: #dbeafe; padding: 0.22rem 0.55rem; border-radius: 6px; flex-shrink: 0;">
                        {{ $lop->ma_lop }}
                    </span>
                    <span class="badge badge-info" style="font-size: 0.76rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block;" title="{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}">
                        {{ $lop->khoi_lop }}
                    </span>
                </div>
                <span style="font-weight: 800; color: #2563eb; font-size: 1rem; white-space: nowrap; flex-shrink: 0;">
                    {{ $lop->hoc_phi_hien_thi }}
                </span>
            </div>

            {{-- Hàng 2: Tiêu đề cố định chính xác 2 dòng --}}
            <h3 style="font-size: 1.04rem; font-weight: 800; color: #0f172a; margin: 0 0 0.8rem 0; line-height: 1.4; height: 2.8em; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;" title="Tuyển gia sư dạy {{ $lop->mon_hoc }} {{ $lop->khoi_lop }}">
                Tuyển gia sư dạy {{ $lop->mon_hoc }} {{ $lop->khoi_lop }}
            </h3>

            {{-- Hàng 3: Khung thông tin chi tiết đồng đều từng dòng --}}
            <div style="background: #f8fafc; padding: 0.95rem 1rem; border-radius: 14px; border: 1px solid #f1f5f9; font-size: 0.85rem; color: #475569; line-height: 1.6; margin-bottom: 1.2rem; flex: 1 1 auto; display: flex; flex-direction: column; justify-content: flex-start; gap: 0.35rem;">
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
                    📝 <strong>Yêu cầu:</strong> {{ Str::limit($lop->yeu_cau_gia_su ?: 'Gia sư nhiệt tình, vững chuyên môn', 45) }}
                </div>
            </div>

            {{-- Hàng 4: Nút bấm cố định ở đáy --}}
            <div style="margin-top: auto;">
                <a href="{{ route('chi-tiet-lop-hoc', $lop->id) }}" class="btn btn-primary btn-sm btn-block" style="border-radius: 10px; width: 100%; padding: 0.65rem; font-size: 0.86rem; font-weight: 700;">
                    <i class="fas fa-paper-plane"></i> Xem Chi Tiết & Đăng Ký Nhận Lớp
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
