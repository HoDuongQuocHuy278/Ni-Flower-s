<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucVuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('chuc_vus')->insert([
            ['ten_chuc_vu' => 'Admin', 'mo_ta' => 'Quản trị viên - Toàn quyền', 'quyen' => 1, 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_chuc_vu' => 'Nhân viên bán hàng', 'mo_ta' => 'Nhân viên - Hạn chế quyền', 'quyen' => 0, 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
