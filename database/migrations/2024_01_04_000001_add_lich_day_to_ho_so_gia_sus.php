<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('ho_so_gia_sus', 'lich_day')) {
            Schema::table('ho_so_gia_sus', function (Blueprint $table) {
                $table->text('lich_day')->nullable()->after('so_lop_da_day');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('ho_so_gia_sus', 'lich_day')) {
            Schema::table('ho_so_gia_sus', function (Blueprint $table) {
                $table->dropColumn('lich_day');
            });
        }
    }
};
