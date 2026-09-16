@extends('layouts.app')
@section('title', 'Dashboard Gia SÆ°')
@section('page-title', 'Dashboard Gia SÆ°')

@section('sidebar-nav')
<p class="nav-section-title">Tá»•ng Quan</p>
<div class="nav-item">
    <a href="{{ route('giasu.dashboard') }}" class="nav-link {{ request()->routeIs('giasu.dashboard') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-home"></i></span> Dashboard
    </a>
</div>
<p class="nav-section-title">Há»“ SÆ¡ & Lá»›p Há»c</p>
<div class="nav-item">
    <a href="{{ route('giasu.ho-so') }}" class="nav-link {{ request()->routeIs('giasu.ho-so*') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-id-card"></i></span> Há»“ SÆ¡ Cá»§a TĂ´i
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('giasu.tim-kiem-lop') }}" class="nav-link {{ request()->routeIs('giasu.tim-kiem-lop') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-search"></i></span> TĂ¬m Kiáº¿m Lá»›p
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('giasu.ket-qua') }}" class="nav-link {{ request()->routeIs('giasu.ket-qua') ? 'active' : '' }}">
        <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span> Káº¿t Quáº£ ÄÄƒng KĂ½
    </a>
</div>
@endsection

@section('content')
<!-- Welcome Banner Card -->
<div style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%); border-radius: 20px; padding: 2rem 2.2rem; color: #ffffff; margin-bottom: 2rem; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);">
    <div style="position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.15); padding: 0.35rem 0.9rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700; margin-bottom: 0.8rem; border: 1px solid rgba(255,255,255,0.25);">
                đŸ‘¨â€đŸ« TĂ€I KHOáº¢N GIA SÆ¯
            </div>
            <h2 style="font-size: 1.6rem; font-weight: 800; margin-bottom: 0.4rem;">Xin chĂ o, {{ auth()->user()->ho_ten }}! đŸ‘‹</h2>
            <p style="font-size: 0.95rem; color: rgba(255,255,255,0.85); max-width: 600px;">
                ChĂ o má»«ng báº¡n quay trá»Ÿ láº¡i Trung tĂ¢m Gia sÆ°. HĂ£y kiá»ƒm tra danh sĂ¡ch lá»›p há»c má»›i nháº¥t vĂ  cáº­p nháº­t há»“ sÆ¡ Ä‘á»ƒ nháº­n lá»›p ngay hĂ´m nay!
            </p>
        </div>
        <div>
            <a href="{{ route('giasu.tim-kiem-lop') }}" class="btn" style="background: #ffffff !important; color: #1e3a8a !important; font-weight: 800; padding: 0.85rem 1.6rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.15);">
                <i class="fas fa-search" style="margin-right: 0.4rem; color: #2563eb;"></i> TĂ¬m Lá»›p Má»›i Ngay
            </a>
        </div>
    </div>
</div>

{{-- Notification Alerts --}}
@if(!)
<div class="alert alert-warning" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-exclamation-triangle" style="font-size: 1.2rem;"></i>
    <div>
        <strong>Báº¡n chÆ°a hoĂ n thiá»‡n há»“ sÆ¡ gia sÆ°:</strong> Vui lĂ²ng cáº­p nháº­t Ä‘áº§y Ä‘á»§ trĂ¬nh Ä‘á»™ há»c váº¥n vĂ  kinh nghiá»‡m Ä‘á»ƒ trung tĂ¢m tiáº¿n hĂ nh duyá»‡t tĂ i khoáº£n. 
        <a href="{{ route('giasu.ho-so') }}" style="color: #b45309; font-weight: 800; text-decoration: underline; margin-left: 0.5rem;">Cáº­p nháº­t há»“ sÆ¡ ngay â†’</a>
    </div>
