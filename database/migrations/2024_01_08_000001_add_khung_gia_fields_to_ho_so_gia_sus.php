<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ho_so_gia_sus')) {
            return;
        }

        Schema::table('ho_so_gia_sus', function (Blueprint $table) {
            if (!Schema::hasColumn('ho_so_gia_sus', 'trinh_do')) {
                $table->string('trinh_do', 20)->default('sinh_vien');
            }
            if (!Schema::hasColumn('ho_so_gia_sus', 'cap_day')) {
                $table->string('cap_day', 20)->default('thpt');
            }
            if (!Schema::hasColumn('ho_so_gia_sus', 'vuot_khung_gia')) {
                $table->boolean('vuot_khung_gia')->default(false);
            }
            if (!Schema::hasColumn('ho_so_gia_sus', 'so_lan_vuot_gia')) {
                $table->unsignedSmallInteger('so_lan_vuot_gia')->default(0);
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('ho_so_gia_sus')) {
            return;
        }

        Schema::table('ho_so_gia_sus', function (Blueprint $table) {
            foreach (['trinh_do', 'cap_day', 'vuot_khung_gia', 'so_lan_vuot_gia'] as $col) {
                if (Schema::hasColumn('ho_so_gia_sus', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
