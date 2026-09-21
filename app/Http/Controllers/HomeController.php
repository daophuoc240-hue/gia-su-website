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
                  ->orWhere('mon_day', 'like', "%{$kw}%")
                  ->orWhereHas('taiKhoan', function($sq) use ($kw) {
                      $sq->where('ho_ten', 'like', "%{$kw}%");
                  });
            });
        }

        if ($request->filled('khu_vuc')) {
            $this->applyLocationFilter($query, 'khu_vuc_nhan_day', $request->khu_vuc);
        }

        // Sắp xếp gia sư theo tiêu chí
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'rating_desc'  => $query->orderByDesc('diem_trung_binh')->orderByDesc('so_luot_danh_gia'),
            'rating_count' => $query->orderByDesc('so_luot_danh_gia')->orderByDesc('diem_trung_binh'),
            'classes_desc' => $query->orderByDesc('so_lop_da_day')->orderByDesc('diem_trung_binh'),
            'fee_asc'      => $query->orderBy('hoc_phi_theo_gio', 'asc'),
            'fee_desc'     => $query->orderByDesc('hoc_phi_theo_gio'),
            default        => $query->latest(),
        };

        $gia_sus = $query->paginate(9);

        return view('home.danh-sach-gia-su', compact('gia_sus'));
    }

    public function chiTietGiaSu($id)
    {
        $ho_so = HoSoGiaSu::with(['taiKhoan', 'taiKhoan.danhGias.hocVien'])
            ->where('trang_thai_duyet', 'da_duyet')
            ->findOrFail($id);

        $danh_gias = DanhGia::with('hocVien')
            ->where('gia_su_id', $ho_so->tai_khoan_id)
            ->latest()
            ->get();

        return view('home.chi-tiet-gia-su', compact('ho_so', 'danh_gias'));
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
            $this->applyLocationFilter($query, 'dia_chi_day', $request->dia_chi);
        }

        $lop_hocs = $query->latest()->paginate(9);

        return view('home.danh-sach-lop-hoc', compact('lop_hocs'));
    }

    /**
     * Bộ lọc địa điểm thông minh: Tự động chuẩn hóa Huyện/Quận và Tỉnh/Thành
     */
    private function applyLocationFilter($query, string $column, string $input): void
    {
        $raw = trim($input);
        if ($raw === '') return;

        $terms = [$raw];

        // 1. Tách nếu người dùng chọn định dạng "TP. Hồ Chí Minh - Quận 1"
        if (str_contains($raw, '-')) {
            $parts = explode('-', $raw);
            foreach ($parts as $part) {
                $p = trim($part);
                if ($p !== '') {
                    $terms[] = $p;
                }
            }
        }

        // 2. Xử lý viết tắt Quận / Q: "Quận 1" <-> "Q.1" <-> "Q1"
        foreach ([$raw, ...$terms] as $t) {
            if (preg_match('/(?:quận|q\.?)\s*(\d+)/ui', $t, $m)) {
                $num = $m[1];
                $terms[] = "Quận " . $num;
                $terms[] = "Q." . $num;
                $terms[] = "Q" . $num;
            }
        }

        // 3. Xử lý Tỉnh / Thành phố đồng nghĩa
        if (preg_match('/(?:hồ chí minh|hcm|tp\.?hcm|sài gòn)/ui', $raw)) {
            $terms[] = "Hồ Chí Minh";
            $terms[] = "TP.HCM";
            $terms[] = "TP. Hồ Chí Minh";
        }
        if (preg_match('/(?:hà nội|hn)/ui', $raw)) {
            $terms[] = "Hà Nội";
        }
        if (preg_match('/(?:đà nẵng|dn)/ui', $raw)) {
            $terms[] = "Đà Nẵng";
        }

        $terms = array_unique(array_filter($terms));

        $query->where(function($q) use ($column, $terms) {
            foreach ($terms as $term) {
                $q->orWhere($column, 'like', "%{$term}%");
            }
        });
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
