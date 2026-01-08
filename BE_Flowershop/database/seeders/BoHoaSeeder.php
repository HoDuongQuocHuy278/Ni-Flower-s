<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoHoaSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Hoa Hồng - Tình yêu
            ['ten_bo_hoa' => 'Bó Hồng Đỏ Tình Yêu', 'gia' => 500000, 'gia_giam' => 450000, 'phan_tram_giam' => 10, 'mo_ta' => 'Bó hoa hồng đỏ thắm, tượng trưng cho tình yêu nồng cháy. 20 bông hồng Ecuador nhập khẩu, kết hợp baby trắng tinh khôi.', 'hinh_anh' => 'https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 1, 'id_mua' => 1, 'id_dip_le' => 1, 'noi_bat' => true, 'tinh_trang' => 1],
            ['ten_bo_hoa' => 'Hồng Pastel Nhẹ Nhàng', 'gia' => 350000, 'gia_giam' => null, 'phan_tram_giam' => null, 'mo_ta' => 'Bó hoa hồng pastel dịu dàng, phù hợp tặng bạn gái, mẹ, chị em phụ nữ. Tone màu nhẹ nhàng, thanh lịch.', 'hinh_anh' => 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 1, 'id_mua' => 1, 'id_dip_le' => 1, 'noi_bat' => true, 'tinh_trang' => 1],
            ['ten_bo_hoa' => 'Hồng Trắng Thuần Khiết', 'gia' => 400000, 'gia_giam' => 360000, 'phan_tram_giam' => 10, 'mo_ta' => 'Bó hoa hồng trắng tinh khôi, tượng trưng cho sự thuần khiết và tình yêu chân thành.', 'hinh_anh' => 'https://images.unsplash.com/photo-1487530811176-3780de880c2d?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 1, 'id_mua' => 2, 'id_dip_le' => 2, 'noi_bat' => true, 'tinh_trang' => 1],
            
            // Hoa Lan - Sang trọng
            ['ten_bo_hoa' => 'Lan Hồ Điệp Trắng', 'gia' => 800000, 'gia_giam' => 720000, 'phan_tram_giam' => 10, 'mo_ta' => 'Chậu lan hồ điệp trắng sang trọng, phù hợp làm quà tặng khai trương, tân gia.', 'hinh_anh' => 'https://images.unsplash.com/photo-1566667586429-b16d5ed2b0f0?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 2, 'id_mua' => 1, 'id_dip_le' => 4, 'noi_bat' => true, 'tinh_trang' => 1],
            ['ten_bo_hoa' => 'Lan Hồ Điệp Tím', 'gia' => 900000, 'gia_giam' => null, 'phan_tram_giam' => null, 'mo_ta' => 'Chậu lan hồ điệp tím quý phái, thể hiện sự sang trọng và đẳng cấp.', 'hinh_anh' => 'https://images.unsplash.com/photo-1520763185298-1b434c919102?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 2, 'id_mua' => 3, 'id_dip_le' => 4, 'noi_bat' => false, 'tinh_trang' => 1],
            
            // Hoa Cúc - Thuần khiết
            ['ten_bo_hoa' => 'Cúc Họa Mi Tinh Khôi', 'gia' => 250000, 'gia_giam' => null, 'phan_tram_giam' => null, 'mo_ta' => 'Bó hoa cúc họa mi trắng tinh, mang vẻ đẹp giản dị nhưng đầy sức sống.', 'hinh_anh' => 'https://images.unsplash.com/photo-1508610048659-a06b669e3321?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 3, 'id_mua' => 3, 'id_dip_le' => 3, 'noi_bat' => false, 'tinh_trang' => 1],
            ['ten_bo_hoa' => 'Cúc Vàng Rực Rỡ', 'gia' => 280000, 'gia_giam' => 250000, 'phan_tram_giam' => 11, 'mo_ta' => 'Bó hoa cúc vàng rực rỡ, tượng trưng cho sự may mắn và thịnh vượng.', 'hinh_anh' => 'https://images.unsplash.com/photo-1474557157379-8aa74a6ef541?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 3, 'id_mua' => 2, 'id_dip_le' => 6, 'noi_bat' => true, 'tinh_trang' => 1],
            
            // Hoa Ly - Quyến rũ
            ['ten_bo_hoa' => 'Ly Trắng Thanh Lịch', 'gia' => 450000, 'gia_giam' => null, 'phan_tram_giam' => null, 'mo_ta' => 'Bó hoa ly trắng thanh lịch, hương thơm ngọt ngào, phù hợp trang trí phòng khách.', 'hinh_anh' => 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 4, 'id_mua' => 4, 'id_dip_le' => 1, 'noi_bat' => true, 'tinh_trang' => 1],
            ['ten_bo_hoa' => 'Ly Hồng Quyến Rũ', 'gia' => 480000, 'gia_giam' => 430000, 'phan_tram_giam' => 10, 'mo_ta' => 'Bó hoa ly hồng quyến rũ, tươi lâu, hương thơm dịu nhẹ.', 'hinh_anh' => 'https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 4, 'id_mua' => 1, 'id_dip_le' => 5, 'noi_bat' => false, 'tinh_trang' => 1],
            
            // Hoa Tulip - Thanh lịch
            ['ten_bo_hoa' => 'Tulip Đỏ Rực Rỡ', 'gia' => 550000, 'gia_giam' => 500000, 'phan_tram_giam' => 9, 'mo_ta' => 'Bó tulip đỏ nhập khẩu Hà Lan, tươi lâu 7-10 ngày, sang trọng và đẳng cấp.', 'hinh_anh' => 'https://images.unsplash.com/photo-1520763185298-1b434c919102?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 5, 'id_mua' => 1, 'id_dip_le' => 1, 'noi_bat' => true, 'tinh_trang' => 1],
            ['ten_bo_hoa' => 'Tulip Mix Color', 'gia' => 600000, 'gia_giam' => null, 'phan_tram_giam' => null, 'mo_ta' => 'Bó tulip mix nhiều màu sắc, tạo nên vẻ đẹp rực rỡ và tươi vui.', 'hinh_anh' => 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 5, 'id_mua' => 1, 'id_dip_le' => 5, 'noi_bat' => false, 'tinh_trang' => 1],
            
            // Hoa Sen - Tinh tế
            ['ten_bo_hoa' => 'Sen Hồng Thanh Tao', 'gia' => 350000, 'gia_giam' => null, 'phan_tram_giam' => null, 'mo_ta' => 'Bó hoa sen hồng thanh tao, mang đậm nét đẹp Việt Nam, hương thơm dịu nhẹ.', 'hinh_anh' => 'https://images.unsplash.com/photo-1474557157379-8aa74a6ef541?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 6, 'id_mua' => 2, 'id_dip_le' => 6, 'noi_bat' => false, 'tinh_trang' => 1],
            
            // Hoa Hướng Dương - Năng lượng
            ['ten_bo_hoa' => 'Hướng Dương Rạng Rỡ', 'gia' => 320000, 'gia_giam' => 290000, 'phan_tram_giam' => 9, 'mo_ta' => 'Bó hoa hướng dương tươi tắn, mang năng lượng tích cực, phù hợp tặng bạn bè.', 'hinh_anh' => 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 7, 'id_mua' => 2, 'id_dip_le' => 5, 'noi_bat' => true, 'tinh_trang' => 1],
            ['ten_bo_hoa' => 'Hướng Dương Baby Mix', 'gia' => 280000, 'gia_giam' => null, 'phan_tram_giam' => null, 'mo_ta' => 'Bó hoa hướng dương kết hợp baby trắng, tươi vui và đáng yêu.', 'hinh_anh' => 'https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 7, 'id_mua' => 2, 'id_dip_le' => 5, 'noi_bat' => false, 'tinh_trang' => 1],
            
            // Hoa Baby - Nhẹ nhàng
            ['ten_bo_hoa' => 'Baby Trắng Tinh Khôi', 'gia' => 200000, 'gia_giam' => 180000, 'phan_tram_giam' => 10, 'mo_ta' => 'Bó baby trắng tinh khôi, nhẹ nhàng và dễ thương.', 'hinh_anh' => 'https://images.unsplash.com/photo-1487530811176-3780de880c2d?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 8, 'id_mua' => 1, 'id_dip_le' => 1, 'noi_bat' => false, 'tinh_trang' => 1],
            ['ten_bo_hoa' => 'Baby Hồng Dịu Dàng', 'gia' => 220000, 'gia_giam' => null, 'phan_tram_giam' => null, 'mo_ta' => 'Bó baby hồng dịu dàng, phù hợp làm quà tặng nhẹ nhàng, ý nghĩa.', 'hinh_anh' => 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 8, 'id_mua' => 1, 'id_dip_le' => 5, 'noi_bat' => false, 'tinh_trang' => 1],
            
            // Thêm sản phẩm đặc biệt
            ['ten_bo_hoa' => 'Giỏ Hoa Sang Trọng', 'gia' => 1200000, 'gia_giam' => 1000000, 'phan_tram_giam' => 17, 'mo_ta' => 'Giỏ hoa mix cao cấp, kết hợp hồng, lan, ly, phù hợp làm quà tặng VIP.', 'hinh_anh' => 'https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 1, 'id_mua' => 1, 'id_dip_le' => 4, 'noi_bat' => true, 'tinh_trang' => 1],
            ['ten_bo_hoa' => 'Hoa Cưới Cầm Tay', 'gia' => 650000, 'gia_giam' => null, 'phan_tram_giam' => null, 'mo_ta' => 'Bó hoa cưới cầm tay tinh tế, thiết kế theo yêu cầu cô dâu.', 'hinh_anh' => 'https://images.unsplash.com/photo-1487530811176-3780de880c2d?w=500&h=500&fit=crop', 'facebook' => 'fb.com/shophoa', 'so_dien_thoai' => '0901234567', 'zalo' => '0901234567', 'id_danh_muc' => 1, 'id_mua' => 1, 'id_dip_le' => 2, 'noi_bat' => true, 'tinh_trang' => 1],
        ];

        foreach ($products as $product) {
            $product['created_at'] = now();
            $product['updated_at'] = now();
            DB::table('bo_hoas')->insert($product);
        }
    }
}
