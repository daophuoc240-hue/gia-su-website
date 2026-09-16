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
        // Admin
        $admin = TaiKhoan::create([
            'ho_ten'        => 'Quản Trị Viên',
            'email'         => 'admin@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000001',
            'vai_tro'       => 'admin',
        ]);

        // Gia sư mẫu
        $gs1 = TaiKhoan::create([
            'ho_ten'        => 'Nguyễn Văn An',
            'email'         => 'giasu1@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000002',
            'vai_tro'       => 'giasu',
        ]);

        $gs2 = TaiKhoan::create([
            'ho_ten'        => 'Trần Thị Bích',
            'email'         => 'giasu2@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000003',
            'vai_tro'       => 'giasu',
        ]);

        // Học viên mẫu
        $hv1 = TaiKhoan::create([
            'ho_ten'        => 'Lê Văn Cường',
            'email'         => 'hocvien1@giasu.com',
            'password'      => Hash::make('password'),
            'so_dien_thoai' => '0901000004',
            'vai_tro'       => 'hocvien',
        ]);

        $hv2 = TaiKhoan::create([
            'ho_ten'        => 'Phạm Thị Dung',
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
            'trang_thai_duyet'  => 'cho_duyet',
        ]);

        // Lớp học mẫu
        $lop1 = LopHoc::create([
            'hoc_vien_id'  => $hv1->id,
            'mon_hoc'      => 'Toán',
            'khoi_lop'     => 'Lớp 12',
            'so_buoi_tuan' => 3,
            'dia_chi_day'  => '123 Nguyễn Thị Minh Khai, Quận 1, TP.HCM',
            'muc_hoc_phi'  => 150000,
            'yeu_cau_them' => 'Ưu tiên gia sư có kinh nghiệm luyện thi đại học, học buổi tối.',
            'trang_thai'   => 'dang_tim',
        ]);

        $lop2 = LopHoc::create([
            'hoc_vien_id'  => $hv2->id,
            'mon_hoc'      => 'Tiếng Anh',
            'khoi_lop'     => 'Lớp 9',
            'so_buoi_tuan' => 2,
            'dia_chi_day'  => '456 Lê Văn Sỹ, Quận 3, TP.HCM',
            'muc_hoc_phi'  => 120000,
            'trang_thai'   => 'da_co_gia_su',
            'gia_su_id'    => $gs1->id,
        ]);

        LopHoc::create([
            'hoc_vien_id'  => $hv1->id,
            'mon_hoc'      => 'Vật Lý',
            'khoi_lop'     => 'Lớp 11',
            'so_buoi_tuan' => 2,
            'dia_chi_day'  => '789 Trần Hưng Đạo, Quận 5, TP.HCM',
            'muc_hoc_phi'  => 130000,
            'trang_thai'   => 'dang_tim',
        ]);

        // Đăng ký nhận lớp
        DangKyNhanLop::create([
            'lop_hoc_id'          => $lop1->id,
            'gia_su_id'           => $gs1->id,
            'gioi_thieu_ban_than' => 'Tôi có nhiều kinh nghiệm dạy Toán 12 và đã giúp nhiều học sinh đạt điểm 8-9 trong kỳ thi đại học.',
            'trang_thai'          => 'cho_duyet',
        ]);
    }
}
