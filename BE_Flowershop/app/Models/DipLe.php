<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DipLe extends Model
{
    protected $table = "dip_les";

    protected $fillable = [
        'ten_dip',
        'mo_ta',
        'tinh_trang',
    ];

    public function boHoas()
    {
        return $this->belongsToMany(BoHoa::class, 'bo_hoa_dip_le', 'id_dip_le', 'id_bo_hoa');
    }

    const AN = 0;
    const HOAT_DONG = 1;
}
