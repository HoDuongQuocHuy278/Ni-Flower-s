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
