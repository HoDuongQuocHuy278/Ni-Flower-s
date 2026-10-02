<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    protected $table = "danh_mucs";

    protected $fillable = [
        'ten_danh_muc',
        'slug',
        'tinh_trang',
    ];

    public function boHoas()
    {
        return $this->belongsToMany(BoHoa::class, 'bo_hoa_danh_muc', 'id_danh_muc', 'id_bo_hoa');
    }

    const AN = 0;
    const HOAT_DONG = 1;
}
