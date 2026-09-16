@extends('layouts.app')
@section('title', 'Dashboard Gia Sư')
@section('page-title', 'Dashboard Gia Sư')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item">
    <a href="{{ route('giasu.dashboard') }}" class="nav-link {{ request()->routeIs('giasu.dashboard') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard
    </a>
</div>
<p class="nav-section-title">Hồ Sơ & Lớp Học</p>
<div class="nav-item">
    <a href="{{ route('giasu.ho-so') }}" class="nav-link {{ request()->routeIs('giasu.ho-so*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link {{ request()->routeIs('giasu.tim-kiem-lop') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('giasu.ket-qua') }}" class="nav-link {{ request()->routeIs('giasu.ket-qua') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký
    </a>
</div>
@endsection

@section('content')
<!-- Welcome Banner Card -->
<div style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); border-radius: 20px; padding: 2rem 2.2rem; color: #ffffff; margin-bottom: 2rem; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);">
    <div style="position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.15); padding: 0.35rem 0.9rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700; margin-bottom: 0.8rem; border: 1px solid rgba(255,255,255,0.25);">
                👨‍🏫 TÀI KHOẢN GIA SƯ
            </div>
            <h2 style="font-size: 1.6rem; font-weight: 800; margin-bottom: 0.4rem;">Xin chào, {{ auth()->user()->ho_ten }}! 👋</h2>
            <p style="font-size: 0.95rem; color: rgba(255,255,255,0.85); max-width: 600px;">
                Chào mừng bạn quay trở lại Trung tâm Gia sư. Hãy kiểm tra danh sách lớp học mới nhất và cập nhật hồ sơ để nhận lớp ngay hôm nay!
            </p>
        </div>
        <div>
            <a href="{{ route('giasu.tim-kiem-lop') }}" class="btn" style="background: #ffffff !important; color: #1e3a8a !important; font-weight: 800; padding: 0.85rem 1.6rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.15);">
                <i class="fas fa-search" style="margin-right: 0.4rem; color: #2563eb;"></i> Tìm Lớp Mới Ngay
            </a>
        </div>
    </div>
</div>

{{-- Notification Alerts --}}
@if(!$ho_so)
<div class="alert alert-warning" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-exclamation-triangle" style="font-size: 1.2rem;"></i>
    <div>
        <strong>Bạn chưa hoàn thiện hồ sơ gia sư:</strong> Vui lòng cập nhật đầy đủ trình độ học vấn và kinh nghiệm để trung tâm tiến hành duyệt tài khoản. 
        <a href="{{ route('giasu.ho-so') }}" style="color: #b45309; font-weight: 800; text-decoration: underline; margin-left: 0.5rem;">Cập nhật hồ sơ ngay →</a>
    </div>
</div>
@elseif($ho_so->trang_thai_duyet === 'cho_duyet')
<div class="alert alert-warning" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-clock" style="font-size: 1.2rem;"></i>
    <div>
        <strong>Hồ sơ đang chờ phê duyệt:</strong> Ban quản trị đang tiến hành xem xét hồ sơ của bạn. Bạn sẽ nhận được thông báo ngay khi hồ sơ được kích hoạt!
    </div>
</div>
@elseif($ho_so->trang_thai_duyet === 'tu_choi')
<div class="alert alert-error" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-times-circle" style="font-size: 1.2rem;"></i>
    <div>
        <strong>Hồ sơ bị từ chối:</strong> {{ $ho_so->ly_do_tu_choi ?? 'Hồ sơ chưa đạt yêu cầu của trung tâm.' }} 
        <a href="{{ route('giasu.ho-so') }}" style="color: #991b1b; font-weight: 800; text-decoration: underline; margin-left: 0.5rem;">Cập nhật lại thông tin →</a>
    </div>
</div>
@else
<div class="alert alert-success" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-check-circle" style="font-size: 1.2rem;"></i>
    <div>
        <strong>Tài khoản đã được xác thực:</strong> Hồ sơ của bạn đã được phê duyệt thành công! Bạn có thể tự do chọn và đăng ký nhận các lớp học phù hợp.
    </div>
</div>
@endif

{{-- 4 Stat Cards Grid --}}
<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-card-icon orange"><i class="fas fa-hourglass-half"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['cho_duyet'] }}</div>
            <div class="stat-card-label">Đang chờ duyệt</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-icon green"><i class="fas fa-check-circle"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['da_duyet'] }}</div>
            <div class="stat-card-label">Lớp đã nhận</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-icon red"><i class="fas fa-times-circle"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['tu_choi'] }}</div>
            <div class="stat-card-label">Yêu cầu bị từ chối</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon blue"><i class="fas fa-chalkboard-teacher"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['lop_dang_tim'] ?? 0 }}</div>
            <div class="stat-card-label">Lớp học hiện có</div>
        </div>
    </div>
