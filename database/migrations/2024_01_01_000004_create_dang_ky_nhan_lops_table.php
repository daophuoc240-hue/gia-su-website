<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dang_ky_nhan_lops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lop_hoc_id')->constrained('lop_hocs')->onDelete('cascade');
            $table->foreignId('gia_su_id')->constrained('tai_khoans')->onDelete('cascade');
            $table->text('gioi_thieu_ban_than')->nullable();
            $table->enum('trang_thai', ['cho_duyet', 'da_duyet', 'tu_choi'])->default('cho_duyet');
            $table->timestamps();

            // Prevent duplicate registrations
            $table->unique(['lop_hoc_id', 'gia_su_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dang_ky_nhan_lops');
    }
};
