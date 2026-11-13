@extends('layouts.app')
@section('title', 'Hồ Sơ Gia Sư')
@section('page-title', 'Hồ Sơ Cá Nhân Gia Sư')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
<p class="nav-section-title">Hồ Sơ & Lớp Học</p>
<div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link active"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
<div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
<div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@endsection

@push('styles')
<style>
.avatar-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 1.2rem;
}
.avatar-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #2563eb;
    box-shadow: 0 8px 24px rgba(37,99,235,0.28);
    transition: all 0.3s ease;
    display: block;
}
.avatar-overlay {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: rgba(0,0,0,0.48);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    cursor: pointer;
    transition: opacity 0.25s ease;
    gap: 3px;
}
.avatar-wrapper:hover .avatar-overlay { opacity: 1; }
.avatar-wrapper:hover .avatar-img { filter: brightness(0.75); }
.avatar-overlay span {
    color: #fff;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.4px;
}
.avatar-overlay i { color: #fff; font-size: 1.2rem; }
.online-dot {
    position: absolute;
    bottom: 6px; right: 6px;
    background: #10b981;
    border: 3px solid #ffffff;
    width: 22px; height: 22px;
    border-radius: 50%;
    box-shadow: 0 2px 6px rgba(16,185,129,0.4);
}
.fee-input-wrap {
    position: relative;
}
.fee-input-wrap .prefix {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    font-weight: 600;
    font-size: 0.9rem;
    pointer-events: none;
}
.fee-input-wrap input {
    padding-left: 42px;
}
.slot-label {
    transition: background 0.15s ease;
}
.slot-label:hover {
    background: #e2e8f0;
}
.slot-label.slot-active {
    background: #dcfce7;
}

/* Area Picker & Pill Tags */
.area-picker-card {
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    padding: 1.25rem 1.4rem;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    transition: all 0.25s ease;
}
.area-picker-card:focus-within {
    border-color: #93c5fd;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
}
.area-picker-grid {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 0.75rem;
    align-items: center;
    margin-bottom: 0.85rem;
}
@media (max-width: 640px) {
    .area-picker-grid {
        grid-template-columns: 1fr !important;
    }
}
.area-pills-box {
    background: #ffffff;
    border: 1.5px dashed #cbd5e1;
    border-radius: 12px;
    padding: 0.85rem 1rem;
    min-height: 56px;
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    align-items: center;
    transition: border-color 0.2s ease;
}
.area-pills-box:hover {
    border-color: #94a3b8;
}
.area-pill-item {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
    border-radius: 9999px;
    padding: 0.35rem 0.55rem 0.35rem 0.85rem;
    font-size: 0.85rem;
    font-weight: 600;
    box-shadow: 0 1px 2px rgba(30, 64, 175, 0.06);
    transition: all 0.15s ease;
    animation: pillPop 0.2s cubic-bezier(0.16, 1, 0.3, 1);
}
@keyframes pillPop {
    from { opacity: 0; transform: scale(0.85); }
    to { opacity: 1; transform: scale(1); }
}
.area-pill-item:hover {
    background: #dbeafe;
    border-color: #93c5fd;
    transform: translateY(-1px);
}
.pill-remove-btn {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #dbeafe;
    color: #1e40af;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    line-height: 1;
    cursor: pointer;
    transition: all 0.15s ease;
    padding: 0;
}
.pill-remove-btn:hover {
    background: #fee2e2;
    color: #dc2626;
    transform: rotate(90deg);
}
.quick-chip-btn {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-size: 0.78rem;
    font-weight: 600;
    padding: 0.3rem 0.7rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.15s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}
.quick-chip-btn:hover {
    background: #eff6ff;
    border-color: #93c5fd;
    color: #1d4ed8;
    transform: translateY(-1px);
}
</style>
@endpush

@section('content')
<div style="display: grid; grid-template-columns: 320px 1fr; gap: 1.8rem; align-items: start;">

    {{-- ===== Profile Overview Card ===== --}}
    <div class="glass-card" style="padding: 2rem; text-align: center; border-radius: 20px;">
        {{-- Avatar with upload --}}
        <div class="avatar-wrapper" onclick="document.getElementById('avatar-input').click()" title="Nhấn để đổi ảnh đại diện" style="position: relative; display: inline-block; margin-bottom: 1.2rem; cursor: pointer;">
            <img id="avatar-preview"
                 src="{{ $ho_so?->avatar_url ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=300&q=80' }}"
                 alt="Ảnh đại diện" class="avatar-img"
                 style="width: 130px; height: 130px; border-radius: 50%; object-fit: cover; border: 4px solid #2563eb; box-shadow: 0 8px 24px rgba(37,99,235,0.28); display: block; margin: 0 auto;">
            <div class="avatar-overlay">
                <i class="fas fa-camera"></i>
                <span>Đổi ảnh</span>
            </div>
            <span class="online-dot"></span>
        </div>

        {{-- Hidden file input (in main form) --}}
        <input type="file" id="avatar-input" name="avatar" accept="image/*"
               style="display:none;" form="ho-so-form"
               onchange="previewAvatar(this)">
        <p style="font-size:0.74rem; color:#94a3b8; margin-top:-0.5rem; margin-bottom:1rem;">Nhấn vào ảnh để thay đổi (JPG, PNG, tối đa 5MB)</p>

        <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 0.2rem;">{{ $user->ho_ten }}</h3>
        <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 1rem;">📧 {{ $user->email }}</p>

        @if($ho_so)
            @if($ho_so->trang_thai_duyet === 'da_duyet')
                <span class="badge badge-success" style="font-size: 0.85rem; padding: 0.45rem 1.1rem; border-radius: 20px;">✅ Đã Kiểm Duyệt</span>
            @elseif($ho_so->trang_thai_duyet === 'cho_duyet')
                <span class="badge badge-warning" style="font-size: 0.85rem; padding: 0.45rem 1.1rem; border-radius: 20px;">⏳ Đang Chờ Duyệt</span>
            @else
                <span class="badge badge-danger" style="font-size: 0.85rem; padding: 0.45rem 1.1rem; border-radius: 20px;">❌ Đã Từ Chối</span>
            @endif
        @else
            <span class="badge badge-warning" style="font-size: 0.85rem; padding: 0.45rem 1.1rem; border-radius: 20px;">⚠️ Chưa Tạo Hồ Sơ</span>
        @endif

        <div class="divider" style="margin: 1.4rem 0;"></div>

        <div style="text-align: left; font-size: 0.88rem; color: #334155; line-height: 1.8;">
            <div style="margin-bottom: 0.6rem;">🎓 <strong>Trường học:</strong><br><span style="color: #0f172a; font-weight: 600;">{{ $ho_so->truong_hoc ?? 'Chưa cập nhật' }}</span></div>
            <div style="margin-bottom: 0.6rem;">📖 <strong>Chuyên ngành:</strong><br><span style="color: #0f172a; font-weight: 600;">{{ $ho_so->chuyen_nganh ?? 'Chưa cập nhật' }}</span></div>
            @if($ho_so?->mon_day)
            <div style="margin-bottom: 0.6rem;">📚 <strong>Môn dạy:</strong><br><span style="color: #2563eb; font-weight: 700;">{{ $ho_so->mon_day }}</span></div>
            @endif
            @if($ho_so?->hoc_phi_theo_gio)
            <div style="margin-bottom: 0.6rem;">💰 <strong>Học phí/buổi:</strong><br><span style="color: #0f172a; font-weight: 700;">{{ number_format($ho_so->hoc_phi_theo_gio) }}đ</span></div>
            @endif
            <div style="margin-bottom: 0.6rem;">📍 <strong>Khu vực dạy:</strong><br><span style="color: #0f172a; font-weight: 600;">{{ $ho_so->khu_vuc_nhan_day ?? 'Chưa cập nhật' }}</span></div>
            <div>📞 <strong>Điện thoại:</strong><br><span style="color: #0f172a; font-weight: 600;">{{ $user->so_dien_thoai ?? 'Chưa cập nhật' }}</span></div>
        </div>

        @if($ho_so?->so_lop_da_day)
        <div class="divider" style="margin: 1.2rem 0;"></div>
        <div style="display: flex; justify-content: center; gap: 1.5rem;">
            <div style="text-align:center;">
                <div style="font-size:1.5rem; font-weight:800; color:#2563eb;">{{ $ho_so->so_lop_da_day }}</div>
                <div style="font-size:0.72rem; color:#64748b;">Lớp đã dạy</div>
            </div>
        </div>
        @endif
    </div>

    {{-- ===== Edit Form Card ===== --}}
    <div class="glass-card" style="padding: 2.4rem; border-radius: 20px; background: #ffffff;">
        <div style="border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1.8rem;">
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #0f172a; margin-bottom: 0.3rem;">📝 Cập Nhật Thông Tin Hồ Sơ</h3>
            <p style="font-size: 0.88rem; color: #64748b;">Cung cấp đầy đủ thông tin để hồ sơ được duyệt nhanh nhất và thu hút phụ huynh.</p>
        </div>

        <form id="ho-so-form" method="POST" action="{{ route('giasu.ho-so.cap-nhat') }}" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.4rem; margin-bottom: 0.5rem;">
                <div class="form-group">
                    <label class="form-label">🎓 Trường Học</label>
                    <input type="text" name="truong_hoc" class="form-control {{ $errors->has('truong_hoc') ? 'is-invalid' : '' }}"
                           value="{{ old('truong_hoc', $ho_so->truong_hoc ?? '') }}" required
                           placeholder="Ví dụ: ĐH Sư Phạm, ĐH KHTN...">
                    @error('truong_hoc')<span class="error-msg">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">📖 Chuyên Ngành</label>
                    <input type="text" name="chuyen_nganh" class="form-control {{ $errors->has('chuyen_nganh') ? 'is-invalid' : '' }}"
                           value="{{ old('chuyen_nganh', $ho_so->chuyen_nganh ?? '') }}" required
                           placeholder="Ví dụ: Sư phạm Toán, Tiếng Anh...">
                    @error('chuyen_nganh')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.4rem; margin-bottom: 0.5rem;">
                <div class="form-group">
                    <label class="form-label">📚 Môn Dạy Chính</label>
                    <input type="text" name="mon_day" class="form-control"
                           value="{{ old('mon_day', $ho_so->mon_day ?? '') }}"
                           placeholder="Ví dụ: Toán, Tiếng Anh, Vật Lý...">
                </div>

                <div class="form-group">
                    <label class="form-label">💰 Học Phí (đ / buổi)</label>
                    <div class="fee-input-wrap" style="position: relative;">
                        <span class="prefix" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #64748b; font-weight: 600; font-size: 0.9rem; pointer-events: none;">₫</span>
                        <input type="number" name="hoc_phi_theo_gio" class="form-control"
                               value="{{ old('hoc_phi_theo_gio', $ho_so->hoc_phi_theo_gio ?? '') }}"
                               id="inputHocPhi" placeholder="Ví dụ: 150000" min="0" step="10000" style="padding-left: 36px;">
                    </div>
                </div>
            </div>

            {{-- Khung giá trung tâm & kiểm tra học phí --}}
            @php
                $selTrinhDo = old('trinh_do', $ho_so->trinh_do ?? 'sinh_vien');
                $selCapDay  = old('cap_day', $ho_so->cap_day ?? 'thpt');
            @endphp
            <div id="feeGuardCard" style="background:#f8fafc; border:1.5px solid #cbd5e1; border-radius:16px; padding:1.2rem 1.3rem; margin-bottom:1.6rem; transition: all .2s;">
                <div style="display:flex; align-items:center; justify-content:space-between; gap:.6rem; flex-wrap:wrap; margin-bottom:.9rem;">
                    <div style="font-weight:800; color:#0f172a; font-size:.95rem;">🛡️ Khung Học Phí Trung Tâm Quy Định</div>
                    <a href="{{ route('home') }}#bang-gia-hoc-phi" target="_blank" style="font-size:.78rem; color:#2563eb; font-weight:700; text-decoration:none;">Xem bảng giá niêm yết →</a>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:.9rem;">
                    <div>
                        <label class="form-label" style="font-size:.82rem;">👤 Bạn là</label>
                        <select name="trinh_do" id="selTrinhDo" class="form-select">
                            @foreach(\App\Helpers\BangGiaHocPhi::TRINH_DO as $k => $v)
                                <option value="{{ $k }}" {{ $selTrinhDo === $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label" style="font-size:.82rem;">🏫 Cấp học dạy chính</label>
                        <select name="cap_day" id="selCapDay" class="form-select">
                            @foreach(\App\Helpers\BangGiaHocPhi::CAP_DAY as $k => $v)
                                <option value="{{ $k }}" {{ $selCapDay === $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="feeStatus" style="border-radius:12px; padding:.8rem 1rem; font-size:.86rem; line-height:1.55; background:#eff6ff; color:#1e3a8a; border:1px solid #bfdbfe;"></div>

                @error('hoc_phi_theo_gio')
                    <div style="margin-top:.8rem; padding:.8rem 1rem; background:#fef2f2; border:1.5px solid #ef4444; border-radius:12px; color:#991b1b; font-size:.85rem; font-weight:600; line-height:1.55;">🚫 {{ $message }}</div>
                @enderror

                <label id="feeConfirmWrap" style="display:none; margin-top:.8rem; padding:.8rem 1rem; background:#fef2f2; border:1.5px solid #fca5a5; border-radius:12px; cursor:pointer; font-size:.84rem; color:#991b1b; line-height:1.55;">
                    <input type="checkbox" name="xac_nhan_vuot_gia" id="chkVuotGia" value="1" {{ old('xac_nhan_vuot_gia') ? 'checked' : '' }} style="margin-right:.5rem; vertical-align:middle;">
                    <strong>Tôi hiểu mức giá này vượt khung của trung tâm</strong> và chịu trách nhiệm: hồ sơ sẽ bị tạm ẩn, chuyển cho quản trị viên xem xét lại và ghi nhận vi phạm.
                </label>
            </div>

            {{-- Khu Vực Nhận Dạy --}}
            <div class="form-group" style="margin-bottom: 1.8rem;">
                <div class="area-picker-card">
                    {{-- Header with count --}}
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.85rem;">
                        <label class="form-label" style="margin: 0; font-size: 0.95rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 0.45rem;">
                            <span>📍</span> Khu Vực Nhận Dạy <span style="color:#ef4444;">*</span>
                        </label>
                        <span id="areaCountBadge" style="font-size: 0.78rem; font-weight: 600; padding: 0.2rem 0.65rem; border-radius: 9999px; background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd;">
                            0 khu vực đã chọn
                        </span>
                    </div>

                    {{-- Toolbar: Dropdown Tỉnh/Thành + Dropdown Quận/Huyện + Button Thêm --}}
                    <div class="area-picker-grid">
                        <select class="form-select select-tinh-thanh" id="gs_tinh_thanh" style="height: 42px; border-radius: 10px; font-size: 0.88rem; border-color: #cbd5e1;">
                            <option value="">🏙️ Chọn Tỉnh / Thành Phố --</option>
                            @foreach(\App\Helpers\DiaDiem::getTinhThanhList() as $tinh)
                                <option value="{{ $tinh }}">{{ $tinh }}</option>
                            @endforeach
                        </select>
                        <select class="form-select select-quan-huyen" id="gs_quan_huyen" style="height: 42px; border-radius: 10px; font-size: 0.88rem; border-color: #cbd5e1;">
                            <option value="">📍 Chọn Quận / Huyện / TP --</option>
                        </select>
                        <button type="button" id="btnAddArea" class="btn" style="height: 42px; padding: 0 1.25rem; font-size: 0.88rem; font-weight: 700; background: #2563eb; color: #ffffff; border: none; border-radius: 10px; display: inline-flex; align-items: center; gap: 0.45rem; cursor: pointer; white-space: nowrap; box-shadow: 0 2px 6px rgba(37,99,235,0.22); transition: all 0.2s ease;">
                            <span style="font-size: 1.15rem; line-height: 1;">+</span> Thêm Khu Vực
                        </button>
                    </div>

                    {{-- Tags Pills Container --}}
                    <div class="area-pills-box" id="areaTagsContainer">
                        {{-- Injected dynamically via JS --}}
                    </div>

                    {{-- Quick Suggestion Chips --}}
                    <div style="display: flex; align-items: center; gap: 0.45rem; flex-wrap: wrap; margin-top: 0.75rem;">
                        <span style="font-size: 0.78rem; color: #64748b; font-weight: 500;">Gợi ý nhanh:</span>
                        <button type="button" class="quick-chip-btn" data-area="Dạy Online (Toàn quốc)">🌐 Dạy Online (Toàn quốc)</button>
                        <button type="button" class="quick-chip-btn" data-area="Toàn TP. Hồ Chí Minh">🏙️ Toàn TP. Hồ Chí Minh</button>
                        <button type="button" class="quick-chip-btn" data-area="Toàn Hà Nội">🏛️ Toàn Hà Nội</button>
                        <button type="button" class="quick-chip-btn" data-area="Toàn Đà Nẵng">🌉 Toàn Đà Nẵng</button>
                        <button type="button" class="quick-chip-btn" data-area="Toàn Cần Thơ">🌾 Toàn Cần Thơ</button>
                    </div>

                    {{-- Manual Input fine-tuning toggle --}}
                    <div style="margin-top: 0.75rem; padding-top: 0.65rem; border-top: 1px dashed #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;">
                        <small style="color: #64748b; font-size: 0.8rem;">
                            💡 Bạn có thể chọn nhiều quận/huyện hoặc tỉnh/thành khác nhau mà bạn có thể đến dạy.
                        </small>
                        <button type="button" id="btnToggleManualInput" style="background: none; border: none; color: #2563eb; font-size: 0.78rem; font-weight: 600; cursor: pointer; text-decoration: underline; white-space: nowrap;">
                            ✏️ Tùy chỉnh dạng chữ viết
                        </button>
                    </div>

                    {{-- The actual form input: hidden field for submission + optional manual input --}}
                    <input type="hidden" name="khu_vuc_nhan_day" id="khu_vuc_nhan_day"
                           value="{{ old('khu_vuc_nhan_day', $ho_so->khu_vuc_nhan_day ?? '') }}">

                    <div id="manualInputWrap" style="display: none; margin-top: 0.75rem;">
                        <label style="font-size: 0.8rem; font-weight: 600; color: #475569; margin-bottom: 0.3rem; display: block;">
                            Nhập trực tiếp danh sách khu vực (ngăn cách bởi dấu phẩy):
                        </label>
                        <input type="text" id="manual_khu_vuc_text" class="form-control"
                               placeholder="Ví dụ: Quận 1, Quận 3, Bình Thạnh, TP. Hồ Chí Minh">
                    </div>

                    @error('khu_vuc_nhan_day')<span class="error-msg" style="margin-top: 0.4rem; display: block;">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 1.8rem;">
                <label class="form-label">💡 Kinh Nghiệm Giảng Dạy & Thành Tích</label>
                <textarea name="kinh_nghiem" class="form-control {{ $errors->has('kinh_nghiem') ? 'is-invalid' : '' }}"
                          rows="5" required
                          placeholder="Mô tả chi tiết thành tích học tập, giải thưởng, kinh nghiệm dạy kèm, phương pháp truyền đạt...">{{ old('kinh_nghiem', $ho_so->kinh_nghiem ?? '') }}</textarea>
                @error('kinh_nghiem')<span class="error-msg">{{ $message }}</span>@enderror
            </div>

            {{-- Lịch Dạy & Khung Giờ Rảnh --}}
            @php
                $lichDayData = [];
                if (!empty($ho_so?->lich_day)) {
                    $decoded = json_decode($ho_so->lich_day, true);
                    if (is_array($decoded)) {
                        $lichDayData = $decoded;
                    }
                }
                $savedSlots = $lichDayData['slots'] ?? [];
                $savedGhiChu = $lichDayData['ghi_chu'] ?? (!is_array(json_decode($ho_so?->lich_day, true)) ? ($ho_so?->lich_day ?? '') : '');
                $dayList = [
                    'T2' => 'Thứ 2',
                    'T3' => 'Thứ 3',
                    'T4' => 'Thứ 4',
                    'T5' => 'Thứ 5',
                    'T6' => 'Thứ 6',
                    'T7' => 'Thứ 7',
                    'CN' => 'Chủ Nhật',
                ];
                $shiftList = [
                    'sang'  => ['label' => 'Sáng', 'time' => '8h - 11h30', 'icon' => '🌅'],
                    'chieu' => ['label' => 'Chiều', 'time' => '14h - 17h30', 'icon' => '☀️'],
                    'toi'   => ['label' => 'Tối', 'time' => '18h - 21h30', 'icon' => '🌙'],
                ];
            @endphp
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 1.5rem; margin-bottom: 1.8rem;">
                <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:0.8rem; margin-bottom: 1rem;">
                    <div>
                        <h4 style="font-size: 1.08rem; font-weight: 800; color: #0f172a; margin: 0 0 0.2rem 0;">
                            📅 Sắp Xếp Lịch Dạy & Khung Giờ Rảnh Của Bạn
                        </h4>
                        <p style="font-size: 0.82rem; color: #64748b; margin: 0;">
                            Đánh dấu các buổi bạn có thể nhận dạy kèm. Phụ huynh/học viên sẽ dựa vào lịch này để đăng ký giờ học.
                        </p>
                    </div>
                    <div style="display:flex; gap:0.4rem; flex-wrap:wrap;">
                        <button type="button" class="btn btn-outline btn-sm" style="font-size:0.75rem; padding:0.3rem 0.6rem;" onclick="quickSelectSchedule('toi')">🌙 Tất cả buổi tối</button>
                        <button type="button" class="btn btn-outline btn-sm" style="font-size:0.75rem; padding:0.3rem 0.6rem;" onclick="quickSelectSchedule('weekend')">☕ Cuối tuần (T7, CN)</button>
                        <button type="button" class="btn btn-outline btn-sm" style="font-size:0.75rem; padding:0.3rem 0.6rem;" onclick="quickSelectSchedule('all')">✓ Chọn tất cả</button>
                        <button type="button" class="btn btn-outline btn-sm" style="font-size:0.75rem; padding:0.3rem 0.6rem; color:#ef4444;" onclick="quickSelectSchedule('none')">✕ Bỏ chọn</button>
                    </div>
                </div>

                {{-- Bảng ma trận lịch trong tuần --}}
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse: collapse; text-align:center; font-size:0.85rem; background:#fff; border-radius:10px; overflow:hidden; border:1px solid #e2e8f0;">
                        <thead>
                            <tr style="background:#f1f5f9; color:#334155;">
                                <th style="padding:0.75rem 0.5rem; font-weight:700; width:110px; border-bottom:1px solid #e2e8f0;">Ca Học</th>
                                @foreach($dayList as $k => $dayName)
                                <th style="padding:0.75rem 0.4rem; font-weight:700; border-bottom:1px solid #e2e8f0;">{{ $dayName }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shiftList as $sKey => $sVal)
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:0.65rem 0.5rem; text-align:left; background:#fafafa; font-weight:700; color:#1e293b; border-right:1px solid #f1f5f9;">
                                    <span>{{ $sVal['icon'] }} {{ $sVal['label'] }}</span>
                                    <div style="font-size:0.7rem; color:#64748b; font-weight:normal;">{{ $sVal['time'] }}</div>
                                </td>
                                @foreach($dayList as $dKey => $dayName)
                                @php
                                    $isChecked = isset($savedSlots[$dKey][$sKey]) && $savedSlots[$dKey][$sKey];
                                @endphp
                                <td style="padding:0.6rem 0.3rem;">
                                    <label style="cursor:pointer; display:block; padding:0.4rem; border-radius:6px; margin:0;" class="slot-label {{ $isChecked ? 'slot-active' : '' }}">
                                        <input type="checkbox" name="lich_day_slots[{{ $dKey }}][{{ $sKey }}]" value="1"
                                               class="schedule-slot-check slot-{{ $sKey }} slot-day-{{ $dKey }}"
                                               {{ $isChecked ? 'checked' : '' }}
                                               onchange="toggleSlotBg(this)">
                                    </label>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Ghi chú lịch dạy --}}
                <div style="margin-top: 1rem;">
                    <label style="font-size:0.84rem; font-weight:700; color:#334155; margin-bottom:0.3rem; display:block;">
                        💬 Ghi chú thêm về lịch dạy (Tùy chọn)
                    </label>
                    <input type="text" name="lich_day_ghi_chu" class="form-control"
                           value="{{ old('lich_day_ghi_chu', $savedGhiChu) }}"
                           placeholder="Ví dụ: Có thể dạy Online vào các ngày trong tuần; chỉ nhận dạy kèm trực tiếp vào cuối tuần...">
                </div>
            </div>

            {{-- Documents --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.4rem; margin-bottom: 1.8rem;">
                <div class="form-group">
                    <label class="form-label">🎓 Bằng Cấp / Chứng Chỉ <span style="color:#94a3b8;">(không bắt buộc)</span></label>
                    <input type="file" name="bang_cap" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                    @if($ho_so?->bang_cap)
                    <p style="font-size:0.77rem; color:#10b981; margin-top:4px;">✓ Đã có file. Upload mới để thay.</p>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-label">🪪 Thẻ Sinh Viên / CCCD <span style="color:#94a3b8;">(không bắt buộc)</span></label>
                    <input type="file" name="the_sinh_vien" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                    @if($ho_so?->the_sinh_vien)
                    <p style="font-size:0.77rem; color:#10b981; margin-top:4px;">✓ Đã có file. Upload mới để thay.</p>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="padding: 0.95rem; font-size: 1rem; border-radius: 12px;">
                <i class="fas fa-save" style="margin-right: 0.5rem;"></i> Lưu Thông Tin & Gửi Phê Duyệt
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
(function () {
    const CFG = @json(\App\Helpers\BangGiaHocPhi::toJs());
    const fee   = document.getElementById('inputHocPhi');
    const selTd = document.getElementById('selTrinhDo');
    const selCd = document.getElementById('selCapDay');
    const box   = document.getElementById('feeStatus');
    const card  = document.getElementById('feeGuardCard');
    const wrap  = document.getElementById('feeConfirmWrap');
    const chk   = document.getElementById('chkVuotGia');
    const form  = document.getElementById('ho-so-form');
    if (!fee || !selTd || !selCd || !box) return;

    const fmt = n => Number(n).toLocaleString('vi-VN');
    const styles = {
        trong:     ['#eff6ff', '#1e3a8a', '#bfdbfe', '#cbd5e1'],
        dung:      ['#ecfdf5', '#065f46', '#a7f3d0', '#6ee7b7'],
        duoi:      ['#fffbeb', '#92400e', '#fde68a', '#fcd34d'],
        vuot_nhe:  ['#fff7ed', '#9a3412', '#fdba74', '#fb923c'],
        vuot_nang: ['#fef2f2', '#991b1b', '#fca5a5', '#ef4444']
    };

    function evaluate() {
        const td = selTd.value, cd = selCd.value;
        const [min, max] = CFG.bang[cd][td];
        const phi = parseFloat(fee.value) || 0;
        const label = CFG.trinh_do[td] + ' dạy ' + CFG.cap[cd];
        const khung = fmt(min) + ' – ' + fmt(max) + ' đ/buổi';
        let st = 'dung', html = '';

        if (phi <= 0) {
            st = 'trong';
            html = '📌 Khung giá cho <strong>' + label + '</strong>: <strong>' + khung + '</strong>.';
        } else if (phi < min) {
            st = 'duoi';
            html = '💡 Mức giá thấp hơn khung tham khảo (<strong>' + khung + '</strong>). Bạn vẫn có thể lưu.';
        } else if (phi <= max) {
            html = '✅ Hợp lệ – nằm trong khung trung tâm quy định (<strong>' + khung + '</strong>).';
        } else {
            const pct = ((phi - max) / max * 100).toFixed(1);
            st = phi <= max * (1 + CFG.nguong) ? 'vuot_nhe' : 'vuot_nang';
            html = '⚠️ <strong>CẢNH CÁO:</strong> ' + fmt(phi) + ' đ/buổi <strong>VƯỢT</strong> khung tối đa ' + fmt(max) + ' đ/buổi thêm <strong>' + fmt(phi - max) + ' đ (' + pct + '%)</strong>.'
                 + (st === 'vuot_nang' ? ' <strong>Mức vi phạm nghiêm trọng (&gt;10%).</strong>' : '')
                 + '<br>Khung cho <strong>' + label + '</strong>: ' + khung + '.';
        }

        const c = styles[st];
        box.style.background = c[0]; box.style.color = c[1]; box.style.borderColor = c[2];
        box.innerHTML = html;
        card.style.borderColor = c[3];
        const over = st === 'vuot_nhe' || st === 'vuot_nang';
        wrap.style.display = over ? 'block' : 'none';
        if (!over && chk) chk.checked = false;
        return over;
    }

    ['input', 'change'].forEach(ev => {
        fee.addEventListener(ev, evaluate);
        selTd.addEventListener(ev, evaluate);
        selCd.addEventListener(ev, evaluate);
    });
    evaluate();

    form && form.addEventListener('submit', function (e) {
        if (evaluate() && chk && !chk.checked) {
            e.preventDefault();
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
            alert('⚠️ Học phí bạn đặt đang VƯỢT khung giá của trung tâm.\nVui lòng điều chỉnh giá về trong khung, hoặc tích xác nhận chịu trách nhiệm để tiếp tục.');
        }
    });
})();
</script>
<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        if (file.size > 5 * 1024 * 1024) {
            alert('Ảnh quá lớn! Vui lòng chọn ảnh dưới 5MB.');
            input.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').src = e.target.result;
            // Show toast
            const toast = document.createElement('div');
            toast.style.cssText = 'position:fixed;bottom:1.5rem;right:1.5rem;background:#10b981;color:#fff;padding:0.85rem 1.5rem;border-radius:12px;font-size:0.9rem;font-weight:600;z-index:9999;box-shadow:0 8px 24px rgba(16,185,129,0.35);animation:slideUp 0.3s ease;';
            toast.innerHTML = '<i class="fas fa-check-circle" style="margin-right:8px;"></i> Ảnh đã chọn! Nhấn Lưu để cập nhật.';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3500);
        };
        reader.readAsDataURL(file);
    }
}

function toggleSlotBg(checkbox) {
    const parent = checkbox.closest('.slot-label');
    if (parent) {
        if (checkbox.checked) {
            parent.classList.add('slot-active');
        } else {
            parent.classList.remove('slot-active');
        }
    }
}

function quickSelectSchedule(type) {
    const allChecks = document.querySelectorAll('.schedule-slot-check');
    if (type === 'all') {
        allChecks.forEach(c => { c.checked = true; toggleSlotBg(c); });
    } else if (type === 'none') {
        allChecks.forEach(c => { c.checked = false; toggleSlotBg(c); });
    } else if (type === 'toi') {
        document.querySelectorAll('.slot-toi').forEach(c => { c.checked = true; toggleSlotBg(c); });
    } else if (type === 'weekend') {
        document.querySelectorAll('.slot-day-T7, .slot-day-CN').forEach(c => { c.checked = true; toggleSlotBg(c); });
    }
}

// ==========================================
// QUẢN LÝ KHU VỰC NHẬN DẠY (TAG PILLS WIDGET)
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    const rawInitialValue = @json(old('khu_vuc_nhan_day', $ho_so->khu_vuc_nhan_day ?? ''));
    let areaTags = [];

    function parseInitial(str) {
        if (!str || typeof str !== 'string') return [];
        const trimmed = str.trim();
        if (!trimmed) return [];
        if (trimmed.includes(';')) {
            return trimmed.split(';').map(s => s.trim()).filter(Boolean);
        }
        return trimmed.split(',').map(s => s.trim()).filter(Boolean);
    }

    areaTags = parseInitial(rawInitialValue);

    const tagsContainer = document.getElementById('areaTagsContainer');
    const hiddenInput = document.getElementById('khu_vuc_nhan_day');
    const manualInput = document.getElementById('manual_khu_vuc_text');
    const countBadge = document.getElementById('areaCountBadge');
    const tinhSelect = document.getElementById('gs_tinh_thanh');
    const quanSelect = document.getElementById('gs_quan_huyen');
    const btnAdd = document.getElementById('btnAddArea');
    const btnToggleManual = document.getElementById('btnToggleManualInput');
    const manualWrap = document.getElementById('manualInputWrap');

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function syncTags() {
        const combined = areaTags.join(', ');
        if (hiddenInput) hiddenInput.value = combined;
        if (manualInput && document.activeElement !== manualInput) {
            manualInput.value = combined;
        }
        if (countBadge) {
            if (areaTags.length > 0) {
                countBadge.textContent = areaTags.length + ' khu vực đã chọn';
                countBadge.style.background = '#e0f2fe';
                countBadge.style.color = '#0284c7';
                countBadge.style.borderColor = '#bae6fd';
            } else {
                countBadge.textContent = 'Chưa chọn khu vực';
                countBadge.style.background = '#fef2f2';
                countBadge.style.color = '#ef4444';
                countBadge.style.borderColor = '#fecaca';
            }
        }
    }

    function renderTags() {
        if (!tagsContainer) return;
        tagsContainer.innerHTML = '';

        if (areaTags.length === 0) {
            tagsContainer.innerHTML = `
                <div style="color: #94a3b8; font-size: 0.83rem; font-style: italic; display: flex; align-items: center; gap: 0.4rem; padding: 0.2rem 0;">
                    <span style="font-size: 1rem;">🔍</span>
                    <span>Chưa có khu vực nào. Hãy chọn Tỉnh/Thành & Quận/Huyện ở trên rồi bấm <strong>"+ Thêm Khu Vực"</strong>.</span>
                </div>
            `;
            syncTags();
            return;
        }

        areaTags.forEach((tag, idx) => {
            const pill = document.createElement('span');
            pill.className = 'area-pill-item';
            pill.innerHTML = `
                <span>📍</span>
                <span class="pill-title">${escapeHtml(tag)}</span>
                <button type="button" class="pill-remove-btn" title="Xóa khu vực này">&times;</button>
            `;
            pill.querySelector('.pill-remove-btn').addEventListener('click', function(e) {
                e.stopPropagation();
                areaTags.splice(idx, 1);
                renderTags();
            });
            tagsContainer.appendChild(pill);
        });

        syncTags();
    }

    function addTag(tagText) {
        if (!tagText) return;
        const clean = tagText.trim();
        if (!clean) return;

        const existsIdx = areaTags.findIndex(t => t.toLowerCase() === clean.toLowerCase());
        if (existsIdx !== -1) {
            // Flash existing pill in yellow to inform tutor it already exists
            const existingPill = tagsContainer.children[existsIdx];
            if (existingPill) {
                existingPill.style.transition = 'all 0.2s ease';
                existingPill.style.background = '#fef08a';
                existingPill.style.borderColor = '#facc15';
                existingPill.style.transform = 'scale(1.08)';
                setTimeout(() => {
                    existingPill.style.background = '';
                    existingPill.style.borderColor = '';
                    existingPill.style.transform = '';
                }, 450);
            }
            return;
        }

        areaTags.push(clean);
        renderTags();
    }

    // Add button handler
    if (btnAdd) {
        btnAdd.addEventListener('click', function() {
            const tVal = tinhSelect ? tinhSelect.value.trim() : '';
            const qVal = quanSelect ? quanSelect.value.trim() : '';

            if (!tVal && !qVal) {
                alert('Vui lòng chọn Tỉnh/Thành hoặc Quận/Huyện trước khi thêm!');
                if (tinhSelect) tinhSelect.focus();
                return;
            }

            let newLabel = '';
            if (qVal && !qVal.startsWith('--')) {
                newLabel = tVal ? `${qVal} (${tVal})` : qVal;
            } else if (tVal) {
                newLabel = `Toàn ${tVal}`;
            }

            if (newLabel) {
                addTag(newLabel);
                // Reset quanSelect for rapid adding of multiple districts
                if (quanSelect) quanSelect.value = '';
            }
        });
    }

    // Quick suggestion chips
    document.querySelectorAll('.quick-chip-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const area = this.getAttribute('data-area');
            if (area) addTag(area);
        });
    });

    // Toggle manual input fine-tuning
    if (btnToggleManual && manualWrap) {
        btnToggleManual.addEventListener('click', function() {
            const isHidden = manualWrap.style.display === 'none' || !manualWrap.style.display;
            manualWrap.style.display = isHidden ? 'block' : 'none';
            this.textContent = isHidden ? '🔼 Đóng tùy chỉnh chữ viết' : '✏️ Tùy chỉnh dạng chữ viết';
            if (isHidden && manualInput) {
                manualInput.focus();
            }
        });
    }

    // Manual input sync
    if (manualInput) {
        manualInput.addEventListener('input', function() {
            areaTags = parseInitial(this.value);
            renderTags();
        });
    }

    // Form submit validation
    const hoSoForm = document.getElementById('ho-so-form');
    if (hoSoForm) {
        hoSoForm.addEventListener('submit', function(e) {
            syncTags();
            const val = hiddenInput ? hiddenInput.value.trim() : '';
            if (!val) {
                e.preventDefault();
                alert('Vui lòng chọn hoặc thêm ít nhất 1 khu vực bạn có thể nhận dạy!');
                if (tinhSelect) tinhSelect.focus();
            }
        });
    }

    // Initial render of existing tags
    renderTags();
});
</script>
@endpush
@endsection