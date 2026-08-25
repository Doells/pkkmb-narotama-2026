@extends('layouts.landing.base')

@section('content')
<main>
    <section class="cine-hero" id="beranda">
        <div class="cine-grain" aria-hidden="true"></div>
        <div class="cine-container cine-hero-grid">
            <div>
                <div class="cine-eyebrow">PKKMB UNIVERSITAS NAROTAMA 2026</div>
                <h1>Cine<span>Action</span></h1>
                <p class="cine-tagline">Mahakarya Garda Depan,<br>Mengukir Dampak untuk Negeri.</p>
                <p class="cine-lead">Langkah pertama menuju perjalanan baru. Temukan teman, pengalaman, dan semangat untuk menjadi bagian dari Garda Depan Narotama.</p>
                <div class="cine-actions">
                    <a class="cine-button cine-button-primary" href="{{ route('informasi-landing') }}">Jelajahi Informasi <b>→</b></a>
                    <a class="cine-button cine-button-outline" href="#jadwal">Lihat Jadwal</a>
                </div>
            </div>

            <div class="cine-visual" aria-label="Ilustrasi tiket PKKMB 2026">
                <div class="cine-spot one"></div><div class="cine-spot two"></div>
                <div class="cine-film"><span>WELCOME</span></div>
                <div class="cine-ticket">
                    <div class="cine-ticket-head"><small>ADMIT ONE</small><strong>NAROTAMA</strong></div>
                    <div class="cine-ticket-main">
                        <span>THE FIRST SCENE</span>
                        <strong>PKKMB<br>2026</strong>
                        <div class="cine-ticket-meta"><span>14—17 SEPTEMBER</span><span>SURABAYA</span></div>
                    </div>
                    <div class="cine-ticket-stub"><span>GARDA DEPAN</span><b>26</b></div>
                </div>
                <div class="cine-badge"><b>4</b><span>HARI<br>BERAKSI</span></div>
            </div>
        </div>
        <div class="cine-ticker" aria-hidden="true"><span>ORIENTASI</span> ✦ <span>KOLABORASI</span> ✦ <span>INSPIRASI</span> ✦ <span>AKSI NYATA</span> ✦ <span>GARDA DEPAN</span></div>
    </section>

    <section class="cine-section">
        <div class="cine-container cine-intro-grid">
            <div><div class="cine-kicker">MULAI CERITAMU</div><h2 class="cine-title">Satu langkah kecil.<br><em>Dampak yang besar.</em></h2></div>
            <div class="cine-intro-copy"><p>PKKMB bukan sekadar pengenalan kampus. Ini adalah babak pembuka untuk mengenali potensi, membangun koneksi, dan memulai karya yang berdampak.</p><a href="{{ route('informasi-landing') }}#pengenalan" class="cine-text-link">Baca tentang PKKMB ↗</a></div>
        </div>
    </section>

    <section class="cine-section cine-info">
        <div class="cine-container">
            <div class="cine-section-head"><div><div class="cine-kicker">INFORMASI PESERTA</div><h2 class="cine-title">Semua yang perlu<br>kamu siapkan.</h2></div><p>Empat panduan utama untuk memastikan perjalanan pertamamu dimulai dengan percaya diri.</p></div>
            <div class="cine-info-grid">
                <a href="{{ route('informasi-landing') }}#pengenalan" class="cine-info-card blue"><small>01</small><div class="cine-info-icon">▶</div><h3>Pengenalan PKKMB</h3><p>Kenali tema, rangkaian kegiatan, dan hal penting sebelum hari pelaksanaan.</p><span class="cine-card-link">Buka informasi <b>↗</b></span></a>
                <a href="{{ route('informasi-landing') }}#pedoman" class="cine-info-card yellow"><small>02</small><div class="cine-info-icon">≡</div><h3>Pedoman Peserta</h3><p>Panduan lengkap, tata tertib, perlengkapan, dan ketentuan peserta.</p><span class="cine-card-link">Buka informasi <b>↗</b></span></a>
                <a href="{{ route('informasi-landing') }}#seragam" class="cine-info-card coral"><small>03</small><div class="cine-info-icon">◆</div><h3>Ketentuan Seragam</h3><p>Lihat pakaian dan atribut yang perlu disiapkan untuk setiap rangkaian acara.</p><span class="cine-card-link">Buka informasi <b>↗</b></span></a>
                <a href="{{ route('informasi-landing') }}#panitia" class="cine-info-card mint"><small>04</small><div class="cine-info-icon">●</div><h3>Kenali Panitia</h3><p>Temukan koordinator dan narahubung yang siap membantu mahasiswa baru.</p><span class="cine-card-link">Buka informasi <b>↗</b></span></a>
            </div>
        </div>
    </section>

    <section class="cine-section cine-mascot">
        <div class="cine-container cine-mascot-grid">
            <div class="cine-mascot-visual">
                <img src="{{ asset('img/mascot/mascot-peek-white.png') }}" alt="Maskot PKKMB Narotama 2026">
            </div>
            <div class="cine-mascot-content">
                <div class="cine-kicker">Wajah Ceria Garda Depan</div>
                <h2 class="cine-title">Kenali<br><em>Maskot Kami.</em></h2>
                <p class="cine-mascot-desc">
                    Mewakili kearifan budaya dan semangat tak kenal lelah ksatria Narotama, Maskot PKKMB 2026 hadir untuk menemani perjalanan pertamamu di Garda Depan.
                </p>
            </div>
        </div>
    </section>

    <section class="cine-section" id="jadwal">
        <div class="cine-container cine-schedule">
            <div><div class="cine-kicker">LINIMASA KEGIATAN</div><h2 class="cine-title">Tandai<br><em>tanggalnya.</em></h2><p style="max-width:340px;color:#557282;line-height:1.7;margin-top:35px">Jadwal dapat berubah. Pantau informasi terbaru melalui website dan kanal resmi PKKMB.</p></div>
            <div>
                <article class="cine-agenda"><div class="cine-date"><b>01</b><span>SEPT</span></div><div><small>01</small><h3>Technical Meeting</h3><p>Zoom Meeting</p></div><span>↗</span></article>
                <article class="cine-agenda"><div class="cine-date mint"><b>07-10</b><span>SEPT</span></div><div><small>02</small><h3>Pra-PKKMB</h3><p>Kampus Universitas Narotama</p></div><span>↗</span></article>
                <article class="cine-agenda"><div class="cine-date yellow"><b>14-17</b><span>SEPT</span></div><div><small>03</small><h3>PKKMB 2026</h3><p>Kampus Universitas Narotama</p></div><span>↗</span></article>
            </div>
        </div>
    </section>

    {{-- Berita Terbaru Section --}}
    <section class="cine-section" id="berita">
        <div class="cine-container">
            <div class="cine-section-head" style="margin-bottom:42px">
                <div>
                    <div class="cine-kicker">BERITA TERBARU</div>
                    <h2 class="cine-title">Kabar<br><em>terkini.</em></h2>
                </div>
                <p style="max-width:340px;color:#557282;line-height:1.7">Ikuti perkembangan informasi terbaru mengenai PKKMB Universitas Narotama 2026.</p>
            </div>

            @if(isset($latestNews) && $latestNews->count())
                <div class="cine-news-grid">
                    @foreach($latestNews as $news)
                        <a href="{{ route('detail-informasi-berita', $news->id) }}" class="cine-news-card">
                            {{-- Thumbnail --}}
                            <div class="cine-news-thumb">
                                @if($news->thumbnail_news->first() && $news->thumbnail_news->first()->thumbnail)
                                    <img src="{{ asset('storage/' . $news->thumbnail_news->first()->thumbnail) }}" alt="{{ $news->title }}">
                                @else
                                    <div class="cine-news-thumb-placeholder">
                                        <span>📰</span>
                                    </div>
                                @endif
                            </div>
                            {{-- Content --}}
                            <div class="cine-news-body">
                                <span class="cine-news-date">
                                    {{ $news->created_at ? $news->created_at->format('d M Y') : 'TERBARU' }}
                                </span>
                                <h3 class="cine-news-title">{{ $news->title ?? 'Judul Berita' }}</h3>
                                <p class="cine-news-excerpt">
                                    {{ Str::limit(strip_tags($news->description ?? ''), 120) }}
                                </p>
                                <span class="cine-news-link">
                                    Baca Berita
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div style="text-align:center;margin-top:42px">
                    <a href="{{ route('informasi-berita') }}" class="cine-button cine-button-primary">
                        Lihat Semua Berita <b>→</b>
                    </a>
                </div>
            @else
                <div style="text-align:center;padding:40px 0;position:relative;z-index:2;">
                    <img style="height:200px;margin: 0 auto -25px;display:block;transform:translateY(8px)" src="{{ asset('img/mascot/mascot-peek-trans.png') }}" alt="Maskot Peeking">
                    <div style="display:inline-block;padding:24px 40px;background:#ffffff;border:1px dashed rgba(80, 214, 178, 0.4);border-radius:18px;position:relative;z-index:10;box-shadow: 0 4px 20px rgba(0,0,0,0.05)">
                        <h3 style="font-size:22px;font-weight:900;margin:0 0 8px;color:var(--cine-navy)">Belum Ada Berita</h3>
                        <p style="color:#557282;line-height:1.7;max-width:400px;margin:0 auto">Berita menarik tentang PKKMB Narotama 2026 akan segera hadir di sini.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="cine-cta">
        <div class="cine-container cine-cta-inner">
            <div><small>SUDAH SIAP?</small><h2>Masuk ke ruang<br>peserta PKKMB.</h2></div>
            @auth
                <a href="{{ route('home-presences.indexuserdashboard') }}" class="cine-button cine-button-dark">Buka Dashboard <b>→</b></a>
            @else
                <a href="{{ route('auth.login') }}" class="cine-button cine-button-dark">Login Peserta <b>→</b></a>
            @endauth
        </div>
    </section>
</main>
@endsection
