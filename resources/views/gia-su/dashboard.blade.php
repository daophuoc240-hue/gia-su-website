@extends('layouts.app')
@section('title', 'Tổng Quan Gia Sư')
@section('page-title', 'Bàn Làm Việc Gia Sư')

@section('sidebar-nav')
<p class="nav-section-title">Tổng Quan</p>
<div class="nav-item">
    <a href="{{ route('giasu.dashboard') }}" class="nav-link {{ request()->routeIs('giasu.dashboard') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan
    </a>
</div>
<p class="nav-section-title">Hồ Sơ & Lớp Học</p>
<div class="nav-item">
    <a href="{{ route('giasu.ho-so') }}" class="nav-link {{ request()->routeIs('giasu.ho-so*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link {{ request()->routeIs('giasu.tim-kiem-lop') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('giasu.ket-qua') }}" class="nav-link {{ request()->routeIs('giasu.ket-qua') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký
    </a>
</div>
@endsection

@section('content')
<!-- Welcome Banner Card -->
<div style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); border-radius: 20px; padding: 2rem 2.2rem; color: #ffffff; margin-bottom: 2rem; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);">
    <div style="position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.15); padding: 0.35rem 0.9rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700; margin-bottom: 0.8rem; border: 1px solid rgba(255,255,255,0.25);">
                👨‍🏫 TÀI KHOẢN GIA SƯ
            </div>
            <h2 style="font-size: 1.6rem; font-weight: 800; margin-bottom: 0.4rem;">Xin chào, {{ auth()->user()->ho_ten }}! 👋</h2>
            <p style="font-size: 0.95rem; color: rgba(255,255,255,0.85); max-width: 600px;">
                Chào mừng bạn quay trở lại Trung tâm Gia sư. Hãy kiểm tra danh sách lớp học mới nhất và cập nhật hồ sơ để nhận lớp ngay hôm nay!
            </p>
        </div>
        <div>
            <a href="{{ route('giasu.tim-kiem-lop') }}" class="btn" style="background: #ffffff !important; color: #1e3a8a !important; font-weight: 800; padding: 0.85rem 1.6rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.15);">
                <i class="fas fa-search" style="margin-right: 0.4rem; color: #2563eb;"></i> Tìm Lớp Mới Ngay
            </a>
        </div>
    </div>
</div>

{{-- Notification Alerts --}}
@if(!$ho_so)
<div class="alert alert-warning" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-exclamation-triangle" style="font-size: 1.2rem;"></i>
    <div>
        <strong>Bạn chưa hoàn thiện hồ sơ gia sư:</strong> Vui lòng cập nhật đầy đủ trình độ học vấn và kinh nghiệm để trung tâm tiến hành duyệt tài khoản. 
        <a href="{{ route('giasu.ho-so') }}" style="color: #b45309; font-weight: 800; text-decoration: underline; margin-left: 0.5rem;">Cập nhật hồ sơ ngay →</a>
    </div>
</div>
@elseif($ho_so->trang_thai_duyet === 'cho_duyet')
<div class="alert alert-warning" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-clock" style="font-size: 1.2rem;"></i>
    <div>
        <strong>Hồ sơ đang chờ phê duyệt:</strong> Ban quản trị đang tiến hành xem xét hồ sơ của bạn. Bạn sẽ nhận được thông báo ngay khi hồ sơ được kích hoạt!
    </div>
</div>
@elseif($ho_so->trang_thai_duyet === 'tu_choi')
<div class="alert alert-error" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-times-circle" style="font-size: 1.2rem;"></i>
    <div>
        <strong>Hồ sơ bị từ chối:</strong> {{ $ho_so->ly_do_tu_choi ?? 'Hồ sơ chưa đạt yêu cầu của trung tâm.' }} 
        <a href="{{ route('giasu.ho-so') }}" style="color: #991b1b; font-weight: 800; text-decoration: underline; margin-left: 0.5rem;">Cập nhật lại thông tin →</a>
    </div>
