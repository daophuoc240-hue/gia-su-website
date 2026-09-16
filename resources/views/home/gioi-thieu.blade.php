@extends('layouts.public')

@section('title', 'Giới Thiệu Trung Tâm - Gia Sư Connect')

@section('content')

<div style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); color: #ffffff; padding: 4rem 0; text-align: center;">
    <div class="container" style="max-width: 800px;">
        <span class="badge badge-info" style="font-size: 0.85rem; padding: 0.45rem 1rem; margin-bottom: 1rem; background: rgba(255,255,255,0.2); color: #ffffff;">
            🎓 Về Gia Sư Connect
        </span>
        <h1 style="font-size: 2.4rem; font-weight: 800; color: #ffffff; margin-bottom: 1rem;">Nền Tảng Kết Nối Gia Sư Hàng Đầu</h1>
        <p style="font-size: 1.05rem; color: #bfdbfe; line-height: 1.7;">
            Sứ mệnh nâng cao tri thức, kết nối gia sư giỏi với phụ huynh và học viên toàn quốc bằng công nghệ quản lý minh bạch, tiện lợi.
        </p>
    </div>
</div>

<div class="container" style="padding: 4rem 0;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; margin-bottom: 4rem;">
        <div>
            <h2 style="font-size: 1.8rem; font-weight: 800; color: #0f172a; margin-bottom: 1.2rem;">Tầm Nhìn & Sứ Mệnh</h2>
            <p style="font-size: 0.98rem; color: #475569; line-height: 1.8; margin-bottom: 1rem;">
                Gia Sư Connect được điều hành trực tiếp bởi ông <strong>Đào Bình Phước</strong>, áp dụng quy trình kiểm duyệt hồ sơ 3 lớp nghiêm ngặt: Thẻ sinh viên / Bằng cấp chuyên môn -> Thẩm định hồ sơ -> Đánh giá trải nghiệm thực tế từ phụ huynh.
            </p>
            <p style="font-size: 0.98rem; color: #475569; line-height: 1.8;">
                Chúng tôi giải quyết bài toán môi giới gia sư thiếu minh bạch truyền thống bằng giải pháp công nghệ hiện đại, tự động hóa quy trình phân công và giúp gia sư chủ động theo dõi kết quả nhận lớp.
            </p>
        </div>
        <div>
            <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80" alt="About Image" style="width: 100%; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.08);">
        </div>
    </div>
</div>

@endsection
