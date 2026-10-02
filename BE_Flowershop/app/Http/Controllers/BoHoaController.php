<?php

namespace App\Http\Controllers;

use App\Models\BoHoa;
use App\Models\DanhMuc;
use App\Models\MuaHoa;
use App\Models\DipLe;
use Illuminate\Http\Request;

class BoHoaController extends Controller
{
    private function parseIds($input)
    {
        if (empty($input)) return [];
        if (is_array($input)) return array_values(array_filter(array_map('intval', $input)));
        if (is_string($input)) {
            $decoded = json_decode($input, true);
            if (is_array($decoded)) {
                return array_values(array_filter(array_map('intval', $decoded)));
            }
            return array_values(array_filter(array_map('intval', explode(',', $input))));
        }
        return [intval($input)];
    }

    public function getData()
    {
        $data = BoHoa::with(['danhMucs', 'muaHoas', 'dipLes', 'danhMuc', 'muaHoa', 'dipLe'])
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

            // Xử lý nhiều danh mục, nhiều mùa, nhiều dịp lễ
            $danhMucIds = $this->parseIds($request->danh_muc_ids ?: $request->id_danh_muc);
            $muaIds = $this->parseIds($request->mua_ids ?: $request->id_mua);
            $dipLeIds = $this->parseIds($request->dip_le_ids ?: $request->id_dip_le);

            $boHoa->id_danh_muc = !empty($danhMucIds) ? $danhMucIds[0] : null;
            $boHoa->id_mua = !empty($muaIds) ? $muaIds[0] : null;
            $boHoa->id_dip_le = !empty($dipLeIds) ? $dipLeIds[0] : null;

            $boHoa->noi_bat = $request->noi_bat == 1 || $request->noi_bat == '1' || $request->noi_bat === true;
            $boHoa->tinh_trang = $request->tinh_trang ?? 1;

            // Upload nhiều hình ảnh (tối đa 5)
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $imagePaths = [];
                
                if (!is_array($images)) {
                    $images = [$images];
                }
                
                foreach ($images as $index => $image) {
                    $fileName = time() . '_' . $index . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $image->getClientOriginalName());
                    $image->move(public_path('uploads/bo_hoa'), $fileName);
                    $imagePaths[] = '/uploads/bo_hoa/' . $fileName;
                }
                
                if (count($imagePaths) > 0) {
                    $boHoa->hinh_anh = $imagePaths[0];
                }
                
