<?php

namespace App\Http\Controllers;

use App\Models\MuaHoa;
use Illuminate\Http\Request;

class MuaHoaController extends Controller
{
    public function getData()
    {
        $data = MuaHoa::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        $muaHoa = new MuaHoa();
        $muaHoa->ten_mua = $request->ten_mua;
        $muaHoa->mo_ta = $request->mo_ta;
        $muaHoa->tinh_trang = $request->tinh_trang ?? 1;
        $muaHoa->save();

        return response()->json([
            'status' => true,
            'message' => 'Thêm mùa hoa thành công!'
        ]);
    }

    public function update(Request $request)
    {
        $muaHoa = MuaHoa::find($request->id);
        if (!$muaHoa) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy mùa hoa!'
            ]);
        }

        $muaHoa->ten_mua = $request->ten_mua;
        $muaHoa->mo_ta = $request->mo_ta;
        $muaHoa->tinh_trang = $request->tinh_trang ?? $muaHoa->tinh_trang;
        $muaHoa->save();

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật mùa hoa thành công!'
        ]);
    }

    public function delete(Request $request)
    {
        $muaHoa = MuaHoa::find($request->id);
        if (!$muaHoa) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy mùa hoa!'
            ]);
        }

        $muaHoa->delete();
        return response()->json([
            'status' => true,
            'message' => 'Xóa mùa hoa thành công!'
        ]);
    }

    // Client: Lấy bó hoa theo mùa
    public function layBoHoa($id)
    {
        $muaHoa = MuaHoa::with('boHoas')->find($id);
        if (!$muaHoa) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy mùa hoa!'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $muaHoa
        ]);
    }
}
