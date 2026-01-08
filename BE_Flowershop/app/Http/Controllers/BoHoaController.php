<?php

namespace App\Http\Controllers;

use App\Models\BoHoa;
use App\Models\DanhMuc;
use App\Models\MuaHoa;
use App\Models\DipLe;
use Illuminate\Http\Request;

class BoHoaController extends Controller
{
    public function getData()
    {
        $data = BoHoa::with(['danhMuc', 'muaHoa', 'dipLe'])
            ->orderBy('id', 'desc')
            ->get();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function addData(Request $request)
    {
        try {
            $boHoa = new BoHoa();
            $boHoa->ten_bo_hoa = $request->ten_bo_hoa;
            $boHoa->gia = $request->gia;
            $boHoa->gia_giam = $request->gia_giam;
            $boHoa->phan_tram_giam = $request->phan_tram_giam;
            $boHoa->mo_ta = $request->mo_ta;
            $boHoa->facebook = $request->facebook;
            $boHoa->so_dien_thoai = $request->so_dien_thoai;
            $boHoa->zalo = $request->zalo;
            $boHoa->id_danh_muc = $request->id_danh_muc ?: null;
            $boHoa->id_mua = $request->id_mua ?: null;
            $boHoa->id_dip_le = $request->id_dip_le ?: null;
            $boHoa->noi_bat = $request->noi_bat == 1 || $request->noi_bat == '1' || $request->noi_bat === true;
            $boHoa->tinh_trang = $request->tinh_trang ?? 1;

            // Upload nhiều hình ảnh (tối đa 5)
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $imagePaths = [];
                
                // Đảm bảo là mảng
                if (!is_array($images)) {
                    $images = [$images];
                }
                
                foreach ($images as $index => $image) {
                    $fileName = time() . '_' . $index . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $image->getClientOriginalName());
                    $image->move(public_path('uploads/bo_hoa'), $fileName);
                    $imagePaths[] = '/uploads/bo_hoa/' . $fileName;
                }
                
                // Ảnh đầu tiên là ảnh chính
                if (count($imagePaths) > 0) {
                    $boHoa->hinh_anh = $imagePaths[0];
                }
                
                // Các ảnh còn lại lưu vào hinh_anh_phu dưới dạng JSON
                if (count($imagePaths) > 1) {
                    $boHoa->hinh_anh_phu = json_encode(array_slice($imagePaths, 1));
                }
            }

            $boHoa->save();

            return response()->json([
                'status' => true,
                'message' => 'Thêm bó hoa thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $boHoa = BoHoa::find($request->id);
            if (!$boHoa) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy bó hoa!'
                ]);
            }

            $boHoa->ten_bo_hoa = $request->ten_bo_hoa ?? $boHoa->ten_bo_hoa;
            $boHoa->gia = $request->gia ?? $boHoa->gia;
            $boHoa->gia_giam = $request->gia_giam;
            $boHoa->phan_tram_giam = $request->phan_tram_giam;
            $boHoa->mo_ta = $request->mo_ta ?? $boHoa->mo_ta;
            $boHoa->facebook = $request->facebook ?? $boHoa->facebook;
            $boHoa->so_dien_thoai = $request->so_dien_thoai ?? $boHoa->so_dien_thoai;
            $boHoa->zalo = $request->zalo ?? $boHoa->zalo;
            $boHoa->id_danh_muc = $request->id_danh_muc ?: null;
            $boHoa->id_mua = $request->id_mua ?: null;
            $boHoa->id_dip_le = $request->id_dip_le ?: null;
            $boHoa->noi_bat = $request->noi_bat == 1 || $request->noi_bat == '1' || $request->noi_bat === true;
            $boHoa->tinh_trang = $request->tinh_trang ?? $boHoa->tinh_trang;

            // Chỉ cập nhật ảnh nếu có ảnh mới được upload
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $imagePaths = [];
                
                // Đảm bảo là mảng
                if (!is_array($images)) {
                    $images = [$images];
                }
                
                foreach ($images as $index => $image) {
                    $fileName = time() . '_' . $index . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $image->getClientOriginalName());
                    $image->move(public_path('uploads/bo_hoa'), $fileName);
                    $imagePaths[] = '/uploads/bo_hoa/' . $fileName;
                }
                
                // Ảnh đầu tiên là ảnh chính
                if (count($imagePaths) > 0) {
                    $boHoa->hinh_anh = $imagePaths[0];
                }
                
                // Các ảnh còn lại lưu vào hinh_anh_phu dưới dạng JSON
                if (count($imagePaths) > 1) {
                    $boHoa->hinh_anh_phu = json_encode(array_slice($imagePaths, 1));
                } else {
                    $boHoa->hinh_anh_phu = null;
                }
            }
            // Nếu không có ảnh mới và keep_old_images = 1, giữ nguyên ảnh cũ (không làm gì)

            $boHoa->save();

            return response()->json([
                'status' => true,
                'message' => 'Cập nhật bó hoa thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request)
    {
        $boHoa = BoHoa::find($request->id);
        if (!$boHoa) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy bó hoa!'
            ]);
        }

        $boHoa->delete();
        return response()->json([
            'status' => true,
            'message' => 'Xóa bó hoa thành công!'
        ]);
    }

    // Client: Chi tiết bó hoa
    public function chiTiet($id)
    {
        $boHoa = BoHoa::with(['danhMuc', 'muaHoa', 'dipLe'])->find($id);
        if (!$boHoa) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy bó hoa!'
            ]);
        }

        // Lấy sản phẩm liên quan
        $lienQuan = BoHoa::where('id', '!=', $id)
            ->where(function($query) use ($boHoa) {
                $query->where('id_danh_muc', $boHoa->id_danh_muc)
                    ->orWhere('id_mua', $boHoa->id_mua)
                    ->orWhere('id_dip_le', $boHoa->id_dip_le);
            })
            ->limit(4)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $boHoa,
            'lien_quan' => $lienQuan
        ]);
    }

    // Client: Lấy danh sách bó hoa (filter)
    public function danhSach(Request $request)
    {
        $query = BoHoa::with(['danhMuc', 'muaHoa', 'dipLe'])
            ->where('tinh_trang', 1);

        if ($request->id_danh_muc) {
            $query->where('id_danh_muc', $request->id_danh_muc);
        }
        if ($request->id_mua) {
            $query->where('id_mua', $request->id_mua);
        }
        if ($request->id_dip_le) {
            $query->where('id_dip_le', $request->id_dip_le);
        }
        if ($request->noi_bat) {
            $query->where('noi_bat', true);
        }

        $data = $query->orderBy('id', 'desc')->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}
