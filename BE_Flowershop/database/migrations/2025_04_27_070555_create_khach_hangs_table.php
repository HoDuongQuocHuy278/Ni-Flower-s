<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id();
            // $table->string('ho_va_ten');
            // $table->string('so_dien_thoai');
            // $table->string('email');
            // $table->string('password');
            // $table->string('cccd');
            // $table->date('ngay_sinh');
            // $table->string('avatar');
            // $table->string('avatar');
            // $table->integer('tinh_trang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
    }
};
