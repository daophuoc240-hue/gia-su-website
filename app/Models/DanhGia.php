<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;

    protected $table = 'danh_gias';

    protected $fillable = [
        'lop_hoc_id',
        'gia_su_id',
        'hoc_vien_id',
        'so_sao',
        'nhan_xet',
    ];

    public function giaSu()
    {
        return $this->belongsTo(TaiKhoan::class, 'gia_su_id');
    }

    public function hocVien()
    {
        return $this->belongsTo(TaiKhoan::class, 'hoc_vien_id');
    }

    public function lopHoc()
    {
        return $this->belongsTo(LopHoc::class, 'lop_hoc_id');
    }
}
