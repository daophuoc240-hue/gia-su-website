@extends('layouts.public')

@section('title', 'Tuyển Gia Sư ' . $lop->mon_hoc . ' ' . $lop->khoi_lop . ' - Gia Sư Tri Thức')

@section('content')

<div class="container" style="padding: 3rem 0;">
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('danh-sach-lop-hoc') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại danh sách lớp</a>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start;">
        <!-- Left Class Details -->
        <div class="glass-card" style="padding: 2.2rem; border-radius: 20px; background: #ffffff;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; padding-bottom: 1.2rem; margin-bottom: 1.8rem;">
                <div>
                    <span class="badge badge-info" style="font-size: 0.85rem; margin-bottom: 0.5rem;">{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}</span>
                    <h1 style="font-size: 1.6rem; font-weight: 800; color: #0f172a; margin: 0;">Tuyển Gia Sư {{ $lop->mon_hoc }} {{ $lop->khoi_lop }}</h1>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 0.82rem; color: #64748b;">Mức Học Phí</div>
                    <div style="font-size: 1.6rem; font-weight: 800; color: #2563eb;">{{ number_format($lop->hoc_phi) }} đ/tháng</div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem; font-size: 0.95rem; color: #334155; line-height: 2;">
                <div>📍 <strong>Địa chỉ giảng dạy:</strong> <br><span style="font-weight: 700; color: #0f172a;">{{ $lop->dia_chi_day }}</span></div>
                <div>🗓️ <strong>Số buổi trung bình:</strong> <br><span style="font-weight: 700; color: #0f172a;">{{ $lop->so_buoi_trung_binh }} buổi / tuần</span></div>
                <div>⏰ <strong>Thời gian đề xuất:</strong> <br><span style="font-weight: 700; color: #0f172a;">{{ $lop->thoi_gian_day }}</span></div>
                <div>👤 <strong>Phụ huynh tạo lớp:</strong> <br><span style="font-weight: 700; color: #0f172a;">{{ $lop->hocVien->ho_ten }}</span></div>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; margin-bottom: 1.8rem;">
                <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 0.8rem;">📝 Yêu Cầu Đối Với Gia Sư</h3>
                <p style="font-size: 0.95rem; color: #475569; line-height: 1.8; white-space: pre-line;">{{ $lop->yeu_cau_gia_su }}</p>
            </div>

            @if($lop->mo_ta)
            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
                <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 0.8rem;">💡 Ghi Chú Thêm Từ Phụ Huynh</h3>
                <p style="font-size: 0.95rem; color: #475569; line-height: 1.8;">{{ $lop->mo_ta }}</p>
            </div>
            @endif
        </div>

        <!-- Right Apply Action Box -->
        <div class="glass-card" style="padding: 2rem; border-radius: 20px; background: #ffffff; text-align: center;">
            <div style="width: 60px; height: 60px; background: #dbeafe; color: #2563eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin: 0 auto 1.2rem auto;">
                <i class="fas fa-hand-holding-heart"></i>
            </div>
            <h3 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem;">Bạn Muốn Nhận Lớp Này?</h3>
            <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; margin-bottom: 1.5rem;">
                Đăng nhập tài khoản Gia Sư đã được kiểm duyệt hồ sơ để đăng ký nhận lớp này với trung tâm.
            </p>

            @auth
                @if(auth()->user()->vai_tro === 'giasu')
                    <a href="{{ route('giasu.tim-kiem-lop') }}" class="btn btn-primary btn-block" style="padding: 0.95rem; border-radius: 12px; font-size: 1rem;">
                        <i class="fas fa-paper-plane"></i> Đăng Ký Nhận Lớp Ngay
                    </a>
                @else
                    <div class="alert alert-warning" style="font-size: 0.85rem; text-align: left;">
                        <i class="fas fa-info-circle"></i> Bạn đang đăng nhập tài khoản Học Viên / Admin. Vui lòng đăng nhập tài khoản Gia Sư để nhận lớp.
                    </div>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-block" style="padding: 0.95rem; border-radius: 12px; font-size: 1rem; margin-bottom: 0.8rem;">
                    <i class="fas fa-sign-in-alt"></i> Đăng Nhập Để Nhận Lớp
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline btn-block" style="padding: 0.8rem; border-radius: 12px; font-size: 0.88rem;">
                    Chưa có tài khoản? Đăng ký ngay
                </a>
            @endauth
        </div>
    </div>
</div>

@endsection
