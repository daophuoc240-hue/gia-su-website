<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lop_hocs', function (Blueprint $table) {
            $table->string('thoi_gian_hoc')->nullable()->after('so_buoi_tuan'); // e.g. "Thứ 2, Thứ 4, Thứ 6 (18:00 - 19:30)"
        });

        Schema::table('ho_so_gia_sus', function (Blueprint $table) {
            $table->decimal('diem_trung_binh', 3, 1)->default(5.0)->after('diem_danh_gia'); // 1.0 - 5.0
            $table->integer('so_luot_danh_gia')->default(0)->after('diem_trung_binh');
        });
    }

    public function down(): void
    {
        Schema::table('lop_hocs', function (Blueprint $table) {
            $table->dropColumn('thoi_gian_hoc');
        });

        Schema::table('ho_so_gia_sus', function (Blueprint $table) {
            $table->dropColumn(['diem_trung_binh', 'so_luot_danh_gia']);
        });
    }
};
