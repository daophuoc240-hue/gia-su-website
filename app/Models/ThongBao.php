<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    protected $table = 'thong_baos';

    protected $fillable = [
        'tai_khoan_id',
        'tieu_de',
        'noi_dung',
        'loai',
        'duong_dan',
        'da_doc',
    ];

    protected $casts = [
        'da_doc' => 'boolean',
    ];

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'tai_khoan_id');
    }

    /**
     * Tạo thông báo nhanh cho một tài khoản
     */
    public static function gui($taiKhoanId, string $tieuDe, string $noiDung, ?string $duongDan = null, string $loai = 'he_thong')
    {
        return self::create([
            'tai_khoan_id' => $taiKhoanId,
            'tieu_de'      => $tieuDe,
            'noi_dung'     => $noiDung,
            'duong_dan'    => $duongDan,
            'loai'         => $loai,
            'da_doc'       => false,
        ]);
    }
}
