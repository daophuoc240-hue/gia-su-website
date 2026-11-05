<?php

namespace App\Http\Controllers\GiaSu;

use App\Http\Controllers\Controller;
use App\Models\HoSoGiaSu;
use App\Models\LopHoc;
use App\Models\DangKyNhanLop;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GiaSuController extends Controller
{
    public function dashboard()
    {
        $user    = Auth::user();
        $ho_so   = $user->hoSoGiaSu;

        // Các lời mời dạy kèm từ học viên đang chờ gia sư xem có rảnh vào giờ đó không
        $loi_moi_cho_xac_nhan = DangKyNhanLop::where('gia_su_id', $user->id)
                    ->where('xac_nhan_gia_su', 'cho_xac_nhan')
                    ->where('trang_thai', '!=', 'tu_choi')
                    ->with(['lopHoc.hocVien'])
                    ->latest()
                    ->get();

        $dang_ky = DangKyNhanLop::where('gia_su_id', $user->id)
                    ->with('lopHoc')
                    ->latest()
                    ->take(5)
                    ->get();

        $stats = [
            'cho_xac_nhan' => $loi_moi_cho_xac_nhan->count(),
            'cho_duyet'    => DangKyNhanLop::where('gia_su_id', $user->id)->where('trang_thai', 'cho_duyet')->count(),
            'da_duyet'     => DangKyNhanLop::where('gia_su_id', $user->id)->where('trang_thai', 'da_duyet')->count(),
            'tu_choi'      => DangKyNhanLop::where('gia_su_id', $user->id)->where('trang_thai', 'tu_choi')->count(),
            'lop_dang_tim' => LopHoc::where('trang_thai', 'dang_tim')->count(),
        ];

        return view('gia-su.dashboard', compact('user', 'ho_so', 'dang_ky', 'stats', 'loi_moi_cho_xac_nhan'));
    }

    /**
     * Gia sư xác nhận có rảnh vào khung giờ học viên yêu cầu & đồng ý nhận lớp
     * -> Chuyển lên hệ thống Admin trung tâm xét duyệt
     */
    public function xacNhanLich($id)
    {
        $user = Auth::user();
        $dang_ky = DangKyNhanLop::with('lopHoc.hocVien')
                    ->where('gia_su_id', $user->id)
                    ->findOrFail($id);

        $dang_ky->update([
            'xac_nhan_gia_su'     => 'da_xac_nhan',
            'trang_thai'          => 'cho_duyet',
            'gioi_thieu_ban_than' => $dang_ky->gioi_thieu_ban_than . " [Gia sư đã xác nhận rảnh và đồng ý nhận lớp]",
        ]);

        $dang_ky->lopHoc->update([
            'trang_thai' => 'dang_tim',
        ]);

        // Thông báo phản hồi lại cho Học viên
        ThongBao::gui(
            $dang_ky->lopHoc->hoc_vien_id,
            "🎉 Gia sư {$user->ho_ten} đã xác nhận rảnh lịch học!",
            "Gia sư {$user->ho_ten} đã kiểm tra lịch và xác nhận RẢNH vào khung giờ ({$dang_ky->lopHoc->thoi_gian_hoc}). Yêu cầu đã được chuyển lên Ban Quản Trị trung tâm để hoàn tất xét duyệt!",
            route('hocvien.danh-sach-lop'),
            'xac_nhan'
        );

        return redirect()->route('giasu.dashboard')
            ->with('success', "🎉 Bạn đã xác nhận rảnh khung giờ này và đồng ý nhận lớp! Hệ thống đã gửi hồ sơ lên Ban Quản Trị trung tâm để xét duyệt.");
    }

    /**
     * Gia sư báo bận vào khung giờ này / từ chối lời mời
     */
    public function tuChoiLich(Request $request, $id)
    {
        $user = Auth::user();
        $dang_ky = DangKyNhanLop::with('lopHoc.hocVien')
                    ->where('gia_su_id', $user->id)
                    ->findOrFail($id);

        $lyDo = $request->input('ly_do') ?: 'Trùng lịch dạy khác';

        $dang_ky->update([
            'xac_nhan_gia_su'     => 'tu_choi',
            'trang_thai'          => 'tu_choi',
            'gioi_thieu_ban_than' => $dang_ky->gioi_thieu_ban_than . " [Gia sư báo bận: {$lyDo}]",
        ]);

        // Bỏ gán gia sư để lớp có thể tiếp tục tìm kiếm hoặc học viên chọn gia sư khác
        $dang_ky->lopHoc->update([
            'gia_su_id'  => null,
            'trang_thai' => 'dang_tim',
        ]);

        // Thông báo cho Học viên
        ThongBao::gui(
            $dang_ky->lopHoc->hoc_vien_id,
            "⚠️ Gia sư {$user->ho_ten} báo bận khung giờ đã đăng ký",
            "Gia sư {$user->ho_ten} rất tiếc phải báo bận vào khung giờ ({$dang_ky->lopHoc->thoi_gian_hoc}) do: {$lyDo}. Bạn có thể chọn khung giờ khác hoặc tìm gia sư phù hợp khác trên hệ thống.",
            route('danh-sach-gia-su'),
            'tu_choi'
        );

        return redirect()->route('giasu.dashboard')
            ->with('info', "Bạn đã báo bận vào khung giờ này. Hệ thống đã cập nhật và thông báo lại cho học viên.");
    }

    public function hoSo()
    {
        $user  = Auth::user();
        $ho_so = $user->hoSoGiaSu;
        return view('gia-su.ho-so', compact('user', 'ho_so'));
    }

    public function capNhatHoSo(Request $request)
    {
        $request->validate([
            'truong_hoc'       => 'required|string|max:255',
            'chuyen_nganh'     => 'required|string|max:255',
            'mon_day'          => 'nullable|string|max:100',
            'kinh_nghiem'      => 'required|string',
            'khu_vuc_nhan_day' => 'required|string|max:255',
            'hoc_phi_theo_gio' => 'nullable|numeric|min:0',
            'bang_cap'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'the_sinh_vien'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'avatar'           => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ], [
            'truong_hoc.required'       => 'Vui lòng nhập tên trường học.',
            'chuyen_nganh.required'     => 'Vui lòng nhập chuyên ngành.',
            'kinh_nghiem.required'      => 'Vui lòng nhập kinh nghiệm giảng dạy.',
            'khu_vuc_nhan_day.required' => 'Vui lòng nhập khu vực có thể nhận dạy.',
            'avatar.mimes'              => 'Ảnh đại diện phải là định dạng jpg, jpeg, png, gif hoặc webp.',
            'avatar.max'                => 'Ảnh đại diện không được vượt quá 5MB.',
        ]);

        $user = Auth::user();
        $hoSoCu = HoSoGiaSu::where('tai_khoan_id', $user->id)->first();

        $data = $request->only(['truong_hoc', 'chuyen_nganh', 'mon_day', 'kinh_nghiem', 'khu_vuc_nhan_day', 'hoc_phi_theo_gio']);
        
        // Nếu đã được duyệt trước đó, duy trì trạng thái để không bị ẩn hồ sơ khi gia sư xếp lịch
        if ($hoSoCu && $hoSoCu->trang_thai_duyet === 'da_duyet') {
            $data['trang_thai_duyet'] = 'da_duyet';
        } else {
            $data['trang_thai_duyet'] = 'cho_duyet';
        }

        // Lưu thông tin lịch dạy & khung giờ rảnh
        if ($request->has('lich_day_slots') || $request->filled('lich_day_ghi_chu')) {
            $data['lich_day'] = json_encode([
                'slots'   => $request->input('lich_day_slots', []),
                'ghi_chu' => $request->input('lich_day_ghi_chu', ''),
            ], JSON_UNESCAPED_UNICODE);
        } elseif ($request->has('lich_day')) {
            $data['lich_day'] = $request->input('lich_day');
        }

        if ($request->hasFile('bang_cap')) {
            $data['bang_cap'] = $request->file('bang_cap')->store('ho-so', 'public');
        }
        if ($request->hasFile('the_sinh_vien')) {
            $data['the_sinh_vien'] = $request->file('the_sinh_vien')->store('ho-so', 'public');
        }
        if ($request->hasFile('avatar')) {
            // Xoá ảnh cũ nếu có
            if ($hoSoCu && $hoSoCu->avatar) {
                Storage::disk('public')->delete($hoSoCu->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        HoSoGiaSu::updateOrCreate(
            ['tai_khoan_id' => $user->id],
            array_merge($data, ['tai_khoan_id' => $user->id])
        );

        $msg = ($hoSoCu && $hoSoCu->trang_thai_duyet === 'da_duyet')
            ? 'Đã cập nhật hồ sơ và lịch dạy thành công!'
            : 'Đã cập nhật hồ sơ thành công! Vui lòng chờ kiểm duyệt từ trung tâm.';

        return redirect()->route('giasu.ho-so')->with('success', $msg);
    }

    public function timKiemLop(Request $request)
    {
        $user  = Auth::user();
        $ho_so = $user->hoSoGiaSu;

        if (!$ho_so || $ho_so->trang_thai_duyet !== 'da_duyet') {
            return redirect()->route('giasu.ho-so')
                ->with('error', 'Hồ sơ của bạn chưa được duyệt. Vui lòng cập nhật đầy đủ thông tin và chờ trung tâm phê duyệt.');
        }

        $query = LopHoc::with('hocVien')->where('trang_thai', 'dang_tim');

        if ($request->filled('mon_hoc')) {
            $query->where('mon_hoc', 'like', '%'.$request->mon_hoc.'%');
        }
        if ($request->filled('khoi_lop')) {
            $query->where('khoi_lop', $request->khoi_lop);
        }
        if ($request->filled('dia_chi')) {
            $raw = trim($request->dia_chi);
            $terms = [$raw];
            if (str_contains($raw, '-')) {
                foreach (explode('-', $raw) as $part) {
                    if (trim($part)) $terms[] = trim($part);
                }
            }
            if (preg_match('/(?:quận|q\.?)\s*(\d+)/ui', $raw, $m)) {
                $terms[] = 'Quận ' . $m[1];
                $terms[] = 'Q.' . $m[1];
                $terms[] = 'Q' . $m[1];
            }
            if (preg_match('/(?:hồ chí minh|hcm|tp\.?hcm|sài gòn)/ui', $raw)) {
                $terms[] = 'Hồ Chí Minh';
                $terms[] = 'TP.HCM';
                $terms[] = 'TP. Hồ Chí Minh';
            }
            if (preg_match('/(?:hà nội|hn)/ui', $raw)) {
                $terms[] = 'Hà Nội';
            }
            if (preg_match('/(?:đà nẵng|dn)/ui', $raw)) {
                $terms[] = 'Đà Nẵng';
            }
            $terms = array_unique(array_filter($terms));
            $query->where(function($q) use ($terms) {
                foreach ($terms as $t) {
                    $q->orWhere('dia_chi_day', 'like', "%{$t}%");
                }
            });
        }

        $da_dang_ky_ids = DangKyNhanLop::where('gia_su_id', $user->id)->pluck('lop_hoc_id')->toArray();

        $lop_hocs = $query->latest()->paginate(12);

        return view('gia-su.tim-kiem-lop', compact('lop_hocs', 'da_dang_ky_ids'));
    }

    public function dangKyNhanLop(Request $request, $lop_id)
    {
        $request->validate([
            'gioi_thieu_ban_than' => 'nullable|string|max:500',
        ]);

        $user  = Auth::user();
        $lop   = LopHoc::findOrFail($lop_id);

        if ($lop->trang_thai !== 'dang_tim') {
            return back()->with('error', 'Lớp học này không còn nhận đăng ký.');
        }

        $da_dang_ky = DangKyNhanLop::where('lop_hoc_id', $lop_id)
            ->where('gia_su_id', $user->id)->exists();

        if ($da_dang_ky) {
            return back()->with('error', 'Bạn đã đăng ký nhận lớp này rồi.');
        }

        DangKyNhanLop::create([
            'lop_hoc_id'          => $lop_id,
            'gia_su_id'           => $user->id,
            'gioi_thieu_ban_than' => $request->gioi_thieu_ban_than,
        ]);

        return back()->with('success', 'Đã đăng ký nhận lớp thành công! Vui lòng chờ trung tâm xét duyệt.');
    }

    public function ketQuaDangKy()
    {
        $user = Auth::user();
        $dang_kys = DangKyNhanLop::with('lopHoc.hocVien')
            ->where('gia_su_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('gia-su.ket-qua-dang-ky', compact('dang_kys'));
    }
}