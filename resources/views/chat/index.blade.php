@extends('layouts.app')
@section('title', 'Hộp Thoại Tin Nhắn')
@section('page-title', 'Tin Nhắn & Trao Đổi Trực Tuyến')

@section('sidebar-nav')
<p class="nav-section-title">Điều Hướng</p>
@if(auth()->user()->vai_tro === 'admin')
    <div class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-line"></i></span> Tổng Quan</a></div>
    <div class="nav-item"><a href="{{ route('admin.tai-khoan.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-users"></i></span> Tài Khoản</a></div>
    <div class="nav-item"><a href="{{ route('admin.ho-so.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Gia Sư</a></div>
    <div class="nav-item"><a href="{{ route('admin.lop-hoc.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></span> Lớp Học</a></div>
@elseif(auth()->user()->vai_tro === 'giasu')
    <div class="nav-item"><a href="{{ route('giasu.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
    <div class="nav-item"><a href="{{ route('giasu.ho-so') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Hồ Sơ Của Tôi</a></div>
    <div class="nav-item"><a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-search"></i></span> Tìm Kiếm Lớp</a></div>
    <div class="nav-item"><a href="{{ route('giasu.ket-qua') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Kết Quả Đăng Ký</a></div>
@else
    <div class="nav-item"><a href="{{ route('hocvien.dashboard') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-home"></i></span> Tổng Quan</a></div>
    <div class="nav-item"><a href="{{ route('hocvien.gia-su') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-user-graduate"></i></span> Gia Sư</a></div>
    <div class="nav-item"><a href="{{ route('hocvien.tao-yeu-cau') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-plus-circle"></i></span> Tạo Yêu Cầu Mới</a></div>
    <div class="nav-item"><a href="{{ route('hocvien.danh-sach-lop') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-list"></i></span> Danh Sách Lớp</a></div>
@endif
<div class="nav-item">
    <a href="{{ route('chat.index') }}" class="nav-link active">
        <span class="nav-icon"><i class="fas fa-comments"></i></span> Tin Nhắn
        @php $uCount = auth()->user()->tinNhanChuaDocCount(); @endphp
        @if($uCount > 0)
            <span class="badge" style="background:#ef4444; color:#fff; border-radius:10px; padding:2px 7px; font-size:0.72rem; margin-left:auto;">{{ $uCount }}</span>
        @endif
    </a>
</div>
<div class="nav-item"><a href="{{ route('thong-bao.index') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-bell"></i></span> Thông Báo</a></div>
<div class="nav-item"><a href="{{ route('tai-khoan.cai-dat') }}" class="nav-link"><span class="nav-icon"><i class="fas fa-cog"></i></span> Cài Đặt Tài Khoản</a></div>
@endsection

