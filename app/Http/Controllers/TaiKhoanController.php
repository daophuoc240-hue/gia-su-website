<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\TaiKhoan;

class TaiKhoanController extends Controller
{
    public function caiDat()
    {
        $user = Auth::user();
        return view('tai-khoan.cai-dat', compact('user'));
    }

    public function capNhatThongTin(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'ho_ten'        => 'required|string|max:255',
            'so_dien_thoai' => 'nullable|string|max:15',
        ], [
            'ho_ten.required' => 'Vui lòng nhập họ và tên.',
        ]);

        $user->update([
            'ho_ten'        => $request->ho_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
        ]);

        return back()->with('success', 'Đã cập nhật thông tin cá nhân thành công!');
    }

    public function doiMatKhau(Request $request)
    {
        $request->validate([
            'mat_khau_cu'  => 'required',
            'mat_khau_moi' => 'required|min:6|confirmed',
        ], [
            'mat_khau_cu.required'   => 'Vui lòng nhập mật khẩu hiện tại.',
            'mat_khau_moi.required'  => 'Vui lòng nhập mật khẩu mới.',
            'mat_khau_moi.min'       => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'mat_khau_moi.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->mat_khau_cu, $user->password)) {
            return back()->withErrors(['mat_khau_cu' => 'Mật khẩu hiện tại không chính xác.']);
        }

        $user->update([
            'password' => Hash::make($request->mat_khau_moi),
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công! Mật khẩu mới đã được lưu.');
    }
}
