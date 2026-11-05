@extends('layouts.app')
@section('title', 'Đội Ngũ Gia Sư')
@section('page-title', 'Tìm Kiếm & Lựa Chọn Gia Sư')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('hocvien.dashboard') }}" class="nav-link {{ request()->routeIs('hocvien.dashboard') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
<p class="nav-section-title">Tìm Gia Sư</p>
<div class="nav-item"><a href="{{ route('hocvien.gia-su') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-user-graduate"></i></span> Gia Sư</a></div>
<div class="nav-item"><a href="{{ route('hocvien.tao-yeu-cau') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-plus-circle"></i></span> Tạo Yêu Cầu Mới</a></div>
<div class="nav-item"><a href="{{ route('hocvien.danh-sach-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-list"></i></span> Danh Sách Lớp</a></div>
<p class="nav-section-title">Hệ Thống</p>
<div class="nav-item"><a href="{{ route('thong-bao.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-bell"></i></span> Thông Báo</a></div>
<div class="nav-item"><a href="{{ route('tai-khoan.cai-dat') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-cog"></i></span> Cài Đặt Tài Khoản</a></div>
@endsection

@section('content')
{{-- Banner Chào Mừng --}}
<div style="background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%); border-radius: 20px; padding: 1.8rem 2.2rem; color: #ffffff; margin-bottom: 1.8rem; box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1.2rem;">
        <div>
            <span style="background:rgba(255,255,255,0.2); color:#fff; font-size:0.78rem; font-weight:700; padding:3px 12px; border-radius:20px; display:inline-block; margin-bottom:0.5rem; letter-spacing:0.5px;">
                ⭐ ĐỘI NGŨ GIA SƯ ĐÃ KIỂM DUYỆT
            </span>
            <h2 style="font-size: 1.45rem; font-weight: 800; margin: 0 0 0.3rem 0;">Danh Sách Gia Sư Phù Hợp Cho Bạn</h2>
            <p style="font-size: 0.9rem; color: rgba(255,255,255,0.85); margin: 0; max-width: 650px;">
                Xem phong cách giảng dạy, đánh giá thực tế và lịch rảnh của gia sư. Bạn có thể nhấn <strong>Mời Gia Sư Ngay</strong> để đăng ký giờ học trực tiếp.
            </p>
        </div>
        <a href="{{ route('hocvien.tao-yeu-cau') }}" class="btn" style="background:#ffffff !important; color:#1e40af !important; font-weight:800; padding:0.85rem 1.4rem; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.15);">
            <i class="fas fa-bullhorn" style="margin-right:0.4rem; color:#2563eb;"></i> Hoặc Đăng Yêu Cầu Tìm Lớp
        </a>
    </div>
</div>

{{-- Bộ lọc gia sư --}}
<div class="glass-card" style="padding: 1.4rem; border-radius: 16px; background:#fff; margin-bottom: 1.8rem;">
    <form method="GET" action="{{ route('hocvien.gia-su') }}" style="display: grid; grid-template-columns: 2fr 1.2fr 1.2fr auto auto; gap: 0.8rem; align-items: center;">
        <div>
            <input type="text" name="search" class="form-control" placeholder="Tìm theo tên gia sư, trường học, chuyên ngành..." value="{{ request('search') }}">
        </div>
        <div>
            <select name="mon_day" class="form-control">
                <option value="">Tất cả môn dạy</option>
                <option value="Toán" {{ request('mon_day') === 'Toán' ? 'selected' : '' }}>Toán học</option>
                <option value="Tiếng Anh" {{ request('mon_day') === 'Tiếng Anh' ? 'selected' : '' }}>Tiếng Anh</option>
                <option value="Vật Lý" {{ request('mon_day') === 'Vật Lý' ? 'selected' : '' }}>Vật Lý</option>
                <option value="Hóa Học" {{ request('mon_day') === 'Hóa Học' ? 'selected' : '' }}>Hóa Học</option>
                <option value="Ngữ Văn" {{ request('mon_day') === 'Ngữ Văn' ? 'selected' : '' }}>Ngữ Văn</option>
                <option value="Sinh Học" {{ request('mon_day') === 'Sinh Học' ? 'selected' : '' }}>Sinh Học</option>
                <option value="Tin Học" {{ request('mon_day') === 'Tin Học' ? 'selected' : '' }}>Tin Học / Lập trình</option>
            </select>
        </div>
        <div>
            <input type="text" name="khu_vuc" class="form-control" placeholder="Khu vực / Quận Huyện..." value="{{ request('khu_vuc') }}">
        </div>
        <button type="submit" class="btn btn-primary" style="padding: 0.75rem 1.2rem; border-radius: 10px;">
            <i class="fas fa-search"></i> Lọc
        </button>
        @if(request()->anyFilled(['search', 'mon_day', 'khu_vuc']))
        <a href="{{ route('hocvien.gia-su') }}" class="btn btn-outline" style="padding: 0.75rem 1rem; border-radius: 10px;" title="Xóa bộ lọc">
            <i class="fas fa-times"></i>
        </a>
        @endif
    </form>
</div>

{{-- Thống kê số lượng --}}
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.2rem;">
    <p style="color:#64748b; font-size:0.9rem; margin:0;">
        Tìm thấy <strong style="color:#2563eb;">{{ $gia_sus->total() }}</strong> gia sư uy tín sẵn sàng nhận dạy
    </p>
</div>

{{-- Lưới thẻ Gia sư --}}
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem;">
    @forelse($gia_sus as $hs)
    <div class="glass-card" style="border-radius: 18px; padding: 1.6rem; background: #ffffff; border: 1px solid #e2e8f0; display:flex; flex-direction:column; justify-content:space-between; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 30px rgba(37,99,235,0.1)';" onmouseout="this.style.transform='none'; this.style.boxShadow='none';">
        <div>
            {{-- Header card --}}
            <div style="display: flex; gap: 1.1rem; align-items: center; margin-bottom: 1.1rem;">
                <div style="position:relative; flex-shrink:0;">
                    <img src="{{ $hs->avatar_url }}" alt="{{ $hs->taiKhoan->ho_ten }}"
                         style="width: 72px; height: 72px; border-radius: 50%; object-fit: cover; border: 3px solid #2563eb; box-shadow: 0 4px 12px rgba(37,99,235,0.2);">
                    <span style="position:absolute; bottom:2px; right:2px; width:16px; height:16px; background:#10b981; border:2.5px solid #fff; border-radius:50%;"></span>
                </div>
                <div>
                    <h3 style="font-size: 1.08rem; font-weight: 800; color: #0f172a; margin: 0 0 0.3rem 0;">
                        {{ $hs->taiKhoan->ho_ten }}
                    </h3>
                    @if($hs->mon_day)
                    <span style="background:#eff6ff; color:#2563eb; font-size:0.75rem; font-weight:700; padding:3px 10px; border-radius:20px; display:inline-block;">
                        📚 {{ $hs->mon_day }}
                    </span>
                    @else
                    <span class="badge badge-success" style="font-size:0.72rem;">✓ Đã kiểm duyệt</span>
                    @endif
                </div>
            </div>

            {{-- Body info --}}
            <div style="font-size: 0.86rem; color: #475569; line-height: 1.8; margin-bottom: 1rem; border-top: 1px solid #f1f5f9; padding-top: 0.8rem;">
                <div>🎓 <strong>Trường:</strong> <span style="color:#0f172a; font-weight:600;">{{ $hs->truong_hoc }}</span></div>
                <div>📖 <strong>Chuyên ngành:</strong> <span style="color:#0f172a; font-weight:600;">{{ $hs->chuyen_nganh }}</span></div>
                <div>📍 <strong>Khu vực dạy:</strong> <span style="color:#0f172a; font-weight:600;">{{ $hs->khu_vuc_nhan_day }}</span></div>
                @if($hs->hoc_phi_theo_gio)
                <div>💰 <strong>Học phí:</strong> <span style="color:#2563eb; font-weight:800; font-size:0.95rem;">{{ number_format($hs->hoc_phi_theo_gio) }}đ</span> / buổi</div>
                @endif
                @if($hs->kinh_nghiem)
                <div style="margin-top:0.4rem; color:#64748b; font-size:0.82rem; font-style:italic;">
                    💡 {{ Str::limit($hs->kinh_nghiem, 75) }}
                </div>
                @endif
            </div>

            {{-- Đánh giá & Trạng thái --}}
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.1rem; padding:0.4rem 0.75rem; background:#f8fafc; border-radius:10px; border:1px solid #e2e8f0;">
                <div style="display:flex; align-items:center; gap:0.3rem;">
                    <span style="color:#f59e0b; font-weight:800; font-size:0.9rem;">⭐ {{ number_format($hs->diem_trung_binh ?? 5.0, 1) }}</span>
                    <span style="color:#64748b; font-size:0.75rem;">({{ $hs->so_luot_danh_gia ?? 0 }} nhận xét)</span>
                </div>
                @if($hs->so_lop_da_day)
                <span style="font-size:0.75rem; color:#475569; font-weight:600;">
                    <i class="fas fa-chalkboard-teacher" style="color:#2563eb;"></i> {{ $hs->so_lop_da_day }} lớp đã dạy
                </span>
                @else
                <span style="font-size:0.75rem; color:#10b981; font-weight:700;">
                    ✓ Sẵn sàng nhận lớp
                </span>
                @endif
            </div>
        </div>

        {{-- Action Buttons --}}
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:0.6rem; border-top:1px solid #f1f5f9; padding-top:0.9rem;">
            <a href="{{ route('chi-tiet-gia-su', $hs->id) }}" class="btn btn-outline btn-sm" style="border-radius: 10px; font-size: 0.82rem; padding: 0.55rem; text-align:center; display:flex; align-items:center; justify-content:center; gap:0.3rem;">
                <i class="fas fa-id-card"></i> Xem Hồ Sơ
            </a>
            <a href="{{ route('chi-tiet-gia-su', $hs->id) }}#dang-ky-lich-day" class="btn btn-primary btn-sm" style="border-radius: 10px; font-size: 0.82rem; padding: 0.55rem; background:linear-gradient(135deg,#2563eb,#1d4ed8); border:none; text-align:center; display:flex; align-items:center; justify-content:center; gap:0.3rem; box-shadow:0 3px 10px rgba(37,99,235,0.25);">
                <i class="fas fa-calendar-check"></i> Mời Gia Sư
            </a>
        </div>
    </div>
    @empty
    <div style="grid-column: 1 / -1; text-align:center; padding:3.5rem 1rem; background:#fff; border-radius:18px; border:1px solid #e2e8f0;">
        <div style="font-size: 3rem; margin-bottom: 0.8rem;">🔍</div>
        <h4 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin-bottom: 0.3rem;">Không tìm thấy gia sư phù hợp</h4>
        <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1.2rem;">Vui lòng thử tìm kiếm bằng từ khóa khác hoặc xóa bộ lọc.</p>
        <a href="{{ route('hocvien.gia-su') }}" class="btn btn-primary btn-sm">Xem tất cả gia sư</a>
    </div>
    @endforelse
</div>

<div style="margin-top: 1.8rem;">
    {{ $gia_sus->links() }}
</div>
@endsection
