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
        return $this->hasMany(BoHoa::class, 'id_dip_le');
    }

    const AN = 0;
    const HOAT_DONG = 1;
}
