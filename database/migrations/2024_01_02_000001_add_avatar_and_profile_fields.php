<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tai_khoans', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('so_dien_thoai');
        });

        Schema::table('ho_so_gia_sus', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('tai_khoan_id');
            $table->string('mon_day')->nullable()->after('chuyen_nganh'); // Môn dạy chính
            $table->decimal('hoc_phi_theo_gio', 8, 0)->nullable()->after('mon_day'); // Mức phí/giờ
            $table->tinyInteger('diem_danh_gia')->default(0)->after('hoc_phi_theo_gio'); // TB đánh giá
            $table->integer('so_lop_da_day')->default(0)->after('diem_danh_gia'); // Số lớp đã nhận
        });
    }

    public function down(): void
    {
        Schema::table('tai_khoans', function (Blueprint $table) {
            $table->dropColumn('avatar');
        });
        Schema::table('ho_so_gia_sus', function (Blueprint $table) {
            $table->dropColumn(['avatar', 'mon_day', 'hoc_phi_theo_gio', 'diem_danh_gia', 'so_lop_da_day']);
        });
    }
};
