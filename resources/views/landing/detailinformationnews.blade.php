@extends('layouts.landing.base')

@section('content')
    <!-- Page Header -->
    <section class="w-full bg-cine-navy pt-[168px] pb-[64px]">
        <div class="max-w-[1180px] mx-auto px-[24px] text-center lg:text-left flex flex-col lg:flex-row justify-between lg:items-end gap-[32px]">
            <div class="w-full lg:w-3/4">
                <span class="inline-block text-cine-yellow font-bold text-xs tracking-widest uppercase mb-4 bg-cine-yellow/10 px-3 py-1 rounded">DETAIL BERITA</span>
                <h1 class="text-3xl lg:text-5xl font-black text-cine-cream mb-4 tracking-tighter leading-tight">
                    {{ strtoupper($news->title ?? 'DETAIL INFORMASI BERITA') }}
                </h1>
            </div>
            <div class="w-full lg:w-1/4 lg:text-right">
                <span class="text-cine-cream/70 font-medium text-sm tracking-widest uppercase">TERAKHIR DIPERBARUI</span>
                <p class="text-cine-blue font-bold">
                    {{ $news->created_at ? $news->created_at->translatedFormat('l, j F Y') : 'TERBARU' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="w-full bg-cine-cream min-h-[500px] py-[56px] lg:py-[88px]">
        <div class="max-w-[800px] mx-auto px-[24px] bg-white rounded-[24px] overflow-hidden border border-cine-navy/10 shadow-sm">
            @if($news->thumbnail_news && $news->thumbnail_news->count() > 0)
                <div class="w-full h-[300px] md:h-[400px] bg-cine-navy/5 relative">
                    <img src="{{ asset('storage/' . $news->thumbnail_news->first()->thumbnail) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                </div>
            @endif
            
            <div class="p-[32px] lg:p-[48px]">
                <article class="prose prose-lg lg:prose-xl max-w-none text-cine-navy text-justify leading-relaxed">
                <p class="first-letter:text-6xl first-letter:font-black first-letter:text-cine-blue first-letter:mr-3 first-letter:float-left first-line:uppercase first-line:tracking-widest">
                    {{ $news->description ?? 'Konten berita tidak tersedia.' }}
                </p>
            </article>

            <div class="mt-16 pt-8 border-t border-cine-navy/10 flex justify-center lg:justify-start">
                <a href="{{ route('informasi-berita') }}" class="text-cine-navy bg-cine-navy/5 px-8 py-3 rounded-[12px] font-bold hover:bg-cine-yellow transition-colors inline-block text-sm">
                    Kembali ke Berita
                </a>
            </div>
        </div>
    </section>
@endsection