<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DangKyNhanLop extends Model
{
    protected $table = 'dang_ky_nhan_lops';

    protected $fillable = [
        'lop_hoc_id',
        'gia_su_id',
        'gioi_thieu_ban_than',
        'trang_thai',
    ];

    public function lopHoc()
    {
        return $this->belongsTo(LopHoc::class, 'lop_hoc_id');
    }

    public function giaSu()
    {
        return $this->belongsTo(TaiKhoan::class, 'gia_su_id');
    }

    public function getTrangThaiLabelAttribute(): string
    {
        return match($this->trang_thai) {
            'cho_duyet' => 'Chờ duyệt',
            'da_duyet'  => 'Đã duyệt',
            'tu_choi'   => 'Từ chối',
            default     => 'Không xác định',
        };
    }
}
