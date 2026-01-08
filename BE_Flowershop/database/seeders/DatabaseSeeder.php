<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ChucVuSeeder::class,
            DanhMucSeeder::class,
            MuaHoaSeeder::class,
            DipLeSeeder::class,
            NhanVienSeeder::class,
            BoHoaSeeder::class,
        ]);
    }
}
