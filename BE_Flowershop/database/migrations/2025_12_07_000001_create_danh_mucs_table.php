<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danh_mucs', function (Blueprint $table) {
            $table->id();
            $table->string('ten_danh_muc');
            $table->string('slug')->nullable();
            $table->tinyInteger('tinh_trang')->default(1); // 1: Hoạt động, 0: Ẩn
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('danh_mucs');
    }
};
