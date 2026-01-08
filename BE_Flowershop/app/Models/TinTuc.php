<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    protected $table= "tin_tucs";

    protected $fillable=[
        'tieu_de',
        'noi_dung',
        'hinh_anh',
        'is_noi_bat',
        'tinh_trang',
    ];
}
