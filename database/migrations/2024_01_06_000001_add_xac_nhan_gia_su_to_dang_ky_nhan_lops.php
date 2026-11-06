<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('dang_ky_nhan_lops') && !Schema::hasColumn('dang_ky_nhan_lops', 'xac_nhan_gia_su')) {
            Schema::table('dang_ky_nhan_lops', function (Blueprint $table) {
                $table->string('xac_nhan_gia_su', 50)->nullable()->default(null)->after('trang_thai');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('dang_ky_nhan_lops') && Schema::hasColumn('dang_ky_nhan_lops', 'xac_nhan_gia_su')) {
            Schema::table('dang_ky_nhan_lops', function (Blueprint $table) {
                $table->dropColumn('xac_nhan_gia_su');
            });
        }
    }
};
