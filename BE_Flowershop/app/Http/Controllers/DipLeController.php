<?php

namespace App\Http\Controllers;

use App\Models\DipLe;
use Illuminate\Http\Request;

class DipLeController extends Controller
{
    public function getData()
    {
        $data = DipLe::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        $dipLe = new DipLe();
        $dipLe->ten_dip = $request->ten_dip;
        $dipLe->mo_ta = $request->mo_ta;
        $dipLe->tinh_trang = $request->tinh_trang ?? 1;
        $dipLe->save();

        return response()->json([
            'status' => true,
            'message' => 'Thêm dịp lễ thành công!'
        ]);
    }

    public function update(Request $request)
    {
        $dipLe = DipLe::find($request->id);
        if (!$dipLe) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy dịp lễ!'
            ]);
        }

        $dipLe->ten_dip = $request->ten_dip;
        $dipLe->mo_ta = $request->mo_ta;
        $dipLe->tinh_trang = $request->tinh_trang ?? $dipLe->tinh_trang;
        $dipLe->save();

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật dịp lễ thành công!'
        ]);
    }

    public function delete(Request $request)
    {
        $dipLe = DipLe::find($request->id);
        if (!$dipLe) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy dịp lễ!'
            ]);
        }

        $dipLe->delete();
        return response()->json([
            'status' => true,
            'message' => 'Xóa dịp lễ thành công!'
        ]);
    }

    // Client: Lấy bó hoa theo dịp lễ
    public function layBoHoa($id)
    {
        $dipLe = DipLe::with('boHoas')->find($id);
        if (!$dipLe) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy dịp lễ!'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $dipLe
        ]);
    }
}
