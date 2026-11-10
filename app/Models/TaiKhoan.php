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
        'avatar',
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

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'gia_su_id');
    }

    public function thongBaos()
    {
        return $this->hasMany(ThongBao::class, 'tai_khoan_id')->latest();
    }

    public function thongBaoChuaDocCount(): int
    {
        return $this->thongBaos()->where('da_doc', false)->count();
    }

    public function tinNhanNhan()
    {
        return $this->hasMany(TinNhan::class, 'nguoi_nhan_id');
    }

    public function tinNhanGui()
    {
        return $this->hasMany(TinNhan::class, 'nguoi_gui_id');
    }

    public function tinNhanChuaDocCount(): int
    {
        return $this->tinNhanNhan()->where('da_xem', false)->count();
    }

    public function getAvatarUrlAttribute(): string
    {
        if (!empty($this->avatar)) {
            if (str_starts_with($this->avatar, 'http://') || str_starts_with($this->avatar, 'https://')) {
                return $this->avatar;
            }
            return asset('storage/' . $this->avatar);
        }
        if ($this->hoSoGiaSu && !empty($this->hoSoGiaSu->avatar)) {
            if (str_starts_with($this->hoSoGiaSu->avatar, 'http://') || str_starts_with($this->hoSoGiaSu->avatar, 'https://')) {
                return $this->hoSoGiaSu->avatar;
            }
            return asset('storage/' . $this->hoSoGiaSu->avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->ho_ten ?? 'User') . '&background=2563eb&color=fff&bold=true';
    }

    public function getVaiTroLabelAttribute(): string
    {
        if ($this->vai_tro === 'admin') return 'Quản Trị Viên';
        if ($this->vai_tro === 'giasu') return 'Gia Sư';
        return 'Học Viên / Phụ Huynh';
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