</div>
@else
<div class="alert alert-success" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-check-circle" style="font-size: 1.2rem;"></i>
    <div>
        <strong>Tài khoản đã được xác thực:</strong> Hồ sơ của bạn đã được phê duyệt thành công! Bạn có thể tự do chọn và đăng ký nhận các lớp học phù hợp.
    </div>
</div>
@endif

{{-- 4 Stat Cards Grid --}}
<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-card-icon orange"><i class="fas fa-bell"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['cho_xac_nhan'] ?? 0 }}</div>
            <div class="stat-card-label">Chờ bạn xác nhận lịch</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon blue"><i class="fas fa-hourglass-half"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['cho_duyet'] }}</div>
            <div class="stat-card-label">Đã gửi Admin duyệt</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-icon green"><i class="fas fa-check-circle"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['da_duyet'] }}</div>
            <div class="stat-card-label">Lớp đã nhận</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-icon red"><i class="fas fa-times-circle"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['tu_choi'] }}</div>
            <div class="stat-card-label">Yêu cầu từ chối / bận</div>
        </div>
    </div>
</div>

{{-- LỜI MỜI DẠY KÈM ĐANG CHỜ XÁC NHẬN LỊCH RẢNH --}}
@if(isset($loi_moi_cho_xac_nhan) && $loi_moi_cho_xac_nhan->count() > 0)
<div class="glass-card" style="padding: 1.8rem; border-radius: 18px; margin-bottom: 2rem; border: 2px solid #f59e0b; background: #fffdf7; box-shadow: 0 8px 30px rgba(245,158,11,0.15);">
    <div style="display:flex; justify-content:space-between; align-items:center; border-bottom: 2px solid #fef3c7; padding-bottom: 0.9rem; margin-bottom: 1.2rem;">
        <div>
            <span style="background:#fef3c7; color:#b45309; font-size:0.75rem; font-weight:800; padding:3px 10px; border-radius:12px; display:inline-block; margin-bottom:0.3rem;">
                ⚠️ CẦN BẠN KIỂM TRA LỊCH RẢNH ({{ $loi_moi_cho_xac_nhan->count() }})
            </span>
            <h3 style="font-size: 1.2rem; font-weight: 800; color: #92400e; margin: 0;">
                📩 Lời Mời Dạy Kèm & Đăng Ký Giờ Dạy Từ Học Viên
            </h3>
            <p style="font-size: 0.85rem; color: #78350f; margin: 0;">
                Vui lòng xem kỹ khung giờ và địa chỉ học để xác nhận bạn có rảnh không trước khi hệ thống chuyển lên Ban Quản Trị xét duyệt!
            </p>
        </div>
    </div>

    @foreach($loi_moi_cho_xac_nhan as $lm)
    @php
        $proposedDays  = $lm->getDanhSachNgayDeXuat();
        $proposedHours = $lm->getKhungGioDeXuat();
        $studentNote   = $lm->getGhiChuHocVien();
    @endphp
    <div style="background:#ffffff; border: 1.5px solid #fed7aa; border-radius: 16px; padding: 1.6rem; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(245,158,11,0.08);">
        {{-- Header: Thông tin lớp & Học viên --}}
        <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:1rem; margin-bottom:1.2rem; border-bottom:1px solid #fef3c7; padding-bottom:1rem;">
            <div>
                <div style="font-size:1.15rem; font-weight:800; color:#0f172a; margin-bottom:0.4rem;">
                    📚 Môn: {{ $lm->lopHoc->mon_hoc }} - {{ $lm->lopHoc->khoi_lop }}
                </div>
                <div style="font-size:0.88rem; color:#334155; line-height:1.75;">
                    <div>👤 <strong>Học viên / Phụ huynh:</strong> <span style="color:#0f172a; font-weight:700;">{{ $lm->lopHoc->hocVien->ho_ten ?? 'Học viên' }}</span> (📞 {{ $lm->lopHoc->hocVien->so_dien_thoai ?? 'Chưa cập nhật' }})</div>
                    <div>📍 <strong>Địa chỉ / Hình thức:</strong> <span style="font-weight:600;">{{ $lm->lopHoc->dia_chi_day }}</span></div>
                    <div>💰 <strong>Mức học phí:</strong> <span style="color:#10b981; font-weight:800; font-size:0.95rem;">{{ number_format($lm->lopHoc->muc_hoc_phi) }}đ / buổi</span></div>
                    @if($studentNote)
                    <div style="margin-top:0.4rem; font-style:italic; color:#475569; background:#f8fafc; padding:0.45rem 0.8rem; border-radius:8px; border-left:3px solid #3b82f6;">
                        ✍️ <strong>Ghi chú từ học viên:</strong> "{{ $studentNote }}"
                    </div>
                    @endif
                </div>
            </div>
            <div style="text-align:right;">
                <span style="background:#fff7ed; color:#c2410c; border:1px solid #ffedd5; font-size:0.8rem; font-weight:700; padding:4px 12px; border-radius:12px; display:inline-block;">
                    ⏳ Cần bạn chọn lịch dạy
                </span>
                <div style="font-size:0.75rem; color:#94a3b8; margin-top:4px;">
                    Gửi lúc: {{ $lm->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>

        {{-- Bảng tương tác: Gia sư chọn ngày học & khung giờ dạy --}}
        <div style="background:#f0f9ff; border: 1.5px solid #bfdbfe; border-radius: 12px; padding: 1.3rem; margin-bottom: 1rem;">
            <div style="font-weight: 800; color: #1e40af; font-size: 0.95rem; margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.5rem;">
                <span style="font-size: 1.2rem;">👉</span> 
                <span>Chọn Lịch Dạy Của Bạn (Từ danh sách ngày học viên rảnh):</span>
            </div>

            <form method="POST" action="{{ route('giasu.xac-nhan-lich', $lm->id) }}">
                @csrf

                {{-- 1. Chọn ngày học từ list của học viên --}}
                <div style="margin-bottom: 1.1rem;">
                    <label style="font-size: 0.85rem; font-weight: 700; color: #1e3a8a; display: block; margin-bottom: 0.45rem;">
                        🗓️ Bước 1: Chọn ngày bạn có thể dạy (tích chọn ngày bạn rảnh trong danh sách đề xuất):
                    </label>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.6rem;">
                        @foreach($proposedDays as $idx => $d)
                        <label style="cursor: pointer; display: inline-flex; align-items: center; gap: 0.45rem; background: #ffffff; border: 1.5px solid #2563eb; padding: 0.5rem 0.95rem; border-radius: 8px; font-weight: 700; color: #1e40af; font-size: 0.88rem; box-shadow: 0 1px 3px rgba(37,99,235,0.12); user-select: none;">
                            <input type="checkbox" name="ngay_da_chon[]" value="{{ $d }}" checked style="width: 17px; height: 17px; accent-color: #2563eb;">
                            <span>{{ $d }}</span>
                        </label>
                        @endforeach
                    </div>
                    <small style="color: #64748b; font-size: 0.78rem; margin-top: 0.35rem; display: block;">
                        💡 Học viên đề xuất {{ count($proposedDays) }} ngày trên. Bạn có thể bỏ tích những ngày bạn bận để chốt số buổi học phù hợp.
                    </small>
                </div>

                {{-- 2. Chọn khung giờ học & Lời nhắn --}}
                <div style="display: grid; grid-template-columns: 1.1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label style="font-size: 0.85rem; font-weight: 700; color: #1e3a8a; display: block; margin-bottom: 0.35rem;">
                            ⏰ Bước 2: Chọn khung giờ dạy phù hợp:
                        </label>
                        <select name="khung_gio_chot" class="form-select" style="font-size: 0.88rem; font-weight: 600; padding: 0.55rem 0.8rem; border-radius: 8px; border: 1.5px solid #cbd5e1; width: 100%;">
                            <option value="{{ $proposedHours }}" selected>⭐ Khung giờ học viên đề xuất: {{ $proposedHours }}</option>
                            <option value="Sáng (08:00 - 10:00)">Sáng (08:00 - 10:00)</option>
                            <option value="Sáng (09:30 - 11:30)">Sáng (09:30 - 11:30)</option>
                            <option value="Chiều (14:00 - 16:00)">Chiều (14:00 - 16:00)</option>
                            <option value="Chiều (16:30 - 18:30)">Chiều (16:30 - 18:30)</option>
                            <option value="Tối (18:00 - 20:00)">Tối (18:00 - 20:00)</option>
                            <option value="Tối (19:30 - 21:30)">Tối (19:30 - 21:30)</option>
                            <option value="Thỏa thuận linh hoạt trực tiếp">Thỏa thuận linh hoạt trực tiếp</option>
                        </select>
                    </div>

                    <div>
                        <label style="font-size: 0.85rem; font-weight: 700; color: #1e3a8a; display: block; margin-bottom: 0.35rem;">
                            💬 Lời nhắn gửi học viên (tùy chọn):
                        </label>
                        <input type="text" name="ghi_chu_gia_su" class="form-control" placeholder="VD: Thầy rảnh các tối này, tuần sau bắt đầu nhé!" style="font-size: 0.88rem; padding: 0.55rem 0.8rem; border-radius: 8px; border: 1.5px solid #cbd5e1; width: 100%;">
                    </div>
                </div>

                {{-- Action buttons --}}
                <div style="border-top: 1px dashed #bfdbfe; padding-top: 0.8rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.8rem;">
                    <button type="button" class="btn btn-outline btn-sm" style="color: #ef4444; border-color: #fca5a5; background: #ffffff;" onclick="toggleDeclineForm({{ $lm->id }})">
                        <i class="fas fa-calendar-times"></i> Tôi Bận Hết / Từ Chối
                    </button>

                    <button type="submit" class="btn btn-success btn-sm" style="font-weight: 800; padding: 0.65rem 1.4rem; background: #10b981; border: none; box-shadow: 0 4px 12px rgba(16,185,129,0.3); font-size: 0.92rem; border-radius: 10px;">
                        <i class="fas fa-check-circle"></i> Đồng Ý Lịch Đã Chọn & Gửi Trung Tâm Duyệt
                    </button>
                </div>
            </form>
        </div>

        {{-- Hidden Decline Box --}}
        <div id="decline-box-{{ $lm->id }}" style="display:none; background:#fef2f2; border:1px solid #fecaca; border-radius:10px; padding:1rem;">
            <form method="POST" action="{{ route('giasu.tu-choi-lich', $lm->id) }}">
                @csrf
                <label style="font-size:0.84rem; font-weight:700; color:#991b1b; display:block; margin-bottom:0.3rem;">
                    Lý do báo bận (sẽ hiển thị cho học viên biết):
                </label>
                <div style="display:flex; gap:0.6rem;">
                    <input type="text" name="ly_do" class="form-control" style="font-size:0.85rem;" placeholder="Ví dụ: Đã trùng lịch dạy một lớp khác vào tối thứ 4..." required>
                    <button type="submit" class="btn btn-danger btn-sm" style="flex-shrink:0;">
                        Gửi Phản Hồi Bận
                    </button>
                    <button type="button" class="btn btn-outline btn-sm" onclick="toggleDeclineForm({{ $lm->id }})">
                        Hủy
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endif

{{-- Quick Action Cards --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.2rem; margin-bottom: 2rem;">
    <a href="{{ route('giasu.ho-so') }}" style="text-decoration: none;">
        <div class="glass-card" style="padding: 1.4rem; display: flex; align-items: center; gap: 1rem; border-left: 5px solid #2563eb; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 48px; height: 48px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: #2563eb;">🆔</div>
            <div>
                <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">Hồ Sơ Cá Nhân</div>
                <div style="font-size: 0.8rem; color: #64748b;">Chỉnh sửa thông tin & bằng cấp</div>
            </div>
        </div>
    </a>

    <a href="{{ route('giasu.tim-kiem-lop') }}" style="text-decoration: none;">
        <div class="glass-card" style="padding: 1.4rem; display: flex; align-items: center; gap: 1rem; border-left: 5px solid #10b981; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 48px; height: 48px; background: #ecfdf5; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: #10b981;">🔍</div>
            <div>
                <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">Tìm Lớp Phù Hợp</div>
                <div style="font-size: 0.8rem; color: #64748b;">Xem danh sách lớp đang mở</div>
            </div>
        </div>
    </a>

    <a href="{{ route('giasu.ket-qua') }}" style="text-decoration: none;">
        <div class="glass-card" style="padding: 1.4rem; display: flex; align-items: center; gap: 1rem; border-left: 5px solid #7c3aed; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 48px; height: 48px; background: #f3e8ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: #7c3aed;">📊</div>
            <div>
                <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">Lịch Sử Đăng Ký</div>
                <div style="font-size: 0.8rem; color: #64748b;">Theo dõi tiến độ nhận lớp</div>
            </div>
        </div>
    </a>
</div>

{{-- Recent Registrations Table --}}
<div class="glass-card" style="padding: 1.8rem;">
    <div class="page-header" style="margin-bottom: 1.2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
        <div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a;">📋 Danh Sách Đăng Ký Lớp Gần Đây</h3>
            <p style="font-size: 0.85rem; color: #64748b;">Các lớp học bạn đã gửi yêu cầu nhận dạy</p>
        </div>
        <a href="{{ route('giasu.ket-qua') }}" class="btn btn-outline btn-sm">Xem tất cả →</a>
    </div>

    @forelse($dang_ky as $dk)
    <div style="padding: 1.1rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 0.9rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <div style="font-weight: 800; font-size: 1rem; color: #0f172a; margin-bottom: 0.3rem;">
                📚 {{ $dk->lopHoc->mon_hoc }} - {{ $dk->lopHoc->khoi_lop }}
                @if($dk->lopHoc->gia_su_id === auth()->id() || str_contains($dk->gioi_thieu_ban_than, 'trực tiếp') || str_contains($dk->gioi_thieu_ban_than, 'đăng ký lịch'))
                <span style="background:#eff6ff; color:#2563eb; font-weight:700; font-size:0.75rem; padding:3px 10px; border-radius:20px; display:inline-block; border:1px solid #bfdbfe; margin-left:6px;">
                    ⭐ Học viên mời trực tiếp
                </span>
                @endif
            </div>
            <div style="font-size: 0.85rem; color: #475569; display: flex; gap: 1.2rem; flex-wrap: wrap;">
                <span>📍 <strong>Địa chỉ:</strong> {{ $dk->lopHoc->dia_chi_day }}</span>
                <span>💰 <strong>Học phí:</strong> {{ number_format($dk->lopHoc->muc_hoc_phi) }} đ/buổi</span>
                <span>📅 <strong>Thời gian:</strong> {{ $dk->created_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>
        <div>
            <span class="badge {{ $dk->trang_thai === 'da_duyet' ? 'badge-success' : ($dk->trang_thai === 'tu_choi' ? 'badge-danger' : 'badge-warning') }}" style="font-size: 0.85rem; padding: 0.4rem 0.9rem;">
                {{ $dk->trang_thai_label }}
            </span>
        </div>
    </div>
    @empty
    <div class="empty-state" style="padding: 3rem 1.5rem; background: #f8fafc; border-radius: 16px; border: 2px dashed #cbd5e1;">
        <div class="empty-state-icon" style="font-size: 3.5rem;">📭</div>
        <h4 style="font-size: 1.2rem; font-weight: 800;">Bạn chưa đăng ký nhận lớp nào</h4>
        <p style="margin-bottom: 1.2rem;">Hãy duyệt qua danh sách các lớp học đang mở để tìm lớp dạy phù hợp nhất.</p>
        <a href="{{ route('giasu.tim-kiem-lop') }}" class="btn btn-primary">
            <i class="fas fa-search"></i> Khám Phá Lớp Học Mới Ngay
        </a>
    </div>
    @endforelse
</div>

<script>
function toggleDeclineForm(id) {
    const el = document.getElementById('decline-box-' + id);
    if (el) {
        el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
    }
}
</script>
@endsection