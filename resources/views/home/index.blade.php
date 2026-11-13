@extends('layouts.public')

@section('title', 'Gia Sư Tri Thức - Nền Tảng Kết Nối Gia Sư & Lớp Học Hàng Đầu')

@push('styles')
<style>
    .subject-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.35rem 1.25rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        box-sizing: border-box;
        transition: all 0.22s ease;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.02);
    }
    .subject-card:hover {
        transform: translateY(-4px);
        border-color: #93c5fd;
        box-shadow: 0 12px 24px rgba(37, 99, 235, 0.09);
    }
    .quick-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.3rem 0.75rem;
        border-radius: 50px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #334155;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.18s ease;
    }
    .quick-tag:hover {
        background: #eff6ff;
        border-color: #60a5fa;
        color: #1d4ed8;
    }
    .faq-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        margin-bottom: 0.85rem;
        overflow: hidden;
        transition: border-color 0.2s ease;
    }
    .faq-item.active {
        border-color: #93c5fd;
        box-shadow: 0 6px 18px rgba(37, 99, 235, 0.06);
    }
    .faq-question {
        width: 100%;
        background: none;
        border: none;
        padding: 1.15rem 1.35rem;
        text-align: left;
        font-family: inherit;
        font-size: 0.96rem;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        cursor: pointer;
    }
    .faq-answer {
        display: none;
        padding: 0 1.35rem 1.2rem 1.35rem;
        font-size: 0.9rem;
        color: #475569;
        line-height: 1.65;
        border-top: 1px dashed #e2e8f0;
        padding-top: 0.9rem;
    }
    .faq-item.active .faq-answer {
        display: block;
    }
    .faq-item.active .faq-icon {
        transform: rotate(180deg);
        color: #2563eb;
    }
    @media (max-width: 992px) {
        .home-hero-grid {
            grid-template-columns: 1fr !important;
        }
        .home-grid-4 {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }
        .home-grid-3 {
            grid-template-columns: 1fr !important;
        }
    }
    @media (max-width: 640px) {
        .home-grid-4 {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush

@section('content')

<!-- 1. HERO SECTION -->
<section style="background: linear-gradient(180deg, #eff6ff 0%, #f8fafc 100%); padding: 3.5rem 0 3.2rem 0; border-bottom: 1px solid #e2e8f0;">
    <div class="container home-hero-grid" style="display: grid; grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr); gap: 3.2rem; align-items: center;">
        {{-- CỘT TRÁI: TIÊU ĐỀ & KHUNG TÌM KIẾM CÂN ĐỐI --}}
        <div>
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: #dbeafe; color: #1e40af; font-size: 0.82rem; font-weight: 700; padding: 0.4rem 1rem; margin-bottom: 1rem; border-radius: 50px; border: 1px solid #bfdbfe;">
                <span>🚀 Nền Tảng Kết Nối Gia Sư & Lớp Học Uy Tín Toàn Quốc</span>
            </div>
            <h1 style="font-size: 2.45rem; font-weight: 800; color: #0f172a; line-height: 1.25; margin-bottom: 0.9rem;">
                Kết Nối Gia Sư Giỏi & <br><span style="color: #2563eb; background: linear-gradient(135deg, #2563eb, #1d4ed8); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Tìm Lớp Học Dạy Kèm Uy Tín</span>
            </h1>
            <p style="font-size: 0.98rem; color: #475569; line-height: 1.65; margin-bottom: 1.4rem;">
                Hệ thống hỗ trợ Phụ huynh / Học viên tìm gia sư sư phạm chất lượng cao trong 24h và giúp Giáo viên / Sinh viên nhận lớp dạy kèm minh bạch, an toàn.
            </p>

            <!-- Quick Search Form Card (Căn chỉnh 1:1 thẳng hàng các ô nhập) -->
            <div style="background: #ffffff; padding: 1.5rem 1.6rem; border-radius: 20px; border: 1px solid #cbd5e1; box-shadow: 0 12px 35px rgba(15, 23, 42, 0.06);">
                <form action="{{ route('danh-sach-lop-hoc') }}" method="GET" style="display: flex; flex-direction: column; gap: 0.95rem;">
                    <!-- Hàng 1: Môn Học (1fr) & Khối Lớp (1fr) thẳng hàng ngang bằng -->
                    <div style="display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 1rem;">
                        <div>
                            <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.4rem;">
                                <span>📚</span> Môn Học
                            </label>
                            <input type="text" name="mon_hoc" class="form-control" placeholder="Toán, Tiếng Anh, Vật Lý..." style="padding: 0.72rem 1rem; font-size: 0.92rem; border-radius: 10px; width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1;">
                        </div>
                        <div>
                            <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.4rem;">
                                <span>🎯</span> Khối Lớp
                            </label>
                            <select name="khoi_lop" class="form-select" style="padding: 0.72rem 1rem; font-size: 0.92rem; border-radius: 10px; width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1;">
                                <option value="">Tất cả khối lớp</option>
                                @foreach(['Lớp 1','Lớp 2','Lớp 3','Lớp 4','Lớp 5','Lớp 6','Lớp 7','Lớp 8','Lớp 9','Lớp 10','Lớp 11','Lớp 12','Luyện Thi Đại Học'] as $kl)
                                    <option value="{{ $kl }}">{{ $kl }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Hàng 2: Tỉnh / Thành Phố (1fr) & Quận / Huyện / TP (1fr) thẳng hàng khớp 100% -->
                    <div style="display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 1rem;">
                        <div>
                            <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.4rem;">
                                <span>🏙️</span> Tỉnh / Thành Phố
                            </label>
                            <select name="tinh_thanh" class="form-select select-tinh-thanh" style="padding: 0.72rem 1rem; font-size: 0.92rem; border-radius: 10px; width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1;">
                                <option value="">-- Chọn Tỉnh / Thành Phố --</option>
                                @foreach(\App\Helpers\DiaDiem::getTinhThanhList() as $tinh)
                                    <option value="{{ $tinh }}">{{ $tinh }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label style="font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.4rem;">
                                <span>📍</span> Quận / Huyện / TP
                            </label>
                            <select name="quan_huyen" class="form-select select-quan-huyen" style="padding: 0.72rem 1rem; font-size: 0.92rem; border-radius: 10px; width: 100%; box-sizing: border-box; border: 1.5px solid #cbd5e1;">
                                <option value="">-- Tất cả Quận / Huyện --</option>
                            </select>
                        </div>
                    </div>

                    <!-- Hàng 3: Nút Tìm Kiếm nổi bật, full width -->
                    <div style="margin-top: 0.15rem;">
                        <button type="submit" class="btn btn-primary" style="padding: 0.82rem 1.5rem; font-size: 0.96rem; font-weight: 700; width: 100%; border-radius: 12px; display: flex; align-items: center; justify-content: center; gap: 0.6rem; background: linear-gradient(135deg, #2563eb, #1d4ed8); box-shadow: 0 4px 15px rgba(37, 99, 235, 0.32); border: none;">
                            <i class="fas fa-search"></i> Tìm Kiếm Lớp Học & Gia Sư Ngay
                        </button>
                    </div>

                    <!-- Hàng 4: Từ khóa tìm nhanh -->
                    <div style="padding-top: 0.75rem; border-top: 1px dashed #e2e8f0; display: flex; align-items: center; gap: 0.45rem; flex-wrap: wrap;">
                        <span style="font-size: 0.78rem; font-weight: 700; color: #64748b;">🔥 Tìm nhanh:</span>
                        <a href="{{ route('danh-sach-gia-su', ['keyword' => 'Toán']) }}" class="quick-tag">📐 Gia sư Toán</a>
                        <a href="{{ route('danh-sach-gia-su', ['keyword' => 'Tiếng Anh']) }}" class="quick-tag">🇬🇧 Tiếng Anh / IELTS</a>
                        <a href="{{ route('danh-sach-gia-su', ['keyword' => 'Vật Lý']) }}" class="quick-tag">⚡ Vật Lý</a>
                        <a href="{{ route('danh-sach-gia-su', ['keyword' => 'Hóa']) }}" class="quick-tag">🧪 Hóa Học</a>
                        <a href="{{ route('danh-sach-lop-hoc') }}" class="quick-tag" style="background:#eff6ff; color:#1d4ed8; border-color:#bfdbfe;">📋 Lớp Mới Nhất</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- CỘT PHẢI: HÌNH ẢNH BANNER & TIỆN ÍCH CÂN ĐỐI CHIỀU CAO --}}
        <div>
            <div style="position: relative; margin-bottom: 1.8rem;">
                {{-- Floating Badge Top Right --}}
                <div style="position: absolute; top: -15px; right: -10px; background: #ffffff; padding: 0.65rem 1.1rem; border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 0.6rem; z-index: 2;">
                    <span style="font-size: 1.3rem;">⭐</span>
                    <div>
                        <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">4.9 / 5.0 Đánh Giá</div>
                        <div style="font-size: 0.72rem; color: #64748b;">Phụ huynh & Học viên hài lòng</div>
                    </div>
                </div>

                {{-- Hero Banner Image --}}
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80" alt="Gia Sư Tri Thức" 
                     style="width: 100%; height: 365px; object-fit: cover; border-radius: 24px; box-shadow: 0 20px 40px rgba(37, 99, 235, 0.12); border: 4px solid #ffffff; display: block;">

                {{-- Floating Badge Bottom Left --}}
                <div style="position: absolute; bottom: -20px; left: -15px; background: #ffffff; padding: 0.85rem 1.3rem; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 0.85rem; z-index: 2;">
                    <div style="width: 44px; height: 44px; background: #dcfce7; color: #16a34a; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; flex-shrink: 0;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">100% Hồ Sơ Xác Thực</div>
                        <div style="font-size: 0.75rem; color: #64748b;">Kiểm duyệt bằng cấp & thẻ sinh viên</div>
                    </div>
                </div>
            </div>

            {{-- 2 Thẻ tiện ích bên dưới để cân bằng chiều cao --}}
            <div style="display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 1rem; margin-top: 2rem;">
                <div style="background: #ffffff; padding: 0.95rem 1.1rem; border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 38px; height: 38px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.05rem; flex-shrink: 0;">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 0.88rem; color: #0f172a;">Ghép Lớp Nhanh 24h</div>
                        <div style="font-size: 0.73rem; color: #64748b;">Chủ động chọn lịch dạy</div>
                    </div>
                </div>
                <div style="background: #ffffff; padding: 0.95rem 1.1rem; border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 38px; height: 38px; border-radius: 10px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 1.05rem; flex-shrink: 0;">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 0.88rem; color: #0f172a;">Học Thử 2 Buổi Đầu</div>
                        <div style="font-size: 0.73rem; color: #64748b;">Đổi gia sư miễn phí</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. STATS COUNTER BAR -->
<section style="padding: 2.6rem 0; background: #ffffff; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div class="home-grid-4" style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1.5rem; text-align: center;">
            <div style="padding: 1.4rem; background: #f8fafc; border-radius: 16px; border: 1px solid #e2e8f0;">
                <div style="font-size: 2.1rem; font-weight: 800; color: #2563eb; margin-bottom: 0.25rem;">{{ number_format($stats['tong_gia_su']) }}+</div>
                <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Gia Sư Chất Lượng</div>
                <div style="font-size: 0.78rem; color: #64748b;">Đã xác thực bằng cấp & CCCD</div>
            </div>
            <div style="padding: 1.4rem; background: #f8fafc; border-radius: 16px; border: 1px solid #e2e8f0;">
                <div style="font-size: 2.1rem; font-weight: 800; color: #7c3aed; margin-bottom: 0.25rem;">{{ number_format($stats['tong_lop_hoc']) }}+</div>
                <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Lớp Học Toàn Quốc</div>
                <div style="font-size: 0.78rem; color: #64748b;">Dạy kèm tại nhà & Online</div>
            </div>
            <div style="padding: 1.4rem; background: #f8fafc; border-radius: 16px; border: 1px solid #e2e8f0;">
                <div style="font-size: 2.1rem; font-weight: 800; color: #10b981; margin-bottom: 0.25rem;">{{ number_format($stats['thanh_cong']) }}+</div>
                <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Kết Nối Thành Công</div>
                <div style="font-size: 0.78rem; color: #64748b;">Nhận lớp nhanh trong 24h</div>
            </div>
            <div style="padding: 1.4rem; background: #f8fafc; border-radius: 16px; border: 1px solid #e2e8f0;">
                <div style="font-size: 2.1rem; font-weight: 800; color: #f59e0b; margin-bottom: 0.25rem;">99%</div>
                <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Phụ Huynh Hài Lòng</div>
                <div style="font-size: 0.78rem; color: #64748b;">Cam kết chất lượng đầu ra</div>
            </div>
        </div>
    </div>
</section>

<!-- 3. DANH MỤC MÔN HỌC PHỔ BIẾN (CHUẨN THỊ TRƯỜNG) -->
<section style="padding: 4rem 0; background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.2rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span style="color: #2563eb; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;">Đa Dạng Lĩnh Vực</span>
                <h2 style="font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0.3rem 0 0 0;">🎯 Khám Phá Gia Sư Theo Môn Học</h2>
            </div>
            <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-outline btn-sm">Tất Cả Chuyên Môn <i class="fas fa-arrow-right"></i></a>
        </div>

        @php
            $danhMucMon = [
                ['icon' => '📐', 'bg' => '#eff6ff', 'color' => '#2563eb', 'name' => 'Toán Học Các Cấp', 'sub' => 'Toán tư duy, Đại số, Hình học, Luyện thi 10 & ĐH', 'kw' => 'Toán'],
                ['icon' => '🇬🇧', 'bg' => '#fef2f2', 'color' => '#dc2626', 'name' => 'Tiếng Anh & IELTS', 'sub' => 'Ngữ pháp phổ thông, Giao tiếp, TOEIC, IELTS 6.5+', 'kw' => 'Tiếng Anh'],
                ['icon' => '⚡', 'bg' => '#fef3c7', 'color' => '#d97706', 'name' => 'Vật Lý THCS - THPT', 'sub' => 'Bám sát SGK mới, Luyện thi Học sinh giỏi & ĐH', 'kw' => 'Vật Lý'],
                ['icon' => '🧪', 'bg' => '#dcfce7', 'color' => '#16a34a', 'name' => 'Hóa Học & KHTN', 'sub' => 'Lấy lại gốc Hóa 8-12, Phương pháp giải nhanh', 'kw' => 'Hóa'],
                ['icon' => '📖', 'bg' => '#f3e8ff', 'color' => '#7c3aed', 'name' => 'Ngữ Văn & Tiếng Việt', 'sub' => 'Rèn kỹ năng nghị luận, Cảm thụ văn học & Thi chuyển cấp', 'kw' => 'Ngữ Văn'],
                ['icon' => '✏️', 'bg' => '#ffedd5', 'color' => '#ea580c', 'name' => 'Tiểu Học & Báo Bài', 'sub' => 'Hành trang vào lớp 1, Rèn chữ đẹp, Toán - Tiếng Việt', 'kw' => 'Tiểu học'],
                ['icon' => '💻', 'bg' => '#e0f2fe', 'color' => '#0284c7', 'name' => 'Tin Học & Lập Trình', 'sub' => 'Tin học trẻ, Python, C++, MOS & Kỹ năng máy tính', 'kw' => 'Tin học'],
                ['icon' => '🗣️', 'bg' => '#fce7f3', 'color' => '#db2777', 'name' => 'Ngoại Ngữ Khác', 'sub' => 'Tiếng Trung HSK, Tiếng Nhật JLPT, Tiếng Hàn, Tiếng Pháp', 'kw' => 'Ngoại ngữ'],
            ];
        @endphp

        <div class="home-grid-4" style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1.25rem; align-items: stretch;">
            @foreach($danhMucMon as $mon)
            <a href="{{ route('danh-sach-gia-su', ['keyword' => $mon['kw']]) }}" class="subject-card">
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.9rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: {{ $mon['bg'] }}; color: {{ $mon['color'] }}; display: flex; align-items: center; justify-content: center; font-size: 1.45rem;">
                            {{ $mon['icon'] }}
                        </div>
                        <span style="font-size: 0.74rem; font-weight: 700; color: {{ $mon['color'] }}; background: {{ $mon['bg'] }}; padding: 0.25rem 0.65rem; border-radius: 50px;">
                            Sẵn sàng
                        </span>
                    </div>
                    <h3 style="font-size: 1.02rem; font-weight: 800; color: #0f172a; margin: 0 0 0.4rem 0;">{{ $mon['name'] }}</h3>
                    <p style="font-size: 0.82rem; color: #64748b; line-height: 1.5; margin: 0 0 1rem 0;">{{ $mon['sub'] }}</p>
                </div>
                <div style="font-size: 0.8rem; font-weight: 700; color: #2563eb; display: flex; align-items: center; gap: 0.35rem; margin-top: auto; padding-top: 0.65rem; border-top: 1px solid #f1f5f9;">
                    <span>Xem gia sư môn này</span> <i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- 4. FEATURED TUTORS SHOWCASE (ĐẦY ĐỦ THÔNG TIN MÔN DẠY, HỌC PHÍ, ĐÁNH GIÁ) -->
<section style="padding: 4rem 0; background: #ffffff; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.3rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span style="color: #2563eb; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;">Đội Ngũ Tiêu Biểu</span>
                <h2 style="font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0.3rem 0 0 0;">👨‍🏫 Gia Sư Uy Tín Đã Kiểm Duyệt</h2>
            </div>
            <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-outline btn-sm">Xem Tất Cả Gia Sư <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="home-grid-3" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.75rem; align-items: stretch;">
            @forelse($gia_su_noi_bat as $hs)
            <div class="glass-card" style="border-radius: 20px; padding: 1.65rem; border: 1px solid #e2e8f0; background: #ffffff; transition: all 0.25s ease; display: flex; flex-direction: column; height: 100%; box-sizing: border-box; box-shadow: 0 6px 20px rgba(15, 23, 42, 0.03);" onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='#93c5fd';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#e2e8f0';">
                {{-- Header: Avatar + Tên + Đánh giá sao --}}
                <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1.1rem;">
                    <div style="position: relative; flex-shrink: 0;">
                        <img src="{{ $hs->avatar_url }}" alt="{{ $hs->taiKhoan->ho_ten }}" style="width: 72px; height: 72px; border-radius: 50%; object-fit: cover; border: 3px solid #2563eb;">
                        <span style="position: absolute; bottom: 3px; right: 3px; width: 13px; height: 13px; background: #10b981; border: 2px solid #ffffff; border-radius: 50%;" title="Sẵn sàng nhận lớp"></span>
                    </div>
                    <div style="overflow: hidden; flex: 1;">
                        <h3 style="font-size: 1.08rem; font-weight: 800; color: #0f172a; margin: 0 0 0.3rem 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $hs->taiKhoan->ho_ten }}
                        </h3>
                        <div style="display: flex; gap: 0.4rem; flex-wrap: wrap; align-items: center; margin-bottom: 0.3rem;">
                            <span class="badge badge-success" style="font-size: 0.7rem; padding: 0.18rem 0.55rem;"><i class="fas fa-check-circle"></i> Đã xác thực</span>
                            @if($hs->mon_day)
                                <span class="badge badge-info" style="font-size: 0.7rem; padding: 0.18rem 0.55rem; max-width: 130px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">📚 {{ $hs->mon_day }}</span>
                            @endif
                        </div>
                        <div style="font-size: 0.78rem; color: #f59e0b; font-weight: 700;">
                            ⭐ {{ number_format($hs->diem_trung_binh ?: 5.0, 1) }}
                            <span style="color: #64748b; font-weight: 500;">({{ $hs->so_luot_danh_gia }} đánh giá)</span>
                        </div>
                    </div>
                </div>

                {{-- Body: Thông tin chi tiết đồng đều chiều cao --}}
                <div style="background: #f8fafc; padding: 1rem; border-radius: 14px; font-size: 0.85rem; color: #334155; line-height: 1.65; margin-bottom: 1.1rem; border: 1px solid #f1f5f9; flex: 1 1 auto; display: flex; flex-direction: column; gap: 0.35rem;">
                    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $hs->truong_hoc }}">
                        🎓 <strong>Trường:</strong> {{ $hs->truong_hoc }}
                    </div>
                    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $hs->chuyen_nganh }}">
                        📖 <strong>Chuyên ngành:</strong> {{ $hs->chuyen_nganh }}
                    </div>
                    <div style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 2.75em; line-height: 1.4;" title="{{ $hs->khu_vuc_nhan_day }}">
                        📍 <strong>Khu vực dạy:</strong> {{ $hs->khu_vuc_nhan_day }}
                    </div>
                    <div style="margin-top: auto; padding-top: 0.55rem; border-top: 1px dashed #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                        <span>💰 <strong style="color: #2563eb; font-size: 0.92rem;">{{ number_format($hs->hoc_phi_theo_gio ?: 150000) }} đ/buổi</strong></span>
                        <span style="font-size: 0.76rem; color: #059669; font-weight: 700; background: #dcfce7; padding: 0.15rem 0.55rem; border-radius: 8px;">🏆 {{ $hs->so_lop_da_day }} lớp đã dạy</span>
                    </div>
                </div>

                {{-- Footer Buttons cố định đáy --}}
                <div style="display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 0.65rem; margin-top: auto;">
                    <a href="{{ route('chi-tiet-gia-su', $hs->id) }}" class="btn btn-outline btn-sm" style="border-radius: 10px; font-size: 0.84rem; padding: 0.6rem; text-align: center; background: #ffffff; font-weight: 700;">
                        <i class="fas fa-id-card"></i> Xem Hồ Sơ
                    </a>
                    <a href="{{ route('giasu.moi', $hs->id) }}" class="btn btn-primary btn-sm" style="border-radius: 10px; font-size: 0.84rem; padding: 0.6rem; background: linear-gradient(135deg, #2563eb, #1d4ed8); border: none; text-align: center; font-weight: 700;">
                        <i class="fas fa-paper-plane"></i> Mời Dạy
                    </a>
                </div>
            </div>
            @empty
            <div style="grid-column: span 3; text-align: center; padding: 3rem; color: #64748b;">
                Chưa có gia sư nào được phê duyệt hiển thị.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 5. RECENT OPEN CLASSES (CÓ MÃ LỚP #LH & ĐƠN VỊ HỌC PHÍ THÔNG MINH) -->
<section style="padding: 4rem 0; background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.3rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span style="color: #2563eb; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;">Cơ Hội Nhận Lớp</span>
                <h2 style="font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0.3rem 0 0 0;">📚 Lớp Học Mới Đang Tìm Gia Sư</h2>
            </div>
            <a href="{{ route('danh-sach-lop-hoc') }}" class="btn btn-outline btn-sm">Xem Tất Cả Lớp Mới <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="home-grid-3" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.75rem; align-items: stretch;">
            @forelse($lop_moi as $lop)
            <div class="glass-card" style="border-radius: 20px; padding: 1.65rem; border: 1px solid #e2e8f0; background: #ffffff; display: flex; flex-direction: column; height: 100%; box-sizing: border-box; box-shadow: 0 6px 20px rgba(15, 23, 42, 0.03); transition: all 0.22s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='#93c5fd';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#e2e8f0';">
                {{-- Hàng 1: Mã lớp + Badge môn khối + Học phí thông minh --}}
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem; margin-bottom: 0.6rem; height: 28px;">
                    <span style="font-size: 0.76rem; font-weight: 800; color: #1e40af; background: #dbeafe; padding: 0.24rem 0.6rem; border-radius: 6px; flex-shrink: 0;">
                        {{ $lop->ma_lop }}
                    </span>
                    <span style="font-weight: 800; color: #2563eb; font-size: 1.02rem; white-space: nowrap; flex-shrink: 0;">
                        {{ $lop->hoc_phi_hien_thi }}
                    </span>
                </div>
                <div style="margin-bottom: 0.75rem; height: 28px; display: flex; align-items: center;">
                    <span class="badge badge-info" style="font-size: 0.78rem; max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block;" title="{{ $lop->mon_hoc }} - {{ $lop->khoi_lop }}">
                        📚 {{ $lop->mon_hoc }} • {{ $lop->khoi_lop }}
                    </span>
                </div>

                {{-- Hàng 2: Tiêu đề cố định 2 dòng --}}
                <h3 style="font-size: 1.04rem; font-weight: 800; color: #0f172a; margin: 0 0 0.8rem 0; line-height: 1.4; height: 2.8em; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;" title="Tìm gia sư dạy {{ $lop->mon_hoc }} {{ $lop->khoi_lop }}">
                    Tìm gia sư dạy {{ $lop->mon_hoc }} {{ $lop->khoi_lop }}
                </h3>

                {{-- Hàng 3: Chi tiết lớp học đồng đều --}}
                <div style="background: #f8fafc; padding: 0.95rem 1rem; border-radius: 14px; border: 1px solid #f1f5f9; font-size: 0.85rem; color: #475569; line-height: 1.6; margin-bottom: 1.15rem; flex: 1 1 auto; display: flex; flex-direction: column; gap: 0.38rem;">
                    <div style="height: 2.8em; line-height: 1.4; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;" title="{{ $lop->dia_chi_day }}">
                        📍 <strong>Khu vực:</strong> {{ $lop->dia_chi_day }}
                    </div>
                    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        🗓️ <strong>Thời lượng:</strong> {{ $lop->so_buoi_trung_binh }} buổi/tuần ({{ $lop->thoi_gian_day }})
                    </div>
                    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $lop->yeu_cau_gia_su }}">
                        📝 <strong>Yêu cầu:</strong> {{ Str::limit($lop->yeu_cau_gia_su ?: 'Nhiệt tình, có kinh nghiệm sư phạm', 46) }}
                    </div>
                </div>

                {{-- Hàng 4: Nút ở đáy --}}
                <div style="margin-top: auto;">
                    <a href="{{ route('chi-tiet-lop-hoc', $lop->id) }}" class="btn btn-primary btn-sm btn-block" style="border-radius: 10px; width: 100%; padding: 0.65rem; font-size: 0.86rem; font-weight: 700;">
                        <i class="fas fa-paper-plane"></i> Xem Chi Tiết & Đăng Ký Nhận Lớp
                    </a>
                </div>
            </div>
            @empty
            <div style="grid-column: span 3; text-align: center; padding: 3rem; color: #64748b;">
                Hiện tại chưa có lớp học mới nào đang tìm gia sư.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 6. BẢNG GIÁ HỌC PHÍ GIA SƯ THAM KHẢO (CHUẨN THỊ TRƯỜNG) -->
