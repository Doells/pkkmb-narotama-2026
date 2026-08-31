@extends('layouts.landing.base')

@section('content')
<main>
    <section class="cine-page-hero" style="position: relative;">
        <div class="cine-container cine-page-hero-inner" style="position: relative;">
            <div style="position: relative; z-index: 10;">
                <div class="cine-eyebrow">PUSAT INFORMASI PESERTA</div>
                <h1>Siapkan dirimu.<br><em>Mulai aksimu.</em></h1>
                <p>Temukan semua panduan yang dibutuhkan untuk mengikuti rangkaian PKKMB Universitas Narotama 2026.</p>
            </div>
            
            <!-- 3D Popcorn Asset, absolutely positioned to not break the grid -->
            <div style="position: absolute; right: 5%; top: 50%; transform: translateY(-50%); pointer-events: none; mix-blend-mode: screen;">
                <img src="{{ asset('img/mascot/popcorn-3d.jpg') }}" alt="Popcorn 3D" style="max-height: 280px; mix-blend-mode: screen;" />
            </div>


        </div>
    </section>

    <nav class="cine-tabs" aria-label="Daftar informasi"><div class="cine-container cine-tabs-inner"><a href="#pengenalan"><span>01</span>Pengenalan</a><a href="#pedoman"><span>02</span>Pedoman</a><a href="#seragam"><span>03</span>Seragam</a><a href="#panitia"><span>04</span>Panitia</a><a href="#kegiatan"><span>05</span>Kegiatan</a></div></nav>

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
            <div class="cine-marquee-container">
                <div class="cine-marquee-track">
                    <!-- Set 1 -->
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/divisi-nardam.jpg') }}" alt="Divisi Naradamping">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/divisi-humas.jpg') }}" alt="Divisi Hubungan Masyarakat">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/divisi-perkap.jpg') }}" alt="Divisi Perlengkapan">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_logistik.jpg') }}" alt="Divisi Logistik dan Kesehatan">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_ketua.jpg') }}" alt="Divisi Kesekretariatan">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_pengarah.jpg') }}" alt="Divisi Panitia Pengarah">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_acara.jpg') }}" alt="Divisi Acara dan Kreatif">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_dkats.jpg') }}" alt="Divisi Pendamping Karakter">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_kreatif.jpg') }}" alt="Divisi Kreatif">
                    </a>
                    
                    <!-- Set 2 (Duplicate for infinite seamless loop) -->
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/divisi-nardam.jpg') }}" alt="Divisi Naradamping">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/divisi-humas.jpg') }}" alt="Divisi Hubungan Masyarakat">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/divisi-perkap.jpg') }}" alt="Divisi Perlengkapan">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_logistik.jpg') }}" alt="Divisi Logistik dan Kesehatan">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_ketua.jpg') }}" alt="Divisi Kesekretariatan">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_pengarah.jpg') }}" alt="Divisi Panitia Pengarah">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_acara.jpg') }}" alt="Divisi Acara dan Kreatif">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_dkats.jpg') }}" alt="Divisi Pendamping Karakter">
                    </a>
                    <a href="{{ route('informasi-panitia') }}" class="cine-poster">
                        <img src="{{ asset('img/panitia/poster_kreatif.jpg') }}" alt="Divisi Kreatif">
                    </a>
                </div>
            </div>
            <div class="cine-team-actions">
                <a href="{{ route('informasi-panitia') }}" class="cine-button cine-button-primary">
                    Lihat Semua Susunan Panitia <b>→</b>
                </a>
            </div>
        </div>
    </section>

    <section class="cine-detail" id="kegiatan" style="background: #000; color: #fff;">
        <div class="cine-container">
            <div class="cine-team-head" style="margin-bottom: 40px; text-align: left;">
                <div><span class="cine-detail-index" style="color: #fff; border-color: rgba(255,255,255,0.3);">05</span><div class="cine-kicker">KEGIATAN & TIMELINE</div><h2>Dokumentasi <br><em>Garda Depan.</em></h2></div>
                <p style="color: #aaa; max-width: 550px; line-height: 1.8; font-size: 15px;">Saksikan seluruh rangkaian perjalanan dari awal persiapan hingga momen puncak penutupan. Pantau jadwal pergerakan secara terperinci (timeline) dan temukan rekam jejak langkah mahasiswa baru dalam menghadapi tantangan, merajut kolaborasi, hingga mengukir memori tak terlupakan bersama keluarga besar Garda Depan 2026.</p>
            </div>
            
            <!-- Cinematic Film Strip Model -->
            <div style="background: #111; padding: 40px 20px; border-radius: 12px; position: relative; display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 30px; justify-content: center; align-items: center; box-shadow: inset 0 0 50px rgba(0,0,0,0.8);">
                
                <!-- Film Holes top and bottom -->
                <div style="position: absolute; top: 10px; left: 10px; right: 10px; height: 15px; background: repeating-linear-gradient(to right, transparent, transparent 15px, rgba(255,255,255,0.8) 15px, rgba(255,255,255,0.8) 25px); opacity: 0.1;"></div>
                <div style="position: absolute; bottom: 10px; left: 10px; right: 10px; height: 15px; background: repeating-linear-gradient(to right, transparent, transparent 15px, rgba(255,255,255,0.8) 15px, rgba(255,255,255,0.8) 25px); opacity: 0.1;"></div>

                <!-- Poster 1 (Gambar 2 - TM) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatantm.png') }}" alt="Technical Meeting Placeholder" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2);">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);">
                        <span style="color: #e50914; font-weight: bold; font-family: monospace; font-size: 13px; letter-spacing: 3px;">TM 01</span>
                    </div>
                </div>

                <!-- Poster 2 (Gambar 3 - Pra PKKMB) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanprapkkmb.png') }}" alt="Pra PKKMB Placeholder" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2);">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">PRA TAKE 02</span>
                    </div>
                </div>
                
                <!-- Poster 3 (Gambar 4 - Day 1) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanpkkmbday1.png') }}" alt="PKKMB Day 1 Placeholder" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2);">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">DAY 1 SCENE</span>
                    </div>
                </div>

                <!-- Poster 4 (Gambar 5 - Day 2) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanpkkmbday2.png') }}" alt="PKKMB Day 2 Placeholder" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2);">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">DAY 2 FINAL</span>
                    </div>
                </div>

                <!-- Poster 5 (Day 3) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanpkkmbday3.png') }}" alt="PKKMB Day 3 Placeholder" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2);">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">DAY 3 THRILLER</span>
                    </div>
                </div>

                <!-- Poster 6 (Day 4) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanpkkmbday4.png') }}" alt="PKKMB Day 4 Placeholder" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2);">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">DAY 4 EPILOGUE</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="cine-partners" style="display: flex; justify-content: center; margin-bottom: 60px; margin-top: 10px; padding: 0 20px;">
        <div style="background: #fff; padding: 25px 60px; border-radius: 100px; display: flex; gap: 50px; align-items: center; box-shadow: 0 15px 40px rgba(0,0,0,0.15); flex-wrap: wrap; justify-content: center;">
            <img src="{{ asset('img/logo/tutwuri.png') }}" alt="Tut Wuri Handayani" style="height: 70px; object-fit: contain;">
            <img src="{{ asset('img/logo/diktisaintek.png') }}" alt="Diktisaintek Berdampak" style="height: 70px; object-fit: contain;">
            <img src="{{ asset('img/logo/narotama.png') }}" alt="Universitas Narotama" style="height: 70px; object-fit: contain;">
            <img src="{{ asset('img/logo/kemahasiswaan.png') }}" alt="Kemahasiswaan" style="height: 60px; object-fit: contain;">
            <img src="{{ asset('img/logo/pkkmb.png') }}" alt="PKKMB Narotama" style="height: 85px; object-fit: contain;">
        </div>
    </section>

    <section class="cine-cta"><div class="cine-container cine-cta-inner"><div><small>LANGKAH SELANJUTNYA</small><h2>Sudah membaca semua panduan?</h2></div>@auth<a href="{{ route('home-presences.indexuserdashboard') }}" class="cine-button cine-button-dark">Buka Dashboard <b>→</b></a>@else<a href="{{ route('auth.login') }}" class="cine-button cine-button-dark">Login Peserta <b>→</b></a>@endauth</div></section>
</main>
@endsection
