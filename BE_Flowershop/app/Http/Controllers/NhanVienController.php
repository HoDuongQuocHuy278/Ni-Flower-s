<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NhanVienController extends Controller
{
    public function addData(Request $request)
    {
        NhanVien::create([
            'email' => $request->email,
            'ho_va_ten' => $request->ho_va_ten,
            'mat_khau' => Hash::make($request->mat_khau ?? '123456'),
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
            'ngay_sinh' => $request->ngay_sinh,
            'tinh_trang' => $request->tinh_trang ?? 1,
            'id_chuc_vu' => $request->id_chuc_vu,
        ]);
        return response()->json([
            'status' => true,
            'message' => "Thêm nhân viên " . $request->ho_va_ten . " thành công"
        ]);
    }

    public function update(Request $request)
    {
        $data = [
            'email' => $request->email,
            'ho_va_ten' => $request->ho_va_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
            'ngay_sinh' => $request->ngay_sinh,
            'tinh_trang' => $request->tinh_trang,
            'id_chuc_vu' => $request->id_chuc_vu,
        ];
        
        if ($request->mat_khau) {
            $data['mat_khau'] = Hash::make($request->mat_khau);
        }
        
        NhanVien::where('id', $request->id)->update($data);
        return response()->json([
            'message' => 'Cập nhật thành công',
            'status' => true,
        ]);
    }

    public function delete(Request $request)
    {
        NhanVien::where('id', $request->id)->delete();
        return response()->json([
            'message' => 'Xóa thành công',
            'status' => true,
        ]);
    }

    public function getData()
    {
        $data = NhanVien::leftJoin('chuc_vus', 'nhan_viens.id_chuc_vu', '=', 'chuc_vus.id')
            ->select('nhan_viens.*', 'chuc_vus.ten_chuc_vu')
            ->get();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function dangNhap(Request $request)
    {
        $nhanVien = NhanVien::leftJoin('chuc_vus', 'nhan_viens.id_chuc_vu', '=', 'chuc_vus.id')
            ->select('nhan_viens.*', 'chuc_vus.ten_chuc_vu', 'chuc_vus.quyen')
            ->where('nhan_viens.email', $request->email)
            ->first();
        
        if (!$nhanVien) {
            return response()->json([
                'status' => false,
                'message' => 'Email không tồn tại!'
            ]);
        }

        if (!Hash::check($request->mat_khau, $nhanVien->mat_khau)) {
            return response()->json([
                'status' => false,
                'message' => 'Mật khẩu không đúng!'
            ]);
        }

        if ($nhanVien->tinh_trang == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản đã bị khóa!'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Đăng nhập thành công!',
            'data' => $nhanVien
        ]);
    }
}