</div>
@elseif(->trang_thai_duyet === 'cho_duyet')
<div class="alert alert-warning" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-clock" style="font-size: 1.2rem;"></i>
    <div>
        <strong>Há»“ sÆ¡ Ä‘ang chá» phĂª duyá»‡t:</strong> Ban quáº£n trá»‹ Ä‘ang tiáº¿n hĂ nh xem xĂ©t há»“ sÆ¡ cá»§a báº¡n. Báº¡n sáº½ nháº­n Ä‘Æ°á»£c thĂ´ng bĂ¡o ngay khi há»“ sÆ¡ Ä‘Æ°á»£c kĂ­ch hoáº¡t!
    </div>
</div>
@elseif(->trang_thai_duyet === 'tu_choi')
<div class="alert alert-error" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-times-circle" style="font-size: 1.2rem;"></i>
    <div>
        <strong>Há»“ sÆ¡ bá»‹ tá»« chá»‘i:</strong> {{ ->ly_do_tu_choi ?? 'Há»“ sÆ¡ chÆ°a Ä‘áº¡t yĂªu cáº§u cá»§a trung tĂ¢m.' }} 
        <a href="{{ route('giasu.ho-so') }}" style="color: #991b1b; font-weight: 800; text-decoration: underline; margin-left: 0.5rem;">Cáº­p nháº­t láº¡i thĂ´ng tin â†’</a>
    </div>
</div>
@else
<div class="alert alert-success" style="border-radius: 14px; padding: 1.1rem 1.4rem;">
    <i class="fas fa-check-circle" style="font-size: 1.2rem;"></i>
    <div>
        <strong>TĂ i khoáº£n Ä‘Ă£ Ä‘Æ°á»£c xĂ¡c thá»±c:</strong> Há»“ sÆ¡ cá»§a báº¡n Ä‘Ă£ Ä‘Æ°á»£c phĂª duyá»‡t thĂ nh cĂ´ng! Báº¡n cĂ³ thá»ƒ tá»± do chá»n vĂ  Ä‘Äƒng kĂ½ nháº­n cĂ¡c lá»›p há»c phĂ¹ há»£p.
    </div>
</div>
@endif

{{-- 4 Stat Cards Grid --}}
<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-card-icon orange"><i class="fas fa-hourglass-half"></i></div>
        <div>
            <div class="stat-card-value">{{ ['cho_duyet'] }}</div>
            <div class="stat-card-label">Äang chá» duyá»‡t</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-icon green"><i class="fas fa-check-circle"></i></div>
        <div>
            <div class="stat-card-value">{{ ['da_duyet'] }}</div>
            <div class="stat-card-label">Lá»›p Ä‘Ă£ nháº­n</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-icon red"><i class="fas fa-times-circle"></i></div>
        <div>
            <div class="stat-card-value">{{ ['tu_choi'] }}</div>
            <div class="stat-card-label">YĂªu cáº§u bá»‹ tá»« chá»‘i</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon blue"><i class="fas fa-chalkboard-teacher"></i></div>
        <div>
            <div class="stat-card-value">{{ $stats['lop_dang_tim'] }}</div>
            <div class="stat-card-label">Lá»›p há»c hiá»‡n cĂ³</div>
        </div>
    </div>
</div>

