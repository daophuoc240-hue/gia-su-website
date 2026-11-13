@extends('layouts.public')

@section('title', $bai['tieu_de'] . ' - Gia Sư Tri Thức')

@section('content')

<div class="container" style="padding: 2.8rem 0 4rem 0; max-width: 900px;">
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('kinh-nghiem') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Quay lại Góc Kinh Nghiệm</a>
    </div>

    <article class="glass-card" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 22px; padding: 2.5rem;">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
            <span style="font-size: 0.8rem; font-weight: 800; color: {{ $bai['mau'][1] }}; background: {{ $bai['mau'][0] }}; padding: 0.3rem 0.85rem; border-radius: 50px;">
                {{ $bai['icon'] }} {{ $bai['nhom'] }}
            </span>
            <span style="font-size: 0.82rem; color: #64748b;"><i class="far fa-clock"></i> {{ $bai['doc_phut'] }} phút đọc</span>
        </div>

        <h1 style="font-size: 1.85rem; font-weight: 800; color: #0f172a; line-height: 1.35; margin: 0 0 1rem 0;">
            {{ $bai['tieu_de'] }}
        </h1>

        <p style="font-size: 1rem; color: #475569; line-height: 1.7; background: #f8fafc; padding: 1.1rem 1.3rem; border-radius: 14px; border-left: 4px solid #2563eb; margin: 0 0 1.8rem 0;">
            {{ $bai['tom_tat'] }}
        </p>

        <div style="font-size: 0.96rem; color: #334155; line-height: 1.85;">
            @foreach($bai['noi_dung'] as [$tag, $text])
                @if($tag === 'h')
                    <h2 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin: 1.6rem 0 0.6rem 0;">{{ $text }}</h2>
                @else
                    <p style="margin: 0 0 1rem 0;">{{ $text }}</p>
                @endif
            @endforeach
        </div>
    </article>

    @if(!empty($lien_quan))
    <div style="margin-top: 3rem;">
        <h3 style="font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 0 0 1.2rem 0;">📚 Bài Viết Cùng Chủ Đề</h3>
        <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.25rem;">
            @foreach($lien_quan as $slug => $bv)
            <a href="{{ route('bai-viet', $slug) }}" style="text-decoration: none; color: inherit;">
                <div class="glass-card" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 1.3rem; height: 100%; display: flex; flex-direction: column;">
                    <span style="font-size: 0.74rem; font-weight: 700; color: {{ $bv['mau'][1] }}; margin-bottom: 0.4rem;">{{ $bv['icon'] }} {{ $bv['nhom'] }}</span>
                    <h4 style="font-size: 0.96rem; font-weight: 800; color: #0f172a; margin: 0 0 0.5rem 0; line-height: 1.4;">{{ $bv['tieu_de'] }}</h4>
                    <span style="margin-top: auto; font-size: 0.8rem; font-weight: 700; color: #2563eb;">Xem bài viết →</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection
