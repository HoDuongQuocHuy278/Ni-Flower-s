<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoHoa extends Model
{
    protected $table = "bo_hoas";

    protected $fillable = [
        'ten_bo_hoa',
        'gia',
        'gia_giam',
        'phan_tram_giam',
        'mo_ta',
        'hinh_anh',
        'facebook',
        'so_dien_thoai',
        'zalo',
        'id_danh_muc',
        'id_mua',
        'id_dip_le',
        'noi_bat',
        'tinh_trang',
    ];

    // Many-to-Many relationships (1 bó hoa thuộc NHIỀU danh mục, NHIỀU mùa, NHIỀU dịp)
    public function danhMucs()
    {
        return $this->belongsToMany(DanhMuc::class, 'bo_hoa_danh_muc', 'id_bo_hoa', 'id_danh_muc')->withTimestamps();
    }

    public function muaHoas()
    {
        return $this->belongsToMany(MuaHoa::class, 'bo_hoa_mua_hoa', 'id_bo_hoa', 'id_mua')->withTimestamps();
    }

    public function dipLes()
    {
        return $this->belongsToMany(DipLe::class, 'bo_hoa_dip_le', 'id_bo_hoa', 'id_dip_le')->withTimestamps();
    }

    // Giữ quan hệ cũ để tương thích ngược nếu cần
    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'id_danh_muc');
    }

    public function muaHoa()
    {
        return $this->belongsTo(MuaHoa::class, 'id_mua');
    }

    public function dipLe()
    {
        return $this->belongsTo(DipLe::class, 'id_dip_le');
    }

    const HET_HANG = 0;
    const CON_HANG = 1;
}
