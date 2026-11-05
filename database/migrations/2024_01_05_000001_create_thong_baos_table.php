<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('thong_baos')) {
            Schema::create('thong_baos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tai_khoan_id')->constrained('tai_khoans')->onDelete('cascade');
                $table->string('tieu_de');
                $table->text('noi_dung');
                $table->string('loai', 50)->default('he_thong');
                $table->string('duong_dan')->nullable();
                $table->boolean('da_doc')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('thong_baos');
    }
};
