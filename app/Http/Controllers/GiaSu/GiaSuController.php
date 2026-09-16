<?php

namespace App\Http\Controllers\GiaSu;

use App\Http\Controllers\Controller;
use App\Models\HoSoGiaSu;
use App\Models\LopHoc;
use App\Models\DangKyNhanLop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GiaSuController extends Controller
{
    public function dashboard()
    {
        $user    = Auth::user();
        $ho_so   = $user->hoSoGiaSu;
        $dang_ky = DangKyNhanLop::where('gia_su_id', $user->id)
                    ->with('lopHoc')
                    ->latest()
                    ->take(5)
                    ->get();

        $stats = [
            'cho_duyet'    => DangKyNhanLop::where('gia_su_id', $user->id)->where('trang_thai', 'cho_duyet')->count(),
            'da_duyet'     => DangKyNhanLop::where('gia_su_id', $user->id)->where('trang_thai', 'da_duyet')->count(),
            'tu_choi'      => DangKyNhanLop::where('gia_su_id', $user->id)->where('trang_thai', 'tu_choi')->count(),
            'lop_dang_tim' => LopHoc::where('trang_thai', 'dang_tim')->count(),
        ];

        return view('gia-su.dashboard', compact('user', 'ho_so', 'dang_ky', 'stats'));
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
            'truong_hoc'      => 'required|string|max:255',
            'chuyen_nganh'    => 'required|string|max:255',
            'kinh_nghiem'     => 'required|string',
            'khu_vuc_nhan_day' => 'required|string|max:255',
            'bang_cap'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'the_sinh_vien'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'truong_hoc.required'       => 'Vui lòng nhập tên trường học.',
            'chuyen_nganh.required'     => 'Vui lòng nhập chuyên ngành.',
            'kinh_nghiem.required'      => 'Vui lòng nhập kinh nghiệm giảng dạy.',
            'khu_vuc_nhan_day.required' => 'Vui lòng nhập khu vực có thể nhận dạy.',
        ]);

        $user = Auth::user();
        $data = $request->only(['truong_hoc', 'chuyen_nganh', 'kinh_nghiem', 'khu_vuc_nhan_day']);
        $data['trang_thai_duyet'] = 'cho_duyet';

        if ($request->hasFile('bang_cap')) {
            $data['bang_cap'] = $request->file('bang_cap')->store('ho-so', 'public');
        }
        if ($request->hasFile('the_sinh_vien')) {
            $data['the_sinh_vien'] = $request->file('the_sinh_vien')->store('ho-so', 'public');
        }

        HoSoGiaSu::updateOrCreate(
            ['tai_khoan_id' => $user->id],
            array_merge($data, ['tai_khoan_id' => $user->id])
        );

        return redirect()->route('giasu.ho-so')->with('success', 'Đã cập nhật hồ sơ. Vui lòng chờ kiểm duyệt từ trung tâm.');
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
            $query->where('dia_chi_day', 'like', '%'.$request->dia_chi.'%');
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