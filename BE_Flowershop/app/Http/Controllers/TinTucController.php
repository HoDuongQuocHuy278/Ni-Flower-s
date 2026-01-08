<?php

namespace App\Http\Controllers;

use App\Models\TinTuc;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    public function addData(Request $request)
    {
        // return response()->json($request->all());
        TinTuc::create([
            'tieu_de' => $request->tieu_de,
            'noi_dung' => $request->noi_dung,
            'hinh_anh' => $request->hinh_anh,
            'is_noi_bat' => $request->is_noi_bat,
            'tinh_trang' => $request->tinh_trang,
        ]);
        return response()->json([
            'status' => true,
            'message' => "them mới tin tức mới thành công"
        ]);
    }

    // update
    public function update(Request $request)
    {
        TinTuc::where('id', $request->id)
            ->update([
                'tieu_de' => $request->tieu_de,
                'noi_dung' => $request->noi_dung,
                'hinh_anh' => $request->hinh_anh,
                'is_noi_bat' => $request->is_noi_bat,
                'tinh_trang' => $request->tinh_trang,
            ]);
        return response()->json([
            'message' => 'cập nhật thành công',
            'status' => true,
        ]);
    }

    // gọi đầu lên
    public function getData()
    {
        $data = TinTuc::get();
        return response()->json([
            'data' => $data
        ]);
    }
    public function delete(Request $request)
    {
        TinTuc::where('id', $request->id)
            ->delete([
                'tieu_de' => $request->tieu_de,
                'noi_dung' => $request->noi_dung,
                'hinh_anh' => $request->hinh_anh,
                'is_noi_bat' => $request->is_noi_bat,
                'tinh_trang' => $request->tinh_trang,
            ]);
        return response()->json([
            'message' => 'cập nhật thành công',
            'status' => true,
        ]);
    }
}
