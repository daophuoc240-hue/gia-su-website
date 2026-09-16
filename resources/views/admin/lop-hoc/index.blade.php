@extends('layouts.app')
@section('title', 'Quản Lý Lớp Học')
@section('page-title', 'Quản Lý Lớp Học')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-line"></i></span> Dashboard</a></div>
<p class="nav-section-title">Quản Lý</p>
<div class="nav-item"><a href="{{ route('admin.tai-khoan.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản</a></div>
<div class="nav-item"><a href="{{ route('admin.ho-so.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư</a></div>
<div class="nav-item"><a href="{{ route('admin.lop-hoc.index') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span> Lớp Học</a></div>
@endsection
@section('content')
<div class="page-header">
    <div><h2>📚 Quản Lý Lớp Học</h2><p>Tiếp nhận và quản lý các lớp học</p></div>
</div>
<form method="GET" class="filter-bar">
    <input type="text" name="mon_hoc" class="form-control" placeholder="Tìm theo môn học..." value="{{ request('mon_hoc') }}">
    <select name="trang_thai" class="form-select" style="max-width:200px;">
        <option value="">Tất cả trạng thái</option>
        <option value="dang_tim" {{ request('trang_thai') === 'dang_tim' ? 'selected' : '' }}>🔍 Đang tìm gia sư</option>
        <option value="da_co_gia_su" {{ request('trang_thai') === 'da_co_gia_su' ? 'selected' : '' }}>✅ Đã có gia sư</option>
        <option value="hoan_thanh" {{ request('trang_thai') === 'hoan_thanh' ? 'selected' : '' }}>🏁 Hoàn thành</option>
        <option value="da_huy" {{ request('trang_thai') === 'da_huy' ? 'selected' : '' }}>❌ Đã hủy</option>
    </select>
    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Lọc</button>
    <a href="{{ route('admin.lop-hoc.index') }}" class="btn btn-outline btn-sm">Xóa lọc</a>
</form>
<div class="glass-card">
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr><th>#</th><th>Môn / Khối</th><th>Học Viên</th><th>Địa Chỉ</th><th>Học Phí</th><th>Gia Sư</th><th>Trạng Thái</th><th>Hành Động</th></tr>
            </thead>
            <tbody>
                @forelse($lop_hocs as $lop)
                <tr>
                    <td style="color:var(--text-muted);">{{ $loop->iteration }}</td>
                    <td>
                        <div style="font-weight:600; color:var(--text-primary);">{{ $lop->mon_hoc }}</div>
                        <div style="font-size:0.78rem; color:var(--text-muted);">{{ $lop->khoi_lop }} • {{ $lop->so_buoi_tuan }} buổi/tuần</div>
                    </td>
                    <td>{{ $lop->hocVien->ho_ten }}</td>
                    <td style="font-size:0.85rem;">{{ Str::limit($lop->dia_chi_day, 30) }}</td>
                    <td style="font-weight:600; color:#fda085;">{{ number_format($lop->muc_hoc_phi) }}đ</td>
                    <td>{{ $lop->giaSu?->ho_ten ?? '-' }}</td>
                    <td><span class="badge badge-{{ $lop->trang_thai_class }}">{{ $lop->trang_thai_label }}</span></td>
                    <td style="display:flex; gap:0.4rem; flex-wrap:wrap;">
                        <a href="{{ route('admin.lop-hoc.chi-tiet', $lop->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                        @if($lop->trang_thai === 'dang_tim')
                        <a href="{{ route('admin.lop-hoc.phan-cong', $lop->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-user-check"></i></a>
                        @endif
                        <a href="{{ route('admin.lop-hoc.sua', $lop->id) }}" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('admin.lop-hoc.xoa', $lop->id) }}" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa lớp học này?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8"><div class="empty-state"><div class="empty-state-icon">📚</div><h4>Không có lớp học nào</h4></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem;">{{ $lop_hocs->withQueryString()->links() }}</div>
</div>
@endsection
