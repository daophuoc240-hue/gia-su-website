@extends('layouts.public')

@section('title', 'Góc Kinh Nghiệm & Cẩm Nang Học Tập - Gia Sư Tri Thức')

@section('content')

<div style="background: linear-gradient(180deg, #eff6ff 0%, #f8fafc 100%); padding: 3rem 0 2.5rem 0; border-bottom: 1px solid #e2e8f0; margin-bottom: 2.8rem;">
    <div class="container">
        <span style="display: inline-block; background: #dbeafe; color: #1e40af; font-size: 0.78rem; font-weight: 800; padding: 0.3rem 0.85rem; border-radius: 50px; margin-bottom: 0.6rem;">
            CẨM NANG GIÁO DỤC & GIA SƯ
        </span>
        <h1 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin: 0 0 0.4rem 0;">📖 Góc Kinh Nghiệm Chọn Gia Sư & Phương Pháp Học Tập</h1>
        <p style="color: #64748b; font-size: 0.96rem; margin: 0;">Chia sẻ kinh nghiệm thực tế dành cho Phụ huynh, Học sinh và Sinh viên nhận lớp dạy kèm.</p>
    </div>
</div>

<div class="container" style="margin-bottom: 4rem;">
    <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1.8rem; align-items: stretch;">
        @foreach($bai_viets as $slug => $bv)
        <a href="{{ route('bai-viet', $slug) }}" style="text-decoration: none; color: inherit;">
            <div class="glass-card" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 1.8rem; height: 100%; display: flex; flex-direction: column; box-sizing: border-box; transition: all 0.22s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='#93c5fd';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='#e2e8f0';">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <div style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        <span style="width: 42px; height: 42px; border-radius: 12px; background: {{ $bv['mau'][0] }}; color: {{ $bv['mau'][1] }}; display: inline-flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                            {{ $bv['icon'] }}
                        </span>
                        <span style="font-size: 0.78rem; font-weight: 800; color: {{ $bv['mau'][1] }}; background: {{ $bv['mau'][0] }}; padding: 0.25rem 0.75rem; border-radius: 50px;">
                            {{ $bv['nhom'] }}
                        </span>
                    </div>
                    <span style="font-size: 0.78rem; color: #64748b;"><i class="far fa-clock"></i> {{ $bv['doc_phut'] }} phút đọc</span>
                </div>

                <h2 style="font-size: 1.18rem; font-weight: 800; color: #0f172a; margin: 0 0 0.6rem 0; line-height: 1.4;">
                    {{ $bv['tieu_de'] }}
                </h2>
                <p style="font-size: 0.9rem; color: #475569; line-height: 1.65; margin: 0 0 1.2rem 0; flex: 1;">
                    {{ $bv['tom_tat'] }}
                </p>

                <div style="margin-top: auto; padding-top: 0.8rem; border-top: 1px solid #f1f5f9; font-size: 0.85rem; font-weight: 700; color: #2563eb; display: flex; align-items: center; gap: 0.4rem;">
                    <span>Đọc chi tiết bài viết</span> <i class="fas fa-arrow-right" style="font-size: 0.75rem;"></i>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>

@endsection
