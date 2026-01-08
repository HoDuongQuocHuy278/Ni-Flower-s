<?php

namespace App\Http\Controllers;

use App\Models\ChucVu;
use Illuminate\Http\Request;

class ChucVuController extends Controller
{
    public function getData()
    {
        $data = ChucVu::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        ChucVu::create([
            'ten_chuc_vu' => $request->ten_chuc_vu,
            'mo_ta' => $request->mo_ta,
            'quyen' => $request->quyen ?? 0,
            'tinh_trang' => $request->tinh_trang ?? 1,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Thêm chức vụ thành công!'
        ]);
    }

    public function update(Request $request)
    {
        ChucVu::where('id', $request->id)->update([
            'ten_chuc_vu' => $request->ten_chuc_vu,
            'mo_ta' => $request->mo_ta,
            'quyen' => $request->quyen,
            'tinh_trang' => $request->tinh_trang,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật chức vụ thành công!'
        ]);
    }

    public function delete(Request $request)
    {
        ChucVu::where('id', $request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Xóa chức vụ thành công!'
        ]);
    }
}
