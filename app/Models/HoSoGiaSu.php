<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoSoGiaSu extends Model
{
    protected $table = 'ho_so_gia_sus';

    protected $fillable = [
        'tai_khoan_id',
        'truong_hoc',
        'chuyen_nganh',
        'kinh_nghiem',
        'khu_vuc_nhan_day',
        'bang_cap',
        'the_sinh_vien',
        'trang_thai_duyet',
        'ly_do_tu_choi',
    ];

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'tai_khoan_id');
    }

    public function isDaDuyet(): bool
    {
        return $this->trang_thai_duyet === 'da_duyet';
    }

    public function isChoDuyet(): bool
    {
        return $this->trang_thai_duyet === 'cho_duyet';
    }
}
