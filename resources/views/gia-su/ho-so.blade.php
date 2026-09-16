@extends('layouts.app')
@section('title', 'Hồ Sơ Gia Sư')
@section('page-title', 'Hồ Sơ Của Tôi')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a></div>
<p class="nav-section-title">Hồ Sơ & Lớp Học</p>
<div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
<div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
<div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@endsection
@section('content')
<div class="page-header">
    <div><h2>👤 Hồ Sơ Năng Lực</h2><p>Cập nhật thông tin để được trung tâm kiểm duyệt</p></div>
</div>

{{-- Status card --}}
@if($ho_so)
<div class="profile-status-card {{ $ho_so->trang_thai_duyet === 'da_duyet' ? 'approved' : ($ho_so->trang_thai_duyet === 'tu_choi' ? 'rejected' : 'pending') }}">
    @if($ho_so->trang_thai_duyet === 'da_duyet')
        <i class="fas fa-check-circle fa-2x" style="color:#4facfe;"></i>
        <div><strong style="color:#4facfe;">Hồ sơ đã được phê duyệt!</strong><br><small style="color:var(--text-muted);">Bạn có thể đăng ký nhận lớp.</small></div>
    @elseif($ho_so->trang_thai_duyet === 'tu_choi')
        <i class="fas fa-times-circle fa-2x" style="color:#f5576c;"></i>
        <div><strong style="color:#f5576c;">Hồ sơ đã bị từ chối</strong><br><small style="color:var(--text-muted);">Lý do: {{ $ho_so->ly_do_tu_choi }}</small></div>
    @else
        <i class="fas fa-clock fa-2x" style="color:#fda085;"></i>
        <div><strong style="color:#fda085;">Đang chờ kiểm duyệt</strong><br><small style="color:var(--text-muted);">Trung tâm sẽ sớm xem xét hồ sơ của bạn.</small></div>
    @endif
</div>
@else
<div class="profile-status-card not-submitted">
    <i class="fas fa-file-alt fa-2x" style="color:var(--text-muted);"></i>
    <div><strong style="color:var(--text-secondary);">Chưa có hồ sơ</strong><br><small style="color:var(--text-muted);">Điền thông tin bên dưới để nộp hồ sơ.</small></div>
</div>
@endif

<div class="glass-card" style="padding:1.5rem;">
    <form method="POST" action="{{ route('giasu.ho-so.cap-nhat') }}" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <div>@foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach</div>
        </div>
        @endif

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group">
                <label class="form-label"><i class="fas fa-university"></i> Trường Học</label>
                <input type="text" name="truong_hoc" class="form-control" placeholder="Tên trường đang học/đã học..." value="{{ old('truong_hoc', $ho_so?->truong_hoc) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label"><i class="fas fa-book"></i> Chuyên Ngành</label>
                <input type="text" name="chuyen_nganh" class="form-control" placeholder="Chuyên ngành học..." value="{{ old('chuyen_nganh', $ho_so?->chuyen_nganh) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label"><i class="fas fa-map-marker-alt"></i> Khu Vực Có Thể Nhận Dạy</label>
            <input type="text" name="khu_vuc_nhan_day" class="form-control" placeholder="VD: Quận 1, Quận 3, Bình Thạnh..." value="{{ old('khu_vuc_nhan_day', $ho_so?->khu_vuc_nhan_day) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label"><i class="fas fa-star"></i> Kinh Nghiệm Giảng Dạy</label>
            <textarea name="kinh_nghiem" class="form-control" rows="4" placeholder="Mô tả kinh nghiệm dạy kèm của bạn..." required>{{ old('kinh_nghiem', $ho_so?->kinh_nghiem) }}</textarea>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group">
                <label class="form-label"><i class="fas fa-graduation-cap"></i> Bằng Cấp / Thẻ Sinh Viên (ảnh/PDF)</label>
                <input type="file" name="bang_cap" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                @if($ho_so?->bang_cap)
                <small style="color:var(--text-muted); font-size:0.78rem; margin-top:0.3rem; display:block;">✅ Đã có file: {{ basename($ho_so->bang_cap) }}</small>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label"><i class="fas fa-id-card"></i> Thẻ Sinh Viên (ảnh/PDF)</label>
                <input type="file" name="the_sinh_vien" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                @if($ho_so?->the_sinh_vien)
                <small style="color:var(--text-muted); font-size:0.78rem; margin-top:0.3rem; display:block;">✅ Đã có file: {{ basename($ho_so->the_sinh_vien) }}</small>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fas fa-save"></i>
            {{ $ho_so ? 'Cập Nhật Hồ Sơ' : 'Nộp Hồ Sơ' }}
        </button>
    </form>
</div>
@endsection
