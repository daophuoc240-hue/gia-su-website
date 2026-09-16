<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    protected $table = 'lop_hocs';

    protected $fillable = [
        'hoc_vien_id',
        'mon_hoc',
        'khoi_lop',
        'so_buoi_tuan',
        'dia_chi_day',
        'muc_hoc_phi',
        'yeu_cau_them',
        'trang_thai',
        'gia_su_id',
    ];

    protected $casts = [
        'muc_hoc_phi' => 'decimal:0',
    ];

    public function hocVien()
    {
        return $this->belongsTo(TaiKhoan::class, 'hoc_vien_id');
    }

    public function giaSu()
    {
        return $this->belongsTo(TaiKhoan::class, 'gia_su_id');
    }

    public function dangKyNhanLops()
    {
        return $this->hasMany(DangKyNhanLop::class, 'lop_hoc_id');
    }

    public function getTrangThaiLabelAttribute(): string
    {
        return match($this->trang_thai) {
            'dang_tim'      => 'Đang tìm gia sư',
            'da_co_gia_su'  => 'Đã có gia sư',
            'hoan_thanh'    => 'Hoàn thành',
            'da_huy'        => 'Đã hủy',
            default         => 'Không xác định',
        };
    }

    public function getTrangThaiClassAttribute(): string
    {
        return match($this->trang_thai) {
            'dang_tim'      => 'badge-warning',
            'da_co_gia_su'  => 'badge-success',
            'hoan_thanh'    => 'badge-info',
            'da_huy'        => 'badge-danger',
            default         => 'badge-secondary',
        };
    }

    // Compatibility Accessors for Public Portal
    public function getHocPhiAttribute() { return $this->muc_hoc_phi; }
    public function getSoBuoiTrungBinhAttribute() { return $this->so_buoi_tuan; }
    public function getYeuCauGiaSuAttribute() { return $this->yeu_cau_them; }
    public function getThoiGianDayAttribute() { return 'Lịch thỏa thuận với phụ huynh'; }
    public function getMoTaAttribute() { return $this->yeu_cau_them; }
}
