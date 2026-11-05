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
        'thoi_gian_hoc',
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
        if ($this->trang_thai === 'dang_tim' && $this->gia_su_id && $this->dangKyNhanLops->where('xac_nhan_gia_su', 'cho_xac_nhan')->isNotEmpty()) {
            return 'Chờ gia sư xác nhận lịch';
        }

        return match($this->trang_thai) {
            'dang_tim'      => 'Đang tìm gia sư / Chờ duyệt',
            'da_co_gia_su'  => 'Đã có gia sư',
            'hoan_thanh'    => 'Hoàn thành',
            'da_huy'        => 'Đã hủy',
            default         => 'Không xác định',
        };
    }

    public function getTrangThaiClassAttribute(): string
    {
        if ($this->trang_thai === 'dang_tim' && $this->gia_su_id && $this->dangKyNhanLops->where('xac_nhan_gia_su', 'cho_xac_nhan')->isNotEmpty()) {
            return 'badge-warning';
        }

        return match($this->trang_thai) {
            'dang_tim'      => 'badge-info',
            'da_co_gia_su'  => 'badge-success',
            'hoan_thanh'    => 'badge-primary',
            'da_huy'        => 'badge-danger',
            default         => 'badge-secondary',
        };
    }

    // Compatibility Accessors for Public Portal
    public function getHocPhiAttribute() { return $this->muc_hoc_phi; }
    public function getSoBuoiTrungBinhAttribute() { return $this->so_buoi_tuan; }
    public function getYeuCauGiaSuAttribute() { return $this->yeu_cau_them; }
    public function getThoiGianDayAttribute() { return $this->thoi_gian_hoc ?: ($this->so_buoi_tuan . ' buổi/tuần (Thoả thuận)'); }
    public function getMoTaAttribute() { return $this->yeu_cau_them; }
}
