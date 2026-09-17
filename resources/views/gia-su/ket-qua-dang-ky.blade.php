@extends('layouts.app')
@section('title', 'Kết Quả Đăng Ký Lớp')
@section('page-title', 'Lịch Sử & Kết Quả Đăng Ký Lớp')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
<p class="nav-section-title">Hồ Sơ & Lớp Học</p>
<div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
<div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
<div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@endsection

@section('content')
<div class="glass-card" style="padding: 2.2rem;">
    <div class="page-header" style="margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">
        <div>
            <h2 style="font-size: 1.3rem; font-weight: 800; color: #0f172a;">📊 Tiến Độ & Kết Quả Nhận Lớp</h2>
            <p style="font-size: 0.88rem; color: #64748b;">Theo dõi trạng thái xét duyệt của các bài đăng bạn đã ứng tuyển</p>
        </div>
        <a href="{{ route('giasu.tim-kiem-lop') }}" class="btn btn-primary"><i class="fas fa-search"></i> Tìm Lớp Mới</a>
    </div>

    @forelse($dang_kys as $dk)
    <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 16px; padding: 1.4rem; margin-bottom: 1.2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.2rem;">
        <div style="display: flex; gap: 1.2rem; align-items: center;">
            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=200&q=80" alt="Class image" style="width: 80px; height: 80px; border-radius: 14px; object-fit: cover;">
            <div>
                <div style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 0.3rem;">
                    📚 {{ $dk->lopHoc->mon_hoc }} - {{ $dk->lopHoc->khoi_lop }}
                </div>
                <div style="font-size: 0.85rem; color: #475569; margin-bottom: 0.4rem;">
                    📍 {{ $dk->lopHoc->dia_chi_day }} • 💰 {{ number_format($dk->lopHoc->muc_hoc_phi) }} đ/buổi
                </div>
                @if($dk->gioi_thieu_ban_than)
                <div style="font-size: 0.8rem; color: #64748b; background: #f8fafc; padding: 0.4rem 0.8rem; border-radius: 6px;">
                    📝 <em>"{{ Str::limit($dk->gioi_thieu_ban_than, 80) }}"</em>
                </div>
                @endif
            </div>
        </div>

        <div style="text-align: right;">
            <div style="margin-bottom: 0.5rem;">
                <span class="badge {{ $dk->trang_thai === 'da_duyet' ? 'badge-success' : ($dk->trang_thai === 'tu_choi' ? 'badge-danger' : 'badge-warning') }}" style="font-size: 0.88rem; padding: 0.4rem 1rem;">
                    {{ $dk->trang_thai_label }}
                </span>
            </div>
            <div style="font-size: 0.78rem; color: #94a3b8;">Đăng ký lúc: {{ $dk->created_at->format('d/m/Y H:i') }}</div>
        </div>
    </div>
    @empty
    <div class="empty-state" style="padding: 3rem 1.5rem; background: #f8fafc; border-radius: 16px; border: 2px dashed #cbd5e1;">
        <div class="empty-state-icon" style="font-size: 3.5rem;">📊</div>
        <h4 style="font-size: 1.2rem; font-weight: 800;">Chưa có lịch sử đăng ký nào</h4>
        <p style="margin-bottom: 1.2rem;">Hãy duyệt qua danh sách lớp học đang tuyển gia sư để đăng ký ngay.</p>
        <a href="{{ route('giasu.tim-kiem-lop') }}" class="btn btn-primary"><i class="fas fa-search"></i> Khám Phá Lớp Học</a>
    </div>
    @endforelse

    <div style="margin-top: 1.5rem;">
        {{ $dang_kys->links() }}
    </div>
</div>
@endsection