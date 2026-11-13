@extends('layouts.public')

@section('title', 'Tuyển Dụng Gia Sư Giỏi Toàn Quốc - Gia Sư Tri Thức')

@section('content')

<!-- HERO BANNER TUYỂN DỤNG GIA SƯ -->
<section style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 60%, #2563eb 100%); color: #ffffff; padding: 4.2rem 0;">
    <div class="container" style="display: grid; grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr); gap: 3rem; align-items: center;">
        <div>
            <span style="display: inline-block; background: rgba(255,255,255,0.16); color: #93c5fd; font-size: 0.82rem; font-weight: 800; padding: 0.4rem 1rem; border-radius: 50px; margin-bottom: 1rem;">
                👨‍🏫 DÀNH CHO GIÁO VIÊN & SINH VIÊN GIỎI
            </span>
            <h1 style="font-size: 2.35rem; font-weight: 800; line-height: 1.25; margin: 0 0 1rem 0; color: #ffffff;">
                Trở Thành Đối Tác Giảng Dạy Cùng Gia Sư Tri Thức
            </h1>
            <p style="font-size: 1rem; color: #cbd5e1; line-height: 1.7; margin: 0 0 1.8rem 0;">
                Chủ động chọn lớp gần nhà hoặc dạy Online, thu nhập từ <strong>3.000.000 – 12.000.000 đ/tháng</strong>, quy trình nhận lớp minh bạch và được bảo vệ quyền lợi 100%.
            </p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('register') }}" class="btn" style="background: #ffffff; color: #1e3a8a; font-weight: 800; padding: 0.9rem 1.8rem; border-radius: 12px; font-size: 0.96rem;">
                    <i class="fas fa-user-plus"></i> Đăng Ký Làm Gia Sư Ngay
                </a>
                <a href="{{ route('danh-sach-lop-hoc') }}" class="btn btn-outline" style="border: 1.5px solid #93c5fd; color: #ffffff; background: rgba(255,255,255,0.08); font-weight: 700; padding: 0.9rem 1.8rem; border-radius: 12px; font-size: 0.96rem;">
                    <i class="fas fa-book-open"></i> Xem {{ $stats['lop_dang_tim'] ?? 0 }} Lớp Đang Mở
                </a>
            </div>
        </div>

        <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18); border-radius: 22px; padding: 2rem; backdrop-filter: blur(10px);">
            <h3 style="font-size: 1.2rem; font-weight: 800; color: #ffffff; margin: 0 0 1.2rem 0;">✨ Quyền Lợi Khi Làm Gia Sư Tại Hệ Thống</h3>
            <ul style="list-style: none; padding: 0; margin: 0; font-size: 0.92rem; color: #e2e8f0; line-height: 2.1;">
                <li><i class="fas fa-check-circle" style="color: #34d399; margin-right: 0.5rem;"></i> <strong>Hồ sơ thương hiệu cá nhân:</strong> Hiển thị công khai để phụ huynh mời dạy trực tiếp.</li>
                <li><i class="fas fa-check-circle" style="color: #34d399; margin-right: 0.5rem;"></i> <strong>Chủ động chọn khu vực & lịch rảnh:</strong> Không bị ép nhận lớp xa hay trái giờ.</li>
                <li><i class="fas fa-check-circle" style="color: #34d399; margin-right: 0.5rem;"></i> <strong>Khung học phí chuẩn:</strong> Đảm bảo mức thù lao xứng đáng với năng lực sư phạm.</li>
                <li><i class="fas fa-check-circle" style="color: #34d399; margin-right: 0.5rem;"></i> <strong>Hỗ trợ sự cố lớp học:</strong> Hoàn/đổi lớp nếu phụ huynh hủy lớp khách quan.</li>
            </ul>
        </div>
    </div>
</section>

