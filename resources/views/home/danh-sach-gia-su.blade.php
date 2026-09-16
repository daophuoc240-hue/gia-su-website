@extends('layouts.public')

@section('title', 'Đội Ngũ Gia Sư Uy Tín - Gia Sư Tri Thức')

@section('content')

<div style="background: #eff6ff; padding: 3rem 0; border-bottom: 1px solid #e2e8f0; margin-bottom: 3rem;">
    <div class="container">
        <h1 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem;">👨‍🏫 Đội Ngũ Gia Sư Đã Kiểm Duyệt</h1>
        <p style="color: #64748b; font-size: 1rem;">Danh sách giáo viên, sinh viên giỏi từ các trường Đại học top đầu toàn quốc.</p>
    </div>
</div>

<div class="container" style="margin-bottom: 4rem;">
    <!-- Filter Bar -->
    <form method="GET" action="{{ route('danh-sach-gia-su') }}" class="filter-bar" style="box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
        <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên gia sư, trường học, chuyên ngành..." value="{{ request('keyword') }}">
        <input type="text" name="khu_vuc" class="form-control" placeholder="Khu vực (Quận/Huyện)..." value="{{ request('khu_vuc') }}" style="max-width: 240px;">
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm kiếm</button>
        <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-outline"><i class="fas fa-times"></i> Xóa lọc</a>
    </form>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.8rem;">
        @forelse($gia_sus as $hs)
        <div class="glass-card" style="border-radius: 18px; padding: 1.8rem; background: #ffffff;">
            <div style="display: flex; gap: 1.2rem; align-items: center; margin-bottom: 1.2rem;">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" alt="Avatar" style="width: 72px; height: 72px; border-radius: 50%; object-fit: cover; border: 3px solid #2563eb;">
                <div>
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin-bottom: 0.2rem;">{{ $hs->taiKhoan->ho_ten }}</h3>
                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> Đã duyệt hồ sơ</span>
                </div>
            </div>
            <div style="font-size: 0.88rem; color: #475569; line-height: 1.8; margin-bottom: 1.4rem;">
                <div>🎓 <strong>Trường:</strong> <span style="color: #0f172a; font-weight: 600;">{{ $hs->truong_hoc }}</span></div>
                <div>📖 <strong>Chuyên ngành:</strong> <span style="color: #0f172a; font-weight: 600;">{{ $hs->chuyen_nganh }}</span></div>
                <div>📍 <strong>Khu vực dạy:</strong> <span style="color: #0f172a; font-weight: 600;">{{ $hs->khu_vuc_nhan_day }}</span></div>
                <div>💡 <strong>Kinh nghiệm:</strong> {{ Str::limit($hs->kinh_nghiem, 70) }}</div>
            </div>
            <a href="{{ route('chi-tiet-gia-su', $hs->id) }}" class="btn btn-outline btn-sm btn-block" style="border-radius: 10px;">
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
