@extends('layouts.landing.base')

@section('content')
<main>
    <section class="cine-page-hero">
        <div class="cine-container cine-page-hero-inner">
            <div><div class="cine-eyebrow">PUSAT INFORMASI PESERTA</div><h1>Siapkan dirimu.<br><em>Mulai aksimu.</em></h1><p>Temukan semua panduan yang dibutuhkan untuk mengikuti rangkaian PKKMB Universitas Narotama 2026.</p></div>
            <div class="cine-page-number">01<span>/04</span></div>
        </div>
    </section>

    <nav class="cine-tabs" aria-label="Daftar informasi"><div class="cine-container cine-tabs-inner"><a href="#pengenalan"><span>01</span>Pengenalan</a><a href="#pedoman"><span>02</span>Pedoman</a><a href="#seragam"><span>03</span>Seragam</a><a href="#panitia"><span>04</span>Panitia</a></div></nav>

    <section class="cine-detail" id="pengenalan">
        <div class="cine-container cine-detail-grid">
            <div><span class="cine-detail-index">01</span><div class="cine-kicker">PENGENALAN PKKMB</div><h2>Babak pembuka<br>perjalananmu.</h2></div>
            <div><p class="cine-detail-lead">PKKMB adalah ruang pertama untuk mengenal kehidupan kampus, budaya akademik, lingkungan universitas, dan teman-teman seperjuangan.</p><div class="cine-feature-row"><div><b>Kenali Kampus</b><p>Mengenal fakultas, layanan mahasiswa, fasilitas, dan sistem akademik.</p></div><div><b>Bangun Relasi</b><p>Bertemu mahasiswa baru lintas program studi dan para pendamping.</p></div><div><b>Mulai Berkarya</b><p>Menumbuhkan semangat kolaborasi, kepemimpinan, dan dampak nyata.</p></div></div></div>
        </div>
    </section>

    <section class="cine-detail alt" id="pedoman">
        <div class="cine-container cine-detail-grid">
            <div><span class="cine-detail-index yellow">02</span><div class="cine-kicker">PEDOMAN PESERTA</div><h2>Datang siap.<br>Pulang berkesan.</h2></div>
            <div class="cine-doc"><iframe src="{{ asset('/src/document/buku_pedoman_pkkmb2023.pdf') }}" title="Buku Pedoman PKKMB"></iframe><div class="cine-doc-action"><span><small>DOKUMEN PESERTA</small><b>Buku Pedoman PKKMB</b></span><a href="{{ asset('/src/document/buku_pedoman_pkkmb2023.pdf') }}" download class="cine-button cine-button-dark">Unduh PDF <b>↓</b></a></div></div>
        </div>
    </section>

    <section class="cine-detail" id="seragam">
        <div class="cine-container cine-detail-grid">
            <div><span class="cine-detail-index coral">03</span><div class="cine-kicker">KETENTUAN SERAGAM</div><h2>Rapi, nyaman,<br>dan siap beraksi.</h2></div>
            <div class="cine-doc"><iframe src="{{ asset('/src/document/seragam_peserta_pkkm2023.pdf') }}" title="Ketentuan Seragam PKKMB"></iframe><div class="cine-doc-action"><span><small>DOKUMEN PESERTA</small><b>Ketentuan Seragam PKKMB</b></span><a href="{{ asset('/src/document/seragam_peserta_pkkm2023.pdf') }}" download class="cine-button cine-button-dark">Unduh PDF <b>↓</b></a></div></div>
        </div>
    </section>

    <section class="cine-detail cine-team-section" id="panitia">
        <div class="cine-container">
            <div class="cine-team-head"><div><span class="cine-detail-index mint">04</span><div class="cine-kicker">KENALI PANITIA</div><h2>Teman pertama<br>di langkah barumu.</h2></div><p>Panitia dan pendamping siap membantu agar pengalaman PKKMB-mu berjalan aman, nyaman, dan menyenangkan.</p></div>
            <div class="cine-poster-grid">
                <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                    <img src="{{ asset('img/panitia/divisi-nardam.jpg') }}" alt="Divisi Naradamping">
                </a>
                <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                    <img src="{{ asset('img/panitia/divisi-humas.jpg') }}" alt="Divisi Hubungan Masyarakat">
                </a>
                <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                    <img src="{{ asset('img/panitia/divisi-perkap.jpg') }}" alt="Divisi Perlengkapan">
                </a>
            </div>
            <div class="cine-team-actions">
                <a href="{{ route('informasi-panitia') }}" class="cine-button cine-button-primary">
                    Lihat Semua Susunan Panitia <b>→</b>
                </a>
            </div>
        </div>
    </section>

    <section class="cine-cta"><div class="cine-container cine-cta-inner"><div><small>LANGKAH SELANJUTNYA</small><h2>Sudah membaca semua panduan?</h2></div>@auth<a href="{{ route('home-presences.indexuserdashboard') }}" class="cine-button cine-button-dark">Buka Dashboard <b>→</b></a>@else<a href="{{ route('auth.login') }}" class="cine-button cine-button-dark">Login Peserta <b>→</b></a>@endauth</div></section>
</main>
@endsection
