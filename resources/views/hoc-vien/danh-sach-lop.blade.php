@extends('layouts.app')
@section('title', 'Danh Sách Lớp Học')
@section('page-title', 'Danh Sách Lớp Học')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('hocvien.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
<p class="nav-section-title">Tìm Gia Sư</p>
<div class="nav-item"><a href="{{ route('hocvien.tao-yeu-cau') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-plus-circle"></i></span> Tạo Yêu Cầu Mới</a></div>
<div class="nav-item"><a href="{{ route('hocvien.danh-sach-lop') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-list"></i></span> Danh Sách Lớp</a></div>
@endsection
@section('content')
<div class="page-header">
    <div><h2>📋 Danh Sách Lớp Học</h2><p>Theo dõi kết quả ghép lớp của bạn</p></div>
    <a href="{{ route('hocvien.tao-yeu-cau') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tạo yêu cầu mới</a>
</div>

<form method="GET" class="filter-bar">
    <select name="trang_thai" class="form-select" style="max-width:220px;">
        <option value="">Tất cả trạng thái</option>
        <option value="dang_tim" {{ request('trang_thai') === 'dang_tim' ? 'selected' : '' }}>🔍 Đang tìm gia sư</option>
        <option value="da_co_gia_su" {{ request('trang_thai') === 'da_co_gia_su' ? 'selected' : '' }}>✅ Đã có gia sư</option>
        <option value="hoan_thanh" {{ request('trang_thai') === 'hoan_thanh' ? 'selected' : '' }}>🏁 Hoàn thành</option>
        <option value="da_huy" {{ request('trang_thai') === 'da_huy' ? 'selected' : '' }}>❌ Đã hủy</option>
    </select>
    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Lọc</button>
</form>

<div class="glass-card">
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr><th>#</th><th>Môn Học / Khối</th><th>Địa Chỉ</th><th>Học Phí</th><th>Gia Sư</th><th>Trạng Thái</th><th>Hành Động</th></tr>
            </thead>
            <tbody>
                @forelse($lop_hocs as $lop)
                <tr>
                    <td style="color:var(--text-muted);">{{ $loop->iteration }}</td>
                    <td>
                        <div style="font-weight:600; color:var(--text-primary);">{{ $lop->mon_hoc }}</div>
                        <div style="font-size:0.78rem; color:var(--text-muted);">{{ $lop->khoi_lop }} • {{ $lop->so_buoi_tuan }} buổi/tuần</div>
                    </td>
                    <td style="font-size:0.85rem;">{{ Str::limit($lop->dia_chi_day, 30) }}</td>
                    <td style="font-weight:600; color:#fda085;">{{ number_format($lop->muc_hoc_phi) }}đ</td>
                    <td>
                        @if($lop->giaSu)
                            <span style="color:#4facfe; font-weight:600;">{{ $lop->giaSu->ho_ten }}</span>
                        @else
                            <span style="color:var(--text-muted);">Chưa có</span>
                        @endif
                    </td>
                    <td><span class="badge badge-{{ $lop->trang_thai_class }}">{{ $lop->trang_thai_label }}</span></td>
                    <td style="display:flex; gap:0.4rem;">
                        <a href="{{ route('hocvien.chi-tiet-lop', $lop->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                        @if($lop->trang_thai === 'dang_tim')
                        <form method="POST" action="{{ route('hocvien.huy-lop', $lop->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hủy yêu cầu này?')"><i class="fas fa-times"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-state-icon">📚</div>
                            <h4>Chưa có lớp học nào</h4>
                            <p><a href="{{ route('hocvien.tao-yeu-cau') }}" style="color:var(--primary-start);">Tạo yêu cầu tìm gia sư →</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem;">{{ $lop_hocs->withQueryString()->links() }}</div>
</div>
@endsection
