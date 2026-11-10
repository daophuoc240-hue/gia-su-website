<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;
use App\Models\HoSoGiaSu;
use App\Models\LopHoc;
use App\Models\DangKyNhanLop;
use App\Models\DanhGia;
use App\Models\TinNhan;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==================== ADMIN ====================
        $admin = TaiKhoan::create([
            'ho_ten'        => 'Đào Bình Phước (Quản Trị)',
            'email'         => 'phuocadmin@gmail.com',
            'password'      => Hash::make('123456'),
            'so_dien_thoai' => '0394688031',
            'vai_tro'       => 'admin',
        ]);

        // Giữ tài khoản phụ admin@giasu.com để tương thích
        TaiKhoan::create([
            'ho_ten'        => 'Ban Quản Trị Hệ Thống',
            'email'         => 'admin@giasu.com',
            'password'      => Hash::make('123456'),
            'so_dien_thoai' => '0394688031',
            'vai_tro'       => 'admin',
        ]);

        // ==================== GIA SƯ (20 người) ====================
        $danhSachGiaSu = [
            ['ho_ten' => 'Nguyễn Văn An',      'email' => 'giasu@giasu.com',    'sdt' => '0901000002', 'truong' => 'ĐH Sư Phạm TP.HCM',            'nganh' => 'Sư Phạm Toán',            'mon' => 'Toán', 'khu_vuc' => 'Quận 1 (Q.1), Quận 3 (Q.3), Bình Thạnh, TP. Hồ Chí Minh', 'phi' => 150000, 'kinh_nghiem' => 'Hơn 3 năm dạy kèm Toán THPT và luyện thi ĐH. Đã giúp nhiều học sinh đạt 8-9 điểm thi tốt nghiệp.'],
            ['ho_ten' => 'Trần Thị Bích',       'email' => 'giasu2@giasu.com',   'sdt' => '0901000003', 'truong' => 'ĐH Ngoại Ngữ TP.HCM',           'nganh' => 'Sư Phạm Tiếng Anh',        'mon' => 'Tiếng Anh', 'khu_vuc' => 'Quận 7, Quận 8, Nhà Bè, TP. Hồ Chí Minh', 'phi' => 180000, 'kinh_nghiem' => 'IELTS 7.5. Chuyên luyện thi IELTS/TOEIC và Tiếng Anh giao tiếp cho người đi làm.'],
            ['ho_ten' => 'Phạm Minh Tuấn',      'email' => 'giasu3@giasu.com',   'sdt' => '0901000004', 'truong' => 'ĐH Bách Khoa TP.HCM',            'nganh' => 'Vật Lý Kỹ Thuật',          'mon' => 'Vật Lý', 'khu_vuc' => 'Quận 5, Quận 10, Quận 11, TP. Hồ Chí Minh', 'phi' => 160000, 'kinh_nghiem' => 'Sinh viên xuất sắc ngành Vật Lý. Dạy kèm Lý THPT từ lớp 10 đến 12, phương pháp rõ ràng dễ hiểu.'],
            ['ho_ten' => 'Lê Thị Hương',        'email' => 'giasu4@giasu.com',   'sdt' => '0901000005', 'truong' => 'ĐH Sư Phạm Hà Nội',             'nganh' => 'Sư Phạm Ngữ Văn',          'mon' => 'Ngữ Văn', 'khu_vuc' => 'Quận Cầu Giấy, Quận Ba Đình, Hà Nội', 'phi' => 130000, 'kinh_nghiem' => 'Giáo viên Ngữ Văn với 4 năm kinh nghiệm. Chuyên luyện văn nghị luận và thi vào lớp 10, thi tốt nghiệp.'],
            ['ho_ten' => 'Hoàng Đức Mạnh',      'email' => 'giasu5@giasu.com',   'sdt' => '0901000006', 'truong' => 'ĐH Hàng Hải Việt Nam',          'nganh' => 'Hóa Học',                  'mon' => 'Hóa Học', 'khu_vuc' => 'Quận Lê Chân, Quận Ngô Quyền, Hải Phòng', 'phi' => 155000, 'kinh_nghiem' => 'Từng đạt Học sinh giỏi Hóa cấp Tỉnh. Dạy Hóa THPT chuyên sâu, luyện thi ĐH khối B.'],
            ['ho_ten' => 'Nguyễn Thị Lan',      'email' => 'giasu6@giasu.com',   'sdt' => '0901000007', 'truong' => 'ĐH Y Dược TP.HCM',              'nganh' => 'Dược Học',                 'mon' => 'Sinh Học', 'khu_vuc' => 'Quận 1, Quận 4, Quận 7, TP. Hồ Chí Minh', 'phi' => 170000, 'kinh_nghiem' => 'Sinh viên Y Dược giỏi. Dạy kèm Sinh Học THPT và luyện thi ĐH khối B, rất kiên nhẫn và tận tình.'],
            ['ho_ten' => 'Võ Thanh Hải',        'email' => 'giasu7@giasu.com',   'sdt' => '0901000008', 'truong' => 'ĐH Tin Học TP.HCM',              'nganh' => 'Công Nghệ Thông Tin',      'mon' => 'Tin Học', 'khu_vuc' => 'Quận Bình Thạnh, Gò Vấp, Tân Bình, TP. Hồ Chí Minh', 'phi' => 200000, 'kinh_nghiem' => 'Lập trình viên 2 năm kinh nghiệm. Dạy Tin Học phổ thông, lập trình Python/C++ cho học sinh.'],
            ['ho_ten' => 'Trần Văn Kiên',       'email' => 'giasu8@giasu.com',   'sdt' => '0901000009', 'truong' => 'ĐH Kinh Tế TP.HCM',             'nganh' => 'Toán Kinh Tế',             'mon' => 'Toán', 'khu_vuc' => 'Quận 3, Quận 10, Phú Nhuận, TP. Hồ Chí Minh', 'phi' => 145000, 'kinh_nghiem' => 'Sinh viên xuất sắc Toán Kinh Tế. Dạy kèm Toán THCS và THPT, ôn thi vào lớp 10 chuyên.'],
            ['ho_ten' => 'Đinh Thị Mai',        'email' => 'giasu9@giasu.com',   'sdt' => '0901000010', 'truong' => 'ĐH Cần Thơ',                     'nganh' => 'Sư Phạm Địa Lý',           'mon' => 'Địa Lý', 'khu_vuc' => 'Quận Ninh Kiều, Quận Cái Răng, Cần Thơ', 'phi' => 120000, 'kinh_nghiem' => 'Giáo viên Địa Lý tâm huyết. Dạy kèm Địa THPT, giúp học sinh hiểu bản đồ và địa lý kinh tế.'],
            ['ho_ten' => 'Lý Quốc Tuấn',        'email' => 'giasu10@giasu.com',  'sdt' => '0901000011', 'truong' => 'ĐH Sư Phạm TP.HCM',             'nganh' => 'Sư Phạm Lịch Sử',          'mon' => 'Lịch Sử', 'khu_vuc' => 'Quận Tân Phú, Bình Tân, TP. Hồ Chí Minh', 'phi' => 120000, 'kinh_nghiem' => 'Giáo viên Sử tận tâm. Dạy Lịch Sử theo hướng kể chuyện, học sinh dễ nhớ và yêu thích môn học.'],
            ['ho_ten' => 'Phan Thị Xuân',       'email' => 'giasu11@giasu.com',  'sdt' => '0901000012', 'truong' => 'ĐH Ngoại Ngữ Hà Nội',            'nganh' => 'Tiếng Nhật',               'mon' => 'Tiếng Nhật', 'khu_vuc' => 'Quận 1, Quận 3, Phú Nhuận, TP. Hồ Chí Minh', 'phi' => 200000, 'kinh_nghiem' => 'Đã học và làm việc tại Nhật 2 năm. Dạy Tiếng Nhật từ N5 đến N3, phát âm chuẩn, giao tiếp thực tế.'],
            ['ho_ten' => 'Bùi Văn Thắng',       'email' => 'giasu12@giasu.com',  'sdt' => '0901000013', 'truong' => 'ĐH Thủ Dầu Một',                 'nganh' => 'Toán - Tin học',            'mon' => 'Toán', 'khu_vuc' => 'TP. Thủ Dầu Một, TP. Thuận An, Bình Dương', 'phi' => 160000, 'kinh_nghiem' => 'Học sinh giỏi Toán quốc gia. Dạy Toán chuyên và ôn thi ĐH, đặc biệt giỏi đại số và giải tích.'],
            ['ho_ten' => 'Ngô Thị Hoa',         'email' => 'giasu13@giasu.com',  'sdt' => '0901000014', 'truong' => 'ĐH Sư Phạm TP.HCM',             'nganh' => 'Giáo Dục Tiểu Học',        'mon' => 'Tiểu Học', 'khu_vuc' => 'Quận 4, Quận 7, Quận 8, TP. Hồ Chí Minh', 'phi' => 100000, 'kinh_nghiem' => 'Chuyên dạy kèm Toán và Tiếng Việt cho học sinh Tiểu học. Phương pháp vui vẻ, sinh động, trẻ rất thích.'],
            ['ho_ten' => 'Dương Văn Long',      'email' => 'giasu14@giasu.com',  'sdt' => '0901000015', 'truong' => 'ĐH Bách Khoa TP.HCM',            'nganh' => 'Cơ Khí',                   'mon' => 'Vật Lý', 'khu_vuc' => 'Quận 1, Bình Thạnh, Gò Vấp, TP. Hồ Chí Minh', 'phi' => 155000, 'kinh_nghiem' => 'Kỹ sư cơ khí với kiến thức Vật Lý nền tảng vững chắc. Dạy Lý theo hướng ứng dụng thực tế.'],
            ['ho_ten' => 'Châu Minh Phúc',      'email' => 'giasu15@giasu.com',  'sdt' => '0901000016', 'truong' => 'ĐH Đồng Nai',                    'nganh' => 'Tài Chính - Kế Toán',      'mon' => 'Toán', 'khu_vuc' => 'TP. Biên Hòa, Huyện Long Thành, Đồng Nai', 'phi' => 140000, 'kinh_nghiem' => 'Dạy kèm Toán THPT 2 năm. Có khả năng giải thích các vấn đề phức tạp một cách đơn giản, dễ hiểu.'],
            ['ho_ten' => 'Nguyễn Ngọc Tú',      'email' => 'giasu16@giasu.com',  'sdt' => '0901000017', 'truong' => 'ĐH Quốc Tế TP.HCM',             'nganh' => 'Kinh Doanh Quốc Tế',       'mon' => 'Tiếng Anh', 'khu_vuc' => 'TP. Thủ Đức, TP. Hồ Chí Minh', 'phi' => 220000, 'kinh_nghiem' => 'IELTS 8.0 Overall. Dạy Tiếng Anh học thuật và giao tiếp, luyện Speaking và Writing IELTS.'],
            ['ho_ten' => 'Trịnh Thị Thu',       'email' => 'giasu17@giasu.com',  'sdt' => '0901000018', 'truong' => 'ĐH Sư Phạm TP.HCM',             'nganh' => 'Sư Phạm Toán',             'mon' => 'Toán', 'khu_vuc' => 'Quận Nhà Bè, Bình Chánh, Hóc Môn, TP. Hồ Chí Minh', 'phi' => 130000, 'kinh_nghiem' => 'Giáo viên Toán THCS 3 năm. Dạy kèm toán từ lớp 6 đến 9, ôn thi vào lớp 10 chuyên.'],
            ['ho_ten' => 'Vũ Quốc Khánh',       'email' => 'giasu18@giasu.com',  'sdt' => '0901000019', 'truong' => 'ĐH Khoa Học Huế',                'nganh' => 'Hóa Học',                  'mon' => 'Hóa Học', 'khu_vuc' => 'TP. Huế, Thị xã Hương Thủy, Thừa Thiên Huế', 'phi' => 145000, 'kinh_nghiem' => 'Nghiên cứu sinh Hóa học. Dạy Hóa THPT và ĐH theo hướng hiểu bản chất, không học thuộc lòng.'],
            ['ho_ten' => 'Huỳnh Thị Nga',       'email' => 'giasu19@giasu.com',  'sdt' => '0901000020', 'truong' => 'ĐH Ngoại Ngữ Đà Nẵng',           'nganh' => 'Thương Mại Quốc Tế',       'mon' => 'Tiếng Anh', 'khu_vuc' => 'Quận Hải Châu, Quận Thanh Khê, Đà Nẵng', 'phi' => 180000, 'kinh_nghiem' => 'TOEIC 920. Dạy Tiếng Anh thương mại và giao tiếp doanh nghiệp, luyện thi TOEIC cấp tốc.'],
            ['ho_ten' => 'Cao Đức Minh',        'email' => 'giasu20@giasu.com',  'sdt' => '0901000021', 'truong' => 'ĐH Bách Khoa Hà Nội',            'nganh' => 'Công Nghệ Thông Tin',      'mon' => 'Tin Học', 'khu_vuc' => 'Quận Cầu Giấy, Quận Nam Từ Liêm, Hà Nội', 'phi' => 210000, 'kinh_nghiem' => 'Kỹ sư phần mềm 3 năm. Dạy lập trình web, Python, Java cho học sinh THPT và sinh viên.'],

            // ==================== GIA SƯ NGHỆ AN (14 người) ====================
            ['ho_ten' => 'Nguyễn Thị Quỳnh Trang', 'email' => 'giasu_na1@giasu.com',  'sdt' => '0912111001', 'truong' => 'ĐH Sư Phạm Vinh',            'nganh' => 'Sư Phạm Toán Học',         'mon' => 'Toán', 'khu_vuc' => 'TP. Vinh, Huyện Hưng Nguyên, Nghệ An', 'phi' => 150000, 'kinh_nghiem' => 'Cựu học sinh Chuyên Phan Bội Châu - Nghệ An, tốt nghiệp ĐH Sư Phạm Vinh loại Giỏi. Hơn 4 năm kinh nghiệm luyện thi vào lớp 10 chuyên và THPT Quốc gia.'],
            ['ho_ten' => 'Phan Văn Hoàng Nam',     'email' => 'giasu_na2@giasu.com',  'sdt' => '0912111002', 'truong' => 'ĐH Vinh',                    'nganh' => 'Sư Phạm Tiếng Anh',         'mon' => 'Tiếng Anh', 'khu_vuc' => 'TP. Vinh, Thị xã Cửa Lò, Nghệ An', 'phi' => 180000, 'kinh_nghiem' => 'IELTS 8.0, giảng viên trẻ tại Trung tâm Anh ngữ TP. Vinh. Chuyên luyện thi chứng chỉ IELTS, TOEIC và kèm tiếng Anh học thuật cho học sinh cấp 2, cấp 3.'],
            ['ho_ten' => 'Trần Thị Thu Hằng',      'email' => 'giasu_na3@giasu.com',  'sdt' => '0912111003', 'truong' => 'ĐH Y Khoa Vinh',              'nganh' => 'Bác Sĩ Đa Khoa',           'mon' => 'Hóa Học', 'khu_vuc' => 'TP. Vinh, Huyện Nghi Lộc, Nghệ An', 'phi' => 160000, 'kinh_nghiem' => 'Đạt 28.5 điểm khối B kỳ thi Đại học. Kinh nghiệm 3 năm gia sư Hóa THPT và ôn thi chuyên sâu khối B, phương pháp ghi nhớ nhanh và phản xạ làm trắc nghiệm.'],
            ['ho_ten' => 'Lê Đình Mạnh',           'email' => 'giasu_na4@giasu.com',  'sdt' => '0912111004', 'truong' => 'ĐH Sư Phạm Kỹ Thuật Vinh',   'nganh' => 'Công Nghệ Thông Tin',       'mon' => 'Tin Học', 'khu_vuc' => 'TP. Vinh, Huyện Đô Lương, Nghệ An', 'phi' => 170000, 'kinh_nghiem' => 'Kỹ sư CNTT, từng đạt giải Nhất Hội thi Tin học trẻ tỉnh Nghệ An. Dạy kèm lập trình Python, C++ và Tin học cơ bản cho học sinh THCS, THPT.'],
            ['ho_ten' => 'Ngô Thị Ánh Tuyết',      'email' => 'giasu_na5@giasu.com',  'sdt' => '0912111005', 'truong' => 'ĐH Vinh',                    'nganh' => 'Sư Phạm Ngữ Văn',           'mon' => 'Ngữ Văn', 'khu_vuc' => 'TP. Vinh, Huyện Nam Đàn, Nghệ An', 'phi' => 140000, 'kinh_nghiem' => 'Giáo viên Ngữ Văn THPT tại Nghệ An, chuyên bồi dưỡng học sinh thi vào lớp 10 và kỳ thi tốt nghiệp THPT với kỹ năng làm văn nghị luận đạt điểm cao.'],
            ['ho_ten' => 'Đặng Thái Sơn',          'email' => 'giasu_na6@giasu.com',  'sdt' => '0912111006', 'truong' => 'ĐH Sư Phạm Vinh',            'nganh' => 'Sư Phạm Vật Lý',           'mon' => 'Vật Lý', 'khu_vuc' => 'Huyện Diễn Châu, Huyện Yên Thành, Nghệ An', 'phi' => 150000, 'kinh_nghiem' => 'Giải Nhì Vật lý cấp tỉnh Nghệ An. Tận tâm, nhiệt tình, chuyên củng cố kiến thức từ cơ bản đến nâng cao cho học sinh mất gốc hoặc chuẩn bị thi tuyển sinh.'],
            ['ho_ten' => 'Võ Thị Thanh Thảo',      'email' => 'giasu_na7@giasu.com',  'sdt' => '0912111007', 'truong' => 'ĐH Vinh',                    'nganh' => 'Giáo Dục Tiểu Học',         'mon' => 'Tiểu Học', 'khu_vuc' => 'TP. Vinh, Huyện Hưng Nguyên, Nghệ An', 'phi' => 120000, 'kinh_nghiem' => 'Tốt nghiệp ngành Sư phạm Tiểu học ĐH Vinh. Rèn chữ đẹp, dạy Toán tư duy và Tiếng Việt cho các bé lớp 1 đến lớp 5, kiên nhẫn và được học trò yêu quý.'],
            ['ho_ten' => 'Hoàng Văn Đức',          'email' => 'giasu_na8@giasu.com',  'sdt' => '0912111008', 'truong' => 'ĐH Sư Phạm Vinh',            'nganh' => 'Sư Phạm Toán Học',         'mon' => 'Toán', 'khu_vuc' => 'Huyện Quỳnh Lưu, Thị xã Hoàng Mai, Nghệ An', 'phi' => 145000, 'kinh_nghiem' => 'Kinh nghiệm 5 năm dạy kèm Toán THCS và THPT khu vực Quỳnh Lưu, Hoàng Mai. Ôn thi vào 10 và bám sát ma trận đề thi các năm.'],
            ['ho_ten' => 'Bùi Thị Ngọc Mai',       'email' => 'giasu_na9@giasu.com',  'sdt' => '0912111009', 'truong' => 'ĐH Y Khoa Vinh',              'nganh' => 'Y Khoa',                   'mon' => 'Sinh Học', 'khu_vuc' => 'TP. Vinh, Thị xã Cửa Lò, Nghệ An', 'phi' => 160000, 'kinh_nghiem' => 'Sinh viên năm cuối ĐH Y Khoa Vinh. Đam mê môn Sinh, dạy kèm Sinh 10, 11, 12 và luyện đề thi THPT Quốc Gia với sơ đồ tư duy sinh động.'],
            ['ho_ten' => 'Dương Quốc Bảo',         'email' => 'giasu_na10@giasu.com', 'sdt' => '0912111010', 'truong' => 'ĐH Ngoại Ngữ Hà Nội',        'nganh' => 'Tiếng Trung Quốc',         'mon' => 'Tiếng Trung', 'khu_vuc' => 'TP. Vinh, Huyện Nghi Lộc, Nghệ An', 'phi' => 190000, 'kinh_nghiem' => 'Chứng chỉ HSK6 và HSKK Cao cấp. Dạy Tiếng Trung giao tiếp, chuẩn bị du học và thi lấy chứng chỉ cho học sinh, sinh viên và người đi làm tại TP. Vinh.'],
            ['ho_ten' => 'Phạm Quang Huy',         'email' => 'giasu_na11@giasu.com', 'sdt' => '0912111011', 'truong' => 'ĐH Sư Phạm Vinh',            'nganh' => 'Sư Phạm Hóa Học',          'mon' => 'Hóa Học', 'khu_vuc' => 'Huyện Thanh Chương, Huyện Đô Lương, Nghệ An', 'phi' => 140000, 'kinh_nghiem' => 'Giáo viên Hóa trẻ trung, tâm huyết. Chuyên lấy lại căn bản Hóa học cho học sinh THCS và THPT, dạy trực quan dễ tiếp thu.'],
            ['ho_ten' => 'Nguyễn Đăng Khoa',       'email' => 'giasu_na12@giasu.com', 'sdt' => '0912111012', 'truong' => 'ĐH Bách Khoa Hà Nội',        'nganh' => 'Kỹ Thuật Điện Tử',         'mon' => 'Toán', 'khu_vuc' => 'Thị xã Thái Hòa, Huyện Nghĩa Đàn, Nghệ An', 'phi' => 155000, 'kinh_nghiem' => 'Cựu sinh viên Bách Khoa, có tư duy logic sắc bén. Kèm Toán từ lớp 8 đến 12 khu vực Thái Hòa, Nghĩa Đàn và dạy online toàn tỉnh Nghệ An.'],
            ['ho_ten' => 'Lê Thị Bích Hạnh',       'email' => 'giasu_na13@giasu.com', 'sdt' => '0912111013', 'truong' => 'ĐH Vinh',                    'nganh' => 'Sư Phạm Lịch Sử',          'mon' => 'Lịch Sử', 'khu_vuc' => 'TP. Vinh, Huyện Nam Đàn, Nghệ An', 'phi' => 130000, 'kinh_nghiem' => 'Dạy Lịch Sử theo hệ thống mốc thời gian và sơ đồ hóa sự kiện, giúp học sinh nhớ lâu và đạt điểm 8+ trong kỳ thi tốt nghiệp THPT.'],
            ['ho_ten' => 'Chu Thị Cẩm Tú',         'email' => 'giasu_na14@giasu.com', 'sdt' => '0912111014', 'truong' => 'ĐH Vinh',                    'nganh' => 'Sư Phạm Tiếng Anh',         'mon' => 'Tiếng Anh', 'khu_vuc' => 'Huyện Diễn Châu, Huyện Quỳnh Lưu, Nghệ An', 'phi' => 160000, 'kinh_nghiem' => 'Chứng chỉ C1 Châu Âu (CEFR). Hơn 3 năm kinh nghiệm kèm ngữ pháp và phát âm tiếng Anh cho học sinh cấp 2, 3 khu vực Diễn Châu, Quỳnh Lưu.'],
        ];

        $giaSuAccounts = [];
        foreach ($danhSachGiaSu as $i => $gs) {
            $acc = TaiKhoan::create([
                'ho_ten'        => $gs['ho_ten'],
                'email'         => $gs['email'],
                'password'      => Hash::make('123456'),
                'so_dien_thoai' => $gs['sdt'],
                'vai_tro'       => 'giasu',
            ]);

            $sampleLichDay = [
                'Tối Thứ 2, Thứ 4, Thứ 6 (18:30 - 20:30); Chiều Thứ 7, Chủ Nhật (14:00 - 16:30)',
                'Tối Thứ 3, Thứ 5, Thứ 7 (19:00 - 21:00); Sáng Chủ Nhật (08:30 - 11:00)',
                'Chiều Thứ 2, Thứ 4 (15:00 - 17:30); Tối Thứ 6, Chủ Nhật (18:00 - 20:00)',
                'Tối các ngày trong tuần Thứ 2 đến Thứ 6 (18:00 - 20:00)',
                'Sáng Thứ 7, Chủ Nhật (08:00 - 11:30); Tối Thứ 3, Thứ 5 (18:30 - 20:30)'
            ];

            $hoSo = HoSoGiaSu::create([
                'tai_khoan_id'      => $acc->id,
                'truong_hoc'        => $gs['truong'],
                'chuyen_nganh'      => $gs['nganh'],
                'mon_day'           => $gs['mon'],
                'kinh_nghiem'       => $gs['kinh_nghiem'],
                'khu_vuc_nhan_day'  => $gs['khu_vuc'],
                'hoc_phi_theo_gio'  => $gs['phi'],
                'trang_thai_duyet'  => ($i < 15 || str_contains($gs['email'], 'giasu_na')) ? 'da_duyet' : 'cho_duyet',
                'so_lop_da_day'     => rand(2, 20),
                'lich_day'          => $sampleLichDay[$i % count($sampleLichDay)],
            ]);

            $giaSuAccounts[] = ['acc' => $acc, 'ho_so' => $hoSo];
        }

        // ==================== HỌC VIÊN / PHỤ HUYNH (11 người) ====================
        $danhSachHocVien = [
            ['ho_ten' => 'Đào Bình Phước',      'email' => 'daophuoc20@gmail.com', 'sdt' => '0394688031'],
            ['ho_ten' => 'Lê Văn Cường',        'email' => 'hocvien@giasu.com',    'sdt' => '0901000022'],
            ['ho_ten' => 'Phạm Thị Dung',        'email' => 'hocvien2@giasu.com',   'sdt' => '0901000023'],
            ['ho_ten' => 'Vũ Thị Thanh Hà',      'email' => 'hocvien3@giasu.com',   'sdt' => '0901000024'],
            ['ho_ten' => 'Nguyễn Hùng Cường',    'email' => 'hocvien4@giasu.com',   'sdt' => '0901000025'],
            ['ho_ten' => 'Trần Thị Kim Liên',     'email' => 'hocvien5@giasu.com',   'sdt' => '0901000026'],
            ['ho_ten' => 'Bùi Quang Vinh',        'email' => 'hocvien6@giasu.com',   'sdt' => '0901000027'],
            ['ho_ten' => 'Đặng Thị Hồng Nhung',  'email' => 'hocvien7@giasu.com',   'sdt' => '0901000028'],
            ['ho_ten' => 'Hoàng Văn Sơn',         'email' => 'hocvien8@giasu.com',   'sdt' => '0901000029'],
            ['ho_ten' => 'Lý Thị Ngọc Ánh',      'email' => 'hocvien9@giasu.com',   'sdt' => '0901000030'],
            ['ho_ten' => 'Chu Đức Thành',         'email' => 'hocvien10@giasu.com',  'sdt' => '0901000031'],
        ];

        $hocVienAccounts = [];
        foreach ($danhSachHocVien as $hv) {
            $hocVienAccounts[] = TaiKhoan::create([
                'ho_ten'        => $hv['ho_ten'],
                'email'         => $hv['email'],
                'password'      => Hash::make('123456'),
                'so_dien_thoai' => $hv['sdt'],
                'vai_tro'       => 'hocvien',
            ]);
        }

        // ==================== LỚP HỌC (30 lớp) ====================
        $danhSachLop = [
            ['mon' => 'Toán Đại Số & Hình Học', 'khoi' => 'Lớp 12', 'buoi' => 3, 'lich' => 'Thứ 2, Thứ 4, Thứ 6 (18:00 - 19:30)', 'dia_chi' => '123 Nguyễn Thị Minh Khai, Quận 1 (Q.1), TP. Hồ Chí Minh', 'phi' => 1500000, 'yc' => 'Ưu tiên gia sư sư phạm Toán, kinh nghiệm luyện thi ĐH', 'tt' => 'dang_tim', 'hv_idx' => 0],
            ['mon' => 'Tiếng Anh IELTS', 'khoi' => 'Lớp 12', 'buoi' => 2, 'lich' => 'Thứ 3, Thứ 5 (19:30 - 21:00)', 'dia_chi' => '45 Lê Văn Sỹ, Quận 3 (Q.3), TP. Hồ Chí Minh', 'phi' => 1800000, 'yc' => 'Gia sư IELTS 7.0+ có kinh nghiệm luyện thi', 'tt' => 'dang_tim', 'hv_idx' => 1],
            ['mon' => 'Vật Lý THPT', 'khoi' => 'Lớp 11', 'buoi' => 2, 'lich' => 'Thứ 4, Thứ 7 (17:30 - 19:00)', 'dia_chi' => '67 Trần Hưng Đạo, Quận 5 (Q.5), TP. Hồ Chí Minh', 'phi' => 1300000, 'yc' => 'Gia sư kiên nhẫn, giảng rõ ràng', 'tt' => 'dang_tim', 'hv_idx' => 2],
            ['mon' => 'Hóa Học', 'khoi' => 'Lớp 11', 'buoi' => 2, 'lich' => 'Thứ 3, Thứ 6 (18:00 - 19:30)', 'dia_chi' => '89 Nguyễn Trãi, Quận 5 (Q.5), TP. Hồ Chí Minh', 'phi' => 1200000, 'yc' => 'Gia sư Hóa vui vẻ, chia sẻ tài liệu ôn thi', 'tt' => 'dang_tim', 'hv_idx' => 3],
            ['mon' => 'Ngữ Văn', 'khoi' => 'Lớp 12', 'buoi' => 2, 'lich' => 'Thứ 2, Thứ 5 (19:00 - 20:30)', 'dia_chi' => '12 Bà Huyện Thanh Quan, Quận 3 (Q.3), TP. Hồ Chí Minh', 'phi' => 1100000, 'yc' => 'Gia sư Văn giỏi nghị luận, cẩn thận sửa bài', 'tt' => 'dang_tim', 'hv_idx' => 4],
            ['mon' => 'Sinh Học', 'khoi' => 'Lớp 12', 'buoi' => 2, 'lich' => 'Thứ 7, Chủ Nhật (08:30 - 10:00)', 'dia_chi' => '34 Lý Chính Thắng, Quận 3 (Q.3), TP. Hồ Chí Minh', 'phi' => 1200000, 'yc' => 'Gia sư Sinh luyện thi khối B', 'tt' => 'dang_tim', 'hv_idx' => 5],
            ['mon' => 'Toán - Tiếng Việt', 'khoi' => 'Lớp 3', 'buoi' => 3, 'lich' => 'Thứ 2, Thứ 4, Thứ 6 (17:00 - 18:30)', 'dia_chi' => '56 Cách Mạng Tháng 8, Quận 10 (Q.10), TP. Hồ Chí Minh', 'phi' => 800000, 'yc' => 'Gia sư cẩn thận, yêu trẻ, có kinh nghiệm dạy tiểu học', 'tt' => 'dang_tim', 'hv_idx' => 6],
            ['mon' => 'Tiếng Anh Giao Tiếp', 'khoi' => 'Lớp 8', 'buoi' => 2, 'lich' => 'Thứ 3, Thứ 7 (18:30 - 20:00)', 'dia_chi' => '78 Đinh Tiên Hoàng, Quận Bình Thạnh, TP. Hồ Chí Minh', 'phi' => 1000000, 'yc' => 'Gia sư phát âm chuẩn, tạo môi trường nói tốt', 'tt' => 'dang_tim', 'hv_idx' => 7],
            ['mon' => 'Toán', 'khoi' => 'Lớp 9', 'buoi' => 3, 'lich' => 'Thứ 2, Thứ 4, Thứ 6 (19:00 - 20:30)', 'dia_chi' => '90 Xô Viết Nghệ Tĩnh, Quận Bình Thạnh, TP. Hồ Chí Minh', 'phi' => 1100000, 'yc' => 'Ôn thi vào lớp 10 chuyên Toán', 'tt' => 'dang_tim', 'hv_idx' => 8],
            ['mon' => 'Vật Lý', 'khoi' => 'Lớp 10', 'buoi' => 2, 'lich' => 'Thứ 3, Thứ 5 (17:30 - 19:00)', 'dia_chi' => '13 Bình Giã, Quận Tân Bình, TP. Hồ Chí Minh', 'phi' => 1000000, 'yc' => 'Học sinh mới lên 10, cần củng cố kiến thức cơ bản', 'tt' => 'dang_tim', 'hv_idx' => 9],
            ['mon' => 'Tiếng Nhật N4', 'khoi' => 'Đại học', 'buoi' => 2, 'lich' => 'Thứ 7, Chủ Nhật (14:00 - 15:30)', 'dia_chi' => '5 Nguyễn Đình Chiểu, Quận 3 (Q.3), TP. Hồ Chí Minh', 'phi' => 1500000, 'yc' => 'Gia sư Nhật từng học/làm việc tại Nhật', 'tt' => 'dang_tim', 'hv_idx' => 0],
            ['mon' => 'Lập Trình Python', 'khoi' => 'Đại học', 'buoi' => 2, 'lich' => 'Thứ 2, Thứ 5 (19:30 - 21:00)', 'dia_chi' => '23 Hai Bà Trưng, Quận 1 (Q.1), TP. Hồ Chí Minh', 'phi' => 2000000, 'yc' => 'Học lập trình từ đầu, ưu tiên gia sư IT đang đi làm', 'tt' => 'dang_tim', 'hv_idx' => 1],
            ['mon' => 'Toán Nâng Cao', 'khoi' => 'Lớp 6', 'buoi' => 3, 'lich' => 'Thứ 3, Thứ 5, Thứ 7 (18:00 - 19:30)', 'dia_chi' => '41 Huỳnh Tịnh Của, Quận 3 (Q.3), TP. Hồ Chí Minh', 'phi' => 900000, 'yc' => 'Con học trường chuyên, cần ôn nâng cao', 'tt' => 'dang_tim', 'hv_idx' => 2],
            ['mon' => 'Hóa Đại Cương', 'khoi' => 'Đại học', 'buoi' => 2, 'lich' => 'Thứ 4, Chủ Nhật (18:00 - 19:30)', 'dia_chi' => '67 Phan Xích Long, Quận Phú Nhuận, TP. Hồ Chí Minh', 'phi' => 1400000, 'yc' => 'Sinh viên năm 1 Y Dược cần học Hóa nền', 'tt' => 'dang_tim', 'hv_idx' => 3],
            ['mon' => 'Tiếng Anh Toeic', 'khoi' => 'Đại học', 'buoi' => 3, 'lich' => 'Thứ 2, Thứ 4, Thứ 6 (19:30 - 21:00)', 'dia_chi' => '99 Nguyễn Oanh, Quận Gò Vấp, TP. Hồ Chí Minh', 'phi' => 1600000, 'yc' => 'Ôn TOEIC 700+ trong 2 tháng', 'tt' => 'dang_tim', 'hv_idx' => 4],
            ['mon' => 'Toán', 'khoi' => 'Lớp 5', 'buoi' => 2, 'lich' => 'Thứ 7, Chủ Nhật (09:00 - 10:30)', 'dia_chi' => '15 Trường Chinh, Quận Tân Bình, TP. Hồ Chí Minh', 'phi' => 700000, 'yc' => 'Con lớp 5 cần ôn thi chuyển cấp', 'tt' => 'dang_tim', 'hv_idx' => 5],
            ['mon' => 'Văn - Sử - Địa', 'khoi' => 'Lớp 12', 'buoi' => 3, 'lich' => 'Thứ 3, Thứ 5, Thứ 7 (19:00 - 20:30)', 'dia_chi' => '27 Âu Cơ, Quận Tân Phú, TP. Hồ Chí Minh', 'phi' => 1300000, 'yc' => 'Luyện thi ĐH khối C, ưu tiên kinh nghiệm', 'tt' => 'dang_tim', 'hv_idx' => 6],
            ['mon' => 'Toán & Lý', 'khoi' => 'Lớp 11', 'buoi' => 4, 'lich' => 'Thứ 2, Thứ 3, Thứ 5, Thứ 6 (18:00 - 19:30)', 'dia_chi' => '88 Lê Quang Định, Quận Bình Thạnh, TP. Hồ Chí Minh', 'phi' => 2200000, 'yc' => 'Cần 1 gia sư dạy cả Toán lẫn Lý', 'tt' => 'dang_tim', 'hv_idx' => 7],
            ['mon' => 'Tiếng Trung HSK3', 'khoi' => 'Lớp 9', 'buoi' => 2, 'lich' => 'Thứ 4, Thứ 6 (18:30 - 20:00)', 'dia_chi' => '3 Trần Não, Quận 2 (TP. Thủ Đức), TP. Hồ Chí Minh', 'phi' => 1200000, 'yc' => 'Học Tiếng Trung từ A0, phát âm chuẩn', 'tt' => 'dang_tim', 'hv_idx' => 8],
            ['mon' => 'Toán Tư Duy', 'khoi' => 'Lớp 1', 'buoi' => 2, 'lich' => 'Thứ 7, Chủ Nhật (10:00 - 11:30)', 'dia_chi' => '11 Nguyễn Thị Định, Quận 2 (TP. Thủ Đức), TP. Hồ Chí Minh', 'phi' => 600000, 'yc' => 'Gia sư vui vẻ, kiên nhẫn dạy bé lớp 1', 'tt' => 'dang_tim', 'hv_idx' => 9],
            // Lớp đã có gia sư
            ['mon' => 'Tiếng Anh Giao Tiếp', 'khoi' => 'Lớp 9', 'buoi' => 2, 'lich' => 'Thứ 3, Thứ 5 (18:00 - 19:30)', 'dia_chi' => '456 Lê Văn Sỹ, Quận 3 (Q.3), TP. Hồ Chí Minh', 'phi' => 1200000, 'yc' => 'Gia sư phát âm chuẩn, IELTS 6.5+', 'tt' => 'da_co_gia_su', 'hv_idx' => 0, 'gs_idx' => 0],
            ['mon' => 'Vật Lý THPT', 'khoi' => 'Lớp 12', 'buoi' => 2, 'lich' => 'Thứ 2, Thứ 4 (19:30 - 21:00)', 'dia_chi' => '789 Trần Hưng Đạo, Quận 5 (Q.5), TP. Hồ Chí Minh', 'phi' => 1300000, 'yc' => 'Luyện thi ĐH khối A', 'tt' => 'da_co_gia_su', 'hv_idx' => 1, 'gs_idx' => 2],
            ['mon' => 'Hóa Học', 'khoi' => 'Lớp 12', 'buoi' => 3, 'lich' => 'Thứ 3, Thứ 5, Thứ 7 (18:00 - 19:30)', 'dia_chi' => '22 Đinh Bộ Lĩnh, Quận Bình Thạnh, TP. Hồ Chí Minh', 'phi' => 1400000, 'yc' => 'Ôn thi ĐH khối B chuyên sâu', 'tt' => 'da_co_gia_su', 'hv_idx' => 2, 'gs_idx' => 4],
            ['mon' => 'Lập Trình Web', 'khoi' => 'Đại học', 'buoi' => 2, 'lich' => 'Thứ 6, Chủ Nhật (19:00 - 20:30)', 'dia_chi' => '55 Đinh Tiên Hoàng, Quận 1 (Q.1), TP. Hồ Chí Minh', 'phi' => 2500000, 'yc' => 'Học ReactJS/Laravel', 'tt' => 'da_co_gia_su', 'hv_idx' => 3, 'gs_idx' => 6],
            ['mon' => 'Toán Tiểu Học', 'khoi' => 'Lớp 4', 'buoi' => 3, 'lich' => 'Thứ 2, Thứ 4, Thứ 6 (17:30 - 19:00)', 'dia_chi' => '33 Trường Chinh, Quận Tân Bình, TP. Hồ Chí Minh', 'phi' => 750000, 'yc' => 'Con cần ôn tập toàn diện', 'tt' => 'hoan_thanh', 'hv_idx' => 4, 'gs_idx' => 12],
            ['mon' => 'Tiếng Anh THPT', 'khoi' => 'Lớp 10', 'buoi' => 2, 'lich' => 'Thứ 3, Thứ 7 (18:00 - 19:30)', 'dia_chi' => '44 Pasteur, Quận 3 (Q.3), TP. Hồ Chí Minh', 'phi' => 1200000, 'yc' => 'Củng cố nền tảng Tiếng Anh', 'tt' => 'hoan_thanh', 'hv_idx' => 5, 'gs_idx' => 1],
            ['mon' => 'Toán THCS', 'khoi' => 'Lớp 7', 'buoi' => 2, 'lich' => 'Thứ 4, Thứ 7 (19:00 - 20:30)', 'dia_chi' => '66 Trần Phú, Quận 5 (Q.5), TP. Hồ Chí Minh', 'phi' => 850000, 'yc' => 'Gia sư kiên nhẫn với học sinh yếu', 'tt' => 'hoan_thanh', 'hv_idx' => 6, 'gs_idx' => 7],
            ['mon' => 'Sinh Học', 'khoi' => 'Lớp 11', 'buoi' => 2, 'lich' => 'Thứ 5, Chủ Nhật (17:00 - 18:30)', 'dia_chi' => '77 Nguyễn Thị Minh Khai, Quận 1 (Q.1), TP. Hồ Chí Minh', 'phi' => 1100000, 'yc' => 'Luyện thi ĐH khối B', 'tt' => 'da_co_gia_su', 'hv_idx' => 7, 'gs_idx' => 5],
            ['mon' => 'Toán Lý Hóa', 'khoi' => 'Lớp 12', 'buoi' => 6, 'lich' => 'Thứ 2 đến Thứ 7 (19:00 - 20:30)', 'dia_chi' => '88 Xô Viết Nghệ Tĩnh, Quận Bình Thạnh, TP. Hồ Chí Minh', 'phi' => 3500000, 'yc' => 'Cần gia sư tốt luyện thi ĐH 3 môn', 'tt' => 'da_co_gia_su', 'hv_idx' => 8, 'gs_idx' => 0],
            ['mon' => 'Tiếng Nhật Giao Tiếp', 'khoi' => 'Đại học', 'buoi' => 2, 'lich' => 'Thứ 3, Thứ 6 (19:30 - 21:00)', 'dia_chi' => '99 Đinh Bộ Lĩnh, Quận Bình Thạnh, TP. Hồ Chí Minh', 'phi' => 1600000, 'yc' => 'Học để đi du học Nhật', 'tt' => 'da_co_gia_su', 'hv_idx' => 9, 'gs_idx' => 10],

            // ===== LỚP HỌC NGHỆ AN (8 lớp) =====
            ['mon' => 'Toán Luyện Thi Vào 10 Chuyên', 'khoi' => 'Lớp 9', 'buoi' => 3, 'lich' => 'Thứ 2, Thứ 4, Thứ 6 (19:00 - 20:30)', 'dia_chi' => '68 Đinh Công Tráng, Phường Lê Mao, TP. Vinh, Nghệ An', 'phi' => 1200000, 'yc' => 'Mục tiêu thi đậu chuyên Toán trường THPT Chuyên Phan Bội Châu.', 'tt' => 'dang_tim', 'hv_idx' => 0],
            ['mon' => 'Tiếng Anh IELTS 6.5+', 'khoi' => 'Lớp 11', 'buoi' => 2, 'lich' => 'Thứ 3, Thứ 5 (18:30 - 20:00)', 'dia_chi' => '152 Nguyễn Văn Cừ, Phường Hưng Bình, TP. Vinh, Nghệ An', 'phi' => 1600000, 'yc' => 'Cần gia sư phát âm chuẩn, có chứng chỉ IELTS 7.5 trở lên.', 'tt' => 'dang_tim', 'hv_idx' => 1],
            ['mon' => 'Hóa Học THPT Khối B', 'khoi' => 'Lớp 12', 'buoi' => 3, 'lich' => 'Thứ 2, Thứ 5, Thứ 7 (18:00 - 19:30)', 'dia_chi' => '24 Mai Hắc Đế, Phường Quán Bàu, TP. Vinh, Nghệ An', 'phi' => 1400000, 'yc' => 'Ôn thi tốt nghiệp và xét tuyển đại học Y Dược.', 'tt' => 'dang_tim', 'hv_idx' => 2],
            ['mon' => 'Toán & Tiếng Việt Tiểu Học', 'khoi' => 'Lớp 3', 'buoi' => 3, 'lich' => 'Thứ 2, Thứ 4, Thứ 6 (17:30 - 19:00)', 'dia_chi' => 'Khối 1, Phường Nghi Hương, Thị xã Cửa Lò, Nghệ An', 'phi' => 800000, 'yc' => 'Dạy kèm bé gái lớp 3, gia sư kiên nhẫn, yêu trẻ.', 'tt' => 'dang_tim', 'hv_idx' => 3],
            ['mon' => 'Vật Lý 11', 'khoi' => 'Lớp 11', 'buoi' => 2, 'lich' => 'Thứ 4, Chủ Nhật (19:00 - 20:30)', 'dia_chi' => 'Khối 3, Thị trấn Quán Hành, Huyện Nghi Lộc, Nghệ An', 'phi' => 1100000, 'yc' => 'Học sinh cần củng cố kiến thức học kỳ, nâng cao điểm số.', 'tt' => 'dang_tim', 'hv_idx' => 4],
            ['mon' => 'Toán Nâng Cao Lớp 8', 'khoi' => 'Lớp 8', 'buoi' => 2, 'lich' => 'Thứ 3, Thứ 7 (18:00 - 19:30)', 'dia_chi' => 'Xã Diễn Hồng, Huyện Diễn Châu, Nghệ An', 'phi' => 950000, 'yc' => 'Con học khá, muốn học nâng cao để thi HSG huyện.', 'tt' => 'dang_tim', 'hv_idx' => 5],
            ['mon' => 'Tiếng Anh Giao Tiếp Cơ Bản', 'khoi' => 'Lớp 6', 'buoi' => 2, 'lich' => 'Thứ 5, Thứ 7 (17:30 - 19:00)', 'dia_chi' => 'Thị trấn Đô Lương, Huyện Đô Lương, Nghệ An', 'phi' => 900000, 'yc' => 'Tập trung phản xạ nghe nói và từ vựng cơ bản.', 'tt' => 'dang_tim', 'hv_idx' => 6],
            ['mon' => 'Hóa Học Lớp 10', 'khoi' => 'Lớp 10', 'buoi' => 2, 'lich' => 'Thứ 2, Thứ 6 (19:30 - 21:00)', 'dia_chi' => 'Thị trấn Nam Đàn, Huyện Nam Đàn, Nghệ An', 'phi' => 1000000, 'yc' => 'Mới lên cấp 3 bỡ ngỡ môn Hóa, cần gia sư nhiệt tình.', 'tt' => 'dang_tim', 'hv_idx' => 7],
        ];

        $lopDaCapNhat = [];
        foreach ($danhSachLop as $i => $lop) {
            $giaSuId = null;
            if (isset($lop['gs_idx']) && isset($giaSuAccounts[$lop['gs_idx']])) {
                $giaSuId = $giaSuAccounts[$lop['gs_idx']]['acc']->id;
            }
            $lopMoi = LopHoc::create([
                'hoc_vien_id'   => $hocVienAccounts[$lop['hv_idx']]->id,
                'mon_hoc'       => $lop['mon'],
                'khoi_lop'      => $lop['khoi'],
                'so_buoi_tuan'  => $lop['buoi'],
                'thoi_gian_hoc' => $lop['lich'],
                'dia_chi_day'   => $lop['dia_chi'],
                'muc_hoc_phi'   => $lop['phi'],
                'yeu_cau_them'  => $lop['yc'],
                'trang_thai'    => $lop['tt'],
                'gia_su_id'     => $giaSuId,
            ]);
            $lopDaCapNhat[] = ['lop' => $lopMoi, 'gs_idx' => $lop['gs_idx'] ?? null, 'hv_idx' => $lop['hv_idx']];
        }

        // ==================== ĐĂNG KÝ NHẬN LỚP (28 đơn) ====================
        $danhSachDangKy = [
            [0, 0], [0, 7], [1, 1], [2, 2], [3, 4], [4, 3],
            [5, 5], [6, 12], [7, 1], [8, 7], [9, 2],
            [10, 10], [11, 6], [12, 0], [13, 4], [14, 1],
            // Đăng ký nhận lớp khu vực Nghệ An
            [30, 20], [31, 21], [32, 22], [33, 26], [34, 25],
            [35, 27], [36, 23], [37, 30],
        ];
        foreach ($danhSachDangKy as $idx => $pair) {
            [$lopIdx, $gsIdx] = $pair;
            if ($lopIdx < count($lopDaCapNhat) && $gsIdx < count($giaSuAccounts)) {
                try {
                    DangKyNhanLop::create([
                        'lop_hoc_id'          => $lopDaCapNhat[$lopIdx]['lop']->id,
                        'gia_su_id'           => $giaSuAccounts[$gsIdx]['acc']->id,
                        'gioi_thieu_ban_than' => 'Tôi có nhiều kinh nghiệm trong môn ' . $lopDaCapNhat[$lopIdx]['lop']->mon_hoc . ' và phương pháp dạy hiệu quả, phù hợp với học sinh ' . $lopDaCapNhat[$lopIdx]['lop']->khoi_lop . '.',
                        'trang_thai'          => $idx < 5 ? 'da_duyet' : 'cho_duyet',
                        'xac_nhan_gia_su'     => 'da_xac_nhan',
                    ]);
                } catch (\Exception $e) {
                    // Bỏ qua nếu đã tồn tại
                }
            }
        }

        // ==================== ĐÁNH GIÁ (12 nhận xét) ====================
        $nhanXets = [
            'Gia sư dạy rất nhiệt tình, đúng giờ. Con tôi tiến bộ rõ rệt sau 2 tháng học!',
            'Phương pháp giảng dạy dễ hiểu, bài bản. Rất hài lòng với kết quả của con!',
            'Thầy/Cô vui vẻ, kiên nhẫn với học sinh. Con học xong không muốn nghỉ.',
            'Rất chuyên nghiệp! Biết cách khơi dậy hứng thú học tập cho con.',
            'Con từ điểm 5 lên 8 sau 1 học kỳ, quá tuyệt vời. Sẽ tiếp tục mời.',
            'Dạy rất sát với chương trình thi, cung cấp đề cương ôn tập đầy đủ.',
            'Gia sư trẻ nhiệt huyết, hiểu tâm lý học sinh. Dạy sinh động.',
            'Nội dung bài học rõ ràng, con học được nhiều phương pháp giải nhanh.',
            'Tận tâm sửa bài tập, giải thích đến khi học sinh hiểu mới thôi.',
            'Con rất thích gia sư này, mỗi buổi học đều chờ đợi háo hức.',
            'Điểm kiểm tra tăng vượt bậc. Thực sự cảm ơn gia sư đã cố gắng!',
            'Phụ huynh an tâm 100%. Gia sư luôn báo cáo tình hình học tập định kỳ.',
        ];

        $danhGiaData = [
            [20, 0, 0, 5], [21, 1, 1, 5], [22, 2, 2, 4], [23, 3, 3, 5],
            [24, 4, 4, 5], [25, 5, 5, 4], [26, 6, 6, 5], [27, 7, 7, 4],
            [28, 8, 8, 5], [29, 9, 9, 5], [23, 10, 0, 5], [24, 11, 1, 4],
            // Đánh giá gia sư Nghệ An
            [30, 0, 20, 5], [31, 1, 21, 5], [32, 2, 22, 5], [33, 3, 26, 5],
            [34, 4, 25, 4], [35, 5, 27, 5], [36, 6, 33, 5], [37, 7, 30, 5],
            [30, 8, 31, 5], [31, 9, 29, 5], [32, 10, 28, 5], [33, 11, 24, 5],
        ];

        foreach ($danhGiaData as $idx => [$lopIdx, $nxIdx, $gsIdx, $sao]) {
            if ($lopIdx < count($lopDaCapNhat) && $gsIdx < count($giaSuAccounts)) {
                try {
                    DanhGia::create([
                        'lop_hoc_id'  => $lopDaCapNhat[$lopIdx]['lop']->id,
                        'gia_su_id'   => $giaSuAccounts[$gsIdx]['acc']->id,
                        'hoc_vien_id' => $hocVienAccounts[$lopDaCapNhat[$lopIdx]['hv_idx']]->id,
                        'so_sao'      => $sao,
                        'nhan_xet'    => $nhanXets[$nxIdx % count($nhanXets)],
                    ]);
                } catch (\Exception $e) {
                    // Bỏ qua nếu trùng
                }
            }
        }

        // Cập nhật điểm trung bình và số lượt đánh giá cho từng hồ sơ gia sư
        foreach (\App\Models\HoSoGiaSu::all() as $hs) {
            $avg = DanhGia::where('gia_su_id', $hs->tai_khoan_id)->avg('so_sao');
            $count = DanhGia::where('gia_su_id', $hs->tai_khoan_id)->count();
            $hs->update([
                'diem_trung_binh'  => $count > 0 ? round($avg, 1) : 5.0,
                'diem_danh_gia'    => $count > 0 ? round($avg, 1) : 5.0,
                'so_luot_danh_gia' => $count,
            ]);
        }
        // ==================== TIN NHẮN MẪU (CHAT) ====================
        $sampleChats = [
            ['hocvien_idx' => 0, 'giasu_idx' => 0, 'is_hv' => true,  'msg' => 'Chào thầy An ạ, em thấy thầy có kinh nghiệm dạy Toán 12 rất tốt, em muốn hỏi thêm về phương pháp luyện thi ĐH khối A ạ.'],
            ['hocvien_idx' => 0, 'giasu_idx' => 0, 'is_hv' => false, 'msg' => 'Chào em! Thầy chuyên bám sát cấu trúc đề Bộ Giáo Dục, chia chuyên đề từ cơ bản đến vận dụng cao. Em hiện tại đang yếu phần nào nhất?'],
            ['hocvien_idx' => 0, 'giasu_idx' => 0, 'is_hv' => true,  'msg' => 'Dạ em hay bị vướng phần Hình học không gian và Tích phân ạ.'],
            ['hocvien_idx' => 0, 'giasu_idx' => 0, 'is_hv' => false, 'msg' => 'Không sao em nhé, phần đó thầy có bộ mẹo tư duy hình và công thức giải nhanh rất dễ hiểu. Lịch tối thứ 2 và thứ 4 thầy đã xác nhận rồi nhé!'],
            ['hocvien_idx' => 1, 'giasu_idx' => 1, 'is_hv' => true,  'msg' => 'Chào cô Bích, em muốn kèm Tiếng Anh giao tiếp và chuẩn bị thi IELTS 6.5 ạ.'],
            ['hocvien_idx' => 1, 'giasu_idx' => 1, 'is_hv' => false, 'msg' => 'Chào em! Cô sẽ kiểm tra trình độ đầu vào miễn phí ở buổi đầu tiên để lên lộ trình học cá nhân hóa cho em nhé.'],
            ['hocvien_idx' => 1, 'giasu_idx' => 1, 'is_hv' => true,  'msg' => 'Dạ tuyệt quá, em cảm ơn cô nhiều ạ!'],
        ];
        foreach ($sampleChats as $sc) {
            if (isset($hocVienAccounts[$sc['hocvien_idx']]) && isset($giaSuAccounts[$sc['giasu_idx']])) {
                $senderId   = $sc['is_hv'] ? $hocVienAccounts[$sc['hocvien_idx']]->id : $giaSuAccounts[$sc['giasu_idx']]['acc']->id;
                $receiverId = $sc['is_hv'] ? $giaSuAccounts[$sc['giasu_idx']]['acc']->id : $hocVienAccounts[$sc['hocvien_idx']]->id;
                TinNhan::create([
                    'nguoi_gui_id'  => $senderId,
                    'nguoi_nhan_id' => $receiverId,
                    'noi_dung'      => $sc['msg'],
                    'da_xem'        => true,
                ]);
            }
        }
    }
}
