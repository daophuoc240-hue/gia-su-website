@extends('layouts.app')
@section('title', 'Tổng Quan Phụ Huynh & Học Viên')
@section('page-title', 'Khu Vực Phụ Huynh & Học Viên')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('hocvien.dashboard') }}" class="nav-link {{ request()->routeIs('hocvien.dashboard') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
<p class="nav-section-title">Tìm Gia Sư</p>
<div class="nav-item"><a href="{{ route('hocvien.tao-yeu-cau') }}" class="nav-link {{ request()->routeIs('hocvien.tao-yeu-cau') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-plus-circle"></i></span> Tạo Yêu Cầu Mới</a></div>
<div class="nav-item"><a href="{{ route('hocvien.danh-sach-lop') }}" class="nav-link {{ request()->routeIs('hocvien.danh-sach-lop') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-list"></i></span> Danh Sách Lớp</a></div>
@endsection

@section('content')
<!-- Welcome Banner Card -->
<div style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); border-radius: 20px; padding: 2rem 2.2rem; color: #ffffff; margin-bottom: 2rem; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(2, 132, 199, 0.25);">
    <div style="position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.15); padding: 0.35rem 0.9rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700; margin-bottom: 0.8rem; border: 1px solid rgba(255,255,255,0.25);">
                👨‍👩‍👦 HỌC VIÊN & PHỤ HUYNH
            </div>
            <h2 style="font-size: 1.6rem; font-weight: 800; margin-bottom: 0.4rem;">Xin chào, {{ auth()->user()->ho_ten }}! 👋</h2>
            <p style="font-size: 0.95rem; color: rgba(255,255,255,0.85); max-width: 600px;">
                Đăng yêu cầu tìm gia sư ngay hôm nay để nhận danh sách các gia sư giỏi, tận tâm phù hợp nhất cho con em của bạn!
            </p>
        </div>
        <div>
            <a href="{{ route('hocvien.tao-yeu-cau') }}" class="btn" style="background: #ffffff !important; color: #0284c7 !important; font-weight: 800; padding: 0.85rem 1.6rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.15);">
                <i class="fas fa-plus-circle" style="margin-right: 0.4rem;"></i> Đăng Yêu Cầu Mới
            </a>
        </div>
    </div>
</div>

{{-- 4 Stat Cards --}}
<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-card-icon purple"><i class="fas fa-book-open"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['tong_lop'] ?? 0 }}</div>
            <div class="stat-card-label">Tổng lớp đã tạo</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-icon orange"><i class="fas fa-search"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['dang_tim'] ?? 0 }}</div>
            <div class="stat-card-label">Đang tìm gia sư</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-icon blue"><i class="fas fa-check-circle"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['da_co_gia_su'] ?? 0 }}</div>
            <div class="stat-card-label">Đã ghép gia sư</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon green"><i class="fas fa-flag-checkered"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['hoan_thanh'] ?? 0 }}</div>
            <div class="stat-card-label">Lớp hoàn thành</div>
        </div>
    </div>
</div>

{{-- Recent Classes --}}
<div class="glass-card" style="padding: 1.8rem;">
    <div class="page-header" style="margin-bottom: 1.2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
        <div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a;">📋 Danh Sách Yêu Cầu Tìm Gia Sư Gần Đây</h3>
            <p style="font-size: 0.85rem; color: #64748b;">Quản lý và theo dõi trạng thái bài đăng của bạn</p>
        </div>
        <a href="{{ route('hocvien.tao-yeu-cau') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tạo Yêu Cầu Mới</a>
    </div>

    @forelse($lop_hocs as $lop)
    <a href="{{ route('hocvien.chi-tiet-lop', $lop->id) }}" style="text-decoration:none;">
        <div style="padding: 1.1rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 0.9rem; display: flex; justify-content: space-between; align-items: center; transition: all 0.2s;" onmouseover="this.style.borderColor='#2563eb'" onmouseout="this.style.borderColor='#e2e8f0'">
            <div>
                <div style="font-weight: 800; font-size: 1.02rem; color: #0f172a; margin-bottom: 0.3rem;">
                    📚 {{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}
                </div>
                <div style="font-size: 0.85rem; color: #475569; display: flex; gap: 1.2rem; flex-wrap: wrap;">
                    <span>📍 <strong>Địa chỉ:</strong> {{ $lop->dia_chi_day }}</span>
                    <span>💰 <strong>Học phí:</strong> {{ number_format($lop->muc_hoc_phi) }} đ/buổi</span>
                    <span>⏱️ <strong>Số buổi:</strong> {{ $lop->so_buoi_tuan }} buổi/tuần</span>
                </div>
            </div>
            <div>
                <span class="badge badge-{{ $lop->trang_thai === 'dang_tim' ? 'warning' : 'success' }}" style="font-size: 0.85rem; padding: 0.4rem 0.9rem;">
                    {{ $lop->trang_thai_label }}
                </span>
            </div>
        </div>
    </a>
    @empty
    <div class="empty-state" style="padding: 3rem 1.5rem; background: #f8fafc; border-radius: 16px; border: 2px dashed #cbd5e1;">
        <div class="empty-state-icon" style="font-size: 3.5rem;">📚</div>
        <h4 style="font-size: 1.2rem; font-weight: 800;">Bạn chưa đăng bài tìm gia sư nào</h4>
        <p style="margin-bottom: 1.2rem;">Tạo yêu cầu đầu tiên để nhận thông tin danh sách các gia sư phù hợp nhất.</p>
        <a href="{{ route('hocvien.tao-yeu-cau') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Đăng Yêu Cầu Tìm Gia Sư Ngay
        </a>
    </div>
    @endforelse
</div>
@endsection