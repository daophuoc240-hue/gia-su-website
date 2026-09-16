@extends('layouts.public')

@section('title', 'Gia Sư Tri Thức - Nền Tảng Kết Nối Gia Sư & Lớp Học Hàng Đầu')

@section('content')

<!-- HERO SECTION -->
<section style="background: linear-gradient(180deg, #eff6ff 0%, #f8fafc 100%); padding: 4rem 0 3.5rem 0; border-bottom: 1px solid #e2e8f0;">
    <div class="container" style="display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 3rem; align-items: center;">
        <div>
            <span class="badge badge-info" style="font-size: 0.85rem; padding: 0.45rem 1rem; margin-bottom: 1.2rem; border-radius: 20px;">
                🚀 Nền Tảng Gia Sư Chuyên Nghiệp #1
            </span>
            <h1 style="font-size: 2.7rem; font-weight: 800; color: #0f172a; line-height: 1.25; margin-bottom: 1.2rem;">
                Kết Nối Gia Sư Giỏi & <br><span style="color: #2563eb; background: linear-gradient(135deg, #2563eb, #1d4ed8); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Tìm Lớp Học Dạy Kèm Uy Tín</span>
            </h1>
            <p style="font-size: 1.05rem; color: #475569; line-height: 1.7; margin-bottom: 2rem;">
                Hệ thống hỗ trợ Phụ huynh / Học viên tìm gia sư sư phạm chất lượng cao và giúp Giáo viên / Sinh viên nhận lớp dạy kèm nhanh chóng, an toàn.
            </p>

            <!-- Quick Search Form Card -->
            <div style="background: #ffffff; padding: 1.4rem; border-radius: 16px; border: 1px solid #cbd5e1; box-shadow: 0 10px 30px rgba(0,0,0,0.06); margin-bottom: 2rem;">
                <form action="{{ route('danh-sach-lop-hoc') }}" method="GET" style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 0.8rem; align-items: center;">
                    <div>
                        <label style="font-size: 0.78rem; font-weight: 700; color: #64748b; margin-bottom: 0.3rem; display: block;">Môn Học</label>
                        <input type="text" name="mon_hoc" class="form-control" placeholder="Toán, Tiếng Anh, Lý..." style="padding: 0.6rem 0.8rem; font-size: 0.88rem;">
                    </div>
                    <div>
                        <label style="font-size: 0.78rem; font-weight: 700; color: #64748b; margin-bottom: 0.3rem; display: block;">Khối Lớp</label>
                        <select name="khoi_lop" class="form-select" style="padding: 0.6rem 0.8rem; font-size: 0.88rem;">
                            <option value="">Tất cả khối</option>
                            @foreach(['Lớp 1','Lớp 2','Lớp 3','Lớp 4','Lớp 5','Lớp 6','Lớp 7','Lớp 8','Lớp 9','Lớp 10','Lớp 11','Lớp 12'] as $kl)
                                <option value="{{ $kl }}">{{ $kl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="font-size: 0.78rem; font-weight: 700; color: #64748b; margin-bottom: 0.3rem; display: block;">Khu Vực</label>
                        <input type="text" name="dia_chi" class="form-control" placeholder="Quận / Huyện..." style="padding: 0.6rem 0.8rem; font-size: 0.88rem;">
                    </div>
                    <div style="align-self: end;">
                        <button type="submit" class="btn btn-primary" style="padding: 0.68rem 1.2rem; font-size: 0.9rem;">
                            <i class="fas fa-search"></i> Tìm Lớp
                        </button>
                    </div>
                </form>
            </div>

            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('register') }}" class="btn btn-primary" style="padding: 0.85rem 1.6rem; font-size: 0.95rem;">
                    <i class="fas fa-user-plus"></i> Đăng Ký Làm Gia Sư
                </a>
                <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-outline" style="padding: 0.85rem 1.6rem; font-size: 0.95rem;">
                    <i class="fas fa-search"></i> Xem Đội Ngũ Gia Sư
                </a>
            </div>
        </div>

        <div>
            <div style="position: relative;">
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80" alt="Education Banner" style="width: 100%; border-radius: 24px; box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15); border: 4px solid #ffffff;">
                <div style="position: absolute; bottom: -20px; left: -20px; background: #ffffff; padding: 1.2rem 1.6rem; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 48px; height: 48px; background: #dcfce7; color: #16a34a; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <div style="font-weight: 800; font-size: 1.1rem; color: #0f172a;">100% Hồ Sơ Duyệt</div>
                        <div style="font-size: 0.8rem; color: #64748b;">Đã xác minh bằng cấp & thẻ sinh viên</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS COUNTER BAR -->
