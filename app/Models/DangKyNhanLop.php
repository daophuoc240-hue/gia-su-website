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
            return 'Chờ gia sư chọn lịch';
        }
        if ($this->xac_nhan_gia_su === 'da_xac_nhan' && $this->trang_thai === 'cho_duyet') {
            return 'Gia sư đã chốt lịch (Chờ admin duyệt)';
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
        if ($this->xac_nhan_gia_su === 'da_xac_nhan' && $this->trang_thai === 'cho_duyet') {
            return 'badge-info';
        }
        return match($this->trang_thai) {
            'cho_duyet' => 'badge-info',
            'da_duyet'  => 'badge-success',
            'tu_choi'   => 'badge-danger',
            default     => 'badge-secondary',
        };
    }

    /**
     * Lấy danh sách các ngày học sinh đề xuất
     */
    public function getDanhSachNgayDeXuat(): array
    {
        if (!empty($this->gioi_thieu_ban_than)) {
            $data = json_decode($this->gioi_thieu_ban_than, true);
            if (is_array($data) && !empty($data['ngay_de_xuat'])) {
                return (array) $data['ngay_de_xuat'];
            }
        }

        // Nếu không có JSON, parse từ thoi_gian_hoc của LopHoc
        $thoiGian = $this->lopHoc->thoi_gian_hoc ?? '';
        $matched = [];
        foreach (['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật'] as $d) {
            if (str_contains($thoiGian, $d)) {
                $matched[] = $d;
            }
        }

        return !empty($matched) ? $matched : ['Thứ 2', 'Thứ 4', 'Thứ 6'];
    }

    /**
     * Lấy khung giờ học sinh đề xuất
     */
    public function getKhungGioDeXuat(): string
    {
        if (!empty($this->gioi_thieu_ban_than)) {
            $data = json_decode($this->gioi_thieu_ban_than, true);
            if (is_array($data) && !empty($data['khung_gio'])) {
                return (string) $data['khung_gio'];
            }
        }

        $thoiGian = $this->lopHoc->thoi_gian_hoc ?? '';
        if (preg_match('/\((.*?)\)/', $thoiGian, $m)) {
            return trim($m[1]);
        }

        return 'Tối (18:00 - 20:00)';
    }

    /**
     * Lấy ghi chú của học sinh gửi kèm
     */
    public function getGhiChuHocVien(): string
    {
        if (!empty($this->gioi_thieu_ban_than)) {
            $data = json_decode($this->gioi_thieu_ban_than, true);
            if (is_array($data) && !empty($data['ghi_chu_hv'])) {
                return (string) $data['ghi_chu_hv'];
            }
        }
        return $this->lopHoc->yeu_cau_them ?? '';
    }
}
