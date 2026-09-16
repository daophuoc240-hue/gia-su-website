@extends('layouts.app')
@section('title', 'Tạo Yêu Cầu Tìm Gia Sư')
@section('page-title', 'Tạo Yêu Cầu Mới')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('hocvien.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard</a></div>
<p class="nav-section-title">Tìm Gia Sư</p>
<div class="nav-item"><a href="{{ route('hocvien.tao-yeu-cau') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-plus-circle"></i></span> Tạo Yêu Cầu Mới</a></div>
<div class="nav-item"><a href="{{ route('hocvien.danh-sach-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-list"></i></span> Danh Sách Lớp</a></div>
@endsection
@section('content')
<div class="page-header">
    <div><h2>📝 Tạo Yêu Cầu Tìm Gia Sư</h2><p>Điền thông tin lớp học để hệ thống tìm gia sư phù hợp</p></div>
</div>

<div class="glass-card" style="padding:1.5rem; max-width:680px;">
    @if($errors->any())
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <div>@foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach</div>
    </div>
    @endif

    <form method="POST" action="{{ route('hocvien.gui-yeu-cau') }}">
        @csrf

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group">
                <label class="form-label"><i class="fas fa-book"></i> Môn Học</label>
                <input type="text" name="mon_hoc" class="form-control"
                       placeholder="VD: Toán, Lý, Hóa, Anh Văn..."
                       value="{{ old('mon_hoc') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label"><i class="fas fa-graduation-cap"></i> Khối Lớp</label>
                <select name="khoi_lop" class="form-select" required>
                    <option value="">-- Chọn khối lớp --</option>
                    @foreach(['Lớp 1','Lớp 2','Lớp 3','Lớp 4','Lớp 5','Lớp 6','Lớp 7','Lớp 8','Lớp 9','Lớp 10','Lớp 11','Lớp 12','Đại học','Khác'] as $kl)
                    <option value="{{ $kl }}" {{ old('khoi_lop') === $kl ? 'selected' : '' }}>{{ $kl }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group">
                <label class="form-label"><i class="fas fa-calendar-week"></i> Số Buổi Học / Tuần</label>
                <select name="so_buoi_tuan" class="form-select" required>
                    @for($i = 1; $i <= 7; $i++)
                    <option value="{{ $i }}" {{ old('so_buoi_tuan', 2) == $i ? 'selected' : '' }}>{{ $i }} buổi/tuần</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label class="form-label"><i class="fas fa-money-bill-wave"></i> Mức Học Phí (đ/buổi)</label>
                <input type="number" name="muc_hoc_phi" class="form-control"
                       placeholder="VD: 150000"
                       value="{{ old('muc_hoc_phi') }}"
                       min="0" step="10000" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label"><i class="fas fa-map-marker-alt"></i> Địa Chỉ Dạy</label>
            <input type="text" name="dia_chi_day" class="form-control"
                   placeholder="Số nhà, đường, phường, quận/huyện, tỉnh/thành phố..."
                   value="{{ old('dia_chi_day') }}" required>
        </div>

        <div class="form-group">
            <label class="form-label"><i class="fas fa-sticky-note"></i> Yêu Cầu Thêm (tùy chọn)</label>
            <textarea name="yeu_cau_them" class="form-control" rows="3"
                      placeholder="VD: Ưu tiên gia sư có kinh nghiệm luyện thi, thời gian học vào buổi tối...">{{ old('yeu_cau_them') }}</textarea>
        </div>

        <div style="display:flex; gap:1rem; align-items:center;">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-paper-plane"></i> Gửi Yêu Cầu
            </button>
            <a href="{{ route('hocvien.dashboard') }}" class="btn btn-outline">Hủy</a>
        </div>
    </form>
</div>
@endsection
