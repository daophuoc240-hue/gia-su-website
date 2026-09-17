@extends('layouts.app')
@section('title', 'Chi Tiết Lớp Học')
@section('page-title', 'Chi Tiết Lớp Học')
@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('hocvien.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
<p class="nav-section-title">Tìm Gia Sư</p>
<div class="nav-item"><a href="{{ route('hocvien.tao-yeu-cau') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-plus-circle"></i></span> Tạo Yêu Cầu Mới</a></div>
<div class="nav-item"><a href="{{ route('hocvien.danh-sach-lop') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-list"></i></span> Danh Sách Lớp</a></div>
@endsection
@section('content')
<div class="page-header">
    <a href="{{ route('hocvien.danh-sach-lop') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại</a>
</div>

<div style="display:grid; grid-template-columns:1.2fr 1fr; gap:1.5rem;">
    {{-- Thông tin lớp --}}
    <div class="glass-card" style="padding:1.5rem;">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1.5rem;">
            <h3 style="font-size:1.1rem; font-weight:700;">📋 Thông Tin Lớp</h3>
            <span class="badge badge-{{ $lop->trang_thai_class }}" style="font-size:0.88rem; padding:0.4rem 0.9rem;">{{ $lop->trang_thai_label }}</span>
        </div>
        <div style="margin-bottom:1rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Môn Học</span><br><strong style="font-size:1.1rem;">{{ $lop->mon_hoc }}</strong></div>
        <div style="margin-bottom:1rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Khối Lớp</span><br><strong>{{ $lop->khoi_lop }}</strong></div>
        <div style="margin-bottom:1rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Số Buổi / Tuần</span><br>{{ $lop->so_buoi_tuan }} buổi</div>
        <div style="margin-bottom:1rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Địa Chỉ Dạy</span><br>{{ $lop->dia_chi_day }}</div>
        <div style="margin-bottom:1rem;"><span style="color:var(--text-muted); font-size:0.8rem;">Mức Học Phí</span><br><strong style="color:#fda085; font-size:1.1rem;">{{ number_format($lop->muc_hoc_phi) }}đ/buổi</strong></div>
        @if($lop->yeu_cau_them)
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Yêu Cầu Thêm</span><br><em style="font-size:0.9rem;">{{ $lop->yeu_cau_them }}</em></div>
        @endif
        <div class="divider"></div>
        <div style="font-size:0.78rem; color:var(--text-muted);">Tạo lúc: {{ $lop->created_at->format('d/m/Y H:i') }}</div>
    </div>

    {{-- Thông tin gia sư / ứng viên --}}
    <div>
        @if(($lop->trang_thai === 'da_co_gia_su' || $lop->trang_thai === 'hoan_thanh') && $lop->giaSu)
        <div class="glass-card" style="padding:1.5rem; margin-bottom:1.5rem; background:rgba(37,99,235,0.04); border:1px solid #bfdbfe; border-radius:16px;">
            <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:1rem;">
                <span class="badge badge-success" style="font-size:0.85rem;"><i class="fas fa-check-circle"></i> Đã Ghép Gia Sư</span>
            </div>
            <div style="display:flex; gap:1rem; align-items:center; margin-bottom:1rem;">
                <img src="{{ $lop->giaSu->hoSoGiaSu?->avatar_url ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80' }}"
                     alt="{{ $lop->giaSu->ho_ten }}"
                     style="width:60px; height:60px; border-radius:50%; object-fit:cover; border:2px solid #2563eb;">
                <div>
                    <div style="font-weight:700; font-size:1.1rem; color:#0f172a;">{{ $lop->giaSu->ho_ten }}</div>
                    <div style="font-size:0.82rem; color:#64748b;">📧 {{ $lop->giaSu->email }} • 📞 {{ $lop->giaSu->so_dien_thoai }}</div>
                </div>
            </div>
            @if($lop->giaSu->hoSoGiaSu)
            <div style="font-size:0.85rem; color:#334155; line-height:1.7; border-top:1px solid #e2e8f0; padding-top:0.8rem;">
                <div>🎓 <strong>Trường:</strong> {{ $lop->giaSu->hoSoGiaSu->truong_hoc }}</div>
                <div>📚 <strong>Chuyên ngành:</strong> {{ $lop->giaSu->hoSoGiaSu->chuyen_nganh }}</div>
            </div>
            @endif
        </div>

        {{-- Khối đánh giá chất lượng gia sư --}}
        <div class="glass-card" style="padding:1.5rem; border-radius:16px; border:1px solid #e2e8f0;">
            <h3 style="font-size:1.05rem; font-weight:700; color:#0f172a; margin-bottom:0.5rem;">
                ⭐ Đánh Giá & Nhận Xét Gia Sư
            </h3>
            <p style="font-size:0.82rem; color:#64748b; margin-bottom:1.2rem;">Phản hồi của bạn giúp nâng cao chất lượng dịch vụ của trung tâm.</p>

            @if($danhGia)
            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:1.2rem; margin-bottom:1rem;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.6rem;">
                    <div>
                        @for($s = 1; $s <= 5; $s++)
                            <i class="fas fa-star" style="color: {{ $s <= $danhGia->so_sao ? '#f59e0b' : '#cbd5e1' }}; font-size:1rem;"></i>
                        @endfor
                        <span style="font-weight:700; color:#0f172a; margin-left:6px;">{{ $danhGia->so_sao }}/5 sao</span>
                    </div>
                    <span style="font-size:0.75rem; color:#94a3b8;">{{ $danhGia->updated_at->format('d/m/Y') }}</span>
                </div>
                <p style="font-size:0.9rem; color:#334155; line-height:1.6; margin:0; font-style:italic;">
                    "{{ $danhGia->nhan_xet }}"
                </p>
            </div>
            <button type="button" class="btn btn-outline btn-sm btn-block" onclick="document.getElementById('form-danh-gia').style.display = document.getElementById('form-danh-gia').style.display === 'none' ? 'block' : 'none'">
                <i class="fas fa-edit"></i> Chỉnh sửa đánh giá
            </button>
            @endif

            <form id="form-danh-gia" method="POST" action="{{ route('hocvien.danh-gia', $lop->id) }}" style="{{ $danhGia ? 'display:none; margin-top:1rem;' : '' }}">
                @csrf
                <div class="form-group" style="margin-bottom:1rem;">
                    <label class="form-label">Mức độ hài lòng</label>
                    <select name="so_sao" class="form-select" required>
                        <option value="5" {{ old('so_sao', $danhGia->so_sao ?? 5) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ 5 Sao - Xuất sắc, rất hài lòng</option>
                        <option value="4" {{ old('so_sao', $danhGia->so_sao ?? 5) == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ 4 Sao - Dạy tốt, nhiệt tình</option>
                        <option value="3" {{ old('so_sao', $danhGia->so_sao ?? 5) == 3 ? 'selected' : '' }}>⭐⭐⭐ 3 Sao - Đạt yêu cầu cơ bản</option>
                        <option value="2" {{ old('so_sao', $danhGia->so_sao ?? 5) == 2 ? 'selected' : '' }}>⭐⭐ 2 Sao - Cần cải thiện phương pháp</option>
                        <option value="1" {{ old('so_sao', $danhGia->so_sao ?? 5) == 1 ? 'selected' : '' }}>⭐ 1 Sao - Không hài lòng</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom:1.2rem;">
                    <label class="form-label">Nhận xét chi tiết</label>
                    <textarea name="nhan_xet" class="form-control" rows="3" required placeholder="Chia sẻ cảm nhận về thái độ, sự đúng giờ, phương pháp giảng dạy của gia sư...">{{ old('nhan_xet', $danhGia->nhan_xet ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block" style="border-radius:10px;">
                    <i class="fas fa-paper-plane" style="margin-right:4px;"></i> {{ $danhGia ? 'Cập Nhật Đánh Giá' : 'Gửi Đánh Giá Ngay' }}
                </button>
            </form>
        </div>
        @elseif($lop->trang_thai === 'dang_tim')
        <div class="glass-card" style="padding:1.5rem; margin-bottom:1rem;">
            <h3 style="font-size:1rem; font-weight:700; margin-bottom:1rem;">👨‍🏫 Gia Sư Đã Đăng Ký ({{ $lop->dangKyNhanLops->count() }})</h3>
            @forelse($lop->dangKyNhanLops as $dk)
            <div style="padding:0.7rem 0; border-bottom:1px solid rgba(255,255,255,0.06);">
                <div style="font-weight:600; color:var(--text-primary);">{{ $dk->giaSu->ho_ten }}</div>
                <div style="font-size:0.78rem; color:var(--text-muted);">Đăng ký: {{ $dk->created_at->format('d/m/Y') }}</div>
            </div>
            @empty
            <div class="empty-state" style="padding:1rem;">
                <div class="empty-state-icon">👨‍🏫</div>
                <p>Chưa có gia sư đăng ký</p>
            </div>
            @endforelse
        </div>

        <form method="POST" action="{{ route('hocvien.huy-lop', $lop->id) }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Bạn chắc chắn muốn hủy yêu cầu này?')">
                <i class="fas fa-times"></i> Hủy Yêu Cầu
            </button>
        </form>
        @endif
    </div>
</div>
@endsection
