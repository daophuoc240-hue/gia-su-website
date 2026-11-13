@extends('layouts.public')

@section('title', 'Tuyển Gia Sư ' . $lop->mon_hoc . ' ' . $lop->khoi_lop . ' (' . $lop->ma_lop . ') - Gia Sư Tri Thức')

@section('content')

<div class="container" style="padding: 2.8rem 0 4rem 0;">
    <div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.8rem;">
        <a href="{{ route('danh-sach-lop-hoc') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại danh sách lớp</a>
        <div style="font-size: 0.85rem; color: #64748b;">
            Mã lớp học: <strong style="color: #1e40af; background: #dbeafe; padding: 0.2rem 0.6rem; border-radius: 6px;">{{ $lop->ma_lop }}</strong>
            <span style="margin: 0 0.5rem;">•</span>
            Trạng thái: <span class="badge badge-success">Đang tìm gia sư</span>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start;">
        <!-- Left Class Details -->
        <div class="glass-card" style="padding: 2.2rem; border-radius: 20px; background: #ffffff; border: 1px solid #e2e8f0;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid #e2e8f0; padding-bottom: 1.4rem; margin-bottom: 1.8rem; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.55rem;">
                        <span style="font-size: 0.78rem; font-weight: 800; color: #1e40af; background: #dbeafe; padding: 0.25rem 0.65rem; border-radius: 6px;">{{ $lop->ma_lop }}</span>
                        <span class="badge badge-info" style="font-size: 0.82rem;">{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}</span>
                    </div>
                    <h1 style="font-size: 1.65rem; font-weight: 800; color: #0f172a; margin: 0;">Tuyển Gia Sư {{ $lop->mon_hoc }} {{ $lop->khoi_lop }}</h1>
                </div>
                <div style="text-align: right; background: #eff6ff; padding: 0.8rem 1.2rem; border-radius: 14px; border: 1px solid #bfdbfe;">
                    <div style="font-size: 0.78rem; font-weight: 700; color: #1e40af; text-transform: uppercase;">Mức Học Phí Đề Xuất</div>
                    <div style="font-size: 1.5rem; font-weight: 800; color: #2563eb;">{{ $lop->hoc_phi_hien_thi }}</div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1.8rem;">
                <div style="background: #f8fafc; padding: 1rem 1.2rem; border-radius: 14px; border: 1px solid #e2e8f0;">
                    <div style="font-size: 0.8rem; color: #64748b; margin-bottom: 0.25rem;">📍 Địa chỉ / Khu vực giảng dạy</div>
                    <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">{{ $lop->dia_chi_day }}</div>
                </div>
                <div style="background: #f8fafc; padding: 1rem 1.2rem; border-radius: 14px; border: 1px solid #e2e8f0;">
                    <div style="font-size: 0.8rem; color: #64748b; margin-bottom: 0.25rem;">🗓️ Số buổi học trong tuần</div>
                    <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">{{ $lop->so_buoi_trung_binh }} buổi / tuần (90 - 120 phút/buổi)</div>
                </div>
                <div style="background: #f8fafc; padding: 1rem 1.2rem; border-radius: 14px; border: 1px solid #e2e8f0;">
                    <div style="font-size: 0.8rem; color: #64748b; margin-bottom: 0.25rem;">⏰ Khung thời gian học dự kiến</div>
                    <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">{{ $lop->thoi_gian_day }}</div>
                </div>
                <div style="background: #f8fafc; padding: 1rem 1.2rem; border-radius: 14px; border: 1px solid #e2e8f0;">
                    <div style="font-size: 0.8rem; color: #64748b; margin-bottom: 0.25rem;">👤 Phụ huynh / Học viên đăng lớp</div>
                    <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">{{ $lop->hocVien->ho_ten ?? 'Phụ huynh đã xác thực' }}</div>
                </div>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; margin-bottom: 1.8rem;">
                <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 0.8rem;">📝 Yêu Cầu Cụ Thể Đối Với Gia Sư</h3>
                <div style="background: #f8fafc; padding: 1.2rem; border-radius: 14px; border-left: 4px solid #2563eb; font-size: 0.94rem; color: #334155; line-height: 1.75; white-space: pre-line;">{{ $lop->yeu_cau_gia_su ?: 'Yêu cầu gia sư có kiến thức chuyên môn vững vàng, kiên nhẫn, đúng giờ và có phương pháp truyền đạt dễ hiểu.' }}</div>
            </div>

            <!-- Quy trình nhận lớp chuẩn -->
            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0f172a; margin-bottom: 0.9rem;">🛡️ Lưu Ý & Cam Kết Khi Nhận Lớp Tại Gia Sư Tri Thức</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; font-size: 0.86rem; color: #475569;">
                    <div style="display: flex; align-items: flex-start; gap: 0.55rem;">
                        <i class="fas fa-check-circle" style="color: #10b981; margin-top: 0.2rem;"></i>
                        <span>Thông tin lớp học đã được xác minh trực tiếp với phụ huynh.</span>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 0.55rem;">
                        <i class="fas fa-check-circle" style="color: #10b981; margin-top: 0.2rem;"></i>
                        <span>Gia sư chủ động nhắn tin trao đổi với phụ huynh ngay trên hệ thống.</span>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 0.55rem;">
                        <i class="fas fa-check-circle" style="color: #10b981; margin-top: 0.2rem;"></i>
                        <span>Chuẩn bị thẻ sinh viên / bằng cấp khi đến gặp phụ huynh buổi đầu.</span>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 0.55rem;">
                        <i class="fas fa-check-circle" style="color: #10b981; margin-top: 0.2rem;"></i>
                        <span>Hỗ trợ bảo vệ quyền lợi gia sư 24/7 qua Hotline 0394.688.031.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Apply Action Box -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="glass-card" style="padding: 2rem; border-radius: 20px; background: #ffffff; border: 1px solid #e2e8f0; text-align: center;">
                <div style="width: 60px; height: 60px; background: #dbeafe; color: #2563eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin: 0 auto 1.1rem auto;">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin-bottom: 0.45rem;">Đăng Ký Nhận Lớp {{ $lop->ma_lop }}</h3>
                <p style="font-size: 0.86rem; color: #64748b; line-height: 1.6; margin-bottom: 1.4rem;">
                    Đăng nhập tài khoản Gia Sư đã được kiểm duyệt hồ sơ để ứng tuyển nhận lớp này.
                </p>

                @auth
                    @if(auth()->user()->isGiaSu())
                        @if($daDangKy)
                            <div style="background:#eff6ff; border:1px solid #bfdbfe; border-radius:12px; padding:1.2rem; margin-bottom:1rem;">
                                <div style="font-weight:700; color:#1e40af; font-size:0.95rem; margin-bottom:0.35rem;">
                                    <i class="fas fa-check-circle" style="color:#2563eb;"></i> Bạn đã đăng ký nhận lớp này
                                </div>
                                <p style="font-size:0.84rem; color:#475569; margin:0;">
                                    Hồ sơ của bạn đang được trung tâm và phụ huynh xem xét duyệt.
                                </p>
                            </div>
                            <a href="{{ route('giasu.ket-qua') }}" class="btn btn-outline btn-block" style="padding:0.75rem; border-radius:10px; font-size:0.9rem; margin-bottom:0.8rem;">
                                <i class="fas fa-clipboard-list"></i> Xem Kết Quả Đăng Ký
                            </a>
                        @else
                            <form method="POST" action="{{ route('giasu.dang-ky-lop', $lop->id) }}" style="margin-bottom:0.8rem;">
                                @csrf
                                <div style="margin-bottom:0.8rem; text-align:left;">
                                    <label style="font-size:0.82rem; font-weight:700; color:#334155; display:block; margin-bottom:0.3rem;">Lời giới thiệu của bạn:</label>
                                    <textarea name="gioi_thieu_ban_than" rows="3" class="form-control" style="font-size:0.85rem;" placeholder="Kinh nghiệm giảng dạy, thành tích hoặc thời gian bạn có thể bắt đầu dạy..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" style="padding: 0.85rem; border-radius: 12px; font-size: 0.95rem; font-weight: 700;">
                                    <i class="fas fa-paper-plane"></i> Đăng Ký Nhận Lớp Ngay
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('chat.conversation', $lop->hoc_vien_id) }}" class="btn btn-outline btn-block" style="padding:0.75rem; border-radius:10px; font-size:0.9rem; color:#2563eb; border-color:#bfdbfe;">
                            <i class="fas fa-comment-dots"></i> Nhắn Tin Với Phụ Huynh
                        </a>
                    @elseif(auth()->user()->isHocVien())
                        @if(auth()->id() === $lop->hoc_vien_id)
                            <a href="{{ route('hocvien.chi-tiet-lop', $lop->id) }}" class="btn btn-primary btn-block" style="padding: 0.85rem; border-radius: 12px; font-size: 0.95rem;">
                                <i class="fas fa-tasks"></i> Quản Lý Lớp Học Của Bạn
                            </a>
                        @else
                            <div class="alert alert-warning" style="font-size: 0.85rem; text-align: left;">
                                <i class="fas fa-info-circle"></i> Đây là lớp học của phụ huynh khác tạo. Bạn có thể tự đăng ký tạo một lớp học mới cho riêng mình!
                            </div>
                            <a href="{{ route('hocvien.tao-yeu-cau') }}" class="btn btn-primary btn-block" style="padding: 0.85rem; border-radius: 12px; font-size: 0.95rem;">
                                <i class="fas fa-plus-circle"></i> Tạo Yêu Cầu Học Mới
                            </a>
                        @endif
                    @else
                        <a href="{{ route('admin.lop-hoc.phan-cong', $lop->id) }}" class="btn btn-primary btn-block" style="padding: 0.85rem; border-radius: 12px; font-size: 0.95rem;">
                            <i class="fas fa-user-check"></i> Điều Phối / Phân Công Lớp (Admin)
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-block" style="padding: 0.9rem; border-radius: 12px; font-size: 0.95rem; font-weight: 700; margin-bottom: 0.75rem;">
                        <i class="fas fa-sign-in-alt"></i> Đăng Nhập Để Nhận Lớp
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline btn-block" style="padding: 0.78rem; border-radius: 12px; font-size: 0.86rem;">
                        Chưa có tài khoản? Đăng ký làm Gia sư
                    </a>
                @endauth
            </div>

            <!-- Hotline Support Card -->
            <div style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); color: #ffffff; padding: 1.5rem; border-radius: 18px;">
                <div style="font-weight: 800; font-size: 0.98rem; margin-bottom: 0.4rem;"><i class="fas fa-headset" style="color: #60a5fa; margin-right: 0.4rem;"></i> Cần Hỗ Trợ Nhận Lớp?</div>
                <p style="font-size: 0.82rem; color: #cbd5e1; line-height: 1.55; margin: 0 0 0.9rem 0;">
                    Liên hệ bộ phận điều phối lớp của Gia Sư Tri Thức để được hướng dẫn duyệt hồ sơ nhanh.
                </p>
                <a href="tel:0394688031" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; background: #2563eb; color: #ffffff; padding: 0.65rem; border-radius: 10px; font-weight: 700; font-size: 0.88rem; text-decoration: none;">
                    <i class="fas fa-phone-alt"></i> Hotline: 0394.688.031
                </a>
            </div>
        </div>
    </div>

    <!-- LỚP HỌC TƯƠNG TỰ ĐANG TÌM GIA SƯ -->
    @if(isset($lop_tuong_tu) && $lop_tuong_tu->count() > 0)
    <div style="margin-top: 3.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.4rem; font-weight: 800; color: #0f172a; margin: 0;">📚 Các Lớp Học Tương Tự Đang Cần Gia Sư</h2>
            <a href="{{ route('danh-sach-lop-hoc') }}" class="btn btn-outline btn-sm">Xem tất cả lớp <i class="fas fa-arrow-right"></i></a>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; align-items: stretch;">
            @foreach($lop_tuong_tu as $lt)
            <div class="glass-card" style="border-radius: 18px; padding: 1.5rem; background: #ffffff; border: 1px solid #e2e8f0; display: flex; flex-direction: column; height: 100%; box-sizing: border-box;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.7rem;">
                    <span style="font-size: 0.74rem; font-weight: 800; color: #1e40af; background: #dbeafe; padding: 0.2rem 0.55rem; border-radius: 6px;">{{ $lt->ma_lop }}</span>
                    <span style="font-weight: 800; color: #2563eb; font-size: 0.95rem;">{{ $lt->hoc_phi_hien_thi }}</span>
                </div>
                <h3 style="font-size: 1rem; font-weight: 800; color: #0f172a; margin: 0 0 0.6rem 0; line-height: 1.4; height: 2.8em; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                    Tìm gia sư dạy {{ $lt->mon_hoc }} {{ $lt->khoi_lop }}
                </h3>
                <div style="font-size: 0.84rem; color: #64748b; margin-bottom: 1rem; flex: 1;">
                    📍 {{ Str::limit($lt->dia_chi_day, 55) }}<br>
                    🗓️ {{ $lt->so_buoi_trung_binh }} buổi/tuần
                </div>
                <a href="{{ route('chi-tiet-lop-hoc', $lt->id) }}" class="btn btn-outline btn-sm btn-block" style="margin-top: auto; border-radius: 10px; font-weight: 700;">
                    Xem Chi Tiết Lớp
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection
