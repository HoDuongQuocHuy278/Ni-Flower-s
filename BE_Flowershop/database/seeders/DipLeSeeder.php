<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DipLeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dip_les')->insert([
            ['ten_dip' => 'Tình Yêu', 'mo_ta' => 'Hoa dành cho người yêu thương, thể hiện tình cảm lãng mạn', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_dip' => 'Đám Cưới', 'mo_ta' => 'Hoa cưới sang trọng, tinh tế cho ngày trọng đại', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_dip' => 'Chia Buồn', 'mo_ta' => 'Hoa tang lễ trang nghiêm, thể hiện sự chia sẻ', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_dip' => 'Khai Trương', 'mo_ta' => 'Hoa khai trương, chúc mừng thành công trong kinh doanh', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_dip' => 'Sinh Nhật', 'mo_ta' => 'Hoa sinh nhật vui tươi, ý nghĩa', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['ten_dip' => 'Lễ Hội', 'mo_ta' => 'Hoa cho các dịp lễ tết, năm mới', 'tinh_trang' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
