@extends('layouts.app')
@section('title', 'Trung Tâm Thông Báo')
@section('page-title', 'Trung Tâm Thông Báo Hệ Thống')

@section('sidebar-nav')
<p class="nav-section-title">Điều Hướng</p>
@if(auth()->user()->vai_tro === 'admin')
    <div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-line"></i></span> Tổng Quan</a></div>
    <div class="nav-item"><a href="{{ route('admin.tai-khoan.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản</a></div>
    <div class="nav-item"><a href="{{ route('admin.ho-so.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư</a></div>
    <div class="nav-item"><a href="{{ route('admin.lop-hoc.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span> Lớp Học</a></div>
@elseif(auth()->user()->vai_tro === 'giasu')
    <div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
    <div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
    <div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
    <div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@else
    <div class="nav-item"><a href="{{ route('hocvien.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
    <div class="nav-item"><a href="{{ route('hocvien.tao-yeu-cau') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-plus-circle"></i></span> Tạo Yêu Cầu Mới</a></div>
    <div class="nav-item"><a href="{{ route('hocvien.danh-sach-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-list"></i></span> Danh Sách Lớp</a></div>
@endif
<div class="nav-item"><a href="{{ route('thong-bao.index') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-bell"></i></span> Thông Báo</a></div>
<div class="nav-item"><a href="{{ route('tai-khoan.cai-dat') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-cog"></i></span> Cài Đặt Tài Khoản</a></div>
@endsection

@section('content')
<div class="glass-card" style="padding: 2.2rem; border-radius: 20px; background: #ffffff;">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1.2rem; margin-bottom: 1.5rem;">
        <div>
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #0f172a; margin-bottom: 0.3rem;">
                🔔 Thông Báo Của Bạn
            </h3>
            <p style="font-size: 0.88rem; color: #64748b; margin: 0;">Theo dõi các cập nhật về lịch dạy, yêu cầu ghép lớp và thông tin từ trung tâm</p>
        </div>
        @if($thong_baos->total() > 0)
        <form method="POST" action="{{ route('thong-bao.doc-tat-ca') }}" style="margin:0;">
            @csrf
            <button type="submit" class="btn btn-outline btn-sm">
                <i class="fas fa-check-double"></i> Đánh dấu tất cả đã đọc
            </button>
        </form>
        @endif
    </div>

    @forelse($thong_baos as $tb)
    <div style="padding: 1.2rem 1.4rem; border-radius: 14px; margin-bottom: 0.9rem; border: 1px solid {{ $tb->da_doc ? '#e2e8f0' : '#bfdbfe' }}; background: {{ $tb->da_doc ? '#ffffff' : '#f8faff' }}; display: flex; justify-content: space-between; align-items: center; gap: 1rem; transition: transform 0.2s;">
        <div style="display: flex; gap: 1rem; align-items: flex-start;">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: {{ $tb->da_doc ? '#f1f5f9' : '#eff6ff' }}; color: {{ $tb->da_doc ? '#64748b' : '#2563eb' }}; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                @if($tb->loai === 'yeu_cau_day')
                    <i class="fas fa-envelope-open-text"></i>
                @elseif($tb->loai === 'xac_nhan')
                    <i class="fas fa-check-circle"></i>
                @elseif($tb->loai === 'tu_choi')
                    <i class="fas fa-times-circle"></i>
                @elseif($tb->loai === 'phan_cong')
                    <i class="fas fa-graduation-cap"></i>
                @else
                    <i class="fas fa-bell"></i>
                @endif
            </div>
            <div>
                <div style="display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.3rem;">
                    <strong style="font-size: 0.98rem; color: #0f172a;">{{ $tb->tieu_de }}</strong>
                    @if(!$tb->da_doc)
                    <span style="background: #2563eb; color: #fff; font-size: 0.68rem; font-weight: 700; padding: 2px 7px; border-radius: 10px;">MỚI</span>
                    @endif
                </div>
                <p style="font-size: 0.88rem; color: #334155; margin: 0 0 0.4rem 0; line-height: 1.6;">
                    {{ $tb->noi_dung }}
                </p>
                <span style="font-size: 0.76rem; color: #94a3b8;">
                    <i class="far fa-clock"></i> {{ $tb->created_at->diffForHumans() }} ({{ $tb->created_at->format('d/m/Y H:i') }})
                </span>
            </div>
        </div>

        <div style="flex-shrink: 0;">
            @if($tb->duong_dan)
                <form method="POST" action="{{ route('thong-bao.da-doc', $tb->id) }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 8px;">
                        Xem Chi Tiết →
                    </button>
                </form>
            @elseif(!$tb->da_doc)
                <form method="POST" action="{{ route('thong-bao.da-doc', $tb->id) }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-sm" style="border-radius: 8px;">
                        Đã đọc
                    </button>
                </form>
            @endif
        </div>
    </div>
    @empty
    <div style="text-align: center; padding: 3.5rem 1rem; color: #94a3b8;">
        <div style="font-size: 3rem; margin-bottom: 0.8rem;">🔕</div>
        <h4 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin-bottom: 0.3rem;">Chưa có thông báo nào</h4>
        <p style="margin: 0; font-size: 0.88rem;">Tất cả các cập nhật mới về lớp học và lịch dạy sẽ hiển thị tại đây.</p>
    </div>
    @endforelse

    <div style="margin-top: 1.5rem;">
        {{ $thong_baos->links() }}
    </div>
</div>
@endsection