<section style="padding: 3rem 0; background: #ffffff; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; text-align: center;">
            <div style="padding: 1.5rem; background: #f8fafc; border-radius: 16px; border: 1px solid #e2e8f0;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #2563eb; margin-bottom: 0.3rem;">{{ number_format($stats['tong_gia_su']) }}+</div>
                <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Gia Sư Chất Lượng</div>
                <div style="font-size: 0.8rem; color: #64748b;">Đã được kiểm duyệt hồ sơ</div>
            </div>
            <div style="padding: 1.5rem; background: #f8fafc; border-radius: 16px; border: 1px solid #e2e8f0;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #7c3aed; margin-bottom: 0.3rem;">{{ number_format($stats['tong_lop_hoc']) }}+</div>
                <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Tổng Lớp Yêu Cầu</div>
                <div style="font-size: 0.8rem; color: #64748b;">Nhu cầu học tập đa dạng</div>
            </div>
            <div style="padding: 1.5rem; background: #f8fafc; border-radius: 16px; border: 1px solid #e2e8f0;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #10b981; margin-bottom: 0.3rem;">{{ number_format($stats['thanh_cong']) }}+</div>
                <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Ghép Lớp Thành Công</div>
                <div style="font-size: 0.8rem; color: #64748b;">Kết nối nhanh trong 24h</div>
            </div>
            <div style="padding: 1.5rem; background: #f8fafc; border-radius: 16px; border: 1px solid #e2e8f0;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #f59e0b; margin-bottom: 0.3rem;">99%</div>
                <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Phụ Huynh Hài Lòng</div>
                <div style="font-size: 0.8rem; color: #64748b;">Đánh giá dịch vụ 5 sao</div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURED TUTORS SHOWCASE -->
<section style="padding: 4rem 0; background: #f8fafc;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: end; margin-bottom: 2.5rem;">
            <div>
                <span style="color: #2563eb; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Đội Ngũ Tiêu Biểu</span>
                <h2 style="font-size: 1.8rem; font-weight: 800; color: #0f172a; margin-top: 0.3rem;">👨‍🏫 Gia Sư Uy Tín Đã Kiểm Duyệt</h2>
            </div>
            <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-outline btn-sm">Xem Tất Cả Gia Sư <i class="fas fa-arrow-right"></i></a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.8rem;">
            @forelse($gia_su_noi_bat as $hs)
            <div class="glass-card" style="border-radius: 18px; padding: 1.8rem; transition: transform 0.25s ease;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="display: flex; gap: 1.2rem; align-items: center; margin-bottom: 1.2rem;">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" alt="Gia sư Avatar" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; border: 3px solid #2563eb;">
                    <div>
                        <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: 0.2rem;">{{ $hs->taiKhoan->ho_ten }}</h3>
                        <span class="badge badge-success"><i class="fas fa-shield-alt"></i> Đã duyệt</span>
                    </div>
                </div>
                <div style="font-size: 0.88rem; color: #475569; line-height: 1.7; margin-bottom: 1.4rem;">
                    <div>🎓 <strong>Trường:</strong> {{ $hs->truong_hoc }}</div>
                    <div>📖 <strong>Chuyên ngành:</strong> {{ $hs->chuyen_nganh }}</div>
                    <div>📍 <strong>Khu vực:</strong> {{ $hs->khu_vuc_nhan_day }}</div>
                </div>
                <a href="{{ route('chi-tiet-gia-su', $hs->id) }}" class="btn btn-outline btn-sm btn-block" style="border-radius: 10px;">
                    <i class="fas fa-eye"></i> Xem Hồ Sơ Chi Tiết
                </a>
            </div>
            @empty
            <div style="grid-column: span 3; text-align: center; padding: 3rem; color: #64748b;">
                Chưa có gia sư nào được phê duyệt hiển thị.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- RECENT OPEN CLASSES -->
<section style="padding: 4rem 0; background: #ffffff; border-top: 1px solid #e2e8f0;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: end; margin-bottom: 2.5rem;">
            <div>
                <span style="color: #2563eb; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Cơ Hội Nhận Lớp</span>
                <h2 style="font-size: 1.8rem; font-weight: 800; color: #0f172a; margin-top: 0.3rem;">📚 Lớp Học Mới Đang Tìm Gia Sư</h2>
            </div>
            <a href="{{ route('danh-sach-lop-hoc') }}" class="btn btn-outline btn-sm">Xem Tất Cả Lớp <i class="fas fa-arrow-right"></i></a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.8rem;">
            @forelse($lop_moi as $lop)
            <div class="glass-card" style="border-radius: 18px; padding: 1.8rem; border: 1px solid #e2e8f0;">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                    <span class="badge badge-info" style="font-size: 0.85rem;">{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}</span>
                    <span style="font-weight: 800; color: #2563eb; font-size: 1.05rem;">{{ number_format($lop->hoc_phi) }} đ/tháng</span>
                </div>
                <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a; margin-bottom: 0.8rem; line-height: 1.4;">
                    Tìm gia sư dạy {{ $lop->mon_hoc }} {{ $lop->khoi_lop }}
                </h3>
                <div style="font-size: 0.88rem; color: #64748b; line-height: 1.8; margin-bottom: 1.4rem;">
                    <div>📍 <strong>Địa chỉ:</strong> {{ $lop->dia_chi_day }}</div>
                    <div>🗓️ <strong>Lịch học:</strong> {{ $lop->so_buoi_trung_binh }} buổi/tuần ({{ $lop->thoi_gian_day }})</div>
                    <div>📝 <strong>Yêu cầu:</strong> {{ Str::limit($lop->yeu_cau_gia_su, 60) }}</div>
                </div>
                <a href="{{ route('chi-tiet-lop-hoc', $lop->id) }}" class="btn btn-primary btn-sm btn-block" style="border-radius: 10px;">
                    <i class="fas fa-paper-plane"></i> Xem & Đăng Ký Nhận Lớp
                </a>
            </div>
            @empty
            <div style="grid-column: span 3; text-align: center; padding: 3rem; color: #64748b;">
                Hiện tại chưa có lớp học mới nào đang tìm gia sư.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 4-STEP PROCESS GUIDE -->
