<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chuc_vus', function (Blueprint $table) {
            $table->id();
            $table->string('ten_chuc_vu');
            $table->string('mo_ta')->nullable();
            $table->integer('quyen')->default(0); // 0 = Nhân viên, 1 = Admin
            $table->integer('tinh_trang')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chuc_vus');
    }
};
