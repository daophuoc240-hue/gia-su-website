<?php

namespace App\Helpers;

/**
 * Bảng giá học phí chuẩn do trung tâm niêm yết (đ/buổi) và thuật toán kiểm tra mức giá gia sư tự đặt.
 *
 * Khung giá được xác định theo 2 yếu tố:
 *   - Trình độ gia sư : Sinh viên  |  Giáo viên / Thạc sĩ
 *   - Cấp học dạy chính: Tiểu học  |  THCS  |  THPT & Luyện thi
 *
 * Thuật toán đánh giá một mức giá $phi:
 *   phi <= 0 / rỗng           → 'trong'  (chưa đặt giá, bỏ qua kiểm tra)
 *   phi <  min                → 'duoi'   (thấp hơn khung - chỉ nhắc nhở, không chặn)
 *   min <= phi <= max         → 'dung'   (hợp lệ)
 *   max <  phi <= max * 1.10  → 'vuot_nhe'  (vượt tối đa 10%  - cảnh cáo mức 1)
 *   phi >  max * 1.10         → 'vuot_nang' (vượt trên 10%    - cảnh cáo mức 2, nghiêm trọng)
 */
class BangGiaHocPhi
{
    public const NGUONG_VUOT_NHE = 0.10; // 10%

    public const CAP_DAY = [
        'tieu_hoc' => 'Tiểu học (Lớp 1 – 5)',
        'thcs'     => 'THCS (Lớp 6 – 9)',
        'thpt'     => 'THPT & Luyện thi (Lớp 10 – 12, ĐH, IELTS)',
    ];

    public const TRINH_DO = [
        'sinh_vien' => 'Sinh viên',
        'giao_vien' => 'Giáo viên / Thạc sĩ',
    ];

    /** [min, max] đ/buổi */
    public const BANG_GIA = [
        'tieu_hoc' => ['sinh_vien' => [120000, 150000], 'giao_vien' => [220000, 280000]],
        'thcs'     => ['sinh_vien' => [150000, 180000], 'giao_vien' => [250000, 320000]],
        'thpt'     => ['sinh_vien' => [180000, 250000], 'giao_vien' => [300000, 450000]],
    ];

    public static function chuanHoa(?string $trinhDo, ?string $capDay): array
    {
        $trinhDo = array_key_exists((string) $trinhDo, self::TRINH_DO) ? $trinhDo : 'sinh_vien';
        $capDay  = array_key_exists((string) $capDay, self::CAP_DAY) ? $capDay : 'thpt';
        return [$trinhDo, $capDay];
    }

    /** @return array{0:int,1:int} */
    public static function khung(?string $trinhDo, ?string $capDay): array
    {
        [$trinhDo, $capDay] = self::chuanHoa($trinhDo, $capDay);
        return self::BANG_GIA[$capDay][$trinhDo];
    }

    public static function danhGia($phi, ?string $trinhDo, ?string $capDay): array
    {
        [$trinhDo, $capDay] = self::chuanHoa($trinhDo, $capDay);
        [$min, $max] = self::khung($trinhDo, $capDay);
        $phi = (float) $phi;

        $khungText = number_format($min) . ' – ' . number_format($max) . ' đ/buổi';
        $nhan = self::TRINH_DO[$trinhDo] . ' dạy ' . self::CAP_DAY[$capDay];

        $kq = [
            'trang_thai' => 'dung',
            'min'        => $min,
            'max'        => $max,
            'phi'        => $phi,
            'vuot_pct'   => 0,
            'vuot_tien'  => 0,
            'vi_pham'    => false,
            'khung_text' => $khungText,
            'message'    => '',
        ];

        if ($phi <= 0) {
            $kq['trang_thai'] = 'trong';
            $kq['message'] = "Khung giá trung tâm quy định cho {$nhan}: {$khungText}.";
            return $kq;
        }

        if ($phi < $min) {
            $kq['trang_thai'] = 'duoi';
            $kq['message'] = 'Mức giá ' . number_format($phi) . " đ/buổi thấp hơn khung tham khảo ({$khungText}). Bạn vẫn có thể lưu, nhưng nên điều chỉnh để phản ánh đúng năng lực.";
            return $kq;
        }

        if ($phi <= $max) {
            $kq['message'] = "Mức giá hợp lệ, nằm trong khung trung tâm quy định ({$khungText}).";
            return $kq;
        }

        $kq['vi_pham']   = true;
        $kq['vuot_tien'] = (int) round($phi - $max);
        $kq['vuot_pct']  = round(($phi - $max) / $max * 100, 1);
        $kq['trang_thai'] = ($phi <= $max * (1 + self::NGUONG_VUOT_NHE)) ? 'vuot_nhe' : 'vuot_nang';

        $kq['message'] = '⚠️ CẢNH CÁO: Mức giá ' . number_format($phi) . ' đ/buổi VƯỢT khung giá tối đa '
            . number_format($max) . ' đ/buổi của trung tâm (' . $nhan . ') thêm '
            . number_format($kq['vuot_tien']) . ' đ (' . $kq['vuot_pct'] . '%).';

        return $kq;
    }

    /** Dữ liệu JSON cho phần kiểm tra trực tiếp trên giao diện */
    public static function toJs(): array
    {
        return [
            'bang'      => self::BANG_GIA,
            'cap'       => self::CAP_DAY,
            'trinh_do'  => self::TRINH_DO,
            'nguong'    => self::NGUONG_VUOT_NHE,
        ];
    }
}
