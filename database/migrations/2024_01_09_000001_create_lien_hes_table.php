<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('lien_hes')) {
            return;
        }

        Schema::create('lien_hes', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten', 100);
            $table->string('so_dien_thoai', 20);
            $table->string('email', 150)->nullable();
            $table->string('loai', 30)->default('tu_van_nhanh'); // tu_van_nhanh | phu_huynh | gia_su | doi_gia_su | khac
            $table->text('noi_dung')->nullable();
            $table->string('trang_thai', 20)->default('moi');    // moi | da_xu_ly
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lien_hes');
    }
};
