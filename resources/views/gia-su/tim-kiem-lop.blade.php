@extends('layouts.app')
@section('title', 'Tìm Kiếm Lớp Học')
@section('page-title', 'Tìm Kiếm Lớp Học Dạy Kèm')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a></div>
<p class="nav-section-title">Hồ Sơ & Lớp Học</p>
<div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
<div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
<div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@endsection

@section('content')
<!-- Hero Banner -->
<div style="background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%); border-radius: 20px; padding: 2rem; color: #ffffff; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem; box-shadow: 0 10px 25px rgba(2, 132, 199, 0.2);">
    <div>
        <div style="display:inline-flex; align-items:center; gap:0.4rem; background:rgba(255,255,255,0.2); padding:0.3rem 0.8rem; border-radius:20px; font-size:0.8rem; font-weight:700; margin-bottom:0.6rem;">
            🔍 DANH SÁCH LỚP HỌC MỚI NHẤT
        </div>
        <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 0.3rem;">Tìm Lớp Dạy Kèm Phù Hợp Với Bạn</h2>
        <p style="font-size: 0.9rem; color: rgba(255,255,255,0.85); max-width: 550px;">Lọc theo môn học, khối lớp hoặc địa điểm dạy để tìm lớp học có thù lao và thời gian tối ưu nhất.</p>
    </div>
    <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=300&q=80" alt="Study" style="width:140px; height:90px; border-radius:14px; object-fit:cover; border:2px solid rgba(255,255,255,0.5);">
</div>

<!-- Filter Bar -->
<div class="glass-card" style="padding: 1.5rem; margin-bottom: 2rem;">
    <form method="GET" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)) 120px 100px; gap: 1rem; align-items: center;">
        <input type="text" name="mon_hoc" class="form-control" placeholder="🔍 Tên môn học..." value="{{ request('mon_hoc') }}">
        <select name="khoi_lop" class="form-select">
            <option value="">Tất cả khối lớp</option>
            @foreach(['Lớp 1','Lớp 2','Lớp 3','Lớp 4','Lớp 5','Lớp 6','Lớp 7','Lớp 8','Lớp 9','Lớp 10','Lớp 11','Lớp 12','Đại học'] as $kl)
            <option value="{{ $kl }}" {{ request('khoi_lop') === $kl ? 'selected' : '' }}>{{ $kl }}</option>
            @endforeach
        </select>
        <input type="text" name="dia_chi" class="form-control" placeholder="📍 Địa chỉ / Quận..." value="{{ request('dia_chi') }}">
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm kiếm</button>
        <a href="{{ route('giasu.tim-kiem-lop') }}" class="btn btn-outline">Xóa lọc</a>
    </form>
</div>

@if($lop_hocs->isEmpty())
<div class="empty-state" style="padding: 3.5rem; background: #ffffff; border-radius: 20px; border: 2px dashed #cbd5e1;">
    <div class="empty-state-icon" style="font-size: 3.5rem;">📭</div>
    <h4 style="font-size: 1.2rem; font-weight: 800;">Không tìm thấy lớp học nào</h4>
    <p>Hãy thử thay đổi điều kiện bộ lọc tìm kiếm môn học hoặc địa điểm</p>
</div>
@else
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem;">
    @foreach($lop_hocs as $lop)
    <div class="glass-card" style="padding: 0; overflow: hidden; border-radius: 18px; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
        <div style="position: relative; height: 130px; background: url('https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=600&q=80') center/cover;">
            <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.7) 100%);"></div>
            <div style="position: absolute; top: 0.8rem; right: 0.8rem; background: #10b981; color: #fff; font-weight: 800; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.78rem;">
                {{ number_format($lop->muc_hoc_phi) }} đ/buổi
            </div>
            <div style="position: absolute; bottom: 0.8rem; left: 1rem; color: #ffffff;">
                <h3 style="font-size: 1.15rem; font-weight: 800; margin-bottom: 0.1rem;">📚 {{ $lop->mon_hoc }}</h3>
                <div style="font-size: 0.8rem; opacity: 0.9;">🎓 {{ $lop->khoi_lop }} • {{ $lop->so_buoi_tuan }} buổi/tuần</div>
            </div>
        </div>

        <div style="padding: 1.4rem;">
            <div style="font-size: 0.88rem; color: #334155; margin-bottom: 0.6rem; display: flex; align-items: flex-start; gap: 0.5rem;">
                <span style="color: #ef4444; font-size: 1rem;">📍</span>
                <span><strong>Địa điểm:</strong> {{ $lop->dia_chi_day }}</span>
            </div>

            @if($lop->yeu_cau_them)
            <div style="font-size: 0.82rem; color: #64748b; background: #f8fafc; padding: 0.6rem 0.8rem; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 1.2rem;">
                📝 <em>{{ Str::limit($lop->yeu_cau_them, 75) }}</em>
            </div>
            @endif

            <div class="divider" style="margin: 1rem 0;"></div>

            @if(in_array($lop->id, $da_dang_ky_ids))
            <button class="btn btn-outline btn-block" disabled style="background: #f1f5f9; color: #94a3b8;">
                <i class="fas fa-check-circle" style="color: #10b981;"></i> Đã Đăng Ký Nhận Lớp
            </button>
            @else
            <button type="button" class="btn btn-primary btn-block"
                    onclick="openModal({{ $lop->id }}, '{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}')">
                <i class="fas fa-hand-paper"></i> Đăng Ký Nhận Lớp Ngay
            </button>
            @endif
        </div>
    </div>
    @endforeach
</div>

<div style="margin-top: 2rem;">
    {{ $lop_hocs->withQueryString()->links() }}
</div>
@endif

{{-- Modal đăng ký --}}
<div id="dangKyModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(15,23,42,0.6); z-index:9999; align-items:center; justify-content:center; backdrop-filter:blur(4px);">
    <div class="glass-card" style="max-width:500px; width:92%; padding:2.2rem; border-radius:20px; background:#ffffff !important;">
        <h3 style="font-size:1.2rem; font-weight:800; color:#0f172a; margin-bottom:0.4rem;">📝 Đăng Ký Nhận Lớp Dạy</h3>
        <p id="modal-lop-name" style="font-size:0.88rem; color:#2563eb; font-weight:700; margin-bottom:1.5rem;"></p>
        <form id="dangKyForm" method="POST">
            @csrf
            <div class="form-group" style="margin-bottom:1.4rem;">
                <label class="form-label" style="font-weight:700; color:#1e293b;">Giới thiệu bản thân & Kinh nghiệm dạy</label>
                <textarea name="gioi_thieu_ban_than" class="form-control" rows="4" placeholder="Giới thiệu ngắn gọn thành tích, bằng cấp hoặc phương pháp giảng dạy của bạn cho lớp học này..."></textarea>
            </div>
            <div style="display:flex; gap:0.8rem;">
                <button type="button" class="btn btn-outline btn-block" onclick="closeModal()">Hủy Bỏ</button>
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
document.getElementById('dangKyModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>
@endpush
@endsection