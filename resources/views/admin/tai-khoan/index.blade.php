@extends('layouts.app')
@section('title', 'Quản Lý Tài Khoản')
@section('page-title', 'Quản Lý Tài Khoản')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-line"></i></span> Tổng Quan</a></div>
<p class="nav-section-title">Quản Lý</p>
<div class="nav-item"><a href="{{ route('admin.tai-khoan.index') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản</a></div>
<div class="nav-item"><a href="{{ route('admin.ho-so.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư</a></div>
<div class="nav-item"><a href="{{ route('admin.lop-hoc.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span> Lớp Học</a></div>
@endsection
@section('content')
<div class="page-header">
    <div><h2>👥 Danh Sách Tài Khoản</h2><p>Quản lý tài khoản gia sư và học viên</p></div>
</div>
<form method="GET" class="filter-bar">
    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên, email..." value="{{ request('search') }}">
    <select name="vai_tro" class="form-select" style="max-width:160px;">
        <option value="">Tất cả vai trò</option>
        <option value="giasu" {{ request('vai_tro') === 'giasu' ? 'selected' : '' }}>Gia Sư</option>
        <option value="hocvien" {{ request('vai_tro') === 'hocvien' ? 'selected' : '' }}>Học Viên</option>
    </select>
    <select name="trang_thai" class="form-select" style="max-width:160px;">
        <option value="">Tất cả trạng thái</option>
        <option value="active" {{ request('trang_thai') === 'active' ? 'selected' : '' }}>Hoạt động</option>
        <option value="locked" {{ request('trang_thai') === 'locked' ? 'selected' : '' }}>Đã khóa</option>
    </select>
    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Tìm kiếm</button>
    <a href="{{ route('admin.tai-khoan.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-times"></i> Xóa lọc</a>
</form>
<div class="glass-card">
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th><th>Họ Tên</th><th>Email</th><th>Điện Thoại</th><th>Vai Trò</th><th>Trạng Thái</th><th>Ngày Tạo</th><th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tai_khoans as $tk)
                <tr>
                    <td style="color:var(--text-muted);">{{ $loop->iteration }}</td>
                    <td style="font-weight:600; color:var(--text-primary);">{{ $tk->ho_ten }}</td>
                    <td>{{ $tk->email }}</td>
                    <td>{{ $tk->so_dien_thoai ?? '-' }}</td>
                    <td><span class="badge {{ $tk->vai_tro === 'giasu' ? 'badge-info' : 'badge-success' }}">{{ $tk->vai_tro === 'giasu' ? 'Gia Sư' : 'Học Viên' }}</span></td>
                    <td><span class="badge {{ $tk->trang_thai === 'active' ? 'badge-success' : 'badge-danger' }}">{{ $tk->trang_thai === 'active' ? 'Hoạt động' : 'Đã khóa' }}</span></td>
                    <td style="color:var(--text-muted); font-size:0.82rem;">{{ $tk->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if($tk->trang_thai === 'active')
                        <form method="POST" action="{{ route('admin.tai-khoan.khoa', $tk->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Khóa tài khoản này?')"><i class="fas fa-lock"></i></button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.tai-khoan.mo-khoa', $tk->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-lock-open"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="8"><div class="empty-state"><div class="empty-state-icon">👥</div><h4>Không có tài khoản nào</h4></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem;">{{ $tai_khoans->withQueryString()->links() }}</div>
</div>
@endsection
