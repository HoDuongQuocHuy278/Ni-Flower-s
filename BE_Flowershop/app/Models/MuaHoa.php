<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MuaHoa extends Model
{
    protected $table = "mua_hoas";

    protected $fillable = [
        'ten_mua',
        'mo_ta',
        'tinh_trang',
    ];

    public function boHoas()
    {
        return $this->hasMany(BoHoa::class, 'id_mua');
    }

    const AN = 0;
    const HOAT_DONG = 1;
}
