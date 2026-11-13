@extends('layouts.public')

@section('title', 'Giới Thiệu Trung Tâm - Gia Sư Tri Thức')

@section('content')

<!-- HERO BANNER -->
<div style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); color: #ffffff; padding: 4rem 0; text-align: center;">
    <div class="container" style="max-width: 820px;">
        <span style="display: inline-block; font-size: 0.82rem; font-weight: 800; padding: 0.4rem 1rem; margin-bottom: 1rem; background: rgba(255,255,255,0.18); color: #ffffff; border-radius: 50px; letter-spacing: 0.5px;">
            🎓 VỀ HỆ THỐNG GIA SƯ TRI THỨC
        </span>
        <h1 style="font-size: 2.35rem; font-weight: 800; color: #ffffff; margin: 0 0 1rem 0; line-height: 1.3;">
            Nền Tảng Kết Nối Gia Sư & Quản Lý Lớp Học Minh Bạch Hàng Đầu
        </h1>
        <p style="font-size: 1.02rem; color: #bfdbfe; line-height: 1.7; margin: 0;">
            Sứ mệnh nâng cao chất lượng giáo dục cá nhân hóa, kết nối đội ngũ Giáo viên & Sinh viên ưu tú với Phụ huynh và Học viên toàn quốc bằng công nghệ hiện đại.
        </p>
    </div>
</div>

