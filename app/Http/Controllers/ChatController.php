<?php

namespace App\Http\Controllers;

use App\Models\LopHoc;
use App\Models\TaiKhoan;
use App\Models\ThongBao;
use App\Models\TinNhan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * Giao diện chính của hệ thống Chat
     */
    public function index(Request $request)
    {
        $me = auth()->user();
        $targetUserId = $request->query('user_id');

        // Lấy danh sách ID các người dùng đã từng nhắn tin với $me
        $sentPartnerIds = TinNhan::where('nguoi_gui_id', $me->id)->pluck('nguoi_nhan_id');
        $receivedPartnerIds = TinNhan::where('nguoi_nhan_id', $me->id)->pluck('nguoi_gui_id');
        $partnerIds = $sentPartnerIds->merge($receivedPartnerIds)->unique()->filter(fn($id) => $id != $me->id);

        // Nếu có targetUserId được truyền vào nhưng chưa từng nhắn tin, thêm vào danh sách
        if ($targetUserId && $targetUserId != $me->id && !$partnerIds->contains($targetUserId)) {
            $partnerIds->push((int)$targetUserId);
        }

        // Tải thông tin người dùng và tin nhắn mới nhất cho mỗi hội thoại
        $conversations = collect();
        foreach ($partnerIds as $pid) {
            $partner = TaiKhoan::with('hoSoGiaSu')->find($pid);
            if (!$partner) continue;

            $lastMessage = TinNhan::giuaHaiNguoi($me->id, $pid)
                ->latest()
                ->first();

            $unreadCount = TinNhan::where('nguoi_gui_id', $pid)
                ->where('nguoi_nhan_id', $me->id)
                ->where('da_xem', false)
                ->count();

            $conversations->push((object)[
                'partner' => $partner,
                'last_message' => $lastMessage,
                'unread_count' => $unreadCount,
                'last_activity' => $lastMessage ? $lastMessage->created_at : now(),
            ]);
        }

        // Sắp xếp hội thoại theo tin nhắn mới nhất
        $conversations = $conversations->sortByDesc('last_activity')->values();

        // Xác định đối tác đang chat hiện tại
        $activePartner = null;
        if ($targetUserId && $targetUserId != $me->id) {
            $activePartner = TaiKhoan::with('hoSoGiaSu')->find($targetUserId);
        } elseif ($conversations->isNotEmpty()) {
            $activePartner = $conversations->first()->partner;
        }

        // Tải lịch sử tin nhắn của đối tác đang chọn
        $messages = collect();
        if ($activePartner) {
            $messages = TinNhan::giuaHaiNguoi($me->id, $activePartner->id)
                ->orderBy('created_at', 'asc')
                ->take(150)
                ->get();

            // Đánh dấu các tin nhắn đối phương gửi đến tôi là đã xem
            TinNhan::where('nguoi_gui_id', $activePartner->id)
                ->where('nguoi_nhan_id', $me->id)
                ->where('da_xem', false)
                ->update(['da_xem' => true]);
        }

        // Danh sách gợi ý liên hệ (gia sư / học viên liên quan) khi chưa có hội thoại
        $suggestedContacts = collect();
        if ($conversations->isEmpty()) {
            if ($me->isHocVien()) {
                // Gợi ý các gia sư uy tín
                $suggestedContacts = TaiKhoan::where('vai_tro', 'giasu')
                    ->where('trang_thai', 'active')
                    ->with('hoSoGiaSu')
                    ->take(6)
                    ->get();
            } elseif ($me->isGiaSu()) {
                // Gợi ý học viên của các lớp gia sư đã nhận hoặc đang quan tâm
                $suggestedContacts = TaiKhoan::where('vai_tro', 'hocvien')
                    ->where('trang_thai', 'active')
                    ->take(6)
                    ->get();
            }
        }

        return view('chat.index', compact('conversations', 'activePartner', 'messages', 'suggestedContacts'));
    }

    /**
     * Chuyển hướng nhanh tới cuộc trò chuyện với user_id
     */
    public function conversation($userId)
    {
        return redirect()->route('chat.index', ['user_id' => $userId]);
    }

    /**
     * API Gửi tin nhắn mới (AJAX)
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'nguoi_nhan_id' => 'required|integer|exists:tai_khoans,id',
            'noi_dung'      => 'required|string|max:3000',
            'lop_hoc_id'    => 'nullable|integer|exists:lop_hocs,id',
        ]);

        $me = auth()->user();
        $receiverId = (int)$request->nguoi_nhan_id;

        if ($receiverId === $me->id) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không thể tự gửi tin nhắn cho chính mình.'
            ], 422);
        }

        $tinNhan = TinNhan::create([
            'nguoi_gui_id'  => $me->id,
            'nguoi_nhan_id' => $receiverId,
            'lop_hoc_id'    => $request->lop_hoc_id,
            'noi_dung'      => trim($request->noi_dung),
            'da_xem'        => false,
        ]);

        // Tạo thông báo chuông cho người nhận nếu trong 15 phút chưa nhận thông báo tin nhắn từ người này
        $hasRecentNotif = ThongBao::where('tai_khoan_id', $receiverId)
            ->where('loai', 'tin_nhan')
            ->where('created_at', '>=', now()->subMinutes(15))
            ->exists();

        if (!$hasRecentNotif) {
            ThongBao::gui(
                $receiverId,
                '💬 Tin nhắn mới từ ' . $me->ho_ten,
                Str::limit($tinNhan->noi_dung, 70),
                route('chat.conversation', $me->id),
                'tin_nhan'
            );
        }

        return response()->json([
            'success' => true,
            'message' => [
                'id'         => $tinNhan->id,
                'noi_dung'   => e($tinNhan->noi_dung),
                'time'       => $tinNhan->formatted_time,
                'is_me'      => true,
                'da_xem'     => false,
                'created_at' => $tinNhan->created_at->toIso8601String(),
            ]
        ]);
    }

    /**
     * API Lấy tin nhắn mới theo chu kỳ (Polling)
     */
    public function getMessages(Request $request, $partnerId)
    {
        $me = auth()->user();
        $partnerId = (int)$partnerId;
        $afterId = (int)$request->query('after_id', 0);

        $query = TinNhan::giuaHaiNguoi($me->id, $partnerId);

        if ($afterId > 0) {
            $query->where('id', '>', $afterId);
        }

        $tinNhans = $query->orderBy('created_at', 'asc')->get();

        // Đánh dấu các tin nhắn mới từ partner là đã xem
        TinNhan::where('nguoi_gui_id', $partnerId)
            ->where('nguoi_nhan_id', $me->id)
            ->where('da_xem', false)
            ->update(['da_xem' => true]);

        $data = $tinNhans->map(function ($tn) use ($me) {
            return [
                'id'         => $tn->id,
                'noi_dung'   => e($tn->noi_dung),
                'time'       => $tn->formatted_time,
                'is_me'      => $tn->nguoi_gui_id == $me->id,
                'da_xem'     => $tn->da_xem,
                'created_at' => $tn->created_at->toIso8601String(),
            ];
        });

        return response()->json([
            'success'  => true,
            'messages' => $data,
        ]);
    }

    /**
     * API đếm tổng số tin nhắn chưa đọc
     */
    public function unreadCount()
    {
        $me = auth()->user();
        $count = $me->tinNhanChuaDocCount();

        return response()->json([
            'success'      => true,
            'unread_count' => $count,
        ]);
    }
}
