<?php

namespace App\Http\Controllers\HocVien;

use App\Http\Controllers\Controller;
use App\Models\LopHoc;
use App\Models\DanhGia;
use App\Models\DangKyNhanLop;
use App\Models\ThongBao;
use App\Models\HoSoGiaSu;
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

    /**
     * Danh sách gia sư dành riêng cho tài khoản Học viên / Phụ huynh
     */
    public function danhSachGiaSu(Request $request)
    {
        $query = HoSoGiaSu::with(['taiKhoan', 'taiKhoan.danhGias'])
            ->where('trang_thai_duyet', 'da_duyet');

        if ($request->filled('search')) {
            $term = trim($request->search);
            $query->where(function($q) use ($term) {
                $q->where('truong_hoc', 'like', "%{$term}%")
                  ->orWhere('chuyen_nganh', 'like', "%{$term}%")
                  ->orWhere('mon_day', 'like', "%{$term}%")
                  ->orWhere('khu_vuc_nhan_day', 'like', "%{$term}%")
                  ->orWhereHas('taiKhoan', function($sub) use ($term) {
                      $sub->where('ho_ten', 'like', "%{$term}%");
                  });
            });
        }

        if ($request->filled('mon_day')) {
            $query->where('mon_day', 'like', "%{$request->mon_day}%");
        }

        if ($request->filled('khu_vuc')) {
            $query->where('khu_vuc_nhan_day', 'like', "%{$request->khu_vuc}%");
        }

        $gia_sus = $query->latest()->paginate(9);

        return view('hoc-vien.gia-su', compact('gia_sus'));
    }

    public function taoYeuCau(Request $request)
    {
        $giaSuMoi = null;
        $giaSuId = $request->get('gia_su_id') ?? session('moi_gia_su_id');
        if ($giaSuId) {
            $giaSuMoi = \App\Models\HoSoGiaSu::with('taiKhoan')->find($giaSuId);
        }

        return view('hoc-vien.tao-yeu-cau', compact('giaSuMoi'));
    }

    public function guiYeuCau(Request $request)
    {
        $request->validate([
            'mon_hoc'       => 'required|string|max:100',
            'khoi_lop'      => 'required|string|max:50',
            'so_buoi_tuan'  => 'required|integer|min:1|max:7',
            'dia_chi_day'   => 'nullable|string|max:255',
            'tinh_thanh'    => 'nullable|string|max:100',
            'quan_huyen'    => 'nullable|string|max:100',
            'so_nha_duong'  => 'nullable|string|max:150',
            'muc_hoc_phi'   => 'required|numeric|min:0',
            'yeu_cau_them'  => 'nullable|string|max:500',
            'thu_hoc'       => 'nullable|array',
            'ca_hoc'        => 'nullable|string|max:100',
            'thoi_gian_hoc' => 'nullable|string|max:255',
        ], [
            'mon_hoc.required'      => 'Vui lòng nhập môn học.',
            'khoi_lop.required'     => 'Vui lòng chọn khối lớp.',
            'so_buoi_tuan.required' => 'Vui lòng nhập số buổi học trong tuần.',
            'muc_hoc_phi.required'  => 'Vui lòng nhập mức học phí.',
        ]);

        $diaChiDay = $request->dia_chi_day;
        if ($request->filled('quan_huyen') && $request->filled('tinh_thanh')) {
            $diaChiDay = $request->filled('so_nha_duong')
                ? ($request->so_nha_duong . ', ' . $request->quan_huyen . ', ' . $request->tinh_thanh)
                : ($request->quan_huyen . ', ' . $request->tinh_thanh);
        }

        if (!$diaChiDay) {
            return back()->withInput()->withErrors(['dia_chi_day' => 'Vui lòng nhập khu vực / địa chỉ dạy học.']);
        }

        $thoiGianHoc = $request->thoi_gian_hoc;
        if (!$thoiGianHoc && $request->has('thu_hoc') && is_array($request->thu_hoc)) {
            $thoiGianHoc = implode(', ', $request->thu_hoc);
            if ($request->filled('ca_hoc')) {
                $thoiGianHoc .= ' (' . $request->ca_hoc . ')';
            }
        }

        $lop = LopHoc::create([
            'hoc_vien_id'   => Auth::id(),
            'mon_hoc'       => $request->mon_hoc,
            'khoi_lop'      => $request->khoi_lop,
            'so_buoi_tuan'  => $request->so_buoi_tuan,
            'thoi_gian_hoc' => $thoiGianHoc ?: ($request->so_buoi_tuan . ' buổi/tuần (Thoả thuận)'),
            'dia_chi_day'   => $diaChiDay,
            'muc_hoc_phi'   => $request->muc_hoc_phi,
            'yeu_cau_them'  => $request->yeu_cau_them,
            'trang_thai'    => 'dang_tim',
        ]);

        // Nếu mời đích danh một gia sư, tạo liên kết nhận lớp và thông báo để gia sư xem có rảnh không
        if ($request->filled('gia_su_duoc_moi_id')) {
            $giaSuId = $request->gia_su_duoc_moi_id;
            $lop->update([
                'gia_su_id' => $giaSuId,
            ]);

            DangKyNhanLop::create([
                'lop_hoc_id'          => $lop->id,
                'gia_su_id'           => $giaSuId,
                'gioi_thieu_ban_than' => 'Phụ huynh / Học viên gửi lời mời dạy kèm trực tiếp.',
                'trang_thai'          => 'cho_duyet',
                'xac_nhan_gia_su'     => 'cho_xac_nhan',
            ]);

            ThongBao::gui(
                $giaSuId,
                "🔔 Lời mời dạy kèm mới từ Học viên " . Auth::user()->ho_ten,
                "Học viên " . Auth::user()->ho_ten . " vừa gửi lời mời dạy kèm trực tiếp cho lớp {$lop->mon_hoc} ({$lop->khoi_lop}) vào thời gian: {$lop->thoi_gian_hoc}. Vui lòng kiểm tra lịch rảnh và xác nhận trước khi gửi lên trung tâm!",
                route('giasu.dashboard'),
                'yeu_cau_day'
            );
        }

        return redirect()->route('hocvien.danh-sach-lop')
            ->with('success', 'Đã gửi yêu cầu tìm gia sư thành công! Hệ thống đã gửi thông báo đến gia sư để kiểm tra lịch rảnh.');
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
        $lop  = LopHoc::with(['giaSu.hoSoGiaSu', 'dangKyNhanLops.giaSu.hoSoGiaSu'])
            ->where('hoc_vien_id', $user->id)
            ->findOrFail($id);

        $danhGia = DanhGia::where('lop_hoc_id', $id)
            ->where('hoc_vien_id', $user->id)
            ->first();

        // Thuật toán gợi ý Gia Sư phù hợp nhất (Smart Matching Recommendation)
        $giaSuGoiY = collect();
        if ($lop->trang_thai === 'dang_tim') {
            $giaSuGoiY = \App\Models\HoSoGiaSu::with('taiKhoan')
                ->where('trang_thai_duyet', 'da_duyet')
                ->where(function($q) use ($lop) {
                    $q->where('mon_day', 'like', "%{$lop->mon_hoc}%")
                      ->orWhere('kinh_nghiem', 'like', "%{$lop->mon_hoc}%");
                })
                ->orderByDesc('diem_trung_binh')
                ->orderByDesc('so_lop_da_day')
                ->take(4)
                ->get();

            if ($giaSuGoiY->count() < 4) {
                $daCoIds = $giaSuGoiY->pluck('id')->toArray();
                $extra = \App\Models\HoSoGiaSu::with('taiKhoan')
                    ->where('trang_thai_duyet', 'da_duyet')
                    ->whereNotIn('id', $daCoIds)
                    ->orderByDesc('diem_trung_binh')
                    ->orderByDesc('so_lop_da_day')
                    ->take(4 - $giaSuGoiY->count())
                    ->get();
                $giaSuGoiY = $giaSuGoiY->merge($extra);
            }
        }

        return view('hoc-vien.chi-tiet-lop', compact('lop', 'danhGia', 'giaSuGoiY'));
    }

    public function danhGiaGiaSu(Request $request, $id)
    {
        $request->validate([
            'so_sao'   => 'required|integer|min:1|max:5',
            'nhan_xet' => 'required|string|max:1000',
        ], [
            'so_sao.required'   => 'Vui lòng chọn số sao đánh giá.',
            'nhan_xet.required' => 'Vui lòng nhập nhận xét của bạn.',
        ]);

        $user = Auth::user();
        $lop  = LopHoc::where('hoc_vien_id', $user->id)
                      ->whereNotNull('gia_su_id')
                      ->findOrFail($id);

        DanhGia::updateOrCreate(
            [
                'lop_hoc_id'  => $lop->id,
                'hoc_vien_id' => $user->id,
            ],
            [
                'gia_su_id' => $lop->gia_su_id,
                'so_sao'    => $request->so_sao,
                'nhan_xet'  => $request->nhan_xet,
            ]
        );

        // Tự động tính toán lại điểm trung bình và số lượt đánh giá của gia sư
        $hoSo = \App\Models\HoSoGiaSu::where('tai_khoan_id', $lop->gia_su_id)->first();
        if ($hoSo) {
            $avg = DanhGia::where('gia_su_id', $lop->gia_su_id)->avg('so_sao');
            $count = DanhGia::where('gia_su_id', $lop->gia_su_id)->count();
            $hoSo->update([
                'diem_trung_binh'  => $avg ? round($avg, 1) : 5.0,
                'diem_danh_gia'    => $avg ? round($avg, 1) : 5.0,
                'so_luot_danh_gia' => $count,
            ]);
        }

        return back()->with('success', 'Cảm ơn bạn! Đánh giá và nhận xét gia sư đã được ghi nhận thành công.');
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
