<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lop_hocs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hoc_vien_id')->constrained('tai_khoans')->onDelete('cascade');
            $table->string('mon_hoc');
            $table->string('khoi_lop'); // e.g. "Lớp 10", "Lớp 12", "Đại học"
            $table->integer('so_buoi_tuan')->default(2);
            $table->string('dia_chi_day');
            $table->decimal('muc_hoc_phi', 10, 0); // VND per session
            $table->text('yeu_cau_them')->nullable();
            $table->enum('trang_thai', ['dang_tim', 'da_co_gia_su', 'hoan_thanh', 'da_huy'])->default('dang_tim');
            $table->foreignId('gia_su_id')->nullable()->constrained('tai_khoans')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lop_hocs');
    }
};
