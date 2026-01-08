<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DanhMucController extends Controller
{
    public function getData()
    {
        $data = DanhMuc::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        $danhMuc = new DanhMuc();
        $danhMuc->ten_danh_muc = $request->ten_danh_muc;
        $danhMuc->slug = Str::slug($request->ten_danh_muc);
        $danhMuc->tinh_trang = $request->tinh_trang ?? 1;
        $danhMuc->save();

        return response()->json([
            'status' => true,
            'message' => 'Thêm danh mục thành công!'
        ]);
    }

    public function update(Request $request)
    {
        $danhMuc = DanhMuc::find($request->id);
        if (!$danhMuc) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy danh mục!'
            ]);
        }

        $danhMuc->ten_danh_muc = $request->ten_danh_muc;
        $danhMuc->slug = Str::slug($request->ten_danh_muc);
        $danhMuc->tinh_trang = $request->tinh_trang ?? $danhMuc->tinh_trang;
        $danhMuc->save();

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật danh mục thành công!'
        ]);
    }

    public function delete(Request $request)
    {
        $danhMuc = DanhMuc::find($request->id);
        if (!$danhMuc) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy danh mục!'
            ]);
        }

        $danhMuc->delete();
        return response()->json([
            'status' => true,
            'message' => 'Xóa danh mục thành công!'
        ]);
    }
}
