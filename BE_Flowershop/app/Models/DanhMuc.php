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
        return $this->hasMany(BoHoa::class, 'id_danh_muc');
    }

    const AN = 0;
    const HOAT_DONG = 1;
}