<!-- QUY TRÌNH 4 BƯỚC NHẬN LỚP -->
<section style="padding: 4rem 0; background: #ffffff; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div style="text-align: center; max-width: 680px; margin: 0 auto 2.8rem auto;">
            <span style="color: #2563eb; font-size: 0.82rem; font-weight: 700; text-transform: uppercase;">Quy Trình Chuẩn</span>
            <h2 style="font-size: 1.8rem; font-weight: 800; color: #0f172a; margin: 0.3rem 0 0 0;">📋 4 Bước Trở Thành Gia Sư Chính Thức</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1.5rem;">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 1.8rem;">
                <div style="font-size: 0.78rem; font-weight: 800; color: #2563eb; margin-bottom: 0.5rem;">BƯỚC 01</div>
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0f172a; margin: 0 0 0.5rem 0;">Tạo Tài Khoản Gia Sư</h3>
                <p style="font-size: 0.86rem; color: #64748b; line-height: 1.6; margin: 0;">Đăng ký tài khoản miễn phí với vai trò Gia sư bằng Email và Số điện thoại cá nhân.</p>
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 1.8rem;">
                <div style="font-size: 0.78rem; font-weight: 800; color: #2563eb; margin-bottom: 0.5rem;">BƯỚC 02</div>
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0f172a; margin: 0 0 0.5rem 0;">Hoàn Thiện Hồ Sơ & Khung Giá</h3>
                <p style="font-size: 0.86rem; color: #64748b; line-height: 1.6; margin: 0;">Cập nhật trường học, chuyên ngành, tải ảnh thẻ SV/bằng cấp và đặt học phí đúng khung quy định.</p>
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 1.8rem;">
                <div style="font-size: 0.78rem; font-weight: 800; color: #2563eb; margin-bottom: 0.5rem;">BƯỚC 03</div>
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0f172a; margin: 0 0 0.5rem 0;">Ứng Tuyển Hoặc Nhận Lời Mời</h3>
                <p style="font-size: 0.86rem; color: #64748b; line-height: 1.6; margin: 0;">Chọn lớp phù hợp trong danh sách lớp mới hoặc xác nhận lời mời dạy trực tiếp từ phụ huynh.</p>
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 1.8rem;">
                <div style="font-size: 0.78rem; font-weight: 800; color: #2563eb; margin-bottom: 0.5rem;">BƯỚC 04</div>
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0f172a; margin: 0 0 0.5rem 0;">Nhận Lớp & Giảng Dạy</h3>
                <p style="font-size: 0.86rem; color: #64748b; line-height: 1.6; margin: 0;">Trao đổi qua phòng Chat với phụ huynh, tiến hành dạy thử 2 buổi đầu và nhận lớp lâu dài.</p>
            </div>
        </div>
    </div>
</section>

<!-- BẢNG QUY ĐỊNH KHUNG HỌC PHÍ DÀNH CHO GIA SƯ -->
<section style="padding: 4rem 0; background: #f8fafc;">
    <div class="container" style="max-width: 960px;">
        <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 22px; padding: 2.4rem; box-shadow: 0 8px 25px rgba(15,23,42,0.04);">
            <h2 style="font-size: 1.5rem; font-weight: 800; color: #0f172a; margin: 0 0 0.5rem 0;">🛡️ Quy Định Khung Học Phí Khi Đặt Giá Trên Hồ Sơ</h2>
            <p style="font-size: 0.9rem; color: #64748b; margin: 0 0 1.5rem 0;">
                Để bảo vệ quyền lợi phụ huynh và đảm bảo cạnh tranh lành mạnh, hệ thống áp dụng thuật toán kiểm tra mức học phí/buổi tự động theo bảng chuẩn dưới đây:
            </p>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.92rem;">
                    <thead>
                        <tr style="background: #eff6ff; color: #1e3a8a;">
                            <th style="padding: 0.9rem 1rem; text-align: left; border-bottom: 2px solid #93c5fd;">Cấp Học Giảng Dạy</th>
                            <th style="padding: 0.9rem 1rem; text-align: left; border-bottom: 2px solid #93c5fd;">Khung Giá Gia Sư Sinh Viên</th>
                            <th style="padding: 0.9rem 1rem; text-align: left; border-bottom: 2px solid #93c5fd;">Khung Giá Giáo Viên / Thạc Sĩ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Helpers\BangGiaHocPhi::CAP_DAY as $capKey => $capName)
                        @php
                            [$svMin, $svMax] = \App\Helpers\BangGiaHocPhi::khung('sinh_vien', $capKey);
                            [$gvMin, $gvMax] = \App\Helpers\BangGiaHocPhi::khung('giao_vien', $capKey);
                        @endphp
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 0.9rem 1rem; font-weight: 700; color: #0f172a;">{{ $capName }}</td>
                            <td style="padding: 0.9rem 1rem; color: #2563eb; font-weight: 700;">{{ number_format($svMin) }} – {{ number_format($svMax) }} đ/buổi</td>
                            <td style="padding: 0.9rem 1rem; color: #0f172a; font-weight: 700;">{{ number_format($gvMin) }} – {{ number_format($gvMax) }} đ/buổi</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
