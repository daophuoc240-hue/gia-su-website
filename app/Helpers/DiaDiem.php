<?php

namespace App\Helpers;

class DiaDiem
{
    /**
     * Lấy toàn bộ danh sách 63 Tỉnh/Thành phố và Quận/Huyện trực thuộc
     */
    public static function getAll(): array
    {
        return config('locations.provinces', []);
    }

    /**
     * Lấy danh sách tên 63 Tỉnh / Thành phố
     */
    public static function getTinhThanhList(): array
    {
        return array_keys(static::getAll());
    }

    /**
     * Lấy danh sách Quận / Huyện theo Tỉnh / Thành phố
     */
    public static function getQuanHuyenByTinh(?string $tinhThanh): array
    {
        if (empty($tinhThanh)) {
            return [];
        }
        $all = static::getAll();
        return $all[$tinhThanh] ?? [];
    }

    /**
     * Sinh các từ khóa tìm kiếm đồng nghĩa để tìm kiếm địa chỉ chính xác và linh hoạt
     */
    public static function buildSearchTerms(?string $tinhThanh, ?string $quanHuyen = null, ?string $rawKhuVuc = null): array
    {
        $terms = [];

        if (!empty($rawKhuVuc)) {
            $raw = trim($rawKhuVuc);
            $terms[] = $raw;
            if (str_contains($raw, '-')) {
                foreach (explode('-', $raw) as $part) {
                    $p = trim($part);
                    if ($p !== '') $terms[] = $p;
                }
            }
        }

        if (!empty($quanHuyen)) {
            $qh = trim($quanHuyen);
            $terms[] = $qh;

            // Xử lý Quận 1 <-> Q.1 <-> Q1
            if (preg_match('/(?:quận|q\.?)\s*(\d+)/ui', $qh, $m)) {
                $num = $m[1];
                $terms[] = "Quận " . $num;
                $terms[] = "Q." . $num;
                $terms[] = "Q" . $num;
            }

            // Xử lý TP. Huế <-> Huế, TP. Thủ Đức <-> Thủ Đức
            if (preg_match('/^tp\.?\s*(.+)$/ui', $qh, $m)) {
                $terms[] = trim($m[1]);
            }
            if (preg_match('/^thị xã\s*(.+)$/ui', $qh, $m) || preg_match('/^tx\.?\s*(.+)$/ui', $qh, $m)) {
                $terms[] = trim($m[1]);
            }
            if (preg_match('/^huyện\s*(.+)$/ui', $qh, $m)) {
                $terms[] = trim($m[1]);
            }
        }

        if (!empty($tinhThanh)) {
            $tt = trim($tinhThanh);
            $terms[] = $tt;

            if (preg_match('/(?:hồ chí minh|hcm|tp\.?hcm|sài gòn)/ui', $tt)) {
                $terms[] = "Hồ Chí Minh";
                $terms[] = "TP.HCM";
                $terms[] = "TP. Hồ Chí Minh";
                $terms[] = "Sài Gòn";
            } elseif (preg_match('/(?:thừa thiên huế|huế)/ui', $tt)) {
                $terms[] = "Thừa Thiên Huế";
                $terms[] = "Huế";
            } elseif (preg_match('/(?:hà nội|hn)/ui', $tt)) {
                $terms[] = "Hà Nội";
            } elseif (preg_match('/(?:đà nẵng|dn)/ui', $tt)) {
                $terms[] = "Đà Nẵng";
            } elseif (preg_match('/(?:bà rịa|vũng tàu)/ui', $tt)) {
                $terms[] = "Bà Rịa";
                $terms[] = "Vũng Tàu";
            }
        }

        return array_values(array_unique(array_filter($terms)));
    }
}
