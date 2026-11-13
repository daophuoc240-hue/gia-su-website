@extends('layouts.public')

@section('title', 'Liên Hệ Hỗ Trợ - Gia Sư Tri Thức')

@section('content')

<div style="background: linear-gradient(180deg, #eff6ff 0%, #f8fafc 100%); padding: 3rem 0 2.5rem 0; border-bottom: 1px solid #e2e8f0; margin-bottom: 2.8rem;">
    <div class="container">
        <span style="display: inline-block; background: #dbeafe; color: #1e40af; font-size: 0.78rem; font-weight: 800; padding: 0.3rem 0.85rem; border-radius: 50px; margin-bottom: 0.6rem;">
            HỖ TRỢ TƯ VẤN 24/7
        </span>
        <h1 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin: 0 0 0.4rem 0;">📞 Liên Hệ & Hỗ Trợ Trung Tâm Gia Sư Tri Thức</h1>
        <p style="color: #64748b; font-size: 0.98rem; margin: 0;">Đội ngũ tư vấn viên luôn sẵn sàng giải đáp thắc mắc về tìm gia sư, học phí và quy trình nhận lớp.</p>
    </div>
</div>

<div class="container" style="margin-bottom: 4rem;">
    <!-- 4 Kênh Liên Hệ Nhanh -->
    <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1.25rem; margin-bottom: 2.8rem;">
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; padding: 1.4rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #dbeafe; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                <i class="fas fa-phone-alt"></i>
            </div>
            <div>
                <div style="font-size: 0.78rem; color: #64748b; font-weight: 600;">Hotline / Zalo 24/7</div>
                <a href="tel:0394688031" style="font-size: 1.05rem; font-weight: 800; color: #2563eb; text-decoration: none;">0394.688.031</a>
            </div>
        </div>

        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; padding: 1.4rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                <i class="fas fa-envelope"></i>
            </div>
            <div>
                <div style="font-size: 0.78rem; color: #64748b; font-weight: 600;">Email Hỗ Trợ</div>
                <div style="font-size: 0.92rem; font-weight: 800; color: #0f172a;">support@giasutrithuc.vn</div>
            </div>
        </div>

        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; padding: 1.4rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div>
                <div style="font-size: 0.78rem; color: #64748b; font-weight: 600;">Văn Phòng Điều Phối</div>
                <div style="font-size: 0.92rem; font-weight: 800; color: #0f172a;">Khu Đô Thị ĐH, TP. Huế</div>
            </div>
        </div>

        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; padding: 1.4rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #f3e8ff; color: #7c3aed; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <div style="font-size: 0.78rem; color: #64748b; font-weight: 600;">Giờ Làm Việc</div>
                <div style="font-size: 0.92rem; font-weight: 800; color: #0f172a;">08:00 – 21:00 (T2 - CN)</div>
            </div>
        </div>
    </div>

    <!-- Form Liên Hệ & Thông Tin Trụ Sở -->
    <div id="form-tu-van" style="display: grid; grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr); gap: 2.2rem; align-items: stretch;">
        <div class="glass-card" style="padding: 2.2rem; border-radius: 20px; background: #ffffff; border: 1px solid #e2e8f0;">
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 0 0 0.4rem 0;">📬 Gửi Yêu Cầu Tư Vấn Nhanh</h3>
            <p style="font-size: 0.88rem; color: #64748b; margin: 0 0 1.4rem 0;">Điền thông tin bên dưới, yêu cầu sẽ được gửi trực tiếp tới Ban quản lý và tư vấn viên sẽ gọi lại trong 15 phút.</p>

            @if(session('lien_he_ok'))
                <div style="background: #ecfdf5; border: 1.5px solid #6ee7b7; color: #065f46; padding: 1rem 1.2rem; border-radius: 12px; margin-bottom: 1.2rem; font-weight: 700; font-size: 0.9rem;">
                    ✅ {{ session('lien_he_ok') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background: #fef2f2; border: 1.5px solid #fca5a5; color: #991b1b; padding: 0.9rem 1.1rem; border-radius: 12px; margin-bottom: 1.2rem; font-size: 0.86rem;">
                    @foreach($errors->all() as $err)
                        <div>• {{ $err }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('lien-he.gui') }}">
                @csrf
                <input type="text" name="website" value="" style="display:none;" tabindex="-1" autocomplete="off">

                <div style="display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 1rem; margin-bottom: 1rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Họ và Tên <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="ho_ten" value="{{ old('ho_ten', auth()->user()->ho_ten ?? '') }}" class="form-control" placeholder="Nhập họ và tên của bạn..." required>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Số Điện Thoại / Zalo <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="so_dien_thoai" value="{{ old('so_dien_thoai', auth()->user()->so_dien_thoai ?? '') }}" class="form-control" placeholder="Ví dụ: 0912345678..." required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 1rem; margin-bottom: 1rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Email (Không bắt buộc)</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="form-control" placeholder="email@domain.com">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Bạn cần hỗ trợ về vấn đề gì?</label>
                        <select name="loai" class="form-select">
                            <option value="phu_huynh" {{ old('loai') === 'phu_huynh' ? 'selected' : '' }}>👨‍👩‍👧 Phụ huynh / Học viên tìm gia sư</option>
                            <option value="gia_su" {{ old('loai') === 'gia_su' ? 'selected' : '' }}>👨‍🏫 Gia sư cần hỗ trợ hồ sơ / nhận lớp</option>
                            <option value="doi_gia_su" {{ old('loai') === 'doi_gia_su' ? 'selected' : '' }}>🔄 Đổi lịch học / đổi gia sư</option>
                            <option value="khac" {{ old('loai') === 'khac' ? 'selected' : '' }}>💬 Góp ý dịch vụ & Hợp tác khác</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nội dung chi tiết</label>
                    <textarea name="noi_dung" class="form-control" rows="4" placeholder="Mô tả môn học, khối lớp, khu vực hoặc thắc mắc cần giải đáp...">{{ old('noi_dung') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block" style="padding: 0.9rem; border-radius: 12px; font-weight: 800; font-size: 0.95rem;">
                    <i class="fas fa-paper-plane"></i> Gửi Yêu Cầu Tư Vấn Ngay
                </button>
            </form>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="glass-card" style="padding: 2rem; border-radius: 20px; background: #ffffff; border: 1px solid #e2e8f0; flex: 1;">
                <h3 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin: 0 0 1.2rem 0;">📍 Thông Tin Ban Quản Lý</h3>
                <div style="background: #eff6ff; padding: 1.2rem; border-radius: 14px; border: 1px solid #bfdbfe; margin-bottom: 1.4rem;">
                    <div style="font-size: 0.8rem; font-weight: 700; color: #1e40af; text-transform: uppercase; margin-bottom: 0.25rem;">Quản Lý & Điều Phối Hệ Thống</div>
                    <div style="font-size: 1.15rem; font-weight: 800; color: #0f172a;">Ông Đào Bình Phước</div>
                    <div style="font-size: 0.84rem; color: #475569; margin-top: 0.3rem; line-height: 1.55;">
                        Trực tiếp phụ trách kiểm duyệt hồ sơ gia sư, giải quyết khiếu nại và đảm bảo chất lượng dạy kèm cho phụ huynh.
                    </div>
                </div>

                <div style="font-size: 0.9rem; color: #334155; line-height: 2;">
                    <div>🏢 <strong>Đơn vị:</strong> Trung Tâm Gia Sư Tri Thức</div>
                    <div>📍 <strong>Địa chỉ:</strong> Khu Đô Thị Đại Học, TP. Huế</div>
                    <div>📞 <strong>Điện thoại:</strong> <strong style="color: #2563eb;">0394.688.031</strong></div>
                    <div>📧 <strong>Email cá nhân:</strong> daophuoc240@gmail.com</div>
                </div>
            </div>

            <div style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); color: #ffffff; padding: 1.8rem; border-radius: 20px;">
                <h4 style="font-size: 1.05rem; font-weight: 800; margin: 0 0 0.5rem 0; color: #ffffff;">⚡ Bạn Muốn Tự Tạo Lớp Hoặc Xem Gia Sư?</h4>
                <p style="font-size: 0.85rem; color: #bfdbfe; line-height: 1.6; margin: 0 0 1.1rem 0;">
                    Hệ thống cho phép Phụ huynh đăng ký tài khoản miễn phí để tạo yêu cầu tìm gia sư và chat trực tiếp trên web.
                </p>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="{{ route('register') }}" class="btn" style="background: #ffffff; color: #1e3a8a; font-weight: 800; font-size: 0.84rem; padding: 0.6rem 1.1rem; border-radius: 10px;">
                        Đăng Ký Tài Khoản
                    </a>
                    <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-outline" style="border-color: #ffffff; color: #ffffff; background: transparent; font-weight: 700; font-size: 0.84rem; padding: 0.6rem 1.1rem; border-radius: 10px;">
                        Xem Gia Sư
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
