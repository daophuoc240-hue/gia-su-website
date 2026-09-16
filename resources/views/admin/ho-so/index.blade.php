@extends('layouts.app')
@section('title', 'Duyệt Hồ Sơ Gia Sư')
@section('page-title', 'Duyệt Hồ Sơ Gia Sư')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-line"></i></span> Dashboard</a></div>
<p class="nav-section-title">Quản Lý</p>
<div class="nav-item"><a href="{{ route('admin.tai-khoan.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản</a></div>
<div class="nav-item"><a href="{{ route('admin.ho-so.index') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư</a></div>
<div class="nav-item"><a href="{{ route('admin.lop-hoc.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span> Lớp Học</a></div>
@endsection
@section('content')
<div class="page-header">
    <div><h2>📋 Duyệt Hồ Sơ Gia Sư</h2><p>Kiểm tra và phê duyệt hồ sơ gia sư</p></div>
</div>
<form method="GET" class="filter-bar">
    <select name="trang_thai" class="form-select" style="max-width:200px;">
        <option value="cho_duyet" {{ request('trang_thai','cho_duyet') === 'cho_duyet' ? 'selected' : '' }}>⏳ Chờ duyệt</option>
        <option value="da_duyet" {{ request('trang_thai') === 'da_duyet' ? 'selected' : '' }}>✅ Đã duyệt</option>
        <option value="tu_choi" {{ request('trang_thai') === 'tu_choi' ? 'selected' : '' }}>❌ Từ chối</option>
    </select>
    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Lọc</button>
</form>
<div class="glass-card">
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr><th>#</th><th>Gia Sư</th><th>Trường / Chuyên Ngành</th><th>Khu Vực</th><th>Trạng Thái</th><th>Ngày Nộp</th><th>Hành Động</th></tr>
            </thead>
            <tbody>
                @forelse($ho_sos as $hs)
                <tr>
                    <td style="color:var(--text-muted);">{{ $loop->iteration }}</td>
                    <td>
                        <div style="font-weight:600; color:var(--text-primary);">{{ $hs->taiKhoan->ho_ten }}</div>
                        <div style="font-size:0.78rem; color:var(--text-muted);">{{ $hs->taiKhoan->email }}</div>
                    </td>
                    <td>
                        <div>{{ $hs->truong_hoc }}</div>
                        <div style="font-size:0.8rem; color:var(--text-muted);">{{ $hs->chuyen_nganh }}</div>
                    </td>
                    <td>{{ $hs->khu_vuc_nhan_day }}</td>
                    <td>
                        @if($hs->trang_thai_duyet === 'cho_duyet')
                            <span class="badge badge-warning">⏳ Chờ duyệt</span>
                        @elseif($hs->trang_thai_duyet === 'da_duyet')
                            <span class="badge badge-success">✅ Đã duyệt</span>
                        @else
                            <span class="badge badge-danger">❌ Từ chối</span>
                        @endif
                    </td>
                    <td style="color:var(--text-muted); font-size:0.82rem;">{{ $hs->created_at->format('d/m/Y') }}</td>
                    <td><a href="{{ route('admin.ho-so.chi-tiet', $hs->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Xem</a></td>
                </tr>
                @empty
                <tr><td colspan="7"><div class="empty-state"><div class="empty-state-icon">📋</div><h4>Không có hồ sơ nào</h4></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem;">{{ $ho_sos->withQueryString()->links() }}</div>
</div>
@endsection
