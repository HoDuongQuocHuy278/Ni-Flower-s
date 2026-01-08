<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bo_hoas', function (Blueprint $table) {
            $table->id();
            $table->string('ten_bo_hoa');
            $table->decimal('gia', 12, 0); // Giá VNĐ
            $table->decimal('gia_giam', 12, 0)->nullable(); // Giá sau giảm
            $table->integer('phan_tram_giam')->nullable(); // % giảm giá
            $table->text('mo_ta')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->string('facebook')->nullable(); // Link Facebook liên hệ
            $table->string('so_dien_thoai')->nullable(); // SĐT liên hệ
            $table->string('zalo')->nullable(); // Số Zalo liên hệ
            $table->unsignedBigInteger('id_danh_muc')->nullable();
            $table->unsignedBigInteger('id_mua')->nullable();
            $table->unsignedBigInteger('id_dip_le')->nullable();
            $table->boolean('noi_bat')->default(false); // Sản phẩm nổi bật
            $table->tinyInteger('tinh_trang')->default(1); // 1: Còn hàng, 0: Hết hàng
            $table->timestamps();

            $table->foreign('id_danh_muc')->references('id')->on('danh_mucs')->onDelete('set null');
            $table->foreign('id_mua')->references('id')->on('mua_hoas')->onDelete('set null');
            $table->foreign('id_dip_le')->references('id')->on('dip_les')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bo_hoas');
    }
};
