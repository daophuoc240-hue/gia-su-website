<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ho_so_gia_sus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tai_khoan_id')->constrained('tai_khoans')->onDelete('cascade');
            $table->string('truong_hoc')->nullable();
            $table->string('chuyen_nganh')->nullable();
            $table->text('kinh_nghiem')->nullable();
            $table->string('khu_vuc_nhan_day')->nullable();
            $table->string('bang_cap')->nullable(); // File path
            $table->string('the_sinh_vien')->nullable(); // File path
            $table->enum('trang_thai_duyet', ['cho_duyet', 'da_duyet', 'tu_choi'])->default('cho_duyet');
            $table->text('ly_do_tu_choi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ho_so_gia_sus');
    }
};
