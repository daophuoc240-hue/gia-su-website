<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\GiaSu\GiaSuController;
use App\Http\Controllers\HocVien\HocVienController;
use App\Http\Controllers\TaiKhoanController;

/*
|--------------------------------------------------------------------------
| Web Routes - Enterprise Graduation Project Setup
|--------------------------------------------------------------------------
*/

// ==================== PUBLIC PORTAL ROUTES ====================
Route::get('/',                 [HomeController::class, 'index'])->name('home');
Route::get('/danh-sach-gia-su',  [HomeController::class, 'danhSachGiaSu'])->name('danh-sach-gia-su');
Route::get('/gia-su/{id}',      [HomeController::class, 'chiTietGiaSu'])->whereNumber('id')->name('chi-tiet-gia-su');
Route::get('/danh-sach-lop-hoc',[HomeController::class, 'danhSachLopHoc'])->name('danh-sach-lop-hoc');
Route::get('/lop-hoc/{id}',     [HomeController::class, 'chiTietLopHoc'])->whereNumber('id')->name('chi-tiet-lop-hoc');
Route::get('/gioi-thieu',       [HomeController::class, 'gioiThieu'])->name('gioi-thieu');
Route::get('/lien-he',          [HomeController::class, 'lienHe'])->name('lien-he');

// ==================== AUTH ROUTES ====================
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ==================== CÀI ĐẶT TÀI KHOẢN (CHUNG) ====================
Route::middleware('auth')->group(function () {
    Route::get('/cai-dat-tai-khoan',               [TaiKhoanController::class, 'caiDat'])->name('tai-khoan.cai-dat');
    Route::post('/cai-dat-tai-khoan/thong-tin',    [TaiKhoanController::class, 'capNhatThongTin'])->name('tai-khoan.thong-tin');
    Route::post('/cai-dat-tai-khoan/doi-mat-khau', [TaiKhoanController::class, 'doiMatKhau'])->name('tai-khoan.doi-mat-khau');
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Quản lý tài khoản
    Route::get('/tai-khoan',              [AdminController::class, 'danhSachTaiKhoan'])->name('tai-khoan.index');
    Route::post('/tai-khoan/{id}/khoa',   [AdminController::class, 'khoaTaiKhoan'])->name('tai-khoan.khoa');
    Route::post('/tai-khoan/{id}/mo-khoa', [AdminController::class, 'moKhoaTaiKhoan'])->name('tai-khoan.mo-khoa');

    // Duyệt hồ sơ gia sư
    Route::get('/ho-so',                  [AdminController::class, 'danhSachHoSo'])->name('ho-so.index');
    Route::get('/ho-so/{id}',             [AdminController::class, 'chiTietHoSo'])->name('ho-so.chi-tiet');
    Route::post('/ho-so/{id}/duyet',      [AdminController::class, 'duyetHoSo'])->name('ho-so.duyet');
    Route::post('/ho-so/{id}/tu-choi',    [AdminController::class, 'tuChoiHoSo'])->name('ho-so.tu-choi');

    // Quản lý lớp học
    Route::get('/lop-hoc',                      [AdminController::class, 'danhSachLop'])->name('lop-hoc.index');
    Route::get('/lop-hoc/{id}',                 [AdminController::class, 'chiTietLop'])->name('lop-hoc.chi-tiet');
    Route::get('/lop-hoc/{id}/sua',             [AdminController::class, 'suaLop'])->name('lop-hoc.sua');
    Route::put('/lop-hoc/{id}',                 [AdminController::class, 'capNhatLop'])->name('lop-hoc.cap-nhat');
    Route::delete('/lop-hoc/{id}',              [AdminController::class, 'xoaLop'])->name('lop-hoc.xoa');

    // Phân công lớp
    Route::get('/lop-hoc/{id}/phan-cong',       [AdminController::class, 'phanCongLop'])->name('lop-hoc.phan-cong');
    Route::post('/lop-hoc/{id}/xac-nhan-phan-cong', [AdminController::class, 'xacNhanPhanCong'])->name('lop-hoc.xac-nhan-phan-cong');
});

// ==================== GIA SU ROUTES ====================
Route::prefix('gia-su')->name('giasu.')->middleware(['auth', 'role:giasu'])->group(function () {
    Route::get('/dashboard',     [GiaSuController::class, 'dashboard'])->name('dashboard');
    Route::get('/ho-so',         [GiaSuController::class, 'hoSo'])->name('ho-so');
    Route::post('/ho-so',        [GiaSuController::class, 'capNhatHoSo'])->name('ho-so.cap-nhat');
    Route::get('/tim-kiem-lop',  [GiaSuController::class, 'timKiemLop'])->name('tim-kiem-lop');
    Route::post('/dang-ky-lop/{lop_id}', [GiaSuController::class, 'dangKyNhanLop'])->name('dang-ky-lop');
    Route::get('/ket-qua',       [GiaSuController::class, 'ketQuaDangKy'])->name('ket-qua');
});

// ==================== HỌC VIÊN ROUTES ====================
Route::prefix('hoc-vien')->name('hocvien.')->middleware(['auth', 'role:hocvien'])->group(function () {
    Route::get('/dashboard',       [HocVienController::class, 'dashboard'])->name('dashboard');
    Route::get('/tao-yeu-cau',     [HocVienController::class, 'taoYeuCau'])->name('tao-yeu-cau');
    Route::post('/tao-yeu-cau',    [HocVienController::class, 'guiYeuCau'])->name('gui-yeu-cau');
    Route::get('/danh-sach-lop',   [HocVienController::class, 'danhSachLop'])->name('danh-sach-lop');
    Route::get('/lop/{id}',        [HocVienController::class, 'chiTietLop'])->name('chi-tiet-lop');
    Route::post('/lop/{id}/danh-gia', [HocVienController::class, 'danhGiaGiaSu'])->name('danh-gia');
    Route::post('/lop/{id}/huy',   [HocVienController::class, 'huyLop'])->name('huy-lop');
});
