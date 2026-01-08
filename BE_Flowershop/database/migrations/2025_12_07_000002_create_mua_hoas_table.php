<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mua_hoas', function (Blueprint $table) {
            $table->id();
            $table->string('ten_mua'); // Xuân, Hạ, Thu, Đông
            $table->text('mo_ta')->nullable();
            $table->tinyInteger('tinh_trang')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mua_hoas');
    }
};
