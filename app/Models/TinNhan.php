<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TinNhan extends Model
{
    protected $table = 'tin_nhans';

    protected $fillable = [
        'nguoi_gui_id',
        'nguoi_nhan_id',
        'lop_hoc_id',
        'noi_dung',
        'da_xem',
    ];

    protected $casts = [
        'da_xem' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function nguoiGui(): BelongsTo
    {
        return $this->belongsTo(TaiKhoan::class, 'nguoi_gui_id');
    }

    public function nguoiNhan(): BelongsTo
    {
        return $this->belongsTo(TaiKhoan::class, 'nguoi_nhan_id');
    }

    public function lopHoc(): BelongsTo
    {
        return $this->belongsTo(LopHoc::class, 'lop_hoc_id');
    }

    public function scopeGiuaHaiNguoi($query, $user1Id, $user2Id)
    {
        return $query->where(function ($q) use ($user1Id, $user2Id) {
            $q->where('nguoi_gui_id', $user1Id)->where('nguoi_nhan_id', $user2Id);
        })->orWhere(function ($q) use ($user1Id, $user2Id) {
            $q->where('nguoi_gui_id', $user2Id)->where('nguoi_nhan_id', $user1Id);
        });
    }

    public function getFormattedTimeAttribute(): string
    {
        if ($this->created_at->isToday()) {
            return $this->created_at->format('H:i');
        }
        if ($this->created_at->isYesterday()) {
            return 'Hôm qua ' . $this->created_at->format('H:i');
        }
        return $this->created_at->format('d/m H:i');
    }
}
