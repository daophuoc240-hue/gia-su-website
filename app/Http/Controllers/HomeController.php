<?php

namespace App\Http\Controllers;

use App\Models\HoSoGiaSu;
use App\Models\LopHoc;
use App\Models\TaiKhoan;
use App\Models\DanhGia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'tong_gia_su'  => HoSoGiaSu::where('trang_thai_duyet', 'da_duyet')->count(),
            'tong_lop_hoc' => LopHoc::count(),
            'thanh_cong'   => LopHoc::where('trang_thai', 'da_co_gia_su')->count(),
            'phu_huynh'    => TaiKhoan::where('vai_tro', 'hocvien')->count(),
        ];

        $gia_su_noi_bat = HoSoGiaSu::with('taiKhoan')
            ->where('trang_thai_duyet', 'da_duyet')
            ->latest()
            ->take(6)
            ->get();

        $lop_moi = LopHoc::where('trang_thai', 'dang_tim')
            ->latest()
            ->take(6)
            ->get();

        $danh_gia_noi_bat = DanhGia::with(['giaSu', 'hocVien'])
            ->latest()
            ->take(4)
            ->get();

        return view('home.index', compact('stats', 'gia_su_noi_bat', 'lop_moi', 'danh_gia_noi_bat'));
    }

    public function danhSachGiaSu(Request $request)
    {
        $query = HoSoGiaSu::with('taiKhoan')->where('trang_thai_duyet', 'da_duyet');

        if ($request->filled('keyword')) {
            $kw = $request->keyword;
            $query->where(function($q) use ($kw) {
                $q->where('truong_hoc', 'like', "%{$kw}%")
                  ->orWhere('chuyen_nganh', 'like', "%{$kw}%")
                  ->orWhere('khu_vuc_nhan_day', 'like', "%{$kw}%")
                  ->orWhereHas('taiKhoan', function($sq) use ($kw) {
                      $sq->where('ho_ten', 'like', "%{$kw}%");
                  });
            });
        }

        if ($request->filled('khu_vuc')) {
            $query->where('khu_vuc_nhan_day', 'like', "%{$request->khu_vuc}%");
        }

        $gia_sus = $query->latest()->paginate(9);

        return view('home.danh-sach-gia-su', compact('gia_sus'));
    }

    public function chiTietGiaSu($id)
    {
        $ho_so = HoSoGiaSu::with(['taiKhoan', 'taiKhoan.danhGias.hocVien'])
            ->where('trang_thai_duyet', 'da_duyet')
            ->findOrFail($id);

        return view('home.chi-tiet-gia-su', compact('ho_so'));
    }

    public function danhSachLopHoc(Request $request)
    {
        $query = LopHoc::where('trang_thai', 'dang_tim');

        if ($request->filled('mon_hoc')) {
            $query->where('mon_hoc', 'like', "%{$request->mon_hoc}%");
        }
        if ($request->filled('khoi_lop')) {
            $query->where('khoi_lop', $request->khoi_lop);
        }
        if ($request->filled('dia_chi')) {
            $query->where('dia_chi_day', 'like', "%{$request->dia_chi}%");
        }

        $lop_hocs = $query->latest()->paginate(9);

        return view('home.danh-sach-lop-hoc', compact('lop_hocs'));
    }

    public function chiTietLopHoc($id)
    {
        $lop = LopHoc::with('hocVien')->findOrFail($id);
        return view('home.chi-tiet-lop-hoc', compact('lop'));
    }

    public function gioiThieu()
    {
        return view('home.gioi-thieu');
    }

    public function lienHe()
    {
        return view('home.lien-he');
    }
}
