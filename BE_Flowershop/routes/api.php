<?php

use App\Http\Controllers\BoHoaController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DipLeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MuaHoaController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\TinTucController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// ==================== ADMIN ROUTES ====================

// Danh mục
Route::get('/admin/danh-muc/get-data', [DanhMucController::class, 'getData']);
Route::post('/admin/danh-muc/add-data', [DanhMucController::class, 'addData']);
Route::post('/admin/danh-muc/update-data', [DanhMucController::class, 'update']);
Route::post('/admin/danh-muc/delete-data', [DanhMucController::class, 'delete']);

// Mùa hoa
Route::get('/admin/mua-hoa/get-data', [MuaHoaController::class, 'getData']);
Route::post('/admin/mua-hoa/add-data', [MuaHoaController::class, 'addData']);
Route::post('/admin/mua-hoa/update-data', [MuaHoaController::class, 'update']);
Route::post('/admin/mua-hoa/delete-data', [MuaHoaController::class, 'delete']);

// Dịp lễ
Route::get('/admin/dip-le/get-data', [DipLeController::class, 'getData']);
Route::post('/admin/dip-le/add-data', [DipLeController::class, 'addData']);
Route::post('/admin/dip-le/update-data', [DipLeController::class, 'update']);
Route::post('/admin/dip-le/delete-data', [DipLeController::class, 'delete']);

// Bó hoa (Sản phẩm)
Route::get('/admin/bo-hoa/get-data', [BoHoaController::class, 'getData']);
Route::post('/admin/bo-hoa/add-data', [BoHoaController::class, 'addData']);
Route::post('/admin/bo-hoa/update-data', [BoHoaController::class, 'update']);
Route::post('/admin/bo-hoa/delete-data', [BoHoaController::class, 'delete']);

// Tin tức/Bài viết
Route::get('/admin/tin-tuc/get-data', [TinTucController::class, 'getData']);
Route::post('/admin/tin-tuc/add-data', [TinTucController::class, 'addData']);
Route::post('/admin/tin-tuc/update-data', [TinTucController::class, 'update']);
Route::post('/admin/tin-tuc/delete-data', [TinTucController::class, 'delete']);

// Nhân viên
Route::get('/admin/nhan-vien/get-data', [NhanVienController::class, 'getData']);
Route::post('/admin/nhan-vien/add-data', [NhanVienController::class, 'addData']);
Route::post('/admin/nhan-vien/update-data', [NhanVienController::class, 'update']);
Route::post('/admin/nhan-vien/delete-data', [NhanVienController::class, 'delete']);
Route::post('/admin/dang-nhap', [NhanVienController::class, 'dangNhap']);

// Chức vụ
Route::get('/admin/chuc-vu/get-data', [ChucVuController::class, 'getData']);
Route::post('/admin/chuc-vu/add-data', [ChucVuController::class, 'addData']);
Route::post('/admin/chuc-vu/update-data', [ChucVuController::class, 'update']);
Route::post('/admin/chuc-vu/delete-data', [ChucVuController::class, 'delete']);


// ==================== CLIENT ROUTES ====================

// Trang chủ
Route::get('/client/home-page', [HomeController::class, 'index']);

// Chi tiết bó hoa
Route::get('/client/bo-hoa/{id}', [BoHoaController::class, 'chiTiet']);

// Danh sách bó hoa (filter)
Route::get('/client/bo-hoa', [BoHoaController::class, 'danhSach']);

// Lấy bó hoa theo mùa
Route::get('/client/mua-hoa/{id}', [MuaHoaController::class, 'layBoHoa']);

// Lấy bó hoa theo dịp lễ
Route::get('/client/dip-le/{id}', [DipLeController::class, 'layBoHoa']);

// Lấy danh sách danh mục
Route::get('/client/danh-muc', [DanhMucController::class, 'getData']);

// Lấy danh sách mùa
Route::get('/client/mua-hoa', [MuaHoaController::class, 'getData']);

// Lấy danh sách dịp lễ
Route::get('/client/dip-le', [DipLeController::class, 'getData']);
