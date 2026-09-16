<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use Notifiable;

    protected $table = 'tai_khoans';

    protected $fillable = [
        'ho_ten',
        'email',
        'password',
        'so_dien_thoai',
        'vai_tro',
        'trang_thai',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relationships
    public function hoSoGiaSu()
    {
        return $this->hasOne(HoSoGiaSu::class, 'tai_khoan_id');
    }

    public function lopHocDaTao()
    {
        return $this->hasMany(LopHoc::class, 'hoc_vien_id');
    }

    public function lopHocNhanDay()
    {
        return $this->hasMany(LopHoc::class, 'gia_su_id');
    }

    public function dangKyNhanLops()
    {
        return $this->hasMany(DangKyNhanLop::class, 'gia_su_id');
    }

    // Helper methods
    public function isAdmin(): bool
    {
        return $this->vai_tro === 'admin';
    }

    public function isGiaSu(): bool
    {
        return $this->vai_tro === 'giasu';
    }

    public function isHocVien(): bool
    {
        return $this->vai_tro === 'hocvien';
    }

    public function isActive(): bool
    {
        return $this->trang_thai === 'active';
    }
}
