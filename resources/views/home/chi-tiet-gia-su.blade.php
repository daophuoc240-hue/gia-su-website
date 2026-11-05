@extends('layouts.public')

@section('title', $ho_so->taiKhoan->ho_ten . ' - Hồ Sơ Gia Sư Chi Tiết')

@section('content')

<div class="container" style="padding: 3rem 0;">
    <div style="margin-bottom: 1.5rem; display: flex; gap: 0.8rem; align-items: center;">
        @if(auth()->check() && auth()->user()->vai_tro === 'hoc_vien')
            <a href="{{ route('hocvien.gia-su') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại danh sách gia sư</a>
            <a href="{{ route('hocvien.dashboard') }}" class="btn btn-outline btn-sm" style="color:#64748b;"><i class="fas fa-home"></i> Trang cá nhân học viên</a>
        @else
            <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại danh sách gia sư</a>
        @endif
    </div>

    {{-- Flash Notifications --}}
    @if(session('success'))
    <div style="background:#ecfdf5; border:1px solid #a7f3d0; color:#065f46; padding:1.1rem 1.4rem; border-radius:14px; margin-bottom:1.5rem; display:flex; align-items:center; gap:0.8rem; box-shadow:0 4px 12px rgba(16,185,129,0.12);">
        <i class="fas fa-check-circle" style="font-size:1.4rem; color:#10b981; flex-shrink:0;"></i>
        <div style="font-size:0.95rem; font-weight:600;">{{ session('success') }}</div>
    </div>
    @endif

    @if(session('info'))
    <div style="background:#eff6ff; border:1px solid #bfdbfe; color:#1e40af; padding:1.1rem 1.4rem; border-radius:14px; margin-bottom:1.5rem; display:flex; align-items:center; gap:0.8rem; box-shadow:0 4px 12px rgba(37,99,235,0.1);">
        <i class="fas fa-info-circle" style="font-size:1.4rem; color:#2563eb; flex-shrink:0;"></i>
        <div style="font-size:0.95rem; font-weight:600;">{{ session('info') }}</div>
    </div>
    @endif

    @if(session('error'))
    <div style="background:#fef2f2; border:1px solid #fecaca; color:#991b1b; padding:1.1rem 1.4rem; border-radius:14px; margin-bottom:1.5rem; display:flex; align-items:center; gap:0.8rem;">
        <i class="fas fa-exclamation-circle" style="font-size:1.4rem; color:#ef4444; flex-shrink:0;"></i>
        <div style="font-size:0.95rem; font-weight:600;">{{ session('error') }}</div>
    </div>
    @endif

    @if($errors->any())
    <div style="background:#fef2f2; border:1px solid #fecaca; color:#991b1b; padding:1.1rem 1.4rem; border-radius:14px; margin-bottom:1.5rem;">
        <div style="font-weight:700; margin-bottom:0.4rem;"><i class="fas fa-exclamation-triangle"></i> Vui lòng kiểm tra lại thông tin đăng ký:</div>
        <ul style="margin:0; padding-left:1.4rem; font-size:0.88rem;">
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div style="display: grid; grid-template-columns: 340px 1fr; gap: 2rem; align-items: start;">
        <!-- Left Profile Card -->
        <div class="glass-card" style="padding: 2.2rem; text-align: center; border-radius: 20px; background: #ffffff;">
            <div style="position:relative; display:inline-block; margin-bottom:1.2rem;">
                <img src="{{ $ho_so->avatar_url }}" alt="{{ $ho_so->taiKhoan->ho_ten }}"
                     style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid #2563eb; box-shadow: 0 8px 25px rgba(37,99,235,0.25);">
                <span style="position:absolute;bottom:5px;right:5px;width:20px;height:20px;background:#10b981;border:3px solid #fff;border-radius:50%;"></span>
            </div>
            <h2 style="font-size: 1.35rem; font-weight: 800; color: #0f172a; margin-bottom: 0.3rem;">{{ $ho_so->taiKhoan->ho_ten }}</h2>
            @if($ho_so->mon_day)
            <span style="background:#eff6ff;color:#2563eb;font-size:0.82rem;font-weight:700;padding:4px 14px;border-radius:20px;display:inline-block;margin-bottom:0.7rem;">📚 Dạy môn: {{ $ho_so->mon_day }}</span>
            @endif
            <p style="color: #64748b; font-size: 0.88rem; margin-bottom: 1.2rem;">📧 {{ $ho_so->taiKhoan->email }}</p>

            <span class="badge badge-success" style="font-size: 0.88rem; padding: 0.5rem 1.2rem; border-radius: 20px; margin-bottom: 1.2rem;">
                ✅ Hồ Sơ Đã Được Thẩm Định
            </span>

            {{-- Đánh giá tổng quan --}}
            <div style="background:#fffbeb; border:1px solid #fef3c7; border-radius:14px; padding:0.9rem 1rem; margin-bottom:1.5rem;">
                <div style="font-size:1.5rem; font-weight:800; color:#d97706;">
                    ⭐ {{ number_format($ho_so->diem_trung_binh ?? 5.0, 1) }} <span style="font-size:0.85rem; color:#92400e; font-weight:600;">/ 5.0</span>
                </div>
                <div style="font-size:0.82rem; color:#b45309; font-weight:600; margin-top:3px;">
                    ({{ $ho_so->so_luot_danh_gia ?? 0 }} đánh giá từ phụ huynh)
                </div>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; text-align: left; font-size: 0.9rem; color: #334155; line-height: 1.9;">
                <div>🎓 <strong>Trường học:</strong> <br><span style="font-weight: 700; color: #0f172a;">{{ $ho_so->truong_hoc }}</span></div>
                <div>📖 <strong>Chuyên ngành:</strong> <br><span style="font-weight: 700; color: #0f172a;">{{ $ho_so->chuyen_nganh }}</span></div>
                <div>📍 <strong>Khu vực nhận dạy:</strong> <br><span style="font-weight: 700; color: #0f172a;">{{ $ho_so->khu_vuc_nhan_day }}</span></div>
                @if($ho_so->hoc_phi_theo_gio)
                <div>💰 <strong>Học phí/buổi:</strong> <br><span style="font-weight: 700; color: #2563eb; font-size:1.05rem;">{{ number_format($ho_so->hoc_phi_theo_gio) }}đ</span></div>
                @endif
                @if($ho_so->so_lop_da_day)
                <div>🏫 <strong>Lớp đã dạy:</strong> <span style="font-weight: 700; color: #0f172a;">{{ $ho_so->so_lop_da_day }} lớp</span></div>
                @endif
                <div>📞 <strong>Điện thoại liên hệ:</strong> <br><span style="font-weight: 700; color: #0f172a;">{{ $ho_so->taiKhoan->so_dien_thoai ?? 'Liên hệ trung tâm' }}</span></div>
            </div>

            <a href="#dang-ky-lich-day" class="btn btn-primary" style="width: 100%; margin-top: 1.5rem; border-radius: 12px; font-weight: 800; padding: 0.85rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(37,99,235,0.3);">
                <i class="fas fa-calendar-alt"></i> Đăng Ký Giờ Dạy Ngay
            </a>
        </div>

        <!-- Right Info Details -->
        <div>
            {{-- Kinh nghiệm & Phương pháp --}}
            <div class="glass-card" style="padding: 2.2rem; border-radius: 20px; background: #ffffff; margin-bottom: 1.8rem;">
                <h3 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin-bottom: 1.2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
                    💡 Kinh Nghiệm Giảng Dạy & Phương Pháp Truyền Đạt
                </h3>
                <p style="font-size: 0.98rem; color: #334155; line-height: 1.8; white-space: pre-line;">
                    {{ $ho_so->kinh_nghiem }}
                </p>
            </div>

            {{-- Đánh giá & Nhận xét từ phụ huynh --}}
            <div class="glass-card" style="padding: 2.2rem; border-radius: 20px; background: #ffffff; margin-bottom: 1.8rem;">
                <div style="display:flex; justify-content:space-between; align-items:center; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem; margin-bottom: 1.2rem;">
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0;">
                        💬 Nhận Xét Từ Phụ Huynh Đã Học ({{ isset($danh_gias) ? $danh_gias->count() : 0 }})
                    </h3>
                    <span style="font-size:0.85rem; color:#d97706; font-weight:700; background:#fef3c7; padding:2px 10px; border-radius:12px;">
                        ⭐ {{ number_format($ho_so->diem_trung_binh ?? 5.0, 1) }} / 5.0
                    </span>
                </div>

                @if(isset($danh_gias) && $danh_gias->count() > 0)
                    @foreach($danh_gias as $dg)
                    <div style="padding: 0.9rem 0; border-bottom: 1px solid #f1f5f9;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.4rem;">
                            <div style="display:flex; align-items:center; gap:0.6rem;">
                                <div style="width:34px; height:34px; border-radius:50%; background:#eff6ff; color:#2563eb; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.85rem;">
                                    {{ substr($dg->hocVien->ho_ten ?? 'PH', 0, 1) }}
                                </div>
                                <div>
                                    <span style="font-weight:700; color:#0f172a; font-size:0.92rem;">{{ $dg->hocVien->ho_ten ?? 'Phụ huynh' }}</span>
                                    <span style="font-size:0.75rem; color:#94a3b8; margin-left:6px;">{{ $dg->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star" style="font-size:0.82rem; color:{{ $i <= $dg->so_sao ? '#f59e0b' : '#cbd5e1' }};"></i>
                                @endfor
                            </div>
                        </div>
                        <p style="font-size:0.9rem; color:#334155; line-height:1.6; margin:0; padding-left:2.7rem; font-style:italic;">
                            "{{ $dg->nhan_xet }}"
                        </p>
                    </div>
                    @endforeach
                @else
                    <div style="text-align:center; padding: 2rem 1rem; color:#94a3b8;">
                        <div style="font-size:2rem; margin-bottom:0.5rem;">🌟</div>
                        <p style="margin:0; font-size:0.9rem;">Gia sư này đang chờ những đánh giá đầu tiên. Mời gia sư ngay để trải nghiệm dịch vụ!</p>
                    </div>
                @endif
            </div>

            {{-- ===== MỤC ĐĂNG KÝ GIỜ DẠY & LỊCH DẠY CỦA GIA SƯ ===== --}}
            <div id="dang-ky-lich-day" class="glass-card" style="padding: 2.2rem; border-radius: 20px; background: #ffffff; margin-bottom: 1.8rem; border: 2px solid #2563eb; box-shadow: 0 10px 35px rgba(37,99,235,0.12); scroll-margin-top: 2rem;">
                <div style="border-bottom: 2px solid #eff6ff; padding-bottom: 1rem; margin-bottom: 1.5rem;">
                    <span style="background: linear-gradient(135deg,#2563eb,#1d4ed8); color:#fff; font-size:0.75rem; font-weight:800; padding:4px 12px; border-radius:20px; display:inline-block; margin-bottom:0.5rem; letter-spacing:0.4px;">
                        ⭐ LỊCH RẢNH & ĐĂNG KÝ TRỰC TIẾP
                    </span>
                    <h3 style="font-size: 1.35rem; font-weight: 800; color: #0f172a; margin: 0 0 0.3rem 0;">
                        📅 Lịch Dạy & Đăng Ký Giờ Dạy Với Gia Sư {{ $ho_so->taiKhoan->ho_ten }}
                    </h3>
                    <p style="font-size: 0.9rem; color: #64748b; margin: 0;">
                        Xem trước khung giờ rảnh của gia sư và đăng ký lịch học phù hợp nhất với bạn.
                    </p>
                </div>

                {{-- Phân tích lịch dạy từ CSDL --}}
                @php
                    $lichDayData = [];
                    if (!empty($ho_so->lich_day)) {
                        $decoded = json_decode($ho_so->lich_day, true);
                        if (is_array($decoded)) {
                            $lichDayData = $decoded;
                        }
                    }
                    $tutorSlots = $lichDayData['slots'] ?? [];
                    $tutorGhiChu = $lichDayData['ghi_chu'] ?? (!is_array(json_decode($ho_so->lich_day, true)) ? ($ho_so->lich_day ?? '') : '');
                    $hasSlots = !empty($tutorSlots);
                    $dayLabels = [
                        'T2' => 'Thứ 2',
                        'T3' => 'Thứ 3',
                        'T4' => 'Thứ 4',
                        'T5' => 'Thứ 5',
                        'T6' => 'Thứ 6',
                        'T7' => 'Thứ 7',
                        'CN' => 'Chủ Nhật',
                    ];
                    $shiftLabels = [
                        'sang'  => ['label' => 'Sáng', 'time' => '8h - 11h30', 'icon' => '🌅'],
                        'chieu' => ['label' => 'Chiều', 'time' => '14h - 17h30', 'icon' => '☀️'],
                        'toi'   => ['label' => 'Tối', 'time' => '18h - 21h30', 'icon' => '🌙'],
                    ];
                @endphp

                {{-- Bảng lịch rảnh của gia sư --}}
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 1.2rem; margin-bottom: 1.8rem;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.8rem;">
                        <h4 style="font-size: 0.95rem; font-weight: 700; color: #1e293b; margin: 0;">
                            🕒 Khung Giờ Gia Sư Sẵn Sàng Giảng Dạy:
                        </h4>
                        @if($hasSlots)
                        <span style="font-size:0.75rem; color:#15803d; background:#dcfce7; padding:3px 10px; border-radius:12px; font-weight:700;">
                            ✓ Gia sư đã cập nhật lịch dạy
                        </span>
                        @endif
                    </div>

                    @if($hasSlots)
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse: collapse; text-align:center; font-size:0.83rem; background:#fff; border-radius:8px; overflow:hidden; border:1px solid #e2e8f0;">
                            <thead>
                                <tr style="background:#f1f5f9; color:#475569;">
                                    <th style="padding:0.6rem 0.4rem; font-weight:700; width:95px; border-bottom:1px solid #e2e8f0;">Ca Học</th>
                                    @foreach($dayLabels as $k => $dName)
                                    <th style="padding:0.6rem 0.3rem; font-weight:700; border-bottom:1px solid #e2e8f0;">{{ $dName }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shiftLabels as $sKey => $sVal)
                                <tr style="border-bottom:1px solid #f1f5f9;">
                                    <td style="padding:0.55rem 0.4rem; text-align:left; background:#fafafa; font-weight:700; color:#1e293b; border-right:1px solid #f1f5f9;">
                                        <div>{{ $sVal['icon'] }} {{ $sVal['label'] }}</div>
                                        <div style="font-size:0.68rem; color:#64748b; font-weight:normal;">{{ $sVal['time'] }}</div>
                                    </td>
                                    @foreach($dayLabels as $dKey => $dName)
                                    @php
                                        $isAvailable = isset($tutorSlots[$dKey][$sKey]) && $tutorSlots[$dKey][$sKey];
                                    @endphp
                                    <td style="padding:0.55rem 0.2rem;">
                                        @if($isAvailable)
                                        <span style="display:inline-block; background:#dcfce7; color:#15803d; font-size:0.72rem; font-weight:700; padding:3px 8px; border-radius:6px; box-shadow:0 1px 3px rgba(21,128,61,0.15);">
                                            ✓ Rảnh
                                        </span>
                                        @else
                                        <span style="color:#cbd5e1; font-size:0.9rem;">—</span>
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div style="background:#ffffff; border:1px dashed #cbd5e1; border-radius:10px; padding:1.2rem; text-align:center; color:#475569;">
                        <span style="font-size:1.6rem; display:block; margin-bottom:0.3rem;">🤝</span>
                        <div style="font-weight:700; color:#0f172a; margin-bottom:0.2rem;">Lịch Dạy Linh Hoạt</div>
                        <div style="font-size:0.86rem; color:#64748b;">Gia sư sẵn sàng sắp xếp thời gian linh hoạt theo nhu cầu của phụ huynh và học viên (Sáng, Chiều hoặc Tối các ngày trong tuần).</div>
                    </div>
                    @endif

                    @if(!empty($tutorGhiChu))
                    <div style="margin-top:0.9rem; padding:0.7rem 0.9rem; background:#eff6ff; border-left:4px solid #2563eb; border-radius:6px; font-size:0.86rem; color:#1e40af;">
                        <strong>💬 Ghi chú từ gia sư:</strong> {{ $tutorGhiChu }}
                    </div>
                    @endif
                </div>

                {{-- FORM ĐĂNG KÝ GIỜ DẠY --}}
                <div style="border-top: 1px dashed #e2e8f0; padding-top: 1.5rem;">
                    <h4 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 0.4rem;">
                        📝 Gửi Yêu Cầu Đăng Ký Giờ Dạy Trực Tiếp
                    </h4>
                    <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 1.4rem;">
                        Sau khi bạn gửi đăng ký, gia sư {{ $ho_so->taiKhoan->ho_ten }} sẽ nhận được thông báo ngay trong tài khoản và liên hệ xếp lịch với bạn.
                    </p>

                    <form method="POST" action="{{ route('giasu.dang-ky-gio-day', $ho_so->id) }}">
                        @csrf

                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1rem;">
                            {{-- Môn học --}}
                            <div>
                                <label style="font-size:0.88rem; font-weight:700; color:#334155; margin-bottom:0.3rem; display:block;">
                                    📚 Môn Học <span style="color:#ef4444;">*</span>
                                </label>
                                <input type="text" name="mon_hoc" class="form-control" required
                                       value="{{ old('mon_hoc', $ho_so->mon_day ?? 'Toán học') }}"
                                       placeholder="Ví dụ: Toán, Tiếng Anh, Vật Lý, Hóa học...">
                            </div>

                            {{-- Khối lớp --}}
                            <div>
                                <label style="font-size:0.88rem; font-weight:700; color:#334155; margin-bottom:0.3rem; display:block;">
                                    🏫 Khối Lớp <span style="color:#ef4444;">*</span>
                                </label>
                                <select name="khoi_lop" class="form-control" required>
                                    <option value="">-- Chọn khối lớp --</option>
                                    @for($l = 1; $l <= 12; $l++)
                                    <option value="Lớp {{ $l }}" {{ old('khoi_lop') === "Lớp $l" ? 'selected' : '' }}>Lớp {{ $l }}</option>
                                    @endfor
                                    <option value="Ôn thi Đại học" {{ old('khoi_lop') === 'Ôn thi Đại học' ? 'selected' : '' }}>Ôn thi Đại học / ĐGNL</option>
                                    <option value="Tiếng Anh Giao Tiếp" {{ old('khoi_lop') === 'Tiếng Anh Giao Tiếp' ? 'selected' : '' }}>Tiếng Anh Giao Tiếp</option>
                                    <option value="Khác" {{ old('khoi_lop') === 'Khác' ? 'selected' : '' }}>Khác (Ghi chú thêm)</option>
                                </select>
                            </div>
                        </div>

                        {{-- Chọn ngày học trong tuần --}}
                        <div style="margin-bottom: 1.2rem;">
                            <label style="font-size:0.88rem; font-weight:700; color:#334155; margin-bottom:0.4rem; display:block;">
                                🗓️ Chọn các ngày muốn học trong tuần <span style="color:#ef4444;">*</span>
                            </label>
                            <div style="display:flex; gap:0.6rem; flex-wrap:wrap;">
                                @php
                                    $selectedDays = old('ngay_hoc', ['Thứ 2', 'Thứ 4', 'Thứ 6']);
                                @endphp
                                @foreach(['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật'] as $dName)
                                <label style="cursor:pointer; display:inline-flex; align-items:center; gap:0.4rem; background:#f8fafc; border:1px solid #cbd5e1; padding:0.45rem 0.9rem; border-radius:20px; font-size:0.85rem; font-weight:600; color:#334155; user-select:none;">
                                    <input type="checkbox" name="ngay_hoc[]" value="{{ $dName }}"
                                           {{ in_array($dName, (array)$selectedDays) ? 'checked' : '' }}>
                                    <span>{{ $dName }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1rem;">
                            {{-- Khung giờ học --}}
                            <div>
                                <label style="font-size:0.88rem; font-weight:700; color:#334155; margin-bottom:0.3rem; display:block;">
                                    ⏰ Khung Giờ Học Mong Muốn <span style="color:#ef4444;">*</span>
                                </label>
                                <select name="khung_gio" class="form-control" required>
                                    <option value="Sáng (08:00 - 10:00)" {{ old('khung_gio') === 'Sáng (08:00 - 10:00)' ? 'selected' : '' }}>Sáng (08:00 - 10:00)</option>
                                    <option value="Sáng (09:30 - 11:30)" {{ old('khung_gio') === 'Sáng (09:30 - 11:30)' ? 'selected' : '' }}>Sáng (09:30 - 11:30)</option>
                                    <option value="Chiều (14:00 - 16:00)" {{ old('khung_gio') === 'Chiều (14:00 - 16:00)' ? 'selected' : '' }}>Chiều (14:00 - 16:00)</option>
                                    <option value="Chiều (16:30 - 18:30)" {{ old('khung_gio') === 'Chiều (16:30 - 18:30)' ? 'selected' : '' }}>Chiều (16:30 - 18:30)</option>
                                    <option value="Tối (18:00 - 20:00)" {{ old('khung_gio', 'Tối (18:00 - 20:00)') === 'Tối (18:00 - 20:00)' ? 'selected' : '' }}>Tối (18:00 - 20:00)</option>
                                    <option value="Tối (19:30 - 21:30)" {{ old('khung_gio') === 'Tối (19:30 - 21:30)' ? 'selected' : '' }}>Tối (19:30 - 21:30)</option>
                                    <option value="Thỏa thuận linh hoạt" {{ old('khung_gio') === 'Thỏa thuận linh hoạt' ? 'selected' : '' }}>Linh hoạt / Thỏa thuận với gia sư</option>
                                </select>
                            </div>

                            {{-- Hình thức học --}}
                            <div>
                                <label style="font-size:0.88rem; font-weight:700; color:#334155; margin-bottom:0.3rem; display:block;">
                                    💻 Hình Thức Học <span style="color:#ef4444;">*</span>
                                </label>
                                <select name="hinh_thuc" id="select-hinh-thuc" class="form-control" required onchange="toggleDiaChi(this.value)">
                                    <option value="tai_nha" {{ old('hinh_thuc', 'tai_nha') === 'tai_nha' ? 'selected' : '' }}>🏠 Dạy kèm tại nhà học viên</option>
                                    <option value="online" {{ old('hinh_thuc') === 'online' ? 'selected' : '' }}>🌐 Học Online (Zoom / Google Meet)</option>
                                </select>
                            </div>
                        </div>

                        {{-- Địa chỉ học --}}
                        <div id="wrap-dia-chi" style="margin-bottom: 1rem; {{ old('hinh_thuc') === 'online' ? 'display:none;' : '' }}">
                            <label style="font-size:0.88rem; font-weight:700; color:#334155; margin-bottom:0.3rem; display:block;">
                                📍 Địa Chỉ Học Cụ Thể (Số nhà, đường, Quận/Huyện) <span style="color:#ef4444;">*</span>
                            </label>
                            <input type="text" name="dia_chi_day" class="form-control"
                                   value="{{ old('dia_chi_day') }}"
                                   placeholder="Ví dụ: 123 Nguyễn Văn Cừ, Phường 4, Quận 5, TP.HCM...">
                        </div>

                        {{-- Ghi chú yêu cầu thêm --}}
                        <div style="margin-bottom: 1.5rem;">
                            <label style="font-size:0.88rem; font-weight:700; color:#334155; margin-bottom:0.3rem; display:block;">
                                ✍️ Ghi Chú Yêu Cầu Cho Gia Sư (Tùy chọn)
                            </label>
                            <textarea name="yeu_cau_them" class="form-control" rows="3"
                                      placeholder="Ví dụ: Học sinh bị hổng kiến thức căn bản, muốn ôn thi vào lớp 10, dự kiến bắt đầu học vào đầu tuần tới...">{{ old('yeu_cau_them') }}</textarea>
                        </div>

                        {{-- Nút bấm hành động --}}
                        @auth
                            @if(auth()->user()->isHocVien())
                                <button type="submit" class="btn btn-primary" style="width:100%; padding:0.95rem; font-size:1.05rem; font-weight:800; border-radius:12px; display:flex; align-items:center; justify-content:center; gap:0.6rem; box-shadow:0 6px 20px rgba(37,99,235,0.35);">
                                    <i class="fas fa-paper-plane"></i> Xác Nhận Đăng Ký Giờ Dạy & Mời Gia Sư Ngay
                                </button>
                            @elseif(auth()->user()->isGiaSu() && auth()->id() === $ho_so->tai_khoan_id)
                                <div style="background:#f1f5f9; border:1px solid #cbd5e1; border-radius:12px; padding:1.2rem; text-align:center;">
                                    <div style="font-weight:700; color:#0f172a; margin-bottom:0.4rem;">👨‍🏫 Đây là hồ sơ công khai của bạn</div>
                                    <p style="font-size:0.86rem; color:#64748b; margin-bottom:0.8rem;">Bạn có thể sắp xếp lại lịch dạy hoặc chỉnh sửa thông tin trong trang quản lý hồ sơ cá nhân.</p>
                                    <a href="{{ route('giasu.ho-so') }}" class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Chỉnh Sửa Lịch Dạy Của Bạn
                                    </a>
                                </div>
                            @else
                                <div style="background:#eff6ff; border:1px solid #bfdbfe; border-radius:12px; padding:1.2rem; text-align:center; color:#1e40af; font-size:0.9rem;">
                                    <i class="fas fa-info-circle"></i> Bạn đang đăng nhập bằng tài khoản <strong>{{ auth()->user()->vai_tro === 'admin' ? 'Quản trị viên' : 'Gia sư' }}</strong>. Chức năng đăng ký giờ dạy chỉ áp dụng cho tài khoản <strong>Phụ huynh / Học viên</strong>.
                                </div>
                            @endif
                        @else
                            {{-- Khách vãng lai: Hiển thị nút đăng nhập để tiếp tục --}}
                            <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border:1px solid #bfdbfe; border-radius:14px; padding:1.4rem; text-align:center;">
                                <div style="font-size:1.05rem; font-weight:800; color:#1e40af; margin-bottom:0.4rem;">
                                    🔒 Vui lòng Đăng Nhập để Gửi Đăng Ký Giờ Dạy
                                </div>
                                <p style="font-size:0.88rem; color:#1e3a8a; margin-bottom:1rem;">
                                    Sau khi đăng nhập tài khoản Học viên, hệ thống sẽ tự động đưa bạn trở lại trang của Gia sư {{ $ho_so->taiKhoan->ho_ten }} để xác nhận lịch học.
                                </p>
                                <a href="{{ route('giasu.moi', $ho_so->id) }}" class="btn btn-primary" style="padding:0.85rem 2rem; border-radius:12px; font-weight:800; font-size:0.95rem; display:inline-flex; align-items:center; gap:0.5rem; box-shadow:0 4px 15px rgba(37,99,235,0.3);">
                                    <i class="fas fa-sign-in-alt"></i> Đăng Nhập Tài Khoản Học Viên Ngay
                                </a>
                                <div style="margin-top:0.7rem; font-size:0.82rem; color:#64748b;">
                                    Chưa có tài khoản? <a href="{{ route('register') }}" style="color:#2563eb; font-weight:700; text-decoration:underline;">Đăng ký miễn phí tại đây</a>
                                </div>
                            </div>
                        @endauth
                    </form>
                </div>
            </div>

            <!-- Contact & Hire Banner -->
            <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); padding: 2rem; border-radius: 20px; border: 1px solid #bfdbfe; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h4 style="font-size: 1.15rem; font-weight: 800; color: #1e40af; margin-bottom: 0.4rem;">Bạn Muốn Mời Gia Sư Này Dạy Kèm?</h4>
                    <p style="font-size: 0.88rem; color: #1e3a8a; margin: 0;">Xem lịch rảnh bên trên và đăng ký giờ dạy trực tiếp hoặc gọi hotline trung tâm để được xếp lớp ngay.</p>
                </div>
                <a href="{{ auth()->check() ? '#dang-ky-lich-day' : route('giasu.moi', $ho_so->id) }}" class="btn btn-primary" style="padding: 0.85rem 1.8rem; border-radius: 12px; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(37,99,235,0.3); font-size: 1rem;">
                    <i class="fas fa-calendar-check"></i> Đăng Ký Giờ Dạy
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function toggleDiaChi(hinhThuc) {
    const wrap = document.getElementById('wrap-dia-chi');
    if (wrap) {
        if (hinhThuc === 'online') {
            wrap.style.display = 'none';
        } else {
            wrap.style.display = 'block';
        }
    }
}
</script>

@endsection
