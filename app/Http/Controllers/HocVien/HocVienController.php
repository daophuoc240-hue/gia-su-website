<?php

namespace App\Http\Controllers\HocVien;

use App\Http\Controllers\Controller;
use App\Models\LopHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HocVienController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $lop_hocs = LopHoc::where('hoc_vien_id', $user->id)->latest()->take(5)->get();

        $stats = [
            'dang_tim'      => LopHoc::where('hoc_vien_id', $user->id)->where('trang_thai', 'dang_tim')->count(),
            'da_co_gia_su'  => LopHoc::where('hoc_vien_id', $user->id)->where('trang_thai', 'da_co_gia_su')->count(),
            'hoan_thanh'    => LopHoc::where('hoc_vien_id', $user->id)->where('trang_thai', 'hoan_thanh')->count(),
            'tong_lop'      => LopHoc::where('hoc_vien_id', $user->id)->count(),
        ];

        return view('hoc-vien.dashboard', compact('user', 'lop_hocs', 'stats'));
    }

    public function taoYeuCau()
    {
        return view('hoc-vien.tao-yeu-cau');
    }

    public function guiYeuCau(Request $request)
    {
        $request->validate([
            'mon_hoc'      => 'required|string|max:100',
            'khoi_lop'     => 'required|string|max:50',
            'so_buoi_tuan' => 'required|integer|min:1|max:7',
            'dia_chi_day'  => 'required|string|max:255',
            'muc_hoc_phi'  => 'required|numeric|min:0',
            'yeu_cau_them' => 'nullable|string|max:500',
        ], [
            'mon_hoc.required'      => 'Vui lòng nhập môn học.',
            'khoi_lop.required'     => 'Vui lòng chọn khối lớp.',
            'so_buoi_tuan.required' => 'Vui lòng nhập số buổi học trong tuần.',
            'dia_chi_day.required'  => 'Vui lòng nhập địa chỉ dạy.',
            'muc_hoc_phi.required'  => 'Vui lòng nhập mức học phí.',
        ]);

        LopHoc::create([
            'hoc_vien_id'  => Auth::id(),
            'mon_hoc'      => $request->mon_hoc,
            'khoi_lop'     => $request->khoi_lop,
            'so_buoi_tuan' => $request->so_buoi_tuan,
            'dia_chi_day'  => $request->dia_chi_day,
            'muc_hoc_phi'  => $request->muc_hoc_phi,
            'yeu_cau_them' => $request->yeu_cau_them,
            'trang_thai'   => 'dang_tim',
        ]);

        return redirect()->route('hocvien.danh-sach-lop')
            ->with('success', 'Đã gửi yêu cầu tìm gia sư thành công! Trung tâm sẽ sớm xử lý.');
    }

    public function danhSachLop(Request $request)
    {
        $user  = Auth::user();
        $query = LopHoc::with('giaSu')->where('hoc_vien_id', $user->id);

        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        $lop_hocs = $query->latest()->paginate(10);
        return view('hoc-vien.danh-sach-lop', compact('lop_hocs'));
    }

    public function chiTietLop($id)
    {
        $user = Auth::user();
        $lop  = LopHoc::with(['giaSu.hoSoGiaSu', 'dangKyNhanLops.giaSu'])
            ->where('hoc_vien_id', $user->id)
            ->findOrFail($id);
        return view('hoc-vien.chi-tiet-lop', compact('lop'));
    }

    public function huyLop($id)
    {
        $user = Auth::user();
        $lop  = LopHoc::where('hoc_vien_id', $user->id)
            ->where('trang_thai', 'dang_tim')
            ->findOrFail($id);
        $lop->update(['trang_thai' => 'da_huy']);
        return redirect()->route('hocvien.danh-sach-lop')->with('success', 'Đã hủy yêu cầu tìm gia sư.');
    }
}
