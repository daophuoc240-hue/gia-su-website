@extends('layouts.app')
@section('title', 'Sửa Lớp Học')
@section('page-title', 'Sửa Thông Tin Lớp Học')
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
    <a href="{{ route('admin.lop-hoc.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại</a>
</div>
<div class="glass-card" style="padding:1.5rem; max-width:680px;">
    @if($errors->any())
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <div>@foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach</div>
    </div>
    @endif

    <h3 style="font-size:1rem; font-weight:700; margin-bottom:1.5rem;">✏️ Sửa Thông Tin Lớp Học</h3>

    <form method="POST" action="{{ route('admin.lop-hoc.cap-nhat', $lop->id) }}">
        @csrf
        @method('PUT')

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group">
                <label class="form-label"><i class="fas fa-book"></i> Môn Học</label>
                <input type="text" name="mon_hoc" class="form-control" value="{{ old('mon_hoc', $lop->mon_hoc) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label"><i class="fas fa-graduation-cap"></i> Khối Lớp</label>
                <select name="khoi_lop" class="form-select" required>
                    @foreach(['Lớp 1','Lớp 2','Lớp 3','Lớp 4','Lớp 5','Lớp 6','Lớp 7','Lớp 8','Lớp 9','Lớp 10','Lớp 11','Lớp 12','Đại học','Khác'] as $kl)
                    <option value="{{ $kl }}" {{ old('khoi_lop', $lop->khoi_lop) === $kl ? 'selected' : '' }}>{{ $kl }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group">
                <label class="form-label"><i class="fas fa-calendar-week"></i> Số Buổi / Tuần</label>
                <select name="so_buoi_tuan" class="form-select" required>
                    @for($i = 1; $i <= 7; $i++)
                    <option value="{{ $i }}" {{ old('so_buoi_tuan', $lop->so_buoi_tuan) == $i ? 'selected' : '' }}>{{ $i }} buổi/tuần</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label class="form-label"><i class="fas fa-money-bill-wave"></i> Học Phí (đ/buổi)</label>
                <input type="number" name="muc_hoc_phi" class="form-control" value="{{ old('muc_hoc_phi', $lop->muc_hoc_phi) }}" min="0" step="10000" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label"><i class="fas fa-map-marker-alt"></i> Địa Chỉ Dạy</label>
            <input type="text" name="dia_chi_day" class="form-control" value="{{ old('dia_chi_day', $lop->dia_chi_day) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label"><i class="fas fa-sticky-note"></i> Yêu Cầu Thêm</label>
            <textarea name="yeu_cau_them" class="form-control" rows="3">{{ old('yeu_cau_them', $lop->yeu_cau_them) }}</textarea>
        </div>

        <div style="display:flex; gap:1rem;">
            <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Lưu Thay Đổi</button>
            <a href="{{ route('admin.lop-hoc.index') }}" class="btn btn-outline btn-lg">Hủy</a>
        </div>
    </form>
</div>
@endsection
