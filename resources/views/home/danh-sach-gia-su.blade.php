@extends('layouts.public')

@section('title', 'Đội Ngũ Gia Sư Uy Tín - Gia Sư Tri Thức')

@section('content')

<div style="background: linear-gradient(135deg, #eff6ff 0%, #f0fdf4 100%); padding: 3.5rem 0; border-bottom: 1px solid #e2e8f0; margin-bottom: 3rem;">
    <div class="container">
        <h1 style="font-size: 2.2rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem;">👨‍🏫 Đội Ngũ Gia Sư Đã Kiểm Duyệt</h1>
        <p style="color: #64748b; font-size: 1rem;">Danh sách giáo viên, sinh viên giỏi từ các trường Đại học top đầu toàn quốc.</p>
    </div>
</div>

<div class="container" style="margin-bottom: 4rem;">
    <!-- Filter Bar -->
    <form method="GET" action="{{ route('danh-sach-gia-su') }}" class="filter-bar" style="box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
        <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên gia sư, trường học, chuyên ngành, môn dạy..." value="{{ request('keyword') }}">
        <input type="text" name="khu_vuc" class="form-control" placeholder="Khu vực (Quận/Huyện)..." value="{{ request('khu_vuc') }}" style="max-width: 200px;">
        <select name="sort" class="form-select" style="max-width: 210px;" onchange="this.form.submit()">
            <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Sắp xếp: Mới nhất</option>
            <option value="rating_desc" {{ request('sort') === 'rating_desc' ? 'selected' : '' }}>⭐ Đánh giá cao nhất</option>
            <option value="rating_count" {{ request('sort') === 'rating_count' ? 'selected' : '' }}>💬 Nhiều nhận xét nhất</option>
            <option value="classes_desc" {{ request('sort') === 'classes_desc' ? 'selected' : '' }}>🏫 Dạy nhiều lớp nhất</option>
            <option value="fee_asc" {{ request('sort') === 'fee_asc' ? 'selected' : '' }}>💰 Học phí: Thấp → Cao</option>
            <option value="fee_desc" {{ request('sort') === 'fee_desc' ? 'selected' : '' }}>💰 Học phí: Cao → Thấp</option>
        </select>
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm</button>
        <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-outline"><i class="fas fa-times"></i> Xóa</a>
    </form>

    @if($gia_sus->count() > 0)
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <p style="color:#64748b; font-size:0.88rem; margin:0;">
            Tìm thấy <strong style="color:#2563eb;">{{ $gia_sus->total() }}</strong> gia sư phù hợp
        </p>
        @if(request('sort') === 'rating_desc')
        <span style="font-size:0.8rem; color:#d97706; background:#fef3c7; padding:3px 10px; border-radius:20px; font-weight:700;">
            ⭐ Đang hiển thị theo đánh giá cao nhất
        </span>
        @endif
    </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.8rem;">
        @forelse($gia_sus as $hs)
        <div class="glass-card" style="border-radius: 18px; padding: 1.8rem; background: #ffffff; transition: transform 0.2s ease, box-shadow 0.2s ease; position:relative; overflow:hidden;"
             onmouseenter="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 16px 40px rgba(37,99,235,0.13)'"
             onmouseleave="this.style.transform=''; this.style.boxShadow=''">

            {{-- Stars ribbon --}}
            @if(($hs->diem_trung_binh >= 4.8 && $hs->so_luot_danh_gia > 0) || $hs->so_lop_da_day >= 10)
            <div style="position:absolute;top:12px;right:12px;background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;font-size:0.7rem;font-weight:700;padding:3px 9px;border-radius:20px;letter-spacing:0.3px;">
                ⭐ Đánh Giá Cao
            </div>
            @endif

            <div style="display: flex; gap: 1.2rem; align-items: center; margin-bottom: 1.2rem;">
                <div style="position:relative; flex-shrink:0;">
                    <img src="{{ $hs->avatar_url }}" alt="{{ $hs->taiKhoan->ho_ten }}"
                         style="width: 76px; height: 76px; border-radius: 50%; object-fit: cover; border: 3px solid #2563eb; box-shadow: 0 4px 12px rgba(37,99,235,0.2);">
                    <span style="position:absolute;bottom:2px;right:2px;width:16px;height:16px;background:#10b981;border:2.5px solid #fff;border-radius:50%;"></span>
                </div>
                <div>
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 0.3rem; line-height:1.3;">{{ $hs->taiKhoan->ho_ten }}</h3>
                    @if($hs->mon_day)
                    <span style="background:#eff6ff;color:#2563eb;font-size:0.75rem;font-weight:700;padding:3px 10px;border-radius:20px;">📚 {{ $hs->mon_day }}</span>
                    @else
                    <span class="badge badge-success" style="font-size:0.75rem;"><i class="fas fa-check-circle"></i> Đã duyệt</span>
                    @endif
                </div>
            </div>

            <div style="font-size: 0.88rem; color: #475569; line-height: 1.9; margin-bottom: 1.1rem;">
                <div>🎓 <strong>Trường:</strong> <span style="color: #0f172a; font-weight: 600;">{{ $hs->truong_hoc }}</span></div>
                <div>📖 <strong>Chuyên ngành:</strong> <span style="color: #0f172a; font-weight: 600;">{{ $hs->chuyen_nganh }}</span></div>
                <div>📍 <strong>Khu vực dạy:</strong> <span style="color: #0f172a; font-weight: 600;">{{ $hs->khu_vuc_nhan_day }}</span></div>
                @if($hs->hoc_phi_theo_gio)
                <div>💰 <strong>Học phí/buổi:</strong> <span style="color:#2563eb; font-weight:700;">{{ number_format($hs->hoc_phi_theo_gio) }}đ</span></div>
                @endif
                <div style="margin-top:0.3rem; color:#64748b; font-size:0.83rem;">💡 {{ Str::limit($hs->kinh_nghiem, 75) }}</div>
            </div>

            {{-- Đánh giá & Thống kê --}}
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.9rem; padding: 0.45rem 0.75rem; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                <div style="display:flex; align-items:center; gap:0.3rem;">
                    <span style="color:#f59e0b; font-weight:800; font-size:0.92rem;">⭐ {{ number_format($hs->diem_trung_binh ?? 5.0, 1) }}</span>
                    <span style="color:#64748b; font-size:0.75rem;">({{ $hs->so_luot_danh_gia ?? 0 }} nhận xét)</span>
                </div>
                @if($hs->so_lop_da_day)
                <span style="font-size:0.75rem; color:#475569; font-weight:600;"><i class="fas fa-chalkboard-teacher" style="color:#2563eb;"></i> {{ $hs->so_lop_da_day }} lớp</span>
                @else
                <span style="font-size:0.75rem; color:#10b981; font-weight:600;"><i class="fas fa-check-circle"></i> Sẵn sàng</span>
                @endif
            </div>

            <a href="{{ route('chi-tiet-gia-su', $hs->id) }}" class="btn btn-primary btn-sm btn-block" style="border-radius: 10px; background:linear-gradient(135deg,#2563eb,#7c3aed); border:none;">
                <i class="fas fa-id-card"></i> Xem Chi Tiết Hồ Sơ
            </a>
        </div>
        @empty
        <div style="grid-column: span 3; text-align: center; padding: 4rem 2rem; background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0;">
            <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
            <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a;">Không tìm thấy gia sư phù hợp</h3>
            <p style="color: #64748b;">Vui lòng thử thay đổi từ khóa tìm kiếm hoặc xóa các điều kiện lọc.</p>
        </div>
        @endforelse
    </div>

    <div style="margin-top: 2rem;">
        {{ $gia_sus->withQueryString()->links() }}
    </div>
</div>

@endsection
