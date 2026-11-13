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
        if ($this->trang_thai === 'dang_tim' && $this->gia_su_id && $this->dangKyNhanLops->where('xac_nhan_gia_su', 'da_xac_nhan')->where('trang_thai', 'cho_duyet')->isNotEmpty()) {
            return 'Gia sư đã chốt lịch (Chờ admin duyệt)';
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
        if ($this->trang_thai === 'dang_tim' && $this->gia_su_id && $this->dangKyNhanLops->where('xac_nhan_gia_su', 'da_xac_nhan')->where('trang_thai', 'cho_duyet')->isNotEmpty()) {
            return 'badge-info';
        }

        return match($this->trang_thai) {
            'dang_tim'      => 'badge-info',
            'da_co_gia_su'  => 'badge-success',
            'hoan_thanh'    => 'badge-primary',
            'da_huy'        => 'badge-danger',
            default         => 'badge-secondary',
        };
    }

    // Mã lớp chuẩn thị trường (#LH0001)
    public function getMaLopAttribute(): string
    {
        return '#LH' . str_pad((string)$this->id, 4, '0', STR_PAD_LEFT);
    }

    // Tự động nhận diện đơn vị học phí (đ/buổi nếu < 600,000, đ/tháng nếu >= 600,000)
    public function getDonViHocPhiAttribute(): string
    {
        return ((float)$this->muc_hoc_phi >= 600000) ? 'đ/tháng' : 'đ/buổi';
    }

    public function getHocPhiHienThiAttribute(): string
    {
        return number_format((float)$this->muc_hoc_phi) . ' ' . $this->don_vi_hoc_phi;
    }

    // Compatibility Accessors for Public Portal
    public function getHocPhiAttribute() { return $this->muc_hoc_phi; }
    public function getSoBuoiTrungBinhAttribute() { return $this->so_buoi_tuan; }
    public function getYeuCauGiaSuAttribute() { return $this->yeu_cau_them; }
    public function getThoiGianDayAttribute() { return $this->thoi_gian_hoc ?: ($this->so_buoi_tuan . ' buổi/tuần (Thoả thuận)'); }
    public function getMoTaAttribute() { return $this->yeu_cau_them; }
}
