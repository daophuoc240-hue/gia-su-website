@extends('layouts.app')
@section('title', 'Quản Lý Yêu Cầu Tư Vấn')
@section('page-title', 'Yêu Cầu Tư Vấn & Liên Hệ')

@section('sidebar-nav')
<p class="nav-section-title">Quản Trị</p>
<div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-pie"></i></span> Tổng Quan</a></div>
<div class="nav-item"><a href="{{ route('admin.tai-khoan.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản</a></div>
<div class="nav-item"><a href="{{ route('admin.ho-so.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư</a></div>
<div class="nav-item"><a href="{{ route('admin.lop-hoc.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-book-open"></i></span> Lớp Học</a></div>
<div class="nav-item"><a href="{{ route('admin.lien-he.index') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-headset"></i></span> Tư Vấn / Liên Hệ</a></div>
@endsection

@section('content')
<div class="page-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; margin-bottom:1.5rem;">
    <div>
        <h1 class="page-title">📩 Danh Sách Yêu Cầu Tư Vấn Từ Phụ Huynh & Gia Sư</h1>
        <p class="page-subtitle">Tiếp nhận và xử lý các yêu cầu tư vấn nhanh từ trang chủ và trang liên hệ</p>
    </div>
    <div style="display:flex; gap:0.6rem;">
        <a href="{{ route('admin.lien-he.index') }}" class="btn {{ !request('trang_thai') ? 'btn-primary' : 'btn-outline' }} btn-sm">
            Tất cả ({{ ($dem['moi'] ?? 0) + ($dem['da_xu_ly'] ?? 0) }})
        </a>
        <a href="{{ route('admin.lien-he.index', ['trang_thai' => 'moi']) }}" class="btn {{ request('trang_thai') === 'moi' ? 'btn-primary' : 'btn-outline' }} btn-sm">
            ⏳ Chưa xử lý ({{ $dem['moi'] ?? 0 }})
        </a>
        <a href="{{ route('admin.lien-he.index', ['trang_thai' => 'da_xu_ly']) }}" class="btn {{ request('trang_thai') === 'da_xu_ly' ? 'btn-primary' : 'btn-outline' }} btn-sm">
            ✅ Đã xử lý ({{ $dem['da_xu_ly'] ?? 0 }})
        </a>
    </div>
</div>

<div class="glass-card" style="padding:1.5rem;">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Khách Hàng</th>
                    <th>Số Điện Thoại</th>
                    <th>Phân Loại</th>
                    <th>Nội Dung Yêu Cầu</th>
                    <th>Thời Gian</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lien_hes as $lh)
                <tr>
                    <td style="color:var(--text-muted);">{{ $loop->iteration }}</td>
                    <td>
                        <div style="font-weight:700; color:var(--text-primary);">{{ $lh->ho_ten }}</div>
                        @if($lh->email)
                            <div style="font-size:0.78rem; color:var(--text-muted);">{{ $lh->email }}</div>
                        @endif
                    </td>
                    <td>
                        <a href="tel:{{ $lh->so_dien_thoai }}" style="font-weight:700; color:#2563eb; text-decoration:none;">
                            <i class="fas fa-phone-alt"></i> {{ $lh->so_dien_thoai }}
                        </a>
                    </td>
                    <td>
                        <span class="badge badge-info" style="font-size:0.78rem;">{{ $lh->loai_label }}</span>
                    </td>
                    <td style="max-width:320px; font-size:0.86rem; color:#334155; line-height:1.5;">
                        {{ $lh->noi_dung ?: 'Yêu cầu gọi lại tư vấn nhanh' }}
                    </td>
                    <td style="font-size:0.8rem; color:var(--text-muted); white-space:nowrap;">
                        {{ $lh->created_at?->format('H:i d/m/Y') }}
                    </td>
                    <td>
                        @if($lh->trang_thai === 'moi')
                            <span class="badge badge-warning">⏳ Mới tiếp nhận</span>
                        @else
                            <span class="badge badge-success">✅ Đã liên hệ</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.lien-he.xu-ly', $lh->id) }}" style="margin:0;">
                            @csrf
                            <button type="submit" class="btn {{ $lh->trang_thai === 'moi' ? 'btn-primary' : 'btn-outline' }} btn-sm">
                                @if($lh->trang_thai === 'moi')
                                    <i class="fas fa-check"></i> Đánh dấu đã gọi
                                @else
                                    <i class="fas fa-undo"></i> Mở lại
                                @endif
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <div class="empty-state-icon">📭</div>
                            <h4>Chưa có yêu cầu tư vấn nào</h4>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:1.2rem;">
        {{ $lien_hes->links() }}
    </div>
</div>
@endsection
