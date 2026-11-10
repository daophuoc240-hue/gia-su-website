<?php

namespace App\Http\Controllers;

use App\Models\HoSoGiaSu;
use App\Models\LopHoc;
use App\Models\TaiKhoan;
use App\Models\DanhGia;
use App\Models\DangKyNhanLop;
use App\Models\ThongBao;
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

        if ($request->filled('tinh_thanh') || $request->filled('quan_huyen') || $request->filled('khu_vuc')) {
            $this->applyLocationFilter(
                $query,
                'khu_vuc_nhan_day',
                $request->input('tinh_thanh'),
                $request->input('quan_huyen'),
                $request->input('khu_vuc')
            );
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
