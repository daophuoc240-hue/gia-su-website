@extends('layouts.app')
@section('title', 'Tổng Quan Quản Trị Hệ Thống')
@section('page-title', 'Bảng Điều Khiển Quản Trị')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item">
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-chart-line"></i></span> Tổng Quan
    </a>
</div>
<p class="nav-section-title">Quản Lý</p>
<div class="nav-item">
    <a href="{{ route('admin.tai-khoan.index') }}" class="nav-link {{ request()->routeIs('admin.tai-khoan*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('admin.ho-so.index') }}" class="nav-link {{ request()->routeIs('admin.ho-so*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư
        @if(isset($stats) && ($stats['ho_so_cho_duyet'] ?? 0) > 0)
            <span class="nav-badge">{{ $stats['ho_so_cho_duyet'] }}</span>
        @endif
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('admin.lop-hoc.index') }}" class="nav-link {{ request()->routeIs('admin.lop-hoc*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span> Lớp Học
    </a>
</div>
@endsection

@section('content')
<!-- Welcome Banner Card -->
<div style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%); border-radius: 20px; padding: 2rem 2.2rem; color: #ffffff; margin-bottom: 2rem; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.25);">
    <div style="position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.15); padding: 0.35rem 0.9rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700; margin-bottom: 0.8rem; border: 1px solid rgba(255,255,255,0.25);">
                👑 QUẢN TRỊ VIÊN HỆ THỐNG
            </div>
            <h2 style="font-size: 1.6rem; font-weight: 800; margin-bottom: 0.4rem;">Tổng Quan Điều Hành Hệ Thống</h2>
            <p style="font-size: 0.95rem; color: rgba(255,255,255,0.85); max-width: 600px;">
                Quản lý người dùng, kiểm duyệt hồ sơ gia sư và điều phối phân công lớp học trên toàn bộ trung tâm.
            </p>
        </div>
        <div style="display: flex; gap: 0.8rem;">
            <a href="{{ route('admin.ho-so.index') }}" class="btn" style="background: #2563eb !important; color: #ffffff !important; font-weight: 800; padding: 0.85rem 1.4rem; border-radius: 12px;">
                <i class="fas fa-user-check" style="margin-right: 0.4rem;"></i> Duyệt Hồ Sơ ({{ $stats['ho_so_cho_duyet'] ?? 0 }})
            </a>
        </div>
    </div>
</div>

{{-- 6 Stat Cards Grid --}}
<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-card-icon purple"><i class="fas fa-users"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['tong_tai_khoan'] ?? 0 }}</div>
            <div class="stat-card-label">Tổng tài khoản</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon blue"><i class="fas fa-chalkboard-teacher"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['tong_gia_su'] ?? 0 }}</div>
            <div class="stat-card-label">Gia sư đã đăng ký</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon orange"><i class="fas fa-user-graduate"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['tong_hoc_vien'] ?? 0 }}</div>
            <div class="stat-card-label">Học viên / Phụ huynh</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon red"><i class="fas fa-clock"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['ho_so_cho_duyet'] ?? 0 }}</div>
            <div class="stat-card-label">Hồ sơ chờ duyệt</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon orange"><i class="fas fa-search"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['lop_dang_tim'] ?? 0 }}</div>
            <div class="stat-card-label">Lớp đang tìm gia sư</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon green"><i class="fas fa-check-circle"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['lop_da_co_gia_su'] ?? 0 }}</div>
            <div class="stat-card-label">Lớp đã ghép thành công</div>
        </div>
    </div>
</div>

{{-- Interactive Charts Section --}}
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
    {{-- Biểu đồ phân bố môn học --}}
    <div class="glass-card" style="padding: 1.8rem;">
        <div style="margin-bottom: 1.2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
            <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 0.2rem;">
                <i class="fas fa-chart-pie" style="color: #2563eb; margin-right: 0.5rem;"></i> Phân Bố Nhu Cầu Môn Học
            </h3>
            <p style="font-size: 0.82rem; color: #64748b; margin: 0;">Thống kê tỷ lệ các môn học được phụ huynh đăng ký nhiều nhất</p>
        </div>
        <div style="position: relative; height: 260px; display: flex; justify-content: center;">
            <canvas id="subjectChart"></canvas>
        </div>
    </div>

    {{-- Biểu đồ tình trạng ghép lớp --}}
    <div class="glass-card" style="padding: 1.8rem;">
        <div style="margin-bottom: 1.2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
            <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 0.2rem;">
                <i class="fas fa-chart-bar" style="color: #10b981; margin-right: 0.5rem;"></i> Tiến Độ Ghép Lớp Học
            </h3>
            <p style="font-size: 0.82rem; color: #64748b; margin: 0;">Trạng thái xử lý và điều phối gia sư trên toàn hệ thống</p>
        </div>
        <div style="position: relative; height: 260px;">
            <canvas id="statusChart"></canvas>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
    {{-- Lớp mới nhất --}}
    <div class="glass-card" style="padding: 1.8rem;">
        <div class="page-header" style="margin-bottom: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
            <div>
                <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a;">📋 Lớp Học Mới Nhất</h3>
                <p style="font-size: 0.82rem; color: #64748b;">Các lớp vừa được yêu cầu</p>
            </div>
            <a href="{{ route('admin.lop-hoc.index') }}" class="btn btn-outline btn-sm">Xem tất cả</a>
        </div>
        @forelse($lop_moi_nhat as $lop)
        <div style="padding: 0.9rem 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}</div>
                <div style="font-size: 0.82rem; color: #64748b;">Học viên: {{ $lop->hocVien->ho_ten ?? '' }} • {{ number_format($lop->muc_hoc_phi) }} đ/buổi</div>
            </div>
            <span class="badge badge-{{ $lop->trang_thai === 'dang_tim' ? 'warning' : 'success' }}">
                {{ $lop->trang_thai_label }}
            </span>
        </div>
        @empty
        <div class="empty-state" style="padding: 2rem;">
            <div class="empty-state-icon">📭</div>
            <p>Chưa có lớp học nào</p>
        </div>
        @endforelse
    </div>

    {{-- Hồ sơ chờ duyệt --}}
    <div class="glass-card" style="padding: 1.8rem;">
        <div class="page-header" style="margin-bottom: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
            <div>
                <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a;">👤 Hồ Sơ Gia Sư Chờ Duyệt</h3>
                <p style="font-size: 0.82rem; color: #64748b;">Cần xem xét phê duyệt ngay</p>
            </div>
            <a href="{{ route('admin.ho-so.index') }}" class="btn btn-outline btn-sm">Xem tất cả</a>
        </div>
        @forelse($ho_so_moi as $hs)
        <div style="padding: 0.9rem 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">{{ $hs->taiKhoan->ho_ten ?? '' }}</div>
                <div style="font-size: 0.82rem; color: #64748b;">{{ $hs->chuyen_nganh }} • {{ $hs->truong_hoc }}</div>
            </div>
            <a href="{{ route('admin.ho-so.chi-tiet', $hs->id) }}" class="btn btn-primary btn-sm">Duyệt ngay</a>
        </div>
        @empty
        <div class="empty-state" style="padding: 2rem;">
            <div class="empty-state-icon" style="font-size: 2.5rem;">✅</div>
            <h4 style="font-size: 1rem;">Không có hồ sơ chờ duyệt</h4>
            <p style="font-size: 0.82rem;">Tất cả hồ sơ gia sư đã được xử lý xong!</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Biểu đồ tròn: Phân bố môn học
    const subjectData = @json($chartMonHoc);
    const ctxSubject = document.getElementById('subjectChart').getContext('2d');
    new Chart(ctxSubject, {
        type: 'doughnut',
        data: {
            labels: Object.keys(subjectData),
            datasets: [{
                data: Object.values(subjectData),
                backgroundColor: [
                    '#2563eb', // Xanh dương
                    '#10b981', // Xanh lá
                    '#f59e0b', // Cam vàng
                    '#ec4899', // Hồng
                    '#8b5cf6', // Tím
                    '#06b6d4', // Cyan
                    '#94a3b8'  // Xám
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 14,
                        font: { size: 11, weight: '600' }
                    }
                }
            },
            cutout: '65%'
        }
    });

    // 2. Biểu đồ cột: Tình trạng lớp học
    const statusData = @json($chartTrangThai);
    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'bar',
        data: {
            labels: Object.keys(statusData),
            datasets: [{
                label: 'Số lượng lớp học',
                data: Object.values(statusData),
                backgroundColor: [
                    'rgba(245, 158, 11, 0.85)', // Vàng cam - Đang tìm
                    'rgba(37, 99, 235, 0.85)',   // Xanh dương - Đã có gia sư
                    'rgba(16, 185, 129, 0.85)'   // Xanh lá - Hoàn thành
                ],
                borderRadius: 8,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: { size: 11 }
                    },
                    grid: { color: 'rgba(226, 232, 240, 0.6)' }
                },
                x: {
                    ticks: { font: { size: 11, weight: '600' } },
                    grid: { display: false }
                }
            }
        }
    });
});
</script>
@endpush