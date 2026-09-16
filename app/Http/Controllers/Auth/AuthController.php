<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Vui lòng nhập email.',
            'email.email'       => 'Email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        // Custom auth with TaiKhoan model
        $user = TaiKhoan::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.'])->withInput();
        }

        if ($user->trang_thai === 'locked') {
            return back()->withErrors(['email' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.'])->withInput();
        }

        Auth::login($user, $request->boolean('remember'));

        return $this->redirectByRole($user);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'ho_ten'        => 'required|string|max:255',
            'email'         => 'required|email|unique:tai_khoans,email',
            'so_dien_thoai' => 'required|string|max:15',
            'password'      => 'required|min:6|confirmed',
            'vai_tro'       => 'required|in:giasu,hocvien',
        ], [
            'ho_ten.required'        => 'Vui lòng nhập họ tên.',
            'email.required'         => 'Vui lòng nhập email.',
            'email.unique'           => 'Email này đã được sử dụng.',
            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại.',
            'password.required'      => 'Vui lòng nhập mật khẩu.',
            'password.min'           => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed'     => 'Xác nhận mật khẩu không khớp.',
            'vai_tro.required'       => 'Vui lòng chọn loại tài khoản.',
        ]);

        $user = TaiKhoan::create([
            'ho_ten'        => $request->ho_ten,
            'email'         => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'password'      => Hash::make($request->password),
            'vai_tro'       => $request->vai_tro,
        ]);

        Auth::login($user);

        return $this->redirectByRole($user)->with('success', 'Đăng ký thành công! Chào mừng ' . $user->ho_ten);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Đã đăng xuất thành công.');
    }

    private function redirectByRole($user)
    {
        return match($user->vai_tro) {
            'admin'   => redirect()->route('admin.dashboard'),
            'giasu'   => redirect()->route('giasu.dashboard'),
            'hocvien' => redirect()->route('hocvien.dashboard'),
            default   => redirect()->route('login'),
        };
    }
}