<div class="container" style="padding: 4rem 0;">
    <!-- 1. TẦM NHÌN & SỨ MỆNH -->
    <div style="display: grid; grid-template-columns: 1.05fr 0.95fr; gap: 3rem; align-items: center; margin-bottom: 4.5rem;">
        <div>
            <span style="color: #2563eb; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;">Câu Chuyện Của Chúng Tôi</span>
            <h2 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; margin: 0.35rem 0 1.1rem 0;">Tầm Nhìn & Sứ Mệnh Giáo Dục</h2>
            <p style="font-size: 0.96rem; color: #475569; line-height: 1.8; margin-bottom: 1rem;">
                <strong>Gia Sư Tri Thức</strong> được sáng lập và điều hành trực tiếp bởi ông <strong>Đào Bình Phước</strong> nhằm giải quyết triệt để những bất cập của mô hình môi giới gia sư truyền thống: thiếu thông tin gia sư, học phí không rõ ràng và mất nhiều thời gian chờ đợi.
            </p>
            <p style="font-size: 0.96rem; color: #475569; line-height: 1.8; margin-bottom: 1.4rem;">
                Thông qua nền tảng công nghệ số hóa, Phụ huynh có thể trực tiếp xem hồ sơ năng lực, trường đào tạo, điểm đánh giá và khung giờ rảnh của từng gia sư; đồng thời Gia sư chủ động tìm kiếm và ứng tuyển lớp học phù hợp mà không qua trung gian mập mờ.
            </p>

            <div style="display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 1rem;">
                <div style="background: #f8fafc; padding: 1rem 1.2rem; border-radius: 14px; border: 1px solid #e2e8f0;">
                    <div style="font-weight: 800; color: #2563eb; font-size: 1.4rem;">100%</div>
                    <div style="font-weight: 700; color: #0f172a; font-size: 0.88rem;">Hồ Sơ Xác Thực</div>
                    <div style="font-size: 0.78rem; color: #64748b;">Kiểm duyệt bằng cấp & CCCD</div>
                </div>
                <div style="background: #f8fafc; padding: 1rem 1.2rem; border-radius: 14px; border: 1px solid #e2e8f0;">
                    <div style="font-weight: 800; color: #10b981; font-size: 1.4rem;">24 Giờ</div>
                    <div style="font-weight: 700; color: #0f172a; font-size: 0.88rem;">Kết Nối Nhanh Chóng</div>
                    <div style="font-size: 0.78rem; color: #64748b;">Xếp lịch dạy thử ngay trong ngày</div>
                </div>
            </div>
        </div>
        <div>
            <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=900&q=80" alt="Gia Sư Tri Thức" style="width: 100%; height: 390px; object-fit: cover; border-radius: 22px; box-shadow: 0 18px 40px rgba(15, 23, 42, 0.1); border: 4px solid #ffffff;">
        </div>
    </div>

    <!-- 2. QUY TRÌNH TUYỂN CHỌN GIA SƯ 3 VÒNG NGHIÊM NGẶT -->
    <div style="margin-bottom: 4.5rem;">
        <div style="text-align: center; max-width: 680px; margin: 0 auto 2.5rem auto;">
            <span style="color: #2563eb; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;">Tiêu Chuẩn Chất Lượng</span>
            <h2 style="font-size: 1.8rem; font-weight: 800; color: #0f172a; margin: 0.3rem 0 0.5rem 0;">🛡️ Quy Trình Kiểm Duyệt Gia Sư 3 Vòng</h2>
            <p style="font-size: 0.92rem; color: #64748b; margin: 0;">Mỗi gia sư trên hệ thống đều phải vượt qua 3 bước thẩm định chặt chẽ trước khi nhận lớp.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.75rem; align-items: stretch;">
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 2rem; display: flex; flex-direction: column;">
                <div style="width: 52px; height: 52px; border-radius: 14px; background: #dbeafe; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; margin-bottom: 1.2rem;">
                    01
                </div>
                <h3 style="font-size: 1.12rem; font-weight: 800; color: #0f172a; margin: 0 0 0.6rem 0;">Xác Thực Lý Lịch & Bằng Cấp</h3>
                <p style="font-size: 0.88rem; color: #475569; line-height: 1.7; margin: 0;">
                    Đối chiếu trực tiếp Căn cước công dân, Thẻ sinh viên, Bằng tốt nghiệp Đại học / Sư phạm hoặc Chứng chỉ ngoại ngữ quốc tế (IELTS, TOEIC, HSK).
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 2rem; display: flex; flex-direction: column;">
                <div style="width: 52px; height: 52px; border-radius: 14px; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; margin-bottom: 1.2rem;">
                    02
                </div>
                <h3 style="font-size: 1.12rem; font-weight: 800; color: #0f172a; margin: 0 0 0.6rem 0;">Thẩm Định Chuyên Môn & Tác Phong</h3>
                <p style="font-size: 0.88rem; color: #475569; line-height: 1.7; margin: 0;">
                    Đánh giá kinh nghiệm giảng dạy thực tế, khả năng truyền đạt kiến thức dễ hiểu, thái độ tận tâm, kiên nhẫn và tác phong sư phạm chuẩn mực.
                </p>
            </div>

            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 2rem; display: flex; flex-direction: column;">
                <div style="width: 52px; height: 52px; border-radius: 14px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; margin-bottom: 1.2rem;">
                    03
                </div>
                <h3 style="font-size: 1.12rem; font-weight: 800; color: #0f172a; margin: 0 0 0.6rem 0;">Đánh Giá Định Kỳ Từ Phụ Huynh</h3>
                <p style="font-size: 0.88rem; color: #475569; line-height: 1.7; margin: 0;">
                    Hỗ trợ dạy thử 2 buổi đầu tiên và ghi nhận xếp hạng sao, nhận xét công khai từ Phụ huynh sau mỗi khóa học để duy trì chất lượng cao nhất.
                </p>
            </div>
        </div>
    </div>

    <!-- 3. BẢNG SO SÁNH VỚI MÔI GIỚI TRUYỀN THỐNG -->
    <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 22px; padding: 2.5rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04); margin-bottom: 4rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <span style="color: #2563eb; font-size: 0.82rem; font-weight: 700; text-transform: uppercase;">Sự Khác Biệt Vượt Trội</span>
            <h2 style="font-size: 1.7rem; font-weight: 800; color: #0f172a; margin-top: 0.3rem;">Vì Sao Nên Chọn Hệ Thống Gia Sư Tri Thức?</h2>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 0.92rem;">
                <thead>
                    <tr style="background: #f1f5f9; color: #0f172a;">
                        <th style="padding: 1rem 1.2rem; text-align: left; border-bottom: 2px solid #cbd5e1; width: 32%;">Tiêu chí đánh giá</th>
                        <th style="padding: 1rem 1.2rem; text-align: left; border-bottom: 2px solid #2563eb; background: #eff6ff; color: #1e40af; width: 36%;">🎓 Hệ Thống Gia Sư Tri Thức</th>
                        <th style="padding: 1rem 1.2rem; text-align: left; border-bottom: 2px solid #cbd5e1; color: #64748b; width: 32%;">Môi giới tự do / Truyền thống</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 0.95rem 1.2rem; font-weight: 700; color: #0f172a;">Hồ sơ & Bằng cấp gia sư</td>
                        <td style="padding: 0.95rem 1.2rem; background: #f8fafc; font-weight: 600; color: #15803d;"><i class="fas fa-check-circle"></i> Công khai trường học, chuyên ngành & đã xác thực</td>
                        <td style="padding: 0.95rem 1.2rem; color: #64748b;"><i class="fas fa-times-circle" style="color: #ef4444;"></i> Không rõ ràng, khó kiểm chứng</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 0.95rem 1.2rem; font-weight: 700; color: #0f172a;">Chủ động chọn lịch & Mời dạy</td>
                        <td style="padding: 0.95rem 1.2rem; background: #f8fafc; font-weight: 600; color: #15803d;"><i class="fas fa-check-circle"></i> Xem lịch rảnh trực tuyến & đặt lịch ngay</td>
                        <td style="padding: 0.95rem 1.2rem; color: #64748b;"><i class="fas fa-times-circle" style="color: #ef4444;"></i> Phải gọi điện chờ đợi nhiều ngày</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 0.95rem 1.2rem; font-weight: 700; color: #0f172a;">Trao đổi giữa Phụ huynh & Gia sư</td>
                        <td style="padding: 0.95rem 1.2rem; background: #f8fafc; font-weight: 600; color: #15803d;"><i class="fas fa-check-circle"></i> Tích hợp phòng Chat trực tuyến tiện lợi</td>
                        <td style="padding: 0.95rem 1.2rem; color: #64748b;"><i class="fas fa-times-circle" style="color: #ef4444;"></i> Bị chặn thông tin liên lạc ban đầu</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.95rem 1.2rem; font-weight: 700; color: #0f172a;">Chính sách học thử & Đổi gia sư</td>
                        <td style="padding: 0.95rem 1.2rem; background: #f8fafc; font-weight: 600; color: #15803d;"><i class="fas fa-check-circle"></i> Học thử 2 buổi, hỗ trợ đổi gia sư miễn phí</td>
                        <td style="padding: 0.95rem 1.2rem; color: #64748b;"><i class="fas fa-times-circle" style="color: #ef4444;"></i> Không cam kết sau khi đã thu phí</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 4. CTA -->
    <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border: 1px solid #bfdbfe; border-radius: 22px; padding: 2.8rem; text-align: center;">
        <h3 style="font-size: 1.6rem; font-weight: 800; color: #1e3a8a; margin: 0 0 0.6rem 0;">Bắt Đầu Hành Trình Học Tập Hiệu Quả Cùng Gia Sư Tri Thức</h3>
        <p style="font-size: 0.95rem; color: #1e40af; margin: 0 0 1.6rem 0;">Tìm kiếm gia sư giỏi phù hợp hoặc đăng ký trở thành đối tác giảng dạy ngay hôm nay.</p>
        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-primary" style="padding: 0.85rem 1.8rem; border-radius: 12px; font-weight: 800;">
                <i class="fas fa-search"></i> Tìm Gia Sư Ngay
            </a>
            <a href="{{ route('danh-sach-lop-hoc') }}" class="btn btn-outline" style="background: #ffffff; padding: 0.85rem 1.8rem; border-radius: 12px; font-weight: 700;">
                <i class="fas fa-chalkboard-teacher"></i> Xem Lớp Học Mới
            </a>
        </div>
    </div>
</div>

@endsection
