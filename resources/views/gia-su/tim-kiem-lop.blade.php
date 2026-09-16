@extends('layouts.app')
@section('title', 'Tìm Kiếm Lớp Học')
@section('page-title', 'Tìm Kiếm Lớp Học')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a></div>
<p class="nav-section-title">Hồ Sơ & Lớp Học</p>
<div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
<div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
<div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@endsection
@section('content')
<div class="page-header">
    <div><h2>🔍 Tìm Kiếm Lớp Học</h2><p>Lọc và đăng ký các lớp phù hợp với bạn</p></div>
</div>

<form method="GET" class="filter-bar">
    <input type="text" name="mon_hoc" class="form-control" placeholder="Môn học..." value="{{ request('mon_hoc') }}">
    <select name="khoi_lop" class="form-select" style="max-width:160px;">
        <option value="">Tất cả khối lớp</option>
        @foreach(['Lớp 1','Lớp 2','Lớp 3','Lớp 4','Lớp 5','Lớp 6','Lớp 7','Lớp 8','Lớp 9','Lớp 10','Lớp 11','Lớp 12','Đại học'] as $kl)
        <option value="{{ $kl }}" {{ request('khoi_lop') === $kl ? 'selected' : '' }}>{{ $kl }}</option>
        @endforeach
    </select>
    <input type="text" name="dia_chi" class="form-control" placeholder="Địa chỉ..." value="{{ request('dia_chi') }}">
    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Tìm kiếm</button>
    <a href="{{ route('giasu.tim-kiem-lop') }}" class="btn btn-outline btn-sm">Xóa lọc</a>
</form>

@if($lop_hocs->isEmpty())
<div class="empty-state" style="padding:3rem;">
    <div class="empty-state-icon">📭</div>
    <h4>Không tìm thấy lớp học nào</h4>
    <p>Hãy thử thay đổi bộ lọc tìm kiếm</p>
</div>
@else
<div class="class-cards">
    @foreach($lop_hocs as $lop)
    <div class="class-card glass-card">
        <div class="class-card-header">
            <div class="class-subject">{{ $lop->mon_hoc }}</div>
            <div class="class-fee">{{ number_format($lop->muc_hoc_phi) }}đ/buổi</div>
        </div>

        <div class="class-info-item"><span class="info-icon">🎓</span> {{ $lop->khoi_lop }}</div>
        <div class="class-info-item"><span class="info-icon">📅</span> {{ $lop->so_buoi_tuan }} buổi/tuần</div>
        <div class="class-info-item"><span class="info-icon">📍</span> {{ $lop->dia_chi_day }}</div>
        @if($lop->yeu_cau_them)
        <div class="class-info-item" style="align-items:flex-start;"><span class="info-icon">📝</span> <em style="font-size:0.82rem;">{{ Str::limit($lop->yeu_cau_them, 60) }}</em></div>
        @endif

        <div class="divider"></div>

        @if(in_array($lop->id, $da_dang_ky_ids))
        <button class="btn btn-outline btn-block" disabled>
            <i class="fas fa-check"></i> Đã đăng ký
        </button>
        @else
        <button type="button" class="btn btn-primary btn-block"
                onclick="openModal({{ $lop->id }}, '{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}')">
            <i class="fas fa-hand-paper"></i> Đăng Ký Nhận Lớp
        </button>
        @endif
    </div>
    @endforeach
</div>

<div class="pagination">
    {{ $lop_hocs->withQueryString()->links() }}
</div>
@endif

{{-- Modal đăng ký --}}
<div id="dangKyModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center; backdrop-filter:blur(4px);">
    <div class="glass-card" style="max-width:480px; width:90%; padding:2rem;">
        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.5rem;">📝 Đăng Ký Nhận Lớp</h3>
        <p id="modal-lop-name" style="font-size:0.85rem; color:var(--text-muted); margin-bottom:1.5rem;"></p>
        <form id="dangKyForm" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Giới thiệu bản thân (tùy chọn)</label>
                <textarea name="gioi_thieu_ban_than" class="form-control" rows="3" placeholder="Giới thiệu ngắn gọn về kinh nghiệm của bạn..."></textarea>
            </div>
            <div style="display:flex; gap:0.75rem;">
                <button type="button" class="btn btn-outline btn-block" onclick="closeModal()">Hủy</button>
                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i> Gửi Đăng Ký</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openModal(lopId, lopName) {
    document.getElementById('modal-lop-name').textContent = lopName;
    document.getElementById('dangKyForm').action = '/gia-su/dang-ky-lop/' + lopId;
    document.getElementById('dangKyModal').style.display = 'flex';
}
function closeModal() {
    document.getElementById('dangKyModal').style.display = 'none';
}
document.getElementById('dangKyModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>
@endpush
@endsection