<section id="bang-gia-hoc-phi" style="padding: 4.2rem 0; background: #ffffff; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div style="text-align: center; max-width: 680px; margin: 0 auto 2.8rem auto;">
            <span style="color: #2563eb; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;">Minh Bạch Chi Phí</span>
            <h2 style="font-size: 1.8rem; font-weight: 800; color: #0f172a; margin: 0.3rem 0 0.6rem 0;">💰 Bảng Giá Học Phí Gia Sư Tham Khảo</h2>
            <p style="font-size: 0.92rem; color: #64748b; line-height: 1.6; margin: 0;">
                Mức học phí chuẩn thị trường được niêm yết rõ ràng theo cấp học và trình độ gia sư (Thời lượng tiêu chuẩn: 90 – 120 phút/buổi).
            </p>
        </div>

        <div class="home-grid-3" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.75rem; align-items: stretch;">
            {{-- Gói 1: Tiểu học --}}
            <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 20px; padding: 1.8rem; display: flex; flex-direction: column; height: 100%; box-sizing: border-box;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.8rem;">
                    <span style="background: #eff6ff; color: #1d4ed8; font-weight: 800; font-size: 0.8rem; padding: 0.3rem 0.8rem; border-radius: 50px;">KHỐI TIỂU HỌC</span>
                    <span style="font-size: 1.5rem;">✏️</span>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin: 0 0 0.4rem 0;">Lớp 1 – Lớp 5 & Rèn Chữ</h3>
                <p style="font-size: 0.84rem; color: #64748b; margin: 0 0 1.2rem 0;">Toán, Tiếng Việt, Tiếng Anh thiếu nhi, Báo bài & Rèn nề nếp học tập.</p>

                <div style="background: #f8fafc; border-radius: 14px; padding: 1rem; margin-bottom: 1.2rem; border: 1px solid #e2e8f0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.65rem; margin-bottom: 0.65rem; border-bottom: 1px dashed #cbd5e1;">
                        <span style="font-size: 0.86rem; font-weight: 600; color: #334155;">🎓 Gia sư Sinh viên:</span>
                        <strong style="color: #2563eb; font-size: 0.96rem;">120.000 - 150.000 đ/buổi</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.86rem; font-weight: 600; color: #334155;">👨‍🏫 Giáo viên đứng lớp:</span>
                        <strong style="color: #0f172a; font-size: 0.96rem;">220.000 - 280.000 đ/buổi</strong>
                    </div>
                </div>

                <ul style="list-style: none; padding: 0; margin: 0 0 1.4rem 0; font-size: 0.85rem; color: #475569; line-height: 2; flex: 1;">
                    <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.4rem;"></i> Kèm sát sổ báo bài trên trường</li>
                    <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.4rem;"></i> Rèn chữ viết và tư duy tính toán</li>
                    <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.4rem;"></i> Học thử 2 buổi đầu đánh giá</li>
                </ul>

                <a href="{{ route('danh-sach-gia-su', ['keyword' => 'Tiểu học']) }}" class="btn btn-outline btn-block" style="margin-top: auto; border-radius: 10px; font-weight: 700;">
                    Chọn Gia Sư Tiểu Học
                </a>
            </div>

            {{-- Gói 2: THCS (Nổi bật) --}}
            <div style="background: #ffffff; border: 2px solid #2563eb; border-radius: 20px; padding: 1.8rem; display: flex; flex-direction: column; height: 100%; box-sizing: border-box; box-shadow: 0 12px 30px rgba(37, 99, 235, 0.1); position: relative;">
                <div style="position: absolute; top: -12px; right: 20px; background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #ffffff; font-size: 0.72rem; font-weight: 800; padding: 0.25rem 0.8rem; border-radius: 50px;">
                    PHỔ BIẾN NHẤT
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.8rem;">
                    <span style="background: #dbeafe; color: #1e40af; font-weight: 800; font-size: 0.8rem; padding: 0.3rem 0.8rem; border-radius: 50px;">KHỐI THCS (CẤP 2)</span>
                    <span style="font-size: 1.5rem;">📐</span>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin: 0 0 0.4rem 0;">Lớp 6 – Lớp 9 & Thi Tuyển 10</h3>
                <p style="font-size: 0.84rem; color: #64748b; margin: 0 0 1.2rem 0;">Toán, Lý, Hóa, KHTN, Văn, Anh & Ôn thi chuyển cấp vào lớp 10 công lập / chuyên.</p>

                <div style="background: #eff6ff; border-radius: 14px; padding: 1rem; margin-bottom: 1.2rem; border: 1px solid #bfdbfe;">
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.65rem; margin-bottom: 0.65rem; border-bottom: 1px dashed #93c5fd;">
                        <span style="font-size: 0.86rem; font-weight: 600; color: #1e3a8a;">🎓 Gia sư Sinh viên:</span>
                        <strong style="color: #2563eb; font-size: 0.96rem;">150.000 - 180.000 đ/buổi</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.86rem; font-weight: 600; color: #1e3a8a;">👨‍🏫 Giáo viên đứng lớp:</span>
                        <strong style="color: #0f172a; font-size: 0.96rem;">250.000 - 320.000 đ/buổi</strong>
                    </div>
                </div>

                <ul style="list-style: none; padding: 0; margin: 0 0 1.4rem 0; font-size: 0.85rem; color: #475569; line-height: 2; flex: 1;">
                    <li><i class="fas fa-check" style="color: #2563eb; margin-right: 0.4rem;"></i> Lấy lại gốc kiến thức trong 1 tháng</li>
                    <li><i class="fas fa-check" style="color: #2563eb; margin-right: 0.4rem;"></i> Lộ trình luyện đề thi vào lớp 10</li>
                    <li><i class="fas fa-check" style="color: #2563eb; margin-right: 0.4rem;"></i> Báo cáo tiến độ định kỳ cho phụ huynh</li>
                </ul>

                <a href="{{ route('danh-sach-gia-su') }}" class="btn btn-primary btn-block" style="margin-top: auto; border-radius: 10px; font-weight: 700;">
                    Tìm Gia Sư Cấp 2 Ngay
                </a>
            </div>

            {{-- Gói 3: THPT & Luyện Thi --}}
            <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 20px; padding: 1.8rem; display: flex; flex-direction: column; height: 100%; box-sizing: border-box;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.8rem;">
                    <span style="background: #f3e8ff; color: #7e22ce; font-weight: 800; font-size: 0.8rem; padding: 0.3rem 0.8rem; border-radius: 50px;">THPT & LUYỆN THI</span>
                    <span style="font-size: 1.5rem;">🎓</span>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin: 0 0 0.4rem 0;">Lớp 10 – 12, Thi ĐH & IELTS</h3>
                <p style="font-size: 0.84rem; color: #64748b; margin: 0 0 1.2rem 0;">Luyện thi Tốt nghiệp THPT, Đánh giá năng lực, IELTS, TOEIC & Ngoại ngữ giao tiếp.</p>

                <div style="background: #f8fafc; border-radius: 14px; padding: 1rem; margin-bottom: 1.2rem; border: 1px solid #e2e8f0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.65rem; margin-bottom: 0.65rem; border-bottom: 1px dashed #cbd5e1;">
                        <span style="font-size: 0.86rem; font-weight: 600; color: #334155;">🎓 Sinh viên Giỏi / Thủ khoa:</span>
                        <strong style="color: #2563eb; font-size: 0.96rem;">180.000 - 250.000 đ/buổi</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.86rem; font-weight: 600; color: #334155;">👨‍🏫 Giáo viên / Thạc sĩ:</span>
                        <strong style="color: #0f172a; font-size: 0.96rem;">300.000 - 450.000 đ/buổi</strong>
                    </div>
                </div>

                <ul style="list-style: none; padding: 0; margin: 0 0 1.4rem 0; font-size: 0.85rem; color: #475569; line-height: 2; flex: 1;">
                    <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.4rem;"></i> Chuyên sâu giải đề mục tiêu 8+ / 9+</li>
                    <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.4rem;"></i> Gia sư trường Top (Sư phạm, Bách Khoa, Ngoại Thương)</li>
                    <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.4rem;"></i> Linh hoạt học tại nhà hoặc Online 1-1</li>
                </ul>

                <a href="{{ route('danh-sach-gia-su', ['keyword' => 'THPT']) }}" class="btn btn-outline btn-block" style="margin-top: auto; border-radius: 10px; font-weight: 700;">
                    Chọn Gia Sư Luyện Thi
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 7. 4-STEP PROCESS GUIDE -->
<section style="padding: 4rem 0; background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 2.8rem auto;">
            <span style="color: #2563eb; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;">Quy Trình Hoạt Động</span>
            <h2 style="font-size: 1.75rem; font-weight: 800; color: #0f172a; margin-top: 0.3rem;">⚡ Dễ Dàng & Minh Bạch Trong 4 Bước</h2>
        </div>

        <div class="home-grid-4" style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1.5rem; text-align: center; align-items: stretch;">
            <div style="background: #ffffff; padding: 1.9rem 1.3rem; border-radius: 18px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-direction: column;">
                <div style="width: 54px; height: 54px; background: #dbeafe; color: #2563eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; font-weight: 800; margin: 0 auto 1.1rem auto;">1</div>
                <h3 style="font-size: 1.02rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem;">Đăng Ký / Chọn Gia Sư</h3>
                <p style="font-size: 0.85rem; color: #64748b; line-height: 1.6; margin: 0;">Phụ huynh tạo yêu cầu tìm gia sư hoặc chọn trực tiếp hồ sơ gia sư ưng ý trên website.</p>
            </div>
            <div style="background: #ffffff; padding: 1.9rem 1.3rem; border-radius: 18px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-direction: column;">
                <div style="width: 54px; height: 54px; background: #fef3c7; color: #d97706; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; font-weight: 800; margin: 0 auto 1.1rem auto;">2</div>
                <h3 style="font-size: 1.02rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem;">Thẩm Định & Xếp Lịch</h3>
                <p style="font-size: 0.85rem; color: #64748b; line-height: 1.6; margin: 0;">Gia sư xác nhận khung giờ rảnh và Ban quản trị kiểm duyệt năng lực trước khi bàn giao.</p>
            </div>
            <div style="background: #ffffff; padding: 1.9rem 1.3rem; border-radius: 18px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-direction: column;">
                <div style="width: 54px; height: 54px; background: #f3e8ff; color: #7c3aed; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; font-weight: 800; margin: 0 auto 1.1rem auto;">3</div>
                <h3 style="font-size: 1.02rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem;">Dạy Thử 2 Buổi Đầu</h3>
                <p style="font-size: 0.85rem; color: #64748b; line-height: 1.6; margin: 0;">Gia sư gặp mặt, kiểm tra học lực đầu vào của học sinh và thống nhất lộ trình học tập.</p>
            </div>
            <div style="background: #ffffff; padding: 1.9rem 1.3rem; border-radius: 18px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-direction: column;">
                <div style="width: 54px; height: 54px; background: #dcfce7; color: #16a34a; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; font-weight: 800; margin: 0 auto 1.1rem auto;">4</div>
                <h3 style="font-size: 1.02rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem;">Theo Dõi & Đánh Giá</h3>
                <p style="font-size: 0.85rem; color: #64748b; line-height: 1.6; margin: 0;">Hệ thống hỗ trợ trao đổi trực tuyến và ghi nhận đánh giá minh bạch từ phụ huynh.</p>
            </div>
        </div>
    </div>
