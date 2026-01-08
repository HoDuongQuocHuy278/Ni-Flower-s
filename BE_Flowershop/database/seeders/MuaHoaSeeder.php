<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MuaHoaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mua_hoas')->insert([
            ['ten_mua' => 'Xuân', 'mo_ta' => 'Hoa mùa xuân tươi tắn, rực rỡ sắc màu', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_mua' => 'Hạ', 'mo_ta' => 'Hoa mùa hè rực rỡ, tràn đầy năng lượng', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_mua' => 'Thu', 'mo_ta' => 'Hoa mùa thu ấm áp, lãng mạn', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_mua' => 'Đông', 'mo_ta' => 'Hoa mùa đông tinh tế, thanh lịch', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
