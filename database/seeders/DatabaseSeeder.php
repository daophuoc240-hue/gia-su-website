<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;
use App\Models\HoSoGiaSu;
use App\Models\LopHoc;
use App\Models\DangKyNhanLop;
use App\Models\DanhGia;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Quản Trị Viên (Admin)
        $admin = TaiKhoan::create([
            'ho_ten'        => 'Quản Trị Viên Hệ Thống',
            'email'         => 'admin@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000001',
            'vai_tro'       => 'admin',
        ]);

        // 2. Gia Sư mẫu (Tutor)
        $gs1 = TaiKhoan::create([
            'ho_ten'        => 'Nguyễn Văn An (Gia Sư Toán)',
            'email'         => 'giasu@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000002',
            'vai_tro'       => 'giasu',
        ]);

        $gs2 = TaiKhoan::create([
            'ho_ten'        => 'Trần Thị Bích (Gia Sư Tiếng Anh)',
            'email'         => 'giasu2@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000003',
            'vai_tro'       => 'giasu',
        ]);

        // 3. Học Viên / Phụ Huynh mẫu (Student/Parent)
        $hv1 = TaiKhoan::create([
            'ho_ten'        => 'Lê Văn Cường (Phụ Huynh)',
            'email'         => 'hocvien@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000004',
            'vai_tro'       => 'hocvien',
        ]);

        $hv2 = TaiKhoan::create([
            'ho_ten'        => 'Phạm Thị Dung (Học Viên)',
            'email'         => 'hocvien2@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000005',
            'vai_tro'       => 'hocvien',
        ]);

        // Hồ sơ gia sư
        HoSoGiaSu::create([
            'tai_khoan_id'      => $gs1->id,
            'truong_hoc'        => 'Đại học Khoa học Tự nhiên TP.HCM',
            'chuyen_nganh'      => 'Toán - Tin học',
            'kinh_nghiem'       => 'Có 2 năm kinh nghiệm dạy kèm Toán và Lý cho học sinh THPT. Từng ôn thi đại học cho nhiều em đạt điểm cao.',
            'khu_vuc_nhan_day'  => 'Quận 1, Quận 3, Bình Thạnh',
            'trang_thai_duyet'  => 'da_duyet',
        ]);

        HoSoGiaSu::create([
            'tai_khoan_id'      => $gs2->id,
            'truong_hoc'        => 'Đại học Sư phạm TP.HCM',
            'chuyen_nganh'      => 'Sư phạm Tiếng Anh',
            'kinh_nghiem'       => 'Giáo viên Tiếng Anh với 3 năm kinh nghiệm. Chuyên luyện thi IELTS, TOEIC và Tiếng Anh giao tiếp.',
            'khu_vuc_nhan_day'  => 'Quận 7, Quận 8, Nhà Bè',
            'trang_thai_duyet'  => 'da_duyet',
        ]);

        // Lớp học mẫu
        $lop1 = LopHoc::create([
            'hoc_vien_id'      => $hv1->id,
            'mon_hoc'          => 'Toán Đại Số & Hình Học',
            'khoi_lop'         => 'Lớp 12',
            'so_buoi_trung_binh'=> 3,
            'thoi_gian_day'    => 'Tối thứ 2, 4, 6 (18h-20h)',
            'dia_chi_day'      => '123 Nguyễn Thị Minh Khai, Quận 1, TP.HCM',
            'hoc_phi'          => 1500000,
            'yeu_cau_gia_su'   => 'Ưu tiên gia sư sư phạm Toán kinh nghiệm luyện thi đại học.',
            'mo_ta'            => 'Học sinh đang học lớp 12, cần lấy lại gốc Toán để thi tốt nghiệp.',
            'trang_thai'       => 'dang_tim',
        ]);

        $lop2 = LopHoc::create([
            'hoc_vien_id'      => $hv2->id,
            'mon_hoc'          => 'Tiếng Anh Giao Tiếp',
            'khoi_lop'         => 'Lớp 9',
            'so_buoi_trung_binh'=> 2,
            'thoi_gian_day'    => 'Sáng thứ 7, Chủ nhật (9h-11h)',
            'dia_chi_day'      => '456 Lê Văn Sỹ, Quận 3, TP.HCM',
            'hoc_phi'          => 1200000,
            'yeu_cau_gia_su'   => 'Gia sư phát âm chuẩn, có bằng IELTS 6.5 trở lên.',
            'trang_thai'       => 'da_co_gia_su',
            'gia_su_id'        => $gs1->id,
        ]);

        LopHoc::create([
            'hoc_vien_id'      => $hv1->id,
            'mon_hoc'          => 'Vật Lý THPT',
            'khoi_lop'         => 'Lớp 11',
            'so_buoi_trung_binh'=> 2,
            'thoi_gian_day'    => 'Tối thứ 3, 5 (19h-21h)',
            'dia_chi_day'      => '789 Trần Hưng Đạo, Quận 5, TP.HCM',
            'hoc_phi'          => 1300000,
            'yeu_cau_gia_su'   => 'Gia sư kiên nhẫn, giảng bài nhiệt tình dễ hiểu.',
            'trang_thai'       => 'dang_tim',
        ]);

        // Đăng ký nhận lớp
        DangKyNhanLop::create([
            'lop_hoc_id'          => $lop1->id,
            'gia_su_id'           => $gs1->id,
            'gioi_thieu_ban_than' => 'Tôi có nhiều kinh nghiệm dạy Toán 12 và đã giúp nhiều học sinh đạt điểm 8-9 trong kỳ thi đại học.',
            'trang_thai'          => 'cho_duyet',
        ]);

        // Đánh giá gia sư mẫu
        DanhGia::create([
            'lop_hoc_id'  => $lop2->id,
            'gia_su_id'   => $gs1->id,
            'hoc_vien_id' => $hv2->id,
            'so_sao'      => 5,
            'nhan_xet'    => 'Thầy An dạy rất nhiệt tình, đúng giờ và phương pháp truyền đạt cực kỳ dễ hiểu. Con tôi đã tiến bộ rõ rệt!',
        ]);
    }
}