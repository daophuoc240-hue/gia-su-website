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
        'xac_nhan_gia_su',
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
        if ($this->xac_nhan_gia_su === 'cho_xac_nhan') {
            return 'Chờ gia sư xác nhận lịch';
        }
        return match($this->trang_thai) {
            'cho_duyet' => 'Chờ trung tâm phê duyệt',
            'da_duyet'  => 'Đã duyệt nhận lớp',
            'tu_choi'   => 'Từ chối / Báo bận',
            default     => 'Không xác định',
        };
    }

    public function getTrangThaiClassAttribute(): string
    {
        if ($this->xac_nhan_gia_su === 'cho_xac_nhan') {
            return 'badge-warning';
        }
        return match($this->trang_thai) {
            'cho_duyet' => 'badge-info',
            'da_duyet'  => 'badge-success',
            'tu_choi'   => 'badge-danger',
            default     => 'badge-secondary',
        };
    }
}