                if (count($imagePaths) > 1) {
                    $boHoa->hinh_anh_phu = json_encode(array_slice($imagePaths, 1));
                }
            }

            $boHoa->save();

            // Đồng bộ quan hệ nhiều-nhiều
            $boHoa->danhMucs()->sync($danhMucIds);
            $boHoa->muaHoas()->sync($muaIds);
            $boHoa->dipLes()->sync($dipLeIds);

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

            // Xử lý nhiều danh mục, nhiều mùa, nhiều dịp lễ
            if ($request->has('danh_muc_ids') || $request->has('id_danh_muc')) {
                $danhMucIds = $this->parseIds($request->danh_muc_ids ?: $request->id_danh_muc);
                $boHoa->id_danh_muc = !empty($danhMucIds) ? $danhMucIds[0] : null;
                $boHoa->danhMucs()->sync($danhMucIds);
            }

            if ($request->has('mua_ids') || $request->has('id_mua')) {
                $muaIds = $this->parseIds($request->mua_ids ?: $request->id_mua);
                $boHoa->id_mua = !empty($muaIds) ? $muaIds[0] : null;
                $boHoa->muaHoas()->sync($muaIds);
            }

            if ($request->has('dip_le_ids') || $request->has('id_dip_le')) {
                $dipLeIds = $this->parseIds($request->dip_le_ids ?: $request->id_dip_le);
                $boHoa->id_dip_le = !empty($dipLeIds) ? $dipLeIds[0] : null;
                $boHoa->dipLes()->sync($dipLeIds);
            }

            $boHoa->noi_bat = $request->noi_bat == 1 || $request->noi_bat == '1' || $request->noi_bat === true;
            $boHoa->tinh_trang = $request->tinh_trang ?? $boHoa->tinh_trang;

            // Chỉ cập nhật ảnh nếu có ảnh mới được upload
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $imagePaths = [];
                
                if (!is_array($images)) {
                    $images = [$images];
                }
                
                foreach ($images as $index => $image) {
                    $fileName = time() . '_' . $index . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $image->getClientOriginalName());
                    $image->move(public_path('uploads/bo_hoa'), $fileName);
                    $imagePaths[] = '/uploads/bo_hoa/' . $fileName;
                }
                
                if (count($imagePaths) > 0) {
                    $boHoa->hinh_anh = $imagePaths[0];
                }
                
                if (count($imagePaths) > 1) {
                    $boHoa->hinh_anh_phu = json_encode(array_slice($imagePaths, 1));
                } else {
                    $boHoa->hinh_anh_phu = null;
                }
            }

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

        $boHoa->danhMucs()->detach();
        $boHoa->muaHoas()->detach();
        $boHoa->dipLes()->detach();
        $boHoa->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa bó hoa thành công!'
        ]);
    }

    // Client: Chi tiết bó hoa
    public function chiTiet($id)
    {
        $boHoa = BoHoa::with(['danhMucs', 'muaHoas', 'dipLes', 'danhMuc', 'muaHoa', 'dipLe'])->find($id);
        if (!$boHoa) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy bó hoa!'
            ]);
        }

        // Lấy danh sách ID danh mục, mùa, dịp của bó hoa hiện tại
        $catIds = $boHoa->danhMucs->pluck('id')->toArray();
        if ($boHoa->id_danh_muc && !in_array($boHoa->id_danh_muc, $catIds)) {
            $catIds[] = $boHoa->id_danh_muc;
        }

        $muaIds = $boHoa->muaHoas->pluck('id')->toArray();
        if ($boHoa->id_mua && !in_array($boHoa->id_mua, $muaIds)) {
            $muaIds[] = $boHoa->id_mua;
        }

        $dipIds = $boHoa->dipLes->pluck('id')->toArray();
        if ($boHoa->id_dip_le && !in_array($boHoa->id_dip_le, $dipIds)) {
            $dipIds[] = $boHoa->id_dip_le;
        }

        // Lấy sản phẩm liên quan (chia sẻ bất kỳ danh mục, mùa, hoặc dịp nào)
        $lienQuan = BoHoa::with(['danhMucs', 'muaHoas', 'dipLes'])
            ->where('id', '!=', $id)
            ->where('tinh_trang', 1)
            ->where(function($query) use ($catIds, $muaIds, $dipIds) {
                if (!empty($catIds)) {
                    $query->whereIn('id_danh_muc', $catIds)
                        ->orWhereHas('danhMucs', function($q) use ($catIds) {
                            $q->whereIn('danh_mucs.id', $catIds);
                        });
                }
                if (!empty($muaIds)) {
                    $query->orWhereIn('id_mua', $muaIds)
                        ->orWhereHas('muaHoas', function($q) use ($muaIds) {
                            $q->whereIn('mua_hoas.id', $muaIds);
                        });
                }
                if (!empty($dipIds)) {
                    $query->orWhereIn('id_dip_le', $dipIds)
                        ->orWhereHas('dipLes', function($q) use ($dipIds) {
                            $q->whereIn('dip_les.id', $dipIds);
                        });
                }
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
        $query = BoHoa::with(['danhMucs', 'muaHoas', 'dipLes', 'danhMuc', 'muaHoa', 'dipLe'])
            ->where('tinh_trang', 1);

        // Lọc theo Danh Mục (nằm trong pivot hoặc cột cũ)
        if ($request->id_danh_muc) {
            $id = $request->id_danh_muc;
            $query->where(function($q) use ($id) {
                $q->where('id_danh_muc', $id)
                  ->orWhereHas('danhMucs', function($sub) use ($id) {
                      $sub->where('danh_mucs.id', $id);
                  });
            });
        }

        // Lọc theo Mùa Hoa (nằm trong pivot hoặc cột cũ)
        if ($request->id_mua) {
            $id = $request->id_mua;
            $query->where(function($q) use ($id) {
                $q->where('id_mua', $id)
                  ->orWhereHas('muaHoas', function($sub) use ($id) {
                      $sub->where('mua_hoas.id', $id);
                  });
            });
        }

        // Lọc theo Dịp Lễ (nằm trong pivot hoặc cột cũ)
        if ($request->id_dip_le) {
            $id = $request->id_dip_le;
            $query->where(function($q) use ($id) {
                $q->where('id_dip_le', $id)
                  ->orWhereHas('dipLes', function($sub) use ($id) {
                      $sub->where('dip_les.id', $id);
                  });
            });
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
