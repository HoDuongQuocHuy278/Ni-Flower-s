<?php

namespace App\Http\Controllers;

use App\Models\BoHoa;
use App\Models\DanhMuc;
use App\Models\MuaHoa;
use App\Models\DipLe;
use App\Models\TinTuc;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Sản phẩm nổi bật
        $noiBat = BoHoa::with(['danhMuc', 'muaHoa', 'dipLe'])
            ->where('tinh_trang', 1)
            ->where('noi_bat', true)
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        // Sản phẩm mới nhất
        $moiNhat = BoHoa::with(['danhMuc', 'muaHoa', 'dipLe'])
            ->where('tinh_trang', 1)
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        // Danh mục
        $danhMucs = DanhMuc::where('tinh_trang', 1)->get();

        // Mùa hoa
        $muaHoas = MuaHoa::where('tinh_trang', 1)->get();

        // Dịp lễ
        $dipLes = DipLe::where('tinh_trang', 1)->get();

        // Bài viết/Tin tức
        $tinTucs = TinTuc::orderBy('id', 'desc')->limit(6)->get();

        return response()->json([
            'status' => true,
            'noi_bat' => $noiBat,
            'moi_nhat' => $moiNhat,
            'danh_mucs' => $danhMucs,
            'mua_hoas' => $muaHoas,
            'dip_les' => $dipLes,
            'tin_tucs' => $tinTucs
        ]);
    }
}
