@extends('layouts.public')

@section('title', 'Liên Hệ Hỗ Trợ - Gia Sư Tri Thức')

@section('content')

<div style="background: #eff6ff; padding: 3rem 0; border-bottom: 1px solid #e2e8f0; margin-bottom: 3rem;">
    <div class="container">
        <h1 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem;">📞 Liên Hệ & Hỗ Trợ Trung Tâm</h1>
        <p style="color: #64748b; font-size: 1rem;">Chúng tôi luôn sẵn sàng hỗ trợ giải đáp mọi thắc mắc của bạn.</p>
    </div>
</div>

<div class="container" style="margin-bottom: 4rem;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
        <div>
            <div class="glass-card" style="padding: 2.2rem; border-radius: 20px; background: #ffffff;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 1.5rem;">📬 Gửi Lời Nhắn Hỗ Trợ</h3>
                <form onsubmit="alert('Cảm ơn bạn đã gửi tin nhắn! Trung tâm sẽ phản hồi trong thời gian sớm nhất.'); return false;">
                    <div class="form-group">
                        <label class="form-label">Họ và Tên</label>
                        <input type="text" class="form-control" placeholder="Nhập họ và tên..." required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Số Điện Thoại / Email</label>
                        <input type="text" class="form-control" placeholder="Nhập SĐT hoặc Email..." required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nội dung tin nhắn</label>
                        <textarea class="form-control" rows="4" placeholder="Nhập thắc mắc hoặc yêu cầu tư vấn..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" style="padding: 0.9rem; border-radius: 12px; font-weight: 800;">
                        <i class="fas fa-paper-plane"></i> Gửi Tin Nhắn
                    </button>
                </form>
            </div>
        </div>

        <div>
            <div class="glass-card" style="padding: 2.2rem; border-radius: 20px; background: #ffffff; height: 100%;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 1.5rem;">📍 Văn Phòng Trung Tâm</h3>
                <div style="font-size: 0.95rem; color: #334155; line-height: 2.2; margin-bottom: 2rem;">
                    <div>🏢 <strong>Tên hệ thống:</strong> Trung Tâm Gia Sư Tri Thức</div>
                    <div>📍 <strong>Địa chỉ trụ sở:</strong> Khu Đô Thị Đại Học, TP. Huế</div>
                    <div>📞 <strong>Hotline tư vấn:</strong> <strong style="color: #2563eb;">0394.688.031</strong></div>
                    <div>📧 <strong>Email hỗ trợ:</strong> support@giasutrithuc.vn</div>
                    <div>⏰ <strong>Thời gian hoạt động:</strong> 08:00 - 21:00 hàng ngày</div>
                </div>

                <div style="background: #eff6ff; padding: 1.2rem; border-radius: 14px; border: 1px solid #bfdbfe;">
                    <div style="font-weight: 800; color: #1e40af; margin-bottom: 0.3rem;">👨‍💼 Quản Lý & Điều Phối Trung Tâm</div>
                    <div style="font-size: 1rem; font-weight: 800; color: #0f172a;">Đào Bình Phước</div>
                    <div style="font-size: 0.85rem; color: #64748b; margin-top: 0.2rem;">Trực tiếp tư vấn, kiểm duyệt gia sư và điều phối ghép lớp học.</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
