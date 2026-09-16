<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danh_gias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lop_hoc_id')->nullable()->constrained('lop_hocs')->onDelete('cascade');
            $table->foreignId('gia_su_id')->constrained('tai_khoans')->onDelete('cascade');
            $table->foreignId('hoc_vien_id')->constrained('tai_khoans')->onDelete('cascade');
            $table->tinyInteger('so_sao')->default(5);
            $table->text('nhan_xet')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('danh_gias');
    }
};
