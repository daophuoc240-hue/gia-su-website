@extends('layouts.public')

@section('title', 'Chính Sách Nhận Lớp, Đổi Gia Sư & Bảo Mật - Gia Sư Tri Thức')

@section('content')

<div style="background: linear-gradient(180deg, #eff6ff 0%, #f8fafc 100%); padding: 3rem 0 2.4rem 0; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <span style="display: inline-block; background: #dbeafe; color: #1e40af; font-size: 0.78rem; font-weight: 800; padding: 0.3rem 0.85rem; border-radius: 50px; margin-bottom: 0.6rem;">
            CAM KẾT MINH BẠCH & BẢO VỆ QUYỀN LỢI
        </span>
        <h1 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin: 0 0 0.4rem 0;">📜 Chính Sách Dịch Vụ & Quy Định Hoạt Động</h1>
        <p style="color: #64748b; font-size: 0.96rem; margin: 0;">Quy định rõ ràng dành cho Phụ huynh, Học viên và Đội ngũ Gia sư trên hệ thống Gia Sư Tri Thức.</p>
    </div>
</div>

<div class="container" style="padding: 3rem 0 4rem 0; max-width: 980px;">
    <div style="display: flex; flex-direction: column; gap: 1.8rem;">
        <!-- 1. Chính sách dành cho Phụ huynh -->
        <div class="glass-card" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 2rem;">
            <h2 style="font-size: 1.35rem; font-weight: 800; color: #1e40af; margin: 0 0 1rem 0;">1. Chính Sách Học Thử & Đổi Gia Sư Cho Phụ Huynh</h2>
            <ul style="font-size: 0.94rem; color: #334155; line-height: 1.85; margin: 0; padding-left: 1.2rem;">
                <li><strong>Miễn phí 100% phí dịch vụ tìm gia sư:</strong> Phụ huynh tạo yêu cầu tìm gia sư hoặc gửi lời mời dạy trực tiếp trên website hoàn toàn miễn phí.</li>
                <li><strong>Chính sách học thử 02 buổi đầu:</strong> Học sinh được học thử 2 buổi đầu tiên để kiểm tra sự phù hợp về phương pháp truyền đạt và thái độ giảng dạy.</li>
                <li><strong>Đổi gia sư miễn phí:</strong> Nếu sau 2 buổi đầu học sinh chưa phù hợp, phụ huynh không phải thanh toán học phí 2 buổi đó và được trung tâm đổi gia sư mới hoàn toàn miễn phí trong 24h – 48h.</li>
            </ul>
        </div>

        <!-- 2. Chính sách khung học phí & nhận lớp của Gia sư -->
        <div class="glass-card" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 2rem;">
            <h2 style="font-size: 1.35rem; font-weight: 800; color: #1e40af; margin: 0 0 1rem 0;">2. Quy Định Khung Giá & Nhận Lớp Dành Cho Gia Sư</h2>
            <ul style="font-size: 0.94rem; color: #334155; line-height: 1.85; margin: 0; padding-left: 1.2rem;">
                <li><strong>Xác thực hồ sơ trung thực:</strong> Gia sư cam kết cung cấp đúng thông tin trường đào tạo, chuyên ngành, thẻ sinh viên hoặc bằng cấp chuyên môn.</li>
                <li><strong>Tuân thủ khung học phí niêm yết:</strong> Gia sư đặt mức học phí/buổi theo đúng trình độ (Sinh viên / Giáo viên) và cấp học giảng dạy. Mọi hành vi tự ý nâng giá vượt khung quy định của trung tâm sẽ bị hệ thống cảnh cáo, ghi nhận số lần vi phạm và tạm ẩn hồ sơ để kiểm duyệt lại.</li>
                <li><strong>Bảo hành lớp dạy cho gia sư:</strong> Trong trường hợp lớp học bị hủy trong tháng đầu tiên do nguyên nhân từ phía phụ huynh, trung tâm hỗ trợ ưu tiên xếp lớp mới tương đương cho gia sư.</li>
            </ul>
        </div>

        <!-- 3. Chính sách bảo mật -->
        <div class="glass-card" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 2rem;">
            <h2 style="font-size: 1.35rem; font-weight: 800; color: #1e40af; margin: 0 0 1rem 0;">3. Chính Sách Bảo Mật Thông Tin Cá Nhân</h2>
            <ul style="font-size: 0.94rem; color: #334155; line-height: 1.85; margin: 0; padding-left: 1.2rem;">
                <li>Số điện thoại, địa chỉ chi tiết và giấy tờ định danh của Phụ huynh và Gia sư chỉ được sử dụng cho mục đích kết nối lớp học tại Gia Sư Tri Thức.</li>
                <li>Phụ huynh và Gia sư có thể trao đổi trực tiếp qua <strong>Hệ thống Chat trực tuyến</strong> trên website trước khi quyết định chia sẻ thông tin liên lạc cá nhân.</li>
            </ul>
        </div>
    </div>
</div>

@endsection
