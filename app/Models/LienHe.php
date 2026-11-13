<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LienHe extends Model
{
    protected $table = 'lien_hes';

    protected $fillable = [
        'ho_ten',
        'so_dien_thoai',
        'email',
        'loai',
        'noi_dung',
        'trang_thai',
    ];

    public const LOAI = [
        'tu_van_nhanh' => '⚡ Nhận tư vấn nhanh',
        'phu_huynh'    => '👨‍👩‍👧 Phụ huynh / Học viên tìm gia sư',
        'gia_su'       => '👨‍🏫 Gia sư cần hỗ trợ hồ sơ / nhận lớp',
        'doi_gia_su'   => '🔄 Đổi lịch học / đổi gia sư',
        'khac'         => '💬 Góp ý & hợp tác khác',
    ];

    public function getLoaiLabelAttribute(): string
    {
        return self::LOAI[$this->loai] ?? 'Khác';
    }
}
