<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoSoGiaSu extends Model
{
    protected $table = 'ho_so_gia_sus';

    protected $fillable = [
        'tai_khoan_id',
        'avatar',
        'truong_hoc',
        'chuyen_nganh',
        'mon_day',
        'kinh_nghiem',
        'khu_vuc_nhan_day',
        'hoc_phi_theo_gio',
        'bang_cap',
        'the_sinh_vien',
        'trang_thai_duyet',
        'ly_do_tu_choi',
        'diem_danh_gia',
        'so_lop_da_day',
    ];

    protected $casts = [
        'hoc_phi_theo_gio' => 'decimal:0',
    ];

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'tai_khoan_id');
    }

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'gia_su_id', 'tai_khoan_id');
    }

    public function isDaDuyet(): bool
    {
        return $this->trang_thai_duyet === 'da_duyet';
    }

    public function isChoDuyet(): bool
    {
        return $this->trang_thai_duyet === 'cho_duyet';
    }

    // Get avatar URL - return uploaded or default Unsplash avatar by gender
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && file_exists(public_path('storage/' . $this->avatar))) {
            return secure_asset('storage/' . $this->avatar);
        }
        // Deterministic avatar based on account id
        $seed = ($this->tai_khoan_id ?? 1) % 10;
        $avatars = [
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=200&q=80',
            'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
        ];
        return $avatars[$seed];
    }
}
