<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NhanVienSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('nhan_viens')->insert([
            [
                'email' => 'admin@shophoa.com',
                'ho_va_ten' => 'Admin Shop Hoa',
                'mat_khau' => Hash::make('123456'),
                'so_dien_thoai' => '0901234567',
                'dia_chi' => 'Số 1, Đường Hoa Hồng, TP.HCM',
                'ngay_sinh' => '1990-01-01',
                'tinh_trang' => 1,
                'avatar' => null,
                'id_chuc_vu' => 1, // Admin
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'email' => 'nhanvien@shophoa.com',
                'ho_va_ten' => 'Nhân Viên Bán Hàng',
                'mat_khau' => Hash::make('123456'),
                'so_dien_thoai' => '0909876543',
                'dia_chi' => 'Số 2, Đường Hoa Lan, TP.HCM',
                'ngay_sinh' => '1995-05-15',
                'tinh_trang' => 1,
                'avatar' => null,
                'id_chuc_vu' => 2, // Nhân viên
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