{{-- Quick Action Cards --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.2rem; margin-bottom: 2rem;">
    <a href="{{ route('giasu.ho-so') }}" style="text-decoration: none;">
        <div class="glass-card" style="padding: 1.4rem; display: flex; align-items: center; gap: 1rem; border-left: 5px solid #2563eb; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 48px; height: 48px; background: #eff6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: #2563eb;">đŸ†”</div>
            <div>
                <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">Há»“ SÆ¡ CĂ¡ NhĂ¢n</div>
                <div style="font-size: 0.8rem; color: #64748b;">Chá»‰nh sá»­a thĂ´ng tin & báº±ng cáº¥p</div>
            </div>
        </div>
    </a>

    <a href="{{ route('giasu.tim-kiem-lop') }}" style="text-decoration: none;">
        <div class="glass-card" style="padding: 1.4rem; display: flex; align-items: center; gap: 1rem; border-left: 5px solid #10b981; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 48px; height: 48px; background: #ecfdf5; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: #10b981;">đŸ”</div>
            <div>
                <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">TĂ¬m Lá»›p PhĂ¹ Há»£p</div>
                <div style="font-size: 0.8rem; color: #64748b;">Xem danh sĂ¡ch lá»›p Ä‘ang má»Ÿ</div>
            </div>
        </div>
    </a>

    <a href="{{ route('giasu.ket-qua') }}" style="text-decoration: none;">
        <div class="glass-card" style="padding: 1.4rem; display: flex; align-items: center; gap: 1rem; border-left: 5px solid #7c3aed; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 48px; height: 48px; background: #f3e8ff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; color: #7c3aed;">đŸ“</div>
            <div>
                <div style="font-weight: 800; font-size: 0.95rem; color: #0f172a;">Lá»‹ch Sá»­ ÄÄƒng KĂ½</div>
                <div style="font-size: 0.8rem; color: #64748b;">Theo dĂµi tiáº¿n Ä‘á»™ nháº­n lá»›p</div>
            </div>
        </div>
    </a>
</div>

{{-- Recent Registrations Table --}}
<div class="glass-card" style="padding: 1.8rem;">
    <div class="page-header" style="margin-bottom: 1.2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
        <div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a;">đŸ“‹ Danh SĂ¡ch ÄÄƒng KĂ½ Lá»›p Gáº§n ÄĂ¢y</h3>
            <p style="font-size: 0.85rem; color: #64748b;">CĂ¡c lá»›p há»c báº¡n Ä‘Ă£ gá»­i yĂªu cáº§u nháº­n dáº¡y</p>
        </div>
        <a href="{{ route('giasu.ket-qua') }}" class="btn btn-outline btn-sm">Xem táº¥t cáº£ â†’</a>
    </div>

    @forelse( as )
    <div style="padding: 1.1rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 0.9rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <div style="font-weight: 800; font-size: 1rem; color: #0f172a; margin-bottom: 0.3rem;">
                đŸ“ {{ ->lopHoc->mon_hoc }} - {{ ->lopHoc->khoi_lop }}
            </div>
            <div style="font-size: 0.85rem; color: #475569; display: flex; gap: 1.2rem; flex-wrap: wrap;">
                <span>đŸ“ <strong>Äá»‹a chá»‰:</strong> {{ ->lopHoc->dia_chi_day }}</span>
                <span>đŸ’° <strong>Há»c phĂ­:</strong> {{ number_format(->lopHoc->muc_hoc_phi) }} Ä‘/buá»•i</span>
                <span>đŸ“… <strong>Thá»i gian:</strong> {{ ->created_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>
        <div>
            <span class="badge {{ ->trang_thai === 'da_duyet' ? 'badge-success' : (->trang_thai === 'tu_choi' ? 'badge-danger' : 'badge-warning') }}" style="font-size: 0.85rem; padding: 0.4rem 0.9rem;">
                {{ ->trang_thai_label }}
            </span>
        </div>
    </div>
    @empty
    <div class="empty-state" style="padding: 3rem 1.5rem; background: #f8fafc; border-radius: 16px; border: 2px dashed #cbd5e1;">
        <div class="empty-state-icon" style="font-size: 3.5rem;">đŸ“­</div>
        <h4 style="font-size: 1.2rem; font-weight: 800;">Báº¡n chÆ°a Ä‘Äƒng kĂ½ nháº­n lá»›p nĂ o</h4>
        <p style="margin-bottom: 1.2rem;">HĂ£y duyá»‡t qua danh sĂ¡ch cĂ¡c lá»›p há»c Ä‘ang má»Ÿ Ä‘á»ƒ tĂ¬m lá»›p dáº¡y phĂ¹ há»£p nháº¥t.</p>
        <a href="{{ route('giasu.tim-kiem-lop') }}" class="btn btn-primary">
            <i class="fas fa-search"></i> KhĂ¡m PhĂ¡ Lá»›p Há»c Má»›i Ngay
        </a>
    </div>
    @endforelse
</div>
@endsection