<section style="padding: 4rem 0; background: #f8fafc; border-top: 1px solid #e2e8f0;">
    <div class="container">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 3rem auto;">
            <span style="color: #2563eb; font-size: 0.85rem; font-weight: 700; text-transform: uppercase;">Quy Trình Hoạt Động</span>
            <h2 style="font-size: 1.8rem; font-weight: 800; color: #0f172a; margin-top: 0.3rem;">Dễ Dàng & Minh Bạch Trong 4 Bước</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; text-align: center;">
            <div style="background: #ffffff; padding: 2rem 1.2rem; border-radius: 18px; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <div style="width: 56px; height: 56px; background: #dbeafe; color: #2563eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; margin: 0 auto 1.2rem auto;">1</div>
                <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">Đăng Ký Tài Khoản</h3>
                <p style="font-size: 0.85rem; color: #64748b; line-height: 1.6;">Tạo tài khoản Gia sư hoặc Phụ huynh / Học viên nhanh chóng chỉ trong 1 phút.</p>
            </div>
            <div style="background: #ffffff; padding: 2rem 1.2rem; border-radius: 18px; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <div style="width: 56px; height: 56px; background: #fef3c7; color: #d97706; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; margin: 0 auto 1.2rem auto;">2</div>
                <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">Tạo Hồ Sơ / Đăng Lớp</h3>
                <p style="font-size: 0.85rem; color: #64748b; line-height: 1.6;">Gia sư cập nhật trình độ sư phạm. Phụ huynh tạo yêu cầu môn học & thời gian.</p>
            </div>
            <div style="background: #ffffff; padding: 2rem 1.2rem; border-radius: 18px; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <div style="width: 56px; height: 56px; background: #f3e8ff; color: #7c3aed; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; margin: 0 auto 1.2rem auto;">3</div>
                <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">Duyệt & Phân Công</h3>
                <p style="font-size: 0.85rem; color: #64748b; line-height: 1.6;">Admin trung tâm thẩm định hồ sơ và chọn gia sư phù hợp nhất cho lớp học.</p>
            </div>
            <div style="background: #ffffff; padding: 2rem 1.2rem; border-radius: 18px; border: 1px solid #cbd5e1; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <div style="width: 56px; height: 56px; background: #dcfce7; color: #16a34a; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; margin: 0 auto 1.2rem auto;">4</div>
                <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">Bắt Đầu Giảng Dạy</h3>
                <p style="font-size: 0.85rem; color: #64748b; line-height: 1.6;">Gia sư liên hệ phụ huynh, nhận lớp và tiến hành dạy kèm hiệu quả.</p>
            </div>
        </div>
    </div>
</section>

<!-- CALL TO ACTION BANNER -->
<section style="padding: 4.5rem 0; background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); color: #ffffff; text-align: center;">
    <div class="container" style="max-width: 800px;">
        <h2 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 1rem; color: #ffffff;">Sẵn Sàng Nâng Cao Kết Quả Học Tập Ngay Hôm Nay?</h2>
        <p style="font-size: 1.05rem; color: #bfdbfe; margin-bottom: 2rem; line-height: 1.7;">
            Gia nhập cộng đồng hơn 1,000+ gia sư và phụ huynh tin dùng hệ thống Gia Sư Tri Thức.
        </p>
        <div style="display: flex; justify-content: center; gap: 1.2rem;">
            <a href="{{ route('register') }}" class="btn" style="background: #ffffff; color: #1e3a8a; padding: 0.9rem 2rem; font-weight: 800; font-size: 1rem; border-radius: 12px;">
                <i class="fas fa-rocket"></i> Đăng Ký Ngay
            </a>
            <a href="{{ route('lien-he') }}" class="btn btn-outline" style="border-color: #ffffff; color: #ffffff; background: transparent; padding: 0.9rem 2rem; font-weight: 700; font-size: 1rem; border-radius: 12px;">
                <i class="fas fa-phone"></i> Liên Hệ Tư Vấn
            </a>
        </div>
    </div>
</section>

@endsection
