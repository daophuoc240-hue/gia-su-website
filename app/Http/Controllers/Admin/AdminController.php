<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use App\Models\HoSoGiaSu;
use App\Models\LopHoc;
use App\Models\DangKyNhanLop;
use App\Models\ThongBao;
use App\Models\LienHe;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function danhSachLienHe(Request $request)
    {
        $query = LienHe::query();
        if ($request->filled('trang_thai') && in_array($request->trang_thai, ['moi', 'da_xu_ly'])) {
            $query->where('trang_thai', $request->trang_thai);
        }
        $lien_hes = $query->latest()->paginate(15)->withQueryString();
        $dem = [
            'moi'      => LienHe::where('trang_thai', 'moi')->count(),
            'da_xu_ly' => LienHe::where('trang_thai', 'da_xu_ly')->count(),
        ];
        return view('admin.lien-he.index', compact('lien_hes', 'dem'));
    }

    public function xuLyLienHe($id)
    {
        $lh = LienHe::findOrFail($id);
        $lh->update(['trang_thai' => $lh->trang_thai === 'moi' ? 'da_xu_ly' : 'moi']);
        return back()->with('success', 'Đã cập nhật trạng thái yêu cầu của ' . $lh->ho_ten . '.');
    }

    public function dashboard()
    {
        $stats = [
            'tong_tai_khoan'     => TaiKhoan::count(),
            'tong_gia_su'        => TaiKhoan::where('vai_tro', 'giasu')->count(),
            'tong_hoc_vien'      => TaiKhoan::where('vai_tro', 'hocvien')->count(),
            'ho_so_cho_duyet'    => HoSoGiaSu::where('trang_thai_duyet', 'cho_duyet')->count(),
            'lop_dang_tim'       => LopHoc::where('trang_thai', 'dang_tim')->count(),
            'lop_da_co_gia_su'   => LopHoc::where('trang_thai', 'da_co_gia_su')->count(),
            'lop_hoan_thanh'     => LopHoc::where('trang_thai', 'hoan_thanh')->count(),
            'tong_lop'           => LopHoc::count(),
            'dang_ky_cho_duyet'  => DangKyNhanLop::where('trang_thai', 'cho_duyet')->count(),
        ];

        // Thống kê môn học cho biểu đồ tròn
        $chartMonHoc = [
            'Toán'      => LopHoc::where('mon_hoc', 'like', '%Toán%')->count(),
            'Tiếng Anh' => LopHoc::where('mon_hoc', 'like', '%Anh%')->count(),
            'Vật Lý'    => LopHoc::where('mon_hoc', 'like', '%Lý%')->count(),
            'Hóa Học'   => LopHoc::where('mon_hoc', 'like', '%Hóa%')->count(),
            'Ngữ Văn'   => LopHoc::where('mon_hoc', 'like', '%Văn%')->count(),
            'Ngoại ngữ khác' => LopHoc::where('mon_hoc', 'like', '%Nhật%')->orWhere('mon_hoc', 'like', '%Trung%')->count(),
            'Môn khác'  => LopHoc::where('mon_hoc', 'not like', '%Toán%')
                                  ->where('mon_hoc', 'not like', '%Anh%')
                                  ->where('mon_hoc', 'not like', '%Lý%')
                                  ->where('mon_hoc', 'not like', '%Hóa%')
                                  ->where('mon_hoc', 'not like', '%Văn%')
                                  ->where('mon_hoc', 'not like', '%Nhật%')
                                  ->where('mon_hoc', 'not like', '%Trung%')
                                  ->count(),
        ];

        // Thống kê trạng thái lớp học cho biểu đồ cột
        $chartTrangThai = [
            'Đang tìm gia sư' => $stats['lop_dang_tim'],
            'Đã có gia sư'   => $stats['lop_da_co_gia_su'],
            'Đã hoàn thành'  => $stats['lop_hoan_thanh'],
        ];

        $lop_moi_nhat = LopHoc::with('hocVien')->latest()->take(5)->get();
        $ho_so_moi    = HoSoGiaSu::with('taiKhoan')->where('trang_thai_duyet', 'cho_duyet')->latest()->take(5)->get();
        $dang_ky_chot_lich = DangKyNhanLop::with(['lopHoc.hocVien', 'giaSu.hoSoGiaSu'])
            ->where('xac_nhan_gia_su', 'da_xac_nhan')
            ->where('trang_thai', 'cho_duyet')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', compact('stats', 'lop_moi_nhat', 'ho_so_moi', 'dang_ky_chot_lich', 'chartMonHoc', 'chartTrangThai'));
    }

    // ===== QUẢN LÝ TÀI KHOẢN =====
    public function danhSachTaiKhoan(Request $request)
    {
        $query = TaiKhoan::where('vai_tro', '!=', 'admin');

        if ($request->filled('vai_tro')) {
            $query->where('vai_tro', $request->vai_tro);
        }
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ho_ten', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        $tai_khoans = $query->latest()->paginate(15);
        return view('admin.tai-khoan.index', compact('tai_khoans'));
    }

    public function khoaTaiKhoan($id)
    {
        $tk = TaiKhoan::findOrFail($id);
        $tk->update(['trang_thai' => 'locked']);
        return back()->with('success', "Đã khóa tài khoản: {$tk->ho_ten}");
    }

    public function moKhoaTaiKhoan($id)
    {
        $tk = TaiKhoan::findOrFail($id);
        $tk->update(['trang_thai' => 'active']);
        return back()->with('success', "Đã mở khóa tài khoản: {$tk->ho_ten}");
    }

    // ===== DUYỆT HỒ SƠ GIA SƯ =====
    public function danhSachHoSo(Request $request)
    {
        $query = HoSoGiaSu::with('taiKhoan');

        if ($request->filled('trang_thai')) {
            $query->where('trang_thai_duyet', $request->trang_thai);
        } else {
            $query->where('trang_thai_duyet', 'cho_duyet');
        }

        $ho_sos = $query->latest()->paginate(10);
        return view('admin.ho-so.index', compact('ho_sos'));
    }

    public function chiTietHoSo($id)
    {
        $ho_so = HoSoGiaSu::with('taiKhoan')->findOrFail($id);
        return view('admin.ho-so.chi-tiet', compact('ho_so'));
    }

    public function duyetHoSo($id)
    {
        $ho_so = HoSoGiaSu::findOrFail($id);
        $ho_so->update(['trang_thai_duyet' => 'da_duyet', 'ly_do_tu_choi' => null]);
        return redirect()->route('admin.ho-so.index')->with('success', 'Đã duyệt hồ sơ gia sư thành công!');
    }

    public function tuChoiHoSo(Request $request, $id)
    {
        $request->validate(['ly_do' => 'required|string|max:500']);
        $ho_so = HoSoGiaSu::findOrFail($id);
        $ho_so->update([
            'trang_thai_duyet' => 'tu_choi',
            'ly_do_tu_choi'    => $request->ly_do,
        ]);
        return redirect()->route('admin.ho-so.index')->with('success', 'Đã từ chối hồ sơ gia sư.');
    }

    // ===== QUẢN LÝ LỚP HỌC =====
    public function danhSachLop(Request $request)
    {
        $query = LopHoc::with(['hocVien', 'giaSu']);

        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }
        if ($request->filled('mon_hoc')) {
            $query->where('mon_hoc', 'like', '%'.$request->mon_hoc.'%');
        }

        $lop_hocs = $query->latest()->paginate(15);
        return view('admin.lop-hoc.index', compact('lop_hocs'));
    }

    public function chiTietLop($id)
    {
        $lop = LopHoc::with(['hocVien', 'giaSu', 'dangKyNhanLops.giaSu.hoSoGiaSu'])->findOrFail($id);
        return view('admin.lop-hoc.chi-tiet', compact('lop'));
    }

    public function suaLop($id)
    {
        $lop = LopHoc::findOrFail($id);
        return view('admin.lop-hoc.sua', compact('lop'));
    }

    public function capNhatLop(Request $request, $id)
    {
        $request->validate([
            'mon_hoc'       => 'required|string|max:100',
            'khoi_lop'      => 'required|string|max:50',
            'so_buoi_tuan'  => 'required|integer|min:1|max:7',
            'dia_chi_day'   => 'required|string|max:255',
            'muc_hoc_phi'   => 'required|numeric|min:0',
            'thoi_gian_hoc' => 'nullable|string|max:255',
        ]);

        $lop = LopHoc::findOrFail($id);
        $lop->update($request->only(['mon_hoc', 'khoi_lop', 'so_buoi_tuan', 'dia_chi_day', 'muc_hoc_phi', 'thoi_gian_hoc', 'yeu_cau_them']));
        return redirect()->route('admin.lop-hoc.index')->with('success', 'Đã cập nhật thông tin lớp học.');
    }

    public function xoaLop($id)
    {
        $lop = LopHoc::findOrFail($id);
        $lop->delete();
        return redirect()->route('admin.lop-hoc.index')->with('success', 'Đã xóa lớp học.');
    }

    // ===== PHÂN CÔNG LỚP =====
    public function phanCongLop($lop_id)
    {
        $lop = LopHoc::with(['hocVien', 'dangKyNhanLops.giaSu.hoSoGiaSu'])->findOrFail($lop_id);
        
        // Danh sách gia sư đã xác nhận rảnh hoặc ứng tuyển (sẵn sàng để admin duyệt phân công)
        $dang_kys = DangKyNhanLop::with(['giaSu.hoSoGiaSu'])
            ->where('lop_hoc_id', $lop_id)
            ->where('trang_thai', 'cho_duyet')
            ->where(function($q) {
                $q->whereNull('xac_nhan_gia_su')
                  ->orWhere('xac_nhan_gia_su', 'da_xac_nhan');
            })
            ->get();

        // Danh sách gia sư được mời nhưng đang chờ xem xét lịch rảnh
        $cho_xac_nhan = DangKyNhanLop::with(['giaSu.hoSoGiaSu'])
            ->where('lop_hoc_id', $lop_id)
            ->where('xac_nhan_gia_su', 'cho_xac_nhan')
            ->where('trang_thai', '!=', 'tu_choi')
            ->get();

        return view('admin.lop-hoc.phan-cong', compact('lop', 'dang_kys', 'cho_xac_nhan'));
    }

    public function xacNhanPhanCong(Request $request, $lop_id)
    {
        $request->validate(['dang_ky_id' => 'required|exists:dang_ky_nhan_lops,id']);

        $dang_ky = DangKyNhanLop::with(['giaSu', 'lopHoc.hocVien'])->findOrFail($request->dang_ky_id);

        // Mark selected as approved
        $dang_ky->update(['trang_thai' => 'da_duyet']);

        // Reject all other registrations for this class
        DangKyNhanLop::where('lop_hoc_id', $lop_id)
            ->where('id', '!=', $dang_ky->id)
            ->update(['trang_thai' => 'tu_choi']);

        // Update the class
        $lop = LopHoc::with('hocVien')->findOrFail($lop_id);
        $lop->update([
            'trang_thai' => 'da_co_gia_su',
            'gia_su_id'  => $dang_ky->gia_su_id,
        ]);

        // Gửi thông báo đến Gia Sư
        ThongBao::gui(
            $dang_ky->gia_su_id,
            "🎉 Chúc mừng! Bạn đã được Ban Quản Trị phân công nhận lớp",
            "Ban Quản Trị trung tâm đã chính thức phê duyệt phân công bạn dạy lớp {$lop->mon_hoc} ({$lop->khoi_lop}) cho Học viên {$lop->hocVien->ho_ten}. Vui lòng liên hệ với phụ huynh để thống nhất lịch học đầu tiên!",
            route('giasu.dashboard'),
            'phan_cong'
        );

        // Gửi thông báo đến Học Viên
        ThongBao::gui(
            $lop->hoc_vien_id,
            "🎉 Lớp học của bạn đã có gia sư chính thức!",
            "Ban Quản Trị trung tâm đã phê duyệt phân công Gia sư {$dang_ky->giaSu->ho_ten} dạy kèm lớp {$lop->mon_hoc} ({$lop->khoi_lop}). Gia sư sẽ sớm liên hệ trực tiếp với bạn theo số điện thoại đăng ký.",
            route('hocvien.danh-sach-lop'),
            'phan_cong'
        );

        return redirect()->route('admin.lop-hoc.index')->with('success', 'Đã phân công lớp học thành công và gửi thông báo tới các bên!');
    }
}
