<?php

namespace App\Http\Controllers;

use App\Models\HoSoGiaSu;
use App\Models\LopHoc;
use App\Models\TaiKhoan;
use App\Models\DanhGia;
use App\Models\DangKyNhanLop;
use App\Models\ThongBao;
use App\Models\LienHe;
use App\Helpers\BaiViet;
use App\Helpers\BangGiaHocPhi;
use App\Helpers\DiaDiem;
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
            ->orderByDesc('diem_trung_binh')
            ->latest()
            ->take(6)
            ->get();

        $lop_moi = LopHoc::where('trang_thai', 'dang_tim')
            ->latest()
            ->take(6)
            ->get();

        $danh_gia_noi_bat = DanhGia::with(['giaSu', 'hocVien'])
            ->latest()
            ->take(6)
            ->get();

        return view('home.index', compact('stats', 'gia_su_noi_bat', 'lop_moi', 'danh_gia_noi_bat') + [
            'bai_viets' => array_slice(BaiViet::all(), 0, 3, true),
        ]);
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

        if ($request->filled('tinh_thanh') || $request->filled('quan_huyen') || $request->filled('khu_vuc')) {
            $this->applyLocationFilter(
                $query,
                'khu_vuc_nhan_day',
                $request->input('tinh_thanh'),
                $request->input('quan_huyen'),
                $request->input('khu_vuc')
            );
        }

        // Bộ lọc nâng cao: trình độ, cấp học dạy, mức học phí tối đa
        if ($request->filled('trinh_do') && array_key_exists($request->trinh_do, BangGiaHocPhi::TRINH_DO)) {
            $query->where('trinh_do', $request->trinh_do);
        }
        if ($request->filled('cap_day') && array_key_exists($request->cap_day, BangGiaHocPhi::CAP_DAY)) {
            $query->where('cap_day', $request->cap_day);
        }
        if ($request->filled('hoc_phi_toi_da') && is_numeric($request->hoc_phi_toi_da)) {
            $query->where('hoc_phi_theo_gio', '<=', (float) $request->hoc_phi_toi_da);
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

        $gia_su_tuong_tu = HoSoGiaSu::with('taiKhoan')
            ->where('trang_thai_duyet', 'da_duyet')
            ->where('id', '!=', $ho_so->id)
            ->orderByRaw('CASE WHEN mon_day LIKE ? THEN 0 ELSE 1 END', ['%' . ($ho_so->mon_day ?: 'Toán') . '%'])
            ->orderByDesc('diem_trung_binh')
            ->take(3)
            ->get();

        return view('home.chi-tiet-gia-su', compact('ho_so', 'danh_gias', 'gia_su_tuong_tu'));
    }

    /**
     * Xử lý hành động "Mời Gia Sư Ngay":
     * - Nếu chưa đăng nhập: lưu thông tin gia sư vào Session và chuyển hướng đến trang Đăng nhập (thay vì đăng ký).
     * - Nếu đã đăng nhập với vai trò Học viên / Phụ huynh: chuyển thẳng đến trang Chi tiết Gia sư và cuộn xuống mục Đăng ký lịch dạy.
     * - Sau khi đăng nhập, hệ thống tự động kiểm tra Session để chuyển tiếp tục đến trang chi tiết gia sư mà học viên muốn xem.
     */
    public function moiGiaSu($id)
    {
        $ho_so = HoSoGiaSu::with('taiKhoan')->findOrFail($id);

        if (auth()->check()) {
            $user = auth()->user();
            if ($user->isHocVien()) {
                return redirect(route('chi-tiet-gia-su', $ho_so->id) . '#dang-ky-lich-day')
                    ->with('info', "Bạn đang kết nối trực tiếp với Gia sư {$ho_so->taiKhoan->ho_ten}. Hãy chọn lịch dạy và gửi yêu cầu bên dưới nhé!");
            } else {
                return redirect()->route('chi-tiet-gia-su', $id)
                    ->with('error', 'Chức năng mời gia sư chỉ dành cho tài khoản Phụ huynh / Học viên. Tài khoản hiện tại của bạn là: ' . ($user->isAdmin() ? 'Quản trị viên' : 'Gia sư') . '.');
            }
        }

        // Lưu thông tin gia sư vào Session để sau khi đăng nhập tự động quay lại trang hồ sơ gia sư
        session([
            'moi_gia_su_id'   => $ho_so->id,
            'moi_gia_su_name' => $ho_so->taiKhoan->ho_ten,
            'moi_gia_su_mon'  => $ho_so->mon_day,
            'url.intended'    => route('chi-tiet-gia-su', $ho_so->id) . '#dang-ky-lich-day',
        ]);

        return redirect()->route('login', [
            'moi_gia_su' => $ho_so->id,
            'redirect'   => route('chi-tiet-gia-su', $ho_so->id) . '#dang-ky-lich-day',
        ]);
    }

    /**
     * Học viên đăng ký giờ dạy & gửi lời mời trực tiếp tới gia sư
     */
    public function dangKyGioDay(Request $request, $id)
    {
        if (!auth()->check()) {
            session([
                'moi_gia_su_id' => $id,
                'url.intended'  => route('chi-tiet-gia-su', $id) . '#dang-ky-lich-day',
            ]);
            return redirect()->route('login', [
                'moi_gia_su' => $id,
                'redirect'   => route('chi-tiet-gia-su', $id) . '#dang-ky-lich-day',
            ]);
        }

        $user = auth()->user();
        if (!$user->isHocVien()) {
            return redirect()->route('chi-tiet-gia-su', $id)
                ->with('error', 'Chỉ tài khoản Phụ huynh / Học viên mới có quyền đăng ký giờ dạy với gia sư.');
        }

        $ho_so = HoSoGiaSu::with('taiKhoan')->findOrFail($id);

        $request->validate([
            'mon_hoc'      => 'required|string|max:100',
            'khoi_lop'     => 'required|string|max:50',
            'ngay_hoc'     => 'required|array|min:1',
            'khung_gio'    => 'required|string|max:100',
            'hinh_thuc'    => 'required|in:tai_nha,online',
            'dia_chi_day'  => 'nullable|string|max:255',
            'yeu_cau_them' => 'nullable|string|max:500',
        ], [
            'mon_hoc.required'   => 'Vui lòng nhập môn học cần học.',
            'khoi_lop.required'  => 'Vui lòng chọn khối lớp học.',
            'ngay_hoc.required'  => 'Vui lòng chọn ít nhất 1 ngày học trong tuần.',
            'ngay_hoc.min'       => 'Vui lòng chọn ít nhất 1 ngày học trong tuần.',
            'khung_gio.required' => 'Vui lòng chọn khung giờ học mong muốn.',
            'hinh_thuc.required' => 'Vui lòng chọn hình thức học (Tại nhà hoặc Online).',
        ]);

        if ($request->hinh_thuc === 'tai_nha' && !$request->filled('dia_chi_day')) {
            return back()->withInput()->withErrors(['dia_chi_day' => 'Vui lòng nhập địa chỉ học cụ thể khi chọn hình thức học tại nhà.']);
        }

        $soBuoiTuan  = count($request->ngay_hoc);
        $thoiGianHoc = implode(', ', $request->ngay_hoc) . " ({$request->khung_gio})";
        $diaChi      = ($request->hinh_thuc === 'online')
            ? 'Học Online (Qua Zoom / Google Meet)'
            : ($request->dia_chi_day ?: 'Thỏa thuận trực tiếp với gia sư');

        if ($request->hinh_thuc === 'tai_nha' && $request->filled('dk_quan_huyen') && $request->filled('dk_tinh_thanh')) {
            $street = trim($request->dia_chi_day ?? '');
            if ($street !== '' && !str_contains($street, $request->dk_quan_huyen)) {
                $diaChi = "{$street}, {$request->dk_quan_huyen}, {$request->dk_tinh_thanh}";
            } elseif ($street === '') {
                $diaChi = "{$request->dk_quan_huyen}, {$request->dk_tinh_thanh}";
            }
        }
        $mucHocPhi   = $ho_so->hoc_phi_theo_gio ?: 200000;

        // Tạo lớp học mới gắn với yêu cầu của học viên (trạng thái chờ gia sư xác nhận lịch)
        $lop = LopHoc::create([
            'hoc_vien_id'   => $user->id,
            'mon_hoc'       => $request->mon_hoc,
            'khoi_lop'      => $request->khoi_lop,
            'so_buoi_tuan'  => $soBuoiTuan,
            'thoi_gian_hoc' => $thoiGianHoc,
            'dia_chi_day'   => $diaChi,
            'muc_hoc_phi'   => $mucHocPhi,
            'yeu_cau_them'  => ($request->hinh_thuc === 'online' ? '[Học Online] ' : '[Học tại nhà] ') . ($request->yeu_cau_them ?? 'Học viên đăng ký lịch dạy trực tiếp từ hồ sơ gia sư.'),
            'trang_thai'    => 'dang_tim',
            'gia_su_id'     => $ho_so->tai_khoan_id,
        ]);

        // Đóng gói danh sách ngày và khung giờ học viên đề xuất thành JSON có cấu trúc
        $schedulePayload = [
            'type'         => 'loi_moi_truc_tiep',
            'ngay_de_xuat' => $request->ngay_hoc,
            'khung_gio'    => $request->khung_gio,
            'ghi_chu_hv'   => $request->yeu_cau_them ?? '',
            'mo_ta'        => "Học viên {$user->ho_ten} đề xuất: {$thoiGianHoc}",
        ];

        DangKyNhanLop::create([
            'lop_hoc_id'          => $lop->id,
            'gia_su_id'           => $ho_so->tai_khoan_id,
            'gioi_thieu_ban_than' => json_encode($schedulePayload, JSON_UNESCAPED_UNICODE),
            'trang_thai'          => 'cho_duyet',
            'xac_nhan_gia_su'     => 'cho_xac_nhan',
        ]);

        // Gửi thông báo đến tài khoản của Gia sư
        ThongBao::gui(
            $ho_so->tai_khoan_id,
            "🔔 Lời mời dạy mới từ Học viên {$user->ho_ten}",
            "Học viên {$user->ho_ten} vừa gửi lời mời dạy môn {$request->mon_hoc} ({$request->khoi_lop}). Đề xuất các ngày: " . implode(', ', (array)$request->ngay_hoc) . " ({$request->khung_gio}). Vui lòng vào trang tổng quan để chọn ngày và giờ bạn rảnh để dạy!",
            route('giasu.dashboard'),
            'yeu_cau_day'
        );

        return redirect(route('chi-tiet-gia-su', $id) . '#dang-ky-lich-day')
            ->with('success', "🎉 Đăng ký giờ dạy thành công! Danh sách ngày bạn đề xuất đã được gửi đến Gia sư {$ho_so->taiKhoan->ho_ten} để gia sư lựa chọn lịch rảnh phù hợp.");
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
        if ($request->filled('tinh_thanh') || $request->filled('quan_huyen') || $request->filled('dia_chi')) {
            $this->applyLocationFilter(
                $query,
                'dia_chi_day',
                $request->input('tinh_thanh'),
                $request->input('quan_huyen'),
                $request->input('dia_chi')
            );
        }

        $lop_hocs = $query->latest()->paginate(9);

        return view('home.danh-sach-lop-hoc', compact('lop_hocs'));
    }

    /**
     * Bộ lọc địa điểm thông minh: Tự động chuẩn hóa Huyện/Quận và Tỉnh/Thành
     */
    private function applyLocationFilter($query, string $column, ?string $tinhThanh = null, ?string $quanHuyen = null, ?string $rawInput = null): void
    {
        $terms = DiaDiem::buildSearchTerms($tinhThanh, $quanHuyen, $rawInput);
        if (empty($terms)) return;

        // Nếu có cả Tỉnh và Quận/Huyện, tìm bản ghi khớp cả 2
        if (!empty($tinhThanh) && !empty($quanHuyen)) {
            $tinhTerms = DiaDiem::buildSearchTerms($tinhThanh, null, null);
            $quanTerms = DiaDiem::buildSearchTerms(null, $quanHuyen, null);
            $query->where(function($q) use ($column, $tinhTerms, $quanTerms) {
                $q->where(function($subQ) use ($column, $tinhTerms) {
                    foreach ($tinhTerms as $tt) {
                        $subQ->orWhere($column, 'like', "%{$tt}%");
                    }
                })->where(function($subQ2) use ($column, $quanTerms) {
                    foreach ($quanTerms as $qt) {
                        $subQ2->orWhere($column, 'like', "%{$qt}%");
                    }
                });
            });
            return;
        }

        $query->where(function($q) use ($column, $terms) {
            foreach ($terms as $term) {
                $q->orWhere($column, 'like', "%{$term}%");
            }
        });
    }

    public function chiTietLopHoc($id)
    {
        $lop = LopHoc::with('hocVien')->findOrFail($id);
        $daDangKy = false;
        if (auth()->check() && auth()->user()->isGiaSu()) {
            $daDangKy = DangKyNhanLop::where('lop_hoc_id', $id)
                ->where('gia_su_id', auth()->id())
                ->exists();
        }

        $lop_tuong_tu = LopHoc::where('trang_thai', 'dang_tim')
            ->where('id', '!=', $lop->id)
            ->orderByRaw('CASE WHEN mon_hoc LIKE ? THEN 0 ELSE 1 END', ['%' . ($lop->mon_hoc ?: 'Toán') . '%'])
            ->latest()
            ->take(3)
            ->get();

        return view('home.chi-tiet-lop-hoc', compact('lop', 'daDangKy', 'lop_tuong_tu'));
    }

    public function lienHeGui(Request $request)
    {
        // Honeypot chống bot: trường ẩn "website" phải để trống
        if ($request->filled('website')) {
            return redirect(url()->previous() . '#form-tu-van')->with('lien_he_ok', 'Cảm ơn bạn! Chúng tôi đã nhận được yêu cầu.');
        }

        $data = $request->validate([
            'ho_ten'        => 'required|string|max:100',
            'so_dien_thoai' => ['required', 'string', 'max:20', 'regex:/^(\+84|0)[0-9 .\-]{8,12}$/'],
            'email'         => 'nullable|email|max:150',
            'loai'          => 'nullable|in:' . implode(',', array_keys(LienHe::LOAI)),
            'noi_dung'      => 'nullable|string|max:1500',
        ], [
            'ho_ten.required'        => 'Vui lòng nhập họ và tên.',
            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại để chúng tôi liên hệ lại.',
            'so_dien_thoai.regex'    => 'Số điện thoại chưa đúng định dạng (ví dụ: 0912345678).',
            'email.email'            => 'Email chưa đúng định dạng.',
        ]);

        $lienHe = LienHe::create([
            'ho_ten'        => trim($data['ho_ten']),
            'so_dien_thoai' => preg_replace('/[ .\-]/', '', $data['so_dien_thoai']),
            'email'         => $data['email'] ?? null,
            'loai'          => $data['loai'] ?? 'tu_van_nhanh',
            'noi_dung'      => $data['noi_dung'] ?? null,
            'trang_thai'    => 'moi',
        ]);

        foreach (TaiKhoan::where('vai_tro', 'admin')->get() as $admin) {
            ThongBao::gui(
                $admin->id,
                "📩 Yêu cầu tư vấn mới từ {$lienHe->ho_ten}",
                "{$lienHe->loai_label} – SĐT: {$lienHe->so_dien_thoai}." . ($lienHe->noi_dung ? ' Nội dung: ' . \Illuminate\Support\Str::limit($lienHe->noi_dung, 120) : ''),
                route('admin.lien-he.index'),
                'he_thong'
            );
        }

        return redirect(url()->previous() . '#form-tu-van')
            ->with('lien_he_ok', "Cảm ơn {$lienHe->ho_ten}! Tư vấn viên sẽ gọi lại cho bạn qua số {$lienHe->so_dien_thoai} trong thời gian sớm nhất.");
    }

    public function tuyenGiaSu()
    {
        $stats = [
            'tong_gia_su'  => HoSoGiaSu::where('trang_thai_duyet', 'da_duyet')->count(),
            'lop_dang_tim' => LopHoc::where('trang_thai', 'dang_tim')->count(),
        ];
        return view('home.tuyen-gia-su', compact('stats'));
    }

    public function chinhSach()
    {
        return view('home.chinh-sach');
    }

    public function kinhNghiem()
    {
        return view('home.kinh-nghiem', ['bai_viets' => BaiViet::all()]);
    }

    public function baiViet(string $slug)
    {
        $bai = BaiViet::find($slug);
        abort_if(!$bai, 404);

        $lien_quan = collect(BaiViet::all())->except($slug)->take(3)->all();
        return view('home.bai-viet', ['bai' => $bai, 'lien_quan' => $lien_quan]);
    }

    public function sitemap()
    {
        $urls = [
            [route('home'), '1.0'],
            [route('danh-sach-gia-su'), '0.9'],
            [route('danh-sach-lop-hoc'), '0.9'],
            [route('gioi-thieu'), '0.6'],
            [route('lien-he'), '0.6'],
            [route('tuyen-gia-su'), '0.7'],
            [route('kinh-nghiem'), '0.6'],
            [route('chinh-sach'), '0.3'],
        ];
        foreach (array_keys(BaiViet::all()) as $slug) {
            $urls[] = [route('bai-viet', $slug), '0.5'];
        }
        foreach (HoSoGiaSu::where('trang_thai_duyet', 'da_duyet')->pluck('id') as $id) {
            $urls[] = [route('chi-tiet-gia-su', $id), '0.7'];
        }
        foreach (LopHoc::where('trang_thai', 'dang_tim')->pluck('id') as $id) {
            $urls[] = [route('chi-tiet-lop-hoc', $id), '0.7'];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as [$loc, $priority]) {
            $xml .= '  <url><loc>' . e($loc) . '</loc><priority>' . $priority . '</priority></url>' . "\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function gioiThieu()
    {
        $stats = [
            'tong_gia_su'  => HoSoGiaSu::where('trang_thai_duyet', 'da_duyet')->count(),
            'tong_lop_hoc' => LopHoc::count(),
            'thanh_cong'   => LopHoc::where('trang_thai', 'da_co_gia_su')->count(),
            'phu_huynh'    => TaiKhoan::where('vai_tro', 'hocvien')->count(),
        ];
        return view('home.gioi-thieu', compact('stats'));
    }

    public function lienHe()
    {
        return view('home.lien-he');
    }
}
