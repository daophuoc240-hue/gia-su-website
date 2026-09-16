<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;
use App\Models\HoSoGiaSu;
use App\Models\LopHoc;
use App\Models\DangKyNhanLop;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Quản Trị Viên (Admin)
         = TaiKhoan::create([
            'ho_ten'        => 'Quản Trị Viên Hệ Thống',
            'email'         => 'admin@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000001',
            'vai_tro'       => 'admin',
        ]);

        // 2. Gia Sư mẫu (Tutor)
         = TaiKhoan::create([
            'ho_ten'        => 'Nguyễn Văn An (Gia Sư Toán)',
            'email'         => 'giasu@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000002',
            'vai_tro'       => 'giasu',
        ]);

         = TaiKhoan::create([
            'ho_ten'        => 'Trần Thị Bích (Gia Sư Tiếng Anh)',
            'email'         => 'giasu2@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000003',
            'vai_tro'       => 'giasu',
        ]);

        // 3. Học Viên / Phụ Huynh mẫu (Student/Parent)
         = TaiKhoan::create([
            'ho_ten'        => 'Lê Văn Cường (Phụ Huynh)',
            'email'         => 'hocvien@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000004',
            'vai_tro'       => 'hocvien',
        ]);

         = TaiKhoan::create([
            'ho_ten'        => 'Phạm Thị Dung (Học Viên)',
            'email'         => 'hocvien2@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000005',
            'vai_tro'       => 'hocvien',
        ]);

        // Hồ sơ gia sư
        HoSoGiaSu::create([
            'tai_khoan_id'      => ->id,
            'truong_hoc'        => 'Đại học Khoa học Tự nhiên TP.HCM',
            'chuyen_nganh'      => 'Toán - Tin học',
            'kinh_nghiem'       => 'Có 2 năm kinh nghiệm dạy kèm Toán và Lý cho học sinh THPT. Từng ôn thi đại học cho nhiều em đạt điểm cao.',
            'khu_vuc_nhan_day'  => 'Quận 1, Quận 3, Bình Thạnh',
            'trang_thai_duyet'  => 'da_duyet',
        ]);

        HoSoGiaSu::create([
            'tai_khoan_id'      => ->id,
            'truong_hoc'        => 'Đại học Sư phạm TP.HCM',
            'chuyen_nganh'      => 'Sư phạm Tiếng Anh',
            'kinh_nghiem'       => 'Giáo viên Tiếng Anh với 3 năm kinh nghiệm. Chuyên luyện thi IELTS, TOEIC và Tiếng Anh giao tiếp.',
            'khu_vuc_nhan_day'  => 'Quận 7, Quận 8, Nhà Bè',
            'trang_thai_duyet'  => 'cho_duyet',
        ]);

        // Lớp học mẫu
         = LopHoc::create([
            'hoc_vien_id'  => ->id,
            'mon_hoc'      => 'Toán Họa',
            'khoi_lop'     => 'Lớp 12',
            'so_buoi_tuan' => 3,
            'dia_chi_day'  => '123 Nguyễn Thị Minh Khai, Quận 1, TP.HCM',
            'muc_hoc_phi'  => 150000,
            'yeu_cau_them' => 'Ưu tiên gia sư có kinh nghiệm luyện thi đại học, học buổi tối.',
            'trang_thai'   => 'dang_tim',
        ]);

         = LopHoc::create([
            'hoc_vien_id'  => ->id,
            'mon_hoc'      => 'Tiếng Anh Giao Tiếp',
            'khoi_lop'     => 'Lớp 9',
            'so_buoi_tuan' => 2,
            'dia_chi_day'  => '456 Lê Văn Sỹ, Quận 3, TP.HCM',
            'muc_hoc_phi'  => 120000,
            'trang_thai'   => 'da_co_gia_su',
            'gia_su_id'    => ->id,
        ]);

        LopHoc::create([
            'hoc_vien_id'  => ->id,
            'mon_hoc'      => 'Vật Lý',
            'khoi_lop'     => 'Lớp 11',
            'so_buoi_tuan' => 2,
            'dia_chi_day'  => '789 Trần Hưng Đạo, Quận 5, TP.HCM',
            'muc_hoc_phi'  => 130000,
            'trang_thai'   => 'dang_tim',
        ]);

        // Đăng ký nhận lớp
        DangKyNhanLop::create([
            'lop_hoc_id'          => ->id,
            'gia_su_id'           => ->id,
            'gioi_thieu_ban_than' => 'Tôi có nhiều kinh nghiệm dạy Toán 12 và đã giúp nhiều học sinh đạt điểm 8-9 trong kỳ thi đại học.',
            'trang_thai'          => 'cho_duyet',
        ]);
    }
}