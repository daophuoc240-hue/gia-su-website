@extends('layouts.public')

@section('title', $ho_so->taiKhoan->ho_ten . ' - Hồ Sơ Gia Sư Chi Tiết')

@section('content')

<div class="container" style="padding: 3rem 0;">
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại danh sách gia sư</a>
    </div>

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
        </div>

        <!-- Right Info Details -->
        <div>
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

            <!-- Contact & Hire Banner -->
            <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); padding: 2rem; border-radius: 20px; border: 1px solid #bfdbfe; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h4 style="font-size: 1.15rem; font-weight: 800; color: #1e40af; margin-bottom: 0.4rem;">Bạn Muốn Mời Gia Sư Này Dạy Kèm?</h4>
                    <p style="font-size: 0.88rem; color: #1e3a8a; margin: 0;">Hãy tạo yêu cầu tìm gia sư hoặc liên hệ hotline trung tâm để được xếp lịch ngay.</p>
                </div>
                <a href="{{ route('register') }}" class="btn btn-primary" style="padding: 0.8rem 1.6rem; border-radius: 12px; font-weight: 800;">
                    <i class="fas fa-paper-plane"></i> Mời Gia Sư Ngay
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
