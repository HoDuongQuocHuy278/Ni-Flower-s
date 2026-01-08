<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dip_les', function (Blueprint $table) {
            $table->id();
            $table->string('ten_dip'); // Tình cảm, Đám tang, Đám cưới, Nhà mới, Lễ hội
            $table->text('mo_ta')->nullable();
            $table->tinyInteger('tinh_trang')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dip_les');
    }
};
