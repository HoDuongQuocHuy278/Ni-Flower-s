<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhMucSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('danh_mucs')->insert([
            ['ten_danh_muc' => 'Hoa Hồng', 'slug' => 'hoa-hong', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_danh_muc' => 'Hoa Lan', 'slug' => 'hoa-lan', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_danh_muc' => 'Hoa Cúc', 'slug' => 'hoa-cuc', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_danh_muc' => 'Hoa Ly', 'slug' => 'hoa-ly', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_danh_muc' => 'Hoa Tulip', 'slug' => 'hoa-tulip', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_danh_muc' => 'Hoa Sen', 'slug' => 'hoa-sen', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_danh_muc' => 'Hoa Hướng Dương', 'slug' => 'hoa-huong-duong', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_danh_muc' => 'Hoa Baby', 'slug' => 'hoa-baby', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