@section('content')
<div style="background:#ffffff; border-radius:18px; box-shadow:0 8px 30px rgba(0,0,0,0.05); overflow:hidden; border:1.5px solid #cbd5e1; height:calc(100vh - 150px); min-height:580px; display:flex !important; flex-direction:row !important; padding:0 !important; margin:0; box-sizing:border-box;">

    {{-- CỘT TRÁI: DANH SÁCH HỘI THOẠI (340px) --}}
    <div style="width:340px; min-width:300px; max-width:360px; height:100%; border-right:1.5px solid #e2e8f0; display:flex !important; flex-direction:column !important; background:#ffffff; flex-shrink:0; box-sizing:border-box;">
        {{-- Header tìm kiếm --}}
        <div style="padding:1.1rem 1.2rem; border-bottom:1px solid #f1f5f9; flex-shrink:0;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.8rem;">
                <h3 style="font-size:1.15rem; font-weight:800; color:#0f172a; margin:0; display:flex; align-items:center; gap:0.5rem;">
                    <i class="fas fa-comments" style="color:#2563eb;"></i> Hộp Thư Chat
                </h3>
                @php $totalUnread = auth()->user()->tinNhanChuaDocCount(); @endphp
                @if($totalUnread > 0)
                    <span style="background:#fee2e2; color:#dc2626; font-size:0.75rem; font-weight:700; padding:2px 8px; border-radius:12px;">
                        {{ $totalUnread }} mới
                    </span>
                @endif
            </div>
            <div style="position:relative;">
                <i class="fas fa-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:0.85rem;"></i>
                <input type="text" id="conversationSearch" placeholder="Tìm theo tên người dùng..." 
                       style="width:100%; padding:0.6rem 0.8rem 0.6rem 2.2rem; border-radius:10px; border:1.5px solid #e2e8f0; font-size:0.85rem; outline:none; transition:border 0.2s; box-sizing:border-box;">
            </div>
        </div>

        {{-- Danh sách các cuộc trò chuyện --}}
        <div id="conversationList" style="flex:1; min-height:0; overflow-y:auto; padding:0.5rem;">
            @forelse($conversations as $c)
                @php
                    $isCur = $activePartner && $activePartner->id === $c->partner->id;
                @endphp
                <a href="{{ route('chat.index', ['user_id' => $c->partner->id]) }}" 
                   class="conversation-item"
                   data-name="{{ mb_strtolower($c->partner->ho_ten) }}"
                   style="display:flex; align-items:center; gap:0.85rem; padding:0.85rem; border-radius:12px; text-decoration:none; margin-bottom:4px; transition:all 0.15s ease; background: {{ $isCur ? '#eff6ff' : 'transparent' }}; border: {{ $isCur ? '1.5px solid #bfdbfe' : '1.5px solid transparent' }};">
                    
                    {{-- Avatar --}}
                    <div style="position:relative; flex-shrink:0;">
                        <img src="{{ $c->partner->avatar_url }}" alt="{{ $c->partner->ho_ten }}" 
                             style="width:44px; height:44px; border-radius:50%; object-fit:cover; border:2px solid #fff; box-shadow:0 2px 5px rgba(0,0,0,0.06);">
                        <span style="position:absolute; bottom:1px; right:1px; width:11px; height:11px; background:#10b981; border:2px solid #fff; border-radius:50%;"></span>
                    </div>

                    {{-- Thông tin --}}
                    <div style="flex:1; min-width:0;">
                        <div style="display:flex; justify-content:space-between; align-items:baseline; margin-bottom:2px;">
                            <span style="font-weight:700; font-size:0.9rem; color:#0f172a; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                {{ $c->partner->ho_ten }}
                            </span>
                            <span style="font-size:0.72rem; color:#94a3b8; flex-shrink:0; margin-left:4px;">
                                {{ $c->last_message ? $c->last_message->formatted_time : '' }}
                            </span>
                        </div>
                        <div style="display:flex; align-items:center; justify-content:space-between; gap:4px;">
                            <span style="font-size:0.78rem; color:{{ $c->unread_count > 0 ? '#1e40af' : '#64748b' }}; font-weight:{{ $c->unread_count > 0 ? '700' : '400' }}; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                @if($c->last_message)
                                    {{ ($c->last_message->nguoi_gui_id == auth()->id() ? 'Bạn: ' : '') . $c->last_message->noi_dung }}
                                @else
                                    <em style="color:#94a3b8;">Bắt đầu trò chuyện...</em>
                                @endif
                            </span>
                            @if($c->unread_count > 0)
                                <span style="background:#ef4444; color:#fff; font-size:0.7rem; font-weight:800; border-radius:50%; min-width:18px; height:18px; display:inline-flex; align-items:center; justify-content:center; flex-shrink:0;">
                                    {{ $c->unread_count }}
                                </span>
                            @endif
                        </div>
                        <div style="margin-top:2px;">
                            <span style="font-size:0.68rem; padding:1px 6px; border-radius:4px; background:{{ $c->partner->isGiaSu() ? '#e0e7ff' : '#ecfdf5' }}; color:{{ $c->partner->isGiaSu() ? '#3730a3' : '#065f46' }}; font-weight:600;">
                                {{ $c->partner->vai_tro_label }}
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div style="padding:2rem 1rem; text-align:center; color:#94a3b8;">
                    <div style="font-size:2.4rem; margin-bottom:0.6rem;">💬</div>
                    <div style="font-weight:700; color:#475569; font-size:0.92rem; margin-bottom:0.3rem;">Chưa có tin nhắn nào</div>
                    <p style="font-size:0.78rem; margin:0;">Hãy chọn một người bên dưới để bắt đầu trao đổi!</p>
                </div>
            @endforelse

            {{-- Gợi ý liên hệ khi hộp thư còn trống --}}
            @if(isset($suggestedContacts) && $suggestedContacts->isNotEmpty())
                <div style="padding:0.8rem 0.5rem; margin-top:0.5rem; border-top:1px dashed #e2e8f0;">
                    <div style="font-size:0.75rem; font-weight:700; color:#64748b; text-transform:uppercase; margin-bottom:0.6rem; letter-spacing:0.5px;">
                        💡 Gợi Ý Kết Nối Nhanh
                    </div>
                    @foreach($suggestedContacts as $sc)
                        <a href="{{ route('chat.index', ['user_id' => $sc->id]) }}" 
                           style="display:flex; align-items:center; gap:0.65rem; padding:0.55rem; border-radius:8px; text-decoration:none; margin-bottom:4px; background:#f8fafc; border:1px solid #f1f5f9; transition:all 0.15s ease;">
                            <img src="{{ $sc->avatar_url }}" alt="{{ $sc->ho_ten }}" style="width:34px; height:34px; border-radius:50%; object-fit:cover;">
                            <div style="flex:1; min-width:0;">
                                <div style="font-weight:700; font-size:0.82rem; color:#0f172a; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    {{ $sc->ho_ten }}
                                </div>
                                <div style="font-size:0.7rem; color:#64748b;">
                                    {{ $sc->vai_tro_label }}
                                </div>
                            </div>
                            <span style="font-size:0.72rem; color:#2563eb; font-weight:600;"><i class="fas fa-comment-dots"></i> Chat</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- CỘT PHẢI: KHUNG CHAT CHÍNH (Chiếm toàn bộ không gian còn lại) --}}
    <div style="flex:1; height:100%; display:flex !important; flex-direction:column !important; background:#ffffff; min-width:0; box-sizing:border-box;">
        @if($activePartner)
            {{-- 1. Header Khung Chat (flex-shrink: 0) --}}
            <div style="padding:0.9rem 1.4rem; border-bottom:1.5px solid #e2e8f0; display:flex; justify-content:space-between; align-items:center; background:#ffffff; flex-shrink:0;">
                <div style="display:flex; align-items:center; gap:0.9rem;">
                    <div style="position:relative;">
                        <img src="{{ $activePartner->avatar_url }}" alt="{{ $activePartner->ho_ten }}" 
                             style="width:44px; height:44px; border-radius:50%; object-fit:cover; border:2px solid #e2e8f0;">
                        <span style="position:absolute; bottom:1px; right:1px; width:12px; height:12px; background:#10b981; border:2px solid #fff; border-radius:50%;"></span>
                    </div>
                    <div>
                        <div style="font-weight:800; font-size:1rem; color:#0f172a; display:flex; align-items:center; gap:0.5rem;">
                            <span>{{ $activePartner->ho_ten }}</span>
                            <span style="font-size:0.7rem; padding:2px 8px; border-radius:12px; background:{{ $activePartner->isGiaSu() ? '#e0e7ff' : '#ecfdf5' }}; color:{{ $activePartner->isGiaSu() ? '#3730a3' : '#065f46' }}; font-weight:700;">
                                {{ $activePartner->vai_tro_label }}
                            </span>
                        </div>
                        <div style="font-size:0.78rem; color:#10b981; display:flex; align-items:center; gap:0.35rem; margin-top:2px;">
                            <span style="width:6px; height:6px; background:#10b981; border-radius:50%; display:inline-block;"></span>
                            <span>Đang trực tuyến • Sẵn sàng trao đổi</span>
                        </div>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:0.6rem;">
                    @if($activePartner->isGiaSu() && $activePartner->hoSoGiaSu)
                        <a href="{{ route('chi-tiet-gia-su', $activePartner->id) }}" target="_blank" 
                           class="btn btn-outline btn-sm" style="font-size:0.8rem; padding:0.45rem 0.9rem; border-radius:8px;">
                            <i class="fas fa-external-link-alt" style="margin-right:4px;"></i> Xem Hồ Sơ Gia Sư
                        </a>
                    @endif
                </div>
            </div>

            {{-- 2. Vùng Lịch Sử Tin Nhắn (flex: 1, min-height: 0, tự cuộn) --}}
            <div id="chatMessagesBox" style="flex:1; min-height:0; overflow-y:auto; padding:1.2rem 1.5rem; background:#f8fafc; display:flex; flex-direction:column; gap:0.85rem;">
                {{-- Thông báo đầu cuộc trò chuyện --}}
                <div style="text-align:center; margin-bottom:0.5rem;">
                    <div style="display:inline-block; padding:0.35rem 1rem; background:#e2e8f0; border-radius:20px; font-size:0.75rem; color:#475569; font-weight:600;">
                        🔒 Cuộc trò chuyện được bảo mật trực tiếp giữa {{ auth()->user()->ho_ten }} và {{ $activePartner->ho_ten }}
                    </div>
                </div>

                @forelse($messages as $msg)
                    @php $isMe = $msg->nguoi_gui_id == auth()->id(); @endphp
                    <div class="message-bubble {{ $isMe ? 'msg-me' : 'msg-partner' }}" data-id="{{ $msg->id }}" 
                         style="display:flex; gap:0.6rem; align-items:flex-end; {{ $isMe ? 'justify-content:flex-end;' : 'justify-content:flex-start;' }}">
                        
                        @if(!$isMe)
                            <img src="{{ $activePartner->avatar_url }}" alt="avatar" style="width:28px; height:28px; border-radius:50%; margin-bottom:2px; flex-shrink:0;">
                        @endif

                        <div style="max-width:68%; {{ $isMe ? 'background: linear-gradient(135deg, #2563eb, #1d4ed8); color:#ffffff; border-radius:18px 18px 4px 18px; box-shadow:0 3px 10px rgba(37,99,235,0.2);' : 'background:#ffffff; color:#0f172a; border-radius:18px 18px 18px 4px; border:1px solid #e2e8f0; box-shadow:0 2px 6px rgba(0,0,0,0.03);' }} padding:0.75rem 1.1rem; word-break:break-word;">
                            <div style="font-size:0.92rem; line-height:1.55; white-space:pre-wrap;">{{ $msg->noi_dung }}</div>
                            <div style="font-size:0.68rem; margin-top:4px; text-align:right; color:{{ $isMe ? '#bfdbfe' : '#94a3b8' }}; display:flex; align-items:center; justify-content:flex-end; gap:4px;">
                                <span>{{ $msg->formatted_time }}</span>
                                @if($isMe)
                                    <i class="fas fa-check-double" style="font-size:0.65rem;" title="{{ $msg->da_xem ? 'Đã xem' : 'Đã gửi' }}"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div id="noMessagesPlaceholder" style="text-align:center; padding:2.5rem 1rem; color:#94a3b8;">
                        <div style="font-size:3rem; margin-bottom:0.6rem;">👋</div>
                        <div style="font-weight:700; font-size:1rem; color:#334155; margin-bottom:0.3rem;">Bắt đầu gửi lời chào!</div>
                        <p style="font-size:0.85rem; max-width:380px; margin:0 auto;">
                            Hãy gửi tin nhắn đầu tiên để cùng trao đổi về lịch học, mục tiêu giảng dạy hoặc mức học phí nhé.
                        </p>
                    </div>
                @endforelse
            </div>

            {{-- 3. Khung Nhập Tin Nhắn (Cố định ở đáy, không bao giờ bị che) --}}
            <form id="chatForm" style="padding:0.85rem 1.2rem; background:#ffffff; border-top:1.5px solid #e2e8f0; display:flex; gap:0.75rem; align-items:center; flex-shrink:0; margin:0;">
                @csrf
                <input type="hidden" id="partnerId" value="{{ $activePartner->id }}">
                
                <input type="text" id="messageInput" placeholder="Nhập tin nhắn trao đổi... (Nhấn Enter để gửi)" autocomplete="off"
                       style="flex:1; padding:0.75rem 1.2rem; border-radius:24px; border:1.5px solid #cbd5e1; font-size:0.92rem; outline:none; transition:border-color 0.2s;"
                       onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#cbd5e1'">

                <button type="submit" id="btnSubmit" 
                        style="width:44px; height:44px; border-radius:50%; background:linear-gradient(135deg, #2563eb, #1d4ed8); border:none; color:#ffffff; display:flex; align-items:center; justify-content:center; cursor:pointer; box-shadow:0 4px 12px rgba(37,99,235,0.3); transition:all 0.2s; flex-shrink:0;"
                        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <i class="fas fa-paper-plane" style="font-size:0.95rem; margin-left:-2px;"></i>
                </button>
            </form>
        @else
            {{-- Màn hình chờ khi chưa chọn người chat --}}
            <div style="flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:3rem; text-align:center; background:#f8fafc;">
                <div style="width:80px; height:80px; border-radius:50%; background:#eff6ff; color:#2563eb; display:flex; align-items:center; justify-content:center; font-size:2.4rem; margin-bottom:1.2rem; box-shadow:0 8px 24px rgba(37,99,235,0.1);">
                    <i class="fas fa-comments"></i>
                </div>
                <h3 style="font-size:1.3rem; font-weight:800; color:#0f172a; margin-bottom:0.5rem;">
                    Chọn một cuộc trò chuyện
                </h3>
                <p style="color:#64748b; font-size:0.92rem; max-width:420px; line-height:1.6; margin-bottom:1.5rem;">
                    Kết nối trực tiếp giữa Gia sư và Phụ huynh / Học viên để bàn bạc kế hoạch học tập, thời khóa biểu và phương pháp giảng dạy hiệu quả nhất.
                </p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatBox = document.getElementById('chatMessagesBox');
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const partnerIdInput = document.getElementById('partnerId');
    const conversationSearch = document.getElementById('conversationSearch');
    const noMessagesPlaceholder = document.getElementById('noMessagesPlaceholder');

    // Tự động cuộn xuống đáy hộp chat
    function scrollToBottom(smooth = false) {
        if (!chatBox) return;
        if (smooth) {
            chatBox.scrollTo({ top: chatBox.scrollHeight, behavior: 'smooth' });
        } else {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    }
    scrollToBottom(false);

    // Lọc hội thoại ở cột trái bằng thanh tìm kiếm
    if (conversationSearch) {
        conversationSearch.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            document.querySelectorAll('.conversation-item').forEach(item => {
                const name = item.getAttribute('data-name') || '';
                item.style.display = name.includes(query) ? 'flex' : 'none';
            });
        });
    }

    // Nếu đang trong phòng chat với một người
    if (chatForm && partnerIdInput) {
        const partnerId = partnerIdInput.value;
        const partnerAvatar = '{{ $activePartner ? $activePartner->avatar_url : "" }}';
        let lastMessageId = 0;

        // Tìm lastMessageId hiện tại trong danh sách
        const existingMessages = document.querySelectorAll('.message-bubble');
        if (existingMessages.length > 0) {
            const lastBubble = existingMessages[existingMessages.length - 1];
            lastMessageId = parseInt(lastBubble.getAttribute('data-id')) || 0;
        }

        // Tạo bong bóng tin nhắn DOM
        function createMessageBubble(msg) {
            const wrapper = document.createElement('div');
            wrapper.className = `message-bubble ${msg.is_me ? 'msg-me' : 'msg-partner'}`;
            wrapper.setAttribute('data-id', msg.id);
            wrapper.style.cssText = `display:flex; gap:0.6rem; align-items:flex-end; ${msg.is_me ? 'justify-content:flex-end;' : 'justify-content:flex-start;'}`;

            let avatarHtml = '';
            if (!msg.is_me) {
                avatarHtml = `<img src="${partnerAvatar}" alt="avatar" style="width:28px; height:28px; border-radius:50%; margin-bottom:2px; flex-shrink:0;">`;
            }

            const bubbleStyle = msg.is_me
                ? 'background: linear-gradient(135deg, #2563eb, #1d4ed8); color:#ffffff; border-radius:18px 18px 4px 18px; box-shadow:0 3px 10px rgba(37,99,235,0.2);'
                : 'background:#ffffff; color:#0f172a; border-radius:18px 18px 18px 4px; border:1px solid #e2e8f0; box-shadow:0 2px 6px rgba(0,0,0,0.03);';

            const timeColor = msg.is_me ? '#bfdbfe' : '#94a3b8';
            const checkIcon = msg.is_me ? '<i class="fas fa-check" style="font-size:0.65rem;"></i>' : '';

            wrapper.innerHTML = `
                ${avatarHtml}
                <div style="max-width:68%; ${bubbleStyle} padding:0.75rem 1.1rem; word-break:break-word;">
                    <div style="font-size:0.92rem; line-height:1.55; white-space:pre-wrap;">${msg.noi_dung}</div>
                    <div style="font-size:0.68rem; margin-top:4px; text-align:right; color:${timeColor}; display:flex; align-items:center; justify-content:flex-end; gap:4px;">
                        <span>${msg.time}</span>
                        ${checkIcon}
                    </div>
                </div>
            `;
            return wrapper;
        }

        // Gửi tin nhắn qua Fetch API
        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const text = messageInput.value.trim();
            if (!text) return;

            // Xóa nội dung trong ô nhập và focus lại
            messageInput.value = '';
            messageInput.focus();

            if (noMessagesPlaceholder) {
                noMessagesPlaceholder.style.display = 'none';
            }

            // Gửi lên server
            try {
                const response = await fetch('{{ route("chat.send") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        nguoi_nhan_id: partnerId,
                        noi_dung: text
                    })
                });

                const data = await response.json();
                if (data.success && data.message) {
                    const bubble = createMessageBubble(data.message);
                    chatBox.appendChild(bubble);
                    lastMessageId = data.message.id;
                    scrollToBottom(true);
                } else {
                    alert(data.message || 'Không thể gửi tin nhắn.');
                }
            } catch (err) {
                console.error('Lỗi gửi tin nhắn:', err);
            }
        });

        // Polling lấy tin nhắn mới mỗi 3 giây
        async function fetchNewMessages() {
            try {
                const res = await fetch(`{{ url('/chat/api/messages') }}/${partnerId}?after_id=${lastMessageId}`, {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success && data.messages && data.messages.length > 0) {
                    let hasNew = false;
                    data.messages.forEach(msg => {
                        // Tránh hiển thị trùng lặp tin nhắn vừa tự gửi
                        if (!document.querySelector(`.message-bubble[data-id="${msg.id}"]`)) {
                            const bubble = createMessageBubble(msg);
                            chatBox.appendChild(bubble);
                            lastMessageId = Math.max(lastMessageId, msg.id);
                            hasNew = true;
                        }
                    });
                    if (hasNew) {
                        if (noMessagesPlaceholder) noMessagesPlaceholder.style.display = 'none';
                        scrollToBottom(true);
                    }
                }
            } catch (e) {
                // Ignore transient network errors
            }
        }

        // Bật chu kỳ polling
        const pollingInterval = setInterval(fetchNewMessages, 3000);

        // Hủy polling khi rời trang
        window.addEventListener('beforeunload', () => clearInterval(pollingInterval));
    }
});
</script>
@endpush