</div>

{{-- Quick Action Cards --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.2rem; margin-bottom: 2rem;">
    <a href="{{ route('giasu.ho-so') }}" style="text-decoration: none;">
        <div class="glass-card" style="padding: 1.4rem; display: flex; align-items: center; gap: 1rem; border-left: 5px solid #2563eb; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 48px; height: 48px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: #2563eb;">🆔</div>
            <div>
                <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">Hồ Sơ Cá Nhân</div>
                <div style="font-size: 0.8rem; color: #64748b;">Chỉnh sửa thông tin & bằng cấp</div>
            </div>
        </div>
    </a>

    <a href="{{ route('giasu.tim-kiem-lop') }}" style="text-decoration: none;">
        <div class="glass-card" style="padding: 1.4rem; display: flex; align-items: center; gap: 1rem; border-left: 5px solid #10b981; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 48px; height: 48px; background: #ecfdf5; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: #10b981;">🔍</div>
            <div>
                <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">Tìm Lớp Phù Hợp</div>
                <div style="font-size: 0.8rem; color: #64748b;">Xem danh sách lớp đang mở</div>
            </div>
        </div>
    </a>

    <a href="{{ route('giasu.ket-qua') }}" style="text-decoration: none;">
        <div class="glass-card" style="padding: 1.4rem; display: flex; align-items: center; gap: 1rem; border-left: 5px solid #7c3aed; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 48px; height: 48px; background: #f3e8ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: #7c3aed;">📊</div>
            <div>
                <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">Lịch Sử Đăng Ký</div>
                <div style="font-size: 0.8rem; color: #64748b;">Theo dõi tiến độ nhận lớp</div>
            </div>
        </div>
    </a>
</div>

{{-- Recent Registrations Table --}}
<div class="glass-card" style="padding: 1.8rem;">
    <div class="page-header" style="margin-bottom: 1.2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
        <div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a;">📋 Danh Sách Đăng Ký Lớp Gần Đây</h3>
            <p style="font-size: 0.85rem; color: #64748b;">Các lớp học bạn đã gửi yêu cầu nhận dạy</p>
        </div>
        <a href="{{ route('giasu.ket-qua') }}" class="btn btn-outline btn-sm">Xem tất cả →</a>
    </div>

    @forelse($dang_ky as $dk)
    <div style="padding: 1.1rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 0.9rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <div style="font-weight: 800; font-size: 1rem; color: #0f172a; margin-bottom: 0.3rem;">
                📚 {{ $dk->lopHoc->mon_hoc }} - {{ $dk->lopHoc->khoi_lop }}
            </div>
            <div style="font-size: 0.85rem; color: #475569; display: flex; gap: 1.2rem; flex-wrap: wrap;">
                <span>📍 <strong>Địa chỉ:</strong> {{ $dk->lopHoc->dia_chi_day }}</span>
                <span>💰 <strong>Học phí:</strong> {{ number_format($dk->lopHoc->muc_hoc_phi) }} đ/buổi</span>
                <span>📅 <strong>Thời gian:</strong> {{ $dk->created_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>
        <div>
            <span class="badge {{ $dk->trang_thai === 'da_duyet' ? 'badge-success' : ($dk->trang_thai === 'tu_choi' ? 'badge-danger' : 'badge-warning') }}" style="font-size: 0.85rem; padding: 0.4rem 0.9rem;">
                {{ $dk->trang_thai_label }}
            </span>
        </div>
    </div>
    @empty
    <div class="empty-state" style="padding: 3rem 1.5rem; background: #f8fafc; border-radius: 16px; border: 2px dashed #cbd5e1;">
        <div class="empty-state-icon" style="font-size: 3.5rem;">📭</div>
        <h4 style="font-size: 1.2rem; font-weight: 800;">Bạn chưa đăng ký nhận lớp nào</h4>
        <p style="margin-bottom: 1.2rem;">Hãy duyệt qua danh sách các lớp học đang mở để tìm lớp dạy phù hợp nhất.</p>
        <a href="{{ route('giasu.tim-kiem-lop') }}" class="btn btn-primary">
            <i class="fas fa-search"></i> Khám Phá Lớp Học Mới Ngay
        </a>
    </div>
    @endforelse
</div>
@endsection