<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tin_nhans')) {
            Schema::create('tin_nhans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('nguoi_gui_id')->constrained('tai_khoans')->onDelete('cascade');
                $table->foreignId('nguoi_nhan_id')->constrained('tai_khoans')->onDelete('cascade');
                $table->foreignId('lop_hoc_id')->nullable()->constrained('lop_hocs')->onDelete('set null');
                $table->text('noi_dung');
                $table->boolean('da_xem')->default(false);
                $table->timestamps();

                $table->index(['nguoi_gui_id', 'nguoi_nhan_id']);
                $table->index(['nguoi_nhan_id', 'da_xem']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tin_nhans');
    }
};
