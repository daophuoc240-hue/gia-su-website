@extends('layouts.app')
@section('title', 'Kết Quả Đăng Ký')
@section('page-title', 'Kết Quả Đăng Ký')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a></div>
<p class="nav-section-title">Hồ Sơ & Lớp Học</p>
<div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
<div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
<div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@endsection
@section('content')
<div class="page-header">
    <div><h2>📋 Kết Quả Đăng Ký</h2><p>Theo dõi tình trạng các lớp bạn đã đăng ký</p></div>
</div>
<div class="glass-card">
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr><th>#</th><th>Môn Học / Khối</th><th>Địa Chỉ</th><th>Học Phí</th><th>Trạng Thái</th><th>Thời Gian Đăng Ký</th></tr>
            </thead>
            <tbody>
                @forelse($dang_kys as $dk)
                <tr>
                    <td style="color:var(--text-muted);">{{ $loop->iteration }}</td>
                    <td>
                        <div style="font-weight:600; color:var(--text-primary);">{{ $dk->lopHoc->mon_hoc }}</div>
                        <div style="font-size:0.78rem; color:var(--text-muted);">{{ $dk->lopHoc->khoi_lop }} • {{ $dk->lopHoc->so_buoi_tuan }} buổi/tuần</div>
                    </td>
                    <td style="font-size:0.85rem;">{{ $dk->lopHoc->dia_chi_day }}</td>
                    <td style="font-weight:600; color:#fda085;">{{ number_format($dk->lopHoc->muc_hoc_phi) }}đ</td>
                    <td>
                        @if($dk->trang_thai === 'da_duyet')
                        <span class="badge badge-success">✅ Đã được chọn!</span>
                        @elseif($dk->trang_thai === 'tu_choi')
                        <span class="badge badge-danger">❌ Không được chọn</span>
                        @else
                        <span class="badge badge-warning">⏳ Đang chờ duyệt</span>
                        @endif
                    </td>
                    <td style="color:var(--text-muted); font-size:0.82rem;">{{ $dk->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-state-icon">📭</div>
                            <h4>Chưa có đăng ký nào</h4>
                            <p><a href="{{ route('giasu.tim-kiem-lop') }}" style="color:var(--primary-start);">Tìm lớp để đăng ký →</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem;">{{ $dang_kys->links() }}</div>
</div>
@endsection
