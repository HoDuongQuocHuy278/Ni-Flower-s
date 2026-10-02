<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Pivot table: bo_hoa_danh_muc
        if (!Schema::hasTable('bo_hoa_danh_muc')) {
            Schema::create('bo_hoa_danh_muc', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_bo_hoa');
                $table->unsignedBigInteger('id_danh_muc');
                $table->timestamps();

                $table->foreign('id_bo_hoa')->references('id')->on('bo_hoas')->onDelete('cascade');
                $table->foreign('id_danh_muc')->references('id')->on('danh_mucs')->onDelete('cascade');
                $table->unique(['id_bo_hoa', 'id_danh_muc']);
            });
        }

        // 2. Pivot table: bo_hoa_mua_hoa
        if (!Schema::hasTable('bo_hoa_mua_hoa')) {
            Schema::create('bo_hoa_mua_hoa', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_bo_hoa');
                $table->unsignedBigInteger('id_mua');
                $table->timestamps();

                $table->foreign('id_bo_hoa')->references('id')->on('bo_hoas')->onDelete('cascade');
                $table->foreign('id_mua')->references('id')->on('mua_hoas')->onDelete('cascade');
                $table->unique(['id_bo_hoa', 'id_mua']);
            });
        }

        // 3. Pivot table: bo_hoa_dip_le
        if (!Schema::hasTable('bo_hoa_dip_le')) {
            Schema::create('bo_hoa_dip_le', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_bo_hoa');
                $table->unsignedBigInteger('id_dip_le');
                $table->timestamps();

                $table->foreign('id_bo_hoa')->references('id')->on('bo_hoas')->onDelete('cascade');
                $table->foreign('id_dip_le')->references('id')->on('dip_les')->onDelete('cascade');
                $table->unique(['id_bo_hoa', 'id_dip_le']);
            });
        }

        // 4. Di chuyển dữ liệu quan hệ cũ (id_danh_muc, id_mua, id_dip_le) sang bảng pivot
        $boHoas = DB::table('bo_hoas')->get();
        $now = now();

        foreach ($boHoas as $item) {
            if (!empty($item->id_danh_muc)) {
                DB::table('bo_hoa_danh_muc')->updateOrInsert(
                    ['id_bo_hoa' => $item->id, 'id_danh_muc' => $item->id_danh_muc],
                    ['created_at' => $now, 'updated_at' => $now]
                );
            }
            if (!empty($item->id_mua)) {
                DB::table('bo_hoa_mua_hoa')->updateOrInsert(
                    ['id_bo_hoa' => $item->id, 'id_mua' => $item->id_mua],
                    ['created_at' => $now, 'updated_at' => $now]
                );
            }
            if (!empty($item->id_dip_le)) {
                DB::table('bo_hoa_dip_le')->updateOrInsert(
                    ['id_bo_hoa' => $item->id, 'id_dip_le' => $item->id_dip_le],
                    ['created_at' => $now, 'updated_at' => $now]
                );
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('bo_hoa_dip_le');
        Schema::dropIfExists('bo_hoa_mua_hoa');
        Schema::dropIfExists('bo_hoa_danh_muc');
    }
};