</section>

<!-- 8. ĐÁNH GIÁ TỪ PHỤ HUYNH & HỌC VIÊN -->
<section style="padding: 4rem 0; background: #ffffff; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 2.6rem auto;">
            <span style="color: #2563eb; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;">Cảm Nhận Thực Tế</span>
            <h2 style="font-size: 1.75rem; font-weight: 800; color: #0f172a; margin-top: 0.3rem;">💬 Phụ Huynh & Học Viên Nói Gì Về Chúng Tôi?</h2>
        </div>

        @php
            $fallbackReviews = [
                [
                    'hv_ten' => 'Chị Nguyễn Minh Trang',
                    'role'   => 'Phụ huynh học sinh Lớp 9 - Quận 3, TP.HCM',
                    'gs_ten' => 'Gia sư Toán & Lý',
                    'diem'   => 5,
                    'noi_dung' => 'Bé nhà mình mất gốc Toán hình lớp 9, nhờ trung tâm giới thiệu bạn gia sư ĐH Sư Phạm rất nhiệt tình và kiên nhẫn. Sau 2 tháng học kỳ vừa rồi cháu đã đạt 8.5 điểm Toán.'
                ],
                [
                    'hv_ten' => 'Anh Trần Quốc Bảo',
                    'role'   => 'Phụ huynh học sinh Lớp 12 - Quận Cầu Giấy, Hà Nội',
                    'gs_ten' => 'Gia sư Tiếng Anh IELTS',
                    'diem'   => 5,
                    'noi_dung' => 'Quy trình chọn gia sư trên website rất minh bạch, xem được rõ trường học, điểm đánh giá và đặt lịch dạy trực tiếp. Gia sư đúng giờ, bài giảng chuẩn bị rất chu đáo.'
                ],
                [
                    'hv_ten' => 'Chị Lê Hoàng Yến',
                    'role'   => 'Phụ huynh học sinh Lớp 4 - TP. Huế',
                    'gs_ten' => 'Gia sư Tiểu học & Báo bài',
                    'diem'   => 5,
                    'noi_dung' => 'Mình rất yên tâm vì hồ sơ gia sư đều được xác minh thẻ sinh viên và căn cước rõ ràng. Cô giáo dạy kèm bé rất tận tâm, chữ viết và điểm số của con cải thiện rõ rệt.'
                ],
            ];
        @endphp

        <div class="home-grid-3" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.75rem; align-items: stretch;">
            @if(isset($danh_gia_noi_bat) && $danh_gia_noi_bat->count() >= 3)
                @foreach($danh_gia_noi_bat->take(3) as $dg)
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 1.65rem; display: flex; flex-direction: column; justify-content: space-between; height: 100%; box-sizing: border-box;">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.9rem;">
                            <div style="color: #f59e0b; font-size: 0.95rem;">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star" style="color: {{ $i <= ($dg->so_sao ?: 5) ? '#f59e0b' : '#cbd5e1' }};"></i>
                                @endfor
                            </div>
                            <span style="font-size: 0.75rem; font-weight: 700; color: #2563eb; background: #eff6ff; padding: 0.2rem 0.65rem; border-radius: 50px;">
                                Đã xác thực
                            </span>
                        </div>
                        <p style="font-size: 0.9rem; color: #334155; line-height: 1.65; font-style: italic; margin: 0 0 1.2rem 0;">
                            "{{ $dg->nhan_xet ?: 'Gia sư giảng dạy rất nhiệt tình, đúng giờ và phương pháp sư phạm dễ hiểu. Học sinh tiến bộ rõ rệt sau thời gian học.' }}"
                        </p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.8rem; padding-top: 0.9rem; border-top: 1px solid #e2e8f0; margin-top: auto;">
                        <img src="{{ $dg->hocVien->avatar_url ?? 'https://ui-avatars.com/api/?name=PH&background=2563eb&color=fff' }}" alt="Avatar" style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover;">
                        <div>
                            <div style="font-weight: 800; font-size: 0.9rem; color: #0f172a;">{{ $dg->hocVien->ho_ten ?? 'Phụ huynh Học viên' }}</div>
                            <div style="font-size: 0.76rem; color: #64748b;">Đánh giá Gia sư: <strong>{{ $dg->giaSu->ho_ten ?? 'Gia Sư Tri Thức' }}</strong></div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                @foreach($fallbackReviews as $rv)
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 1.65rem; display: flex; flex-direction: column; justify-content: space-between; height: 100%; box-sizing: border-box;">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.9rem;">
                            <div style="color: #f59e0b; font-size: 0.92rem;">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <span style="font-size: 0.74rem; font-weight: 700; color: #1d4ed8; background: #eff6ff; padding: 0.2rem 0.65rem; border-radius: 50px;">
                                <i class="fas fa-comment-dots"></i> Phản hồi tiêu biểu
                            </span>
                        </div>
                        <p style="font-size: 0.9rem; color: #334155; line-height: 1.65; font-style: italic; margin: 0 0 1.2rem 0;">
                            "{{ $rv['noi_dung'] }}"
                        </p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.8rem; padding-top: 0.9rem; border-top: 1px solid #e2e8f0; margin-top: auto;">
                        <div style="width: 42px; height: 42px; border-radius: 50%; background: #dbeafe; color: #1d4ed8; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            {{ mb_substr($rv['hv_ten'], 0, 1) }}
                        </div>
                        <div>
                            <div style="font-weight: 800; font-size: 0.9rem; color: #0f172a;">{{ $rv['hv_ten'] }}</div>
                            <div style="font-size: 0.76rem; color: #64748b;">{{ $rv['role'] }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- 9. CÂU HỎI THƯỜNG GẶP (FAQ ACCORDION) -->
<section id="cau-hoi-thuong-gap" style="padding: 4rem 0; background: #f8fafc;">
    <div class="container" style="max-width: 900px;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="color: #2563eb; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px;">Giải Đáp Thắc Mắc</span>
            <h2 style="font-size: 1.75rem; font-weight: 800; color: #0f172a; margin-top: 0.3rem;">❓ Câu Hỏi Thường Gặp</h2>
        </div>

        <div class="faq-list">
            <div class="faq-item active">
                <button type="button" class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                    <span>1. Phụ huynh tìm gia sư trên hệ thống Gia Sư Tri Thức có mất phí không?</span>
                    <i class="fas fa-chevron-down faq-icon" style="transition: transform 0.2s;"></i>
                </button>
                <div class="faq-answer">
                    Hoàn toàn <strong>MIỄN PHÍ 100%</strong> đối với Phụ huynh và Học viên. Phụ huynh được tư vấn lộ trình học, xem hồ sơ gia sư, mời gia sư dạy thử 2 buổi đầu tiên để đánh giá sự phù hợp trước khi chính thức học lâu dài.
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                    <span>2. Nếu học thử mà học sinh cảm thấy chưa phù hợp với phương pháp của gia sư thì sao?</span>
                    <i class="fas fa-chevron-down faq-icon" style="transition: transform 0.2s;"></i>
                </button>
                <div class="faq-answer">
                    Trung tâm hỗ trợ <strong>đổi gia sư mới hoàn toàn miễn phí</strong> trong vòng 24h – 48h nếu sau 2 buổi học thử đầu tiên học sinh chưa quen với phương pháp truyền đạt của gia sư.
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                    <span>3. Hồ sơ của gia sư được kiểm duyệt như thế nào?</span>
                    <i class="fas fa-chevron-down faq-icon" style="transition: transform 0.2s;"></i>
                </button>
                <div class="faq-answer">
                    100% gia sư hiển thị trên hệ thống đều phải trải qua quy trình xét duyệt của Quản trị viên bao gồm: Xác thực Căn cước công dân, Thẻ sinh viên / Bằng tốt nghiệp Đại học - Sư phạm, cùng lịch sử giảng dạy và đánh giá thực tế từ các lớp đã dạy.
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                    <span>4. Sinh viên / Giáo viên muốn nhận lớp dạy kèm cần làm những bước nào?</span>
                    <i class="fas fa-chevron-down faq-icon" style="transition: transform 0.2s;"></i>
                </button>
                <div class="faq-answer">
                    Gia sư chỉ cần đăng ký tài khoản với vai trò <strong>Gia sư</strong>, vào mục <em>"Hồ Sơ Của Tôi"</em> để cập nhật trường học, chuyên ngành, môn dạy và khu vực nhận dạy. Sau khi hồ sơ được duyệt, gia sư có thể ứng tuyển trực tiếp vào các lớp đang mở hoặc nhận lời mời dạy từ phụ huynh.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 10. CALL TO ACTION BANNER -->
<section style="padding: 4.2rem 0; background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); color: #ffffff; text-align: center;">
    <div class="container" style="max-width: 820px;">
        <h2 style="font-size: 2.1rem; font-weight: 800; margin-bottom: 0.9rem; color: #ffffff;">Sẵn Sàng Nâng Cao Kết Quả Học Tập Ngay Hôm Nay?</h2>
        <p style="font-size: 1.02rem; color: #bfdbfe; margin-bottom: 2rem; line-height: 1.7;">
            Đồng hành cùng hệ thống Gia Sư Tri Thức để kết nối gia sư giỏi tận tâm hoặc nhận lớp dạy kèm phù hợp nhất tại khu vực của bạn.
        </p>
        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('danh-sach-gia-su') }}" class="btn" style="background: #ffffff; color: #1e3a8a; padding: 0.9rem 1.8rem; font-weight: 800; font-size: 0.96rem; border-radius: 12px;">
                <i class="fas fa-user-graduate"></i> Tìm Gia Sư Giỏi Ngay
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline" style="border: 1.5px solid #ffffff; color: #ffffff; background: rgba(255,255,255,0.1); padding: 0.9rem 1.8rem; font-weight: 700; font-size: 0.96rem; border-radius: 12px;">
                <i class="fas fa-chalkboard-teacher"></i> Đăng Ký Làm Gia Sư
            </a>
        </div>
    </div>
</section>

@endsection
