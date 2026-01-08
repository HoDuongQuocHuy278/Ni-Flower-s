<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bo_hoas', function (Blueprint $table) {
            $table->text('hinh_anh_phu')->nullable()->after('hinh_anh'); // Lưu JSON array các ảnh phụ
        });
    }

    public function down(): void
    {
        Schema::table('bo_hoas', function (Blueprint $table) {
            $table->dropColumn('hinh_anh_phu');
        });
    }
};
