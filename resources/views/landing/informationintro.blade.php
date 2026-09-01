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
                <div><span class="cine-detail-index" style="color: #fff; border-color: rgba(255,255,255,0.3);">05</span><div class="cine-kicker">KEGIATAN & TIMELINE</div><h2>Kegiatan <br><em>Garda Depan.</em></h2></div>
                <p style="color: #aaa; max-width: 550px; line-height: 1.8; font-size: 15px;">Saksikan seluruh rangkaian perjalanan dari awal persiapan hingga momen puncak penutupan. Pantau jadwal pergerakan secara terperinci (timeline) dan temukan rekam jejak langkah mahasiswa baru dalam menghadapi tantangan, merajut kolaborasi, hingga mengukir memori tak terlupakan bersama keluarga besar Garda Depan 2026.</p>
            </div>
            
            <!-- Cinematic Film Strip Model -->
            <div style="background: #111; padding: 40px 20px; border-radius: 12px; position: relative; display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 30px; justify-content: center; align-items: center; box-shadow: inset 0 0 50px rgba(0,0,0,0.8);">
                
                <!-- Film Holes top and bottom -->
                <div style="position: absolute; top: 10px; left: 10px; right: 10px; height: 15px; background: repeating-linear-gradient(to right, transparent, transparent 15px, rgba(255,255,255,0.8) 15px, rgba(255,255,255,0.8) 25px); opacity: 0.1;"></div>
                <div style="position: absolute; bottom: 10px; left: 10px; right: 10px; height: 15px; background: repeating-linear-gradient(to right, transparent, transparent 15px, rgba(255,255,255,0.8) 15px, rgba(255,255,255,0.8) 25px); opacity: 0.1;"></div>

                <!-- Poster 1 (Gambar 2 - TM) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatantm.png') }}" alt="Technical Meeting Placeholder" class="cine-zoomable" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2); cursor: zoom-in; transition: transform 0.3s ease;">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); pointer-events: none;">
                        <span style="color: #e50914; font-weight: bold; font-family: monospace; font-size: 13px; letter-spacing: 3px;">TM 01</span>
                    </div>
                </div>

                <!-- Poster 2 (Gambar 3 - Pra PKKMB) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanprapkkmb.png') }}" alt="Pra PKKMB Placeholder" class="cine-zoomable" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2); cursor: zoom-in; transition: transform 0.3s ease;">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); pointer-events: none;">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">PRA TAKE 02</span>
                    </div>
                </div>
                
                <!-- Poster 3 (Gambar 4 - Day 1) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanpkkmbday1.png') }}" alt="PKKMB Day 1 Placeholder" class="cine-zoomable" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2); cursor: zoom-in; transition: transform 0.3s ease;">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); pointer-events: none;">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">DAY 1 SCENE</span>
                    </div>
                </div>

                <!-- Poster 4 (Gambar 5 - Day 2) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanpkkmbday2.png') }}" alt="PKKMB Day 2 Placeholder" class="cine-zoomable" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2); cursor: zoom-in; transition: transform 0.3s ease;">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); pointer-events: none;">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">DAY 2 FINAL</span>
                    </div>
                </div>

                <!-- Poster 5 (Day 3) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanpkkmbday3.png') }}" alt="PKKMB Day 3 Placeholder" class="cine-zoomable" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2); cursor: zoom-in; transition: transform 0.3s ease;">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); pointer-events: none;">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">DAY 3 THRILLER</span>
                    </div>
                </div>

                <!-- Poster 6 (Day 4) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanpkkmbday4.png') }}" alt="PKKMB Day 4 Placeholder" class="cine-zoomable" style="width: 100%; height: auto; display: block; filter: contrast(1.1) saturate(1.2); cursor: zoom-in; transition: transform 0.3s ease;">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); pointer-events: none;">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">DAY 4 EPILOGUE</span>
                    </div>
                </div>

{{--
                <!-- Poster 8 (Webinar 1) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanwebinar1.jpg') }}" alt="Webinar Nasional AHY" class="cine-zoomable" style="width: 100%; height: auto; display: block; filter: contrast(1.05) saturate(1.1); cursor: zoom-in; transition: transform 0.3s ease;">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); pointer-events: none;">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">WEBINAR NASIONAL I</span>
                    </div>
                </div>

                <!-- Poster 9 (Webinar 2) -->
                <div style="position: relative; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,1);">
                    <img src="{{ asset('img/panitia/kegiatanwebinar2.jpg') }}" alt="Webinar Nasional Astronacci" class="cine-zoomable" style="width: 100%; height: auto; display: block; filter: contrast(1.05) saturate(1.1); cursor: zoom-in; transition: transform 0.3s ease;">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px 20px 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); pointer-events: none;">
                        <span style="color: rgba(255,255,255,0.7); font-family: monospace; font-size: 13px; letter-spacing: 3px;">WEBINAR NASIONAL II</span>
                    </div>
                </div>
--}}
            </div>
        </div>

        <!-- Lightbox Modal -->
        <div id="imageLightbox" style="display: none; position: fixed; z-index: 10000; padding: 40px; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.95); cursor: zoom-out; backdrop-filter: blur(8px); align-items: center; justify-content: center;" onclick="if(event.target === this || event.target.id === 'lightboxContent') this.style.display='none'">
            <span style="position: absolute; top: 20px; right: 40px; color: #fff; font-size: 50px; font-weight: bold; cursor: pointer; transition: 0.3s; z-index: 10001;" onclick="document.getElementById('imageLightbox').style.display='none'" onmouseover="this.style.color='#f00'" onmouseout="this.style.color='#fff'">&times;</span>
            
            <div id="lightboxContent" style="display: flex; gap: 40px; max-width: 90vw; border-radius: 12px; cursor: default; animation: zoomIn 0.3s ease; flex-wrap: wrap; justify-content: center; align-items: flex-start;">
                <img id="lightboxImage" style="max-height: 85vh; max-width: 100%; object-fit: contain; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.8);">
                
                <div id="lightboxSchedule" style="display: none; background: #1a1a1a; padding: 30px; border-radius: 12px; color: #fff; text-align: left; max-width: 550px; flex: 1 1 350px; overflow-y: auto; max-height: 85vh; box-shadow: 0 10px 40px rgba(0,0,0,0.8); cursor: auto;">
                    <!-- Schedule Injected by JS -->
                </div>
            </div>
        </div>

        <style>
            @keyframes zoomIn {
                from {transform: scale(0.9); opacity: 0;}
                to {transform: scale(1); opacity: 1;}
            }
            .cine-zoomable:hover {
                transform: scale(1.03);
            }
            @media (max-width: 768px) {
                #imageLightbox {
                    padding: 15px !important;
                }
                #lightboxContent {
                    gap: 15px !important;
                }
                #lightboxImage {
                    max-height: 40vh !important;
                }
                #lightboxSchedule {
                    padding: 15px !important;
                    max-height: 45vh !important;
                    box-sizing: border-box !important;
                    width: 100% !important;
                    border-radius: 8px !important;
                    font-size: 13px !important;
                }
                #lightboxSchedule h3 {
                    font-size: 16px !important;
                }
                #imageLightbox > span {
                    top: 10px !important;
                    right: 20px !important;
                    font-size: 40px !important;
                }
            }
        </style>
        <script>
            const scheduleTM = `
                <h3 style="margin-top: 0; border-bottom: 2px solid #e50914; padding-bottom: 10px; margin-bottom: 20px; font-size: 20px; font-weight: bold; font-family: sans-serif;">Jadwal Technical Meeting (01 September 2026)</h3>
                <table style="width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 13.5px; line-height: 1.5;">
                    <thead>
                        <tr style="border-bottom: 2px solid #555;"><th style="text-align:left; padding-bottom:10px; color: #fff;">Waktu</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Acara</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Tempat</th></tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top; width: 100px;">08.00–09.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Registrasi</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">09.00–09.05</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Opening Ceremony</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">09.05–09.15</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Indonesia Raya & Mars Narotama</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">09.15–09.20</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Doa</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">09.20–09.25</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sambutan Ketua Pelaksana</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">09.25–09.55</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Presentasi Naradamping</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">09.55–10.25</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Pembagian Kelompok</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">10.25–10.55</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Perkenalan & Closing</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">10.55–11.10</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Menuju Kelas</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">11.10–11.40</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Ishoma</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrahman</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">11.40–13.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Penggawa Time</td><td style="padding: 10px 0; color: #bbb;">Kelas Masing-Masing Penggawa</td></tr>
                        <tr><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">13.00–13.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Clear Area</td><td style="padding: 10px 0; color: #bbb;">Universitas Narotama</td></tr>
                    </tbody>
                </table>
            `;
            
            const schedulePraPKKMB = `
                <h3 style="margin-top: 0; border-bottom: 2px solid #e50914; padding-bottom: 10px; margin-bottom: 20px; font-size: 20px; font-weight: bold; font-family: sans-serif;">Jadwal Pra-PKKMB</h3>
                
                <h4 style="color: #e50914; font-size: 15px; margin: 0 0 10px 0;">HARI KE-1 (07 September 2026)</h4>
                <table style="width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 13.5px; line-height: 1.5; margin-bottom: 30px;">
                    <thead>
                        <tr style="border-bottom: 2px solid #555;"><th style="text-align:left; padding-bottom:5px; color: #fff;">Waktu</th><th style="text-align:left; padding-bottom:5px; color: #fff;">Acara</th><th style="text-align:left; padding-bottom:5px; color: #fff;">Tempat</th></tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top; width: 100px;">08.00–08.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Kedatangan</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.30–11.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Campus Tour</td><td style="padding: 10px 0; color: #bbb;">Universitas Narotama</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">11.30–12.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Ishoma</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrahman</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">12.30–13.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Quality Time</td><td style="padding: 10px 0; color: #bbb;">Kelas F3.04, F3.01, E2.01, E2.04</td></tr>
                        <tr><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">13.30–14.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Clear Area</td><td style="padding: 10px 0; color: #bbb;">Universitas Narotama</td></tr>
                    </tbody>
                </table>

                <h4 style="color: #e50914; font-size: 15px; margin: 0 0 10px 0;">HARI KE-2 (08 September 2026)</h4>
                <table style="width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 13.5px; line-height: 1.5; margin-bottom: 30px;">
                    <thead>
                        <tr style="border-bottom: 2px solid #555;"><th style="text-align:left; padding-bottom:5px; color: #fff;">Waktu</th><th style="text-align:left; padding-bottom:5px; color: #fff;">Acara</th><th style="text-align:left; padding-bottom:5px; color: #fff;">Tempat</th></tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top; width: 100px;">08.00–08.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Kedatangan</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.30–11.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Quality Time</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">11.30–12.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Ishoma</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrahman</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">12.30–13.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Quality Time</td><td style="padding: 10px 0; color: #bbb;">Kelas Penggawa</td></tr>
                        <tr><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">13.30–14.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Clear Area</td><td style="padding: 10px 0; color: #bbb;">Universitas Narotama</td></tr>
                    </tbody>
                </table>

                <h4 style="color: #e50914; font-size: 15px; margin: 0 0 10px 0;">HARI KE-3 (09 September 2026)</h4>
                <table style="width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 13.5px; line-height: 1.5; margin-bottom: 30px;">
                    <thead>
                        <tr style="border-bottom: 2px solid #555;"><th style="text-align:left; padding-bottom:5px; color: #fff;">Waktu</th><th style="text-align:left; padding-bottom:5px; color: #fff;">Acara</th><th style="text-align:left; padding-bottom:5px; color: #fff;">Tempat</th></tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top; width: 100px;">08.00–08.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Kedatangan</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.30–11.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Quality Time</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">11.30–12.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Ishoma</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrahman</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">12.30–13.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Quality Time</td><td style="padding: 10px 0; color: #bbb;">Kelas Penggawa</td></tr>
                        <tr><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">13.30–14.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Clear Area</td><td style="padding: 10px 0; color: #bbb;">Universitas Narotama</td></tr>
                    </tbody>
                </table>

                <h4 style="color: #e50914; font-size: 15px; margin: 0 0 10px 0;">HARI KE-4 (10 September 2026)</h4>
                <table style="width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 13.5px; line-height: 1.5; margin-bottom: 10px;">
                    <thead>
                        <tr style="border-bottom: 2px solid #555;"><th style="text-align:left; padding-bottom:5px; color: #fff;">Waktu</th><th style="text-align:left; padding-bottom:5px; color: #fff;">Acara</th><th style="text-align:left; padding-bottom:5px; color: #fff;">Tempat</th></tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top; width: 100px;">08.00–08.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Kedatangan</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.30–11.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Social Project</td><td style="padding: 10px 0; color: #bbb;">Lokasi Sospro</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">11.30–12.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Ishoma</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrahman</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">12.30–13.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Quality Time</td><td style="padding: 10px 0; color: #bbb;">Kelas Penggawa</td></tr>
                        <tr><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">13.30–14.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Clear Area</td><td style="padding: 10px 0; color: #bbb;">Universitas Narotama</td></tr>
                    </tbody>
                </table>
            `;
            
            const scheduleDay1 = `
                <h3 style="margin-top: 0; border-bottom: 2px solid #e50914; padding-bottom: 10px; margin-bottom: 20px; font-size: 20px; font-weight: bold; font-family: sans-serif;">PKKMB Hari Ke-1 &mdash; 14 September 2026</h3>
                <table style="width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 13.5px; line-height: 1.5;">
                    <thead>
                        <tr style="border-bottom: 2px solid #555;"><th style="text-align:left; padding-bottom:10px; color: #fff;">Waktu</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Acara</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Pemateri</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Tempat</th></tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top; width: 90px;">06.00–06.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Registrasi Peserta</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">06.30–07.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Inspeksi Naradamping</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">07.00–08.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Penggawa Time</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.00–08.20</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Loading Peserta</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.20–08.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Pre Test PKKMB</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.30–09.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Ice Breaking</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">09.30–11.35</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Opening & Pembukaan PKKMB</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">11.40–12.10</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">ISHOMA</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrachmah</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">12.10–13.10</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sistem Pendidikan Tinggi di Indonesia</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Dr. Moh. Saleh, S.H., M.H.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">13.10–14.10</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Kenarotamaan & Jiwa Pro Patria</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Dr. Miftakhul Huda, S.H., M.H.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">14.10–15.10</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Karakter, Integritas & Pencegahan Kekerasan</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Dr. Nynda Fatmawati Octa Rina, S.H., M.H., M.Kn.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">15.10–15.40</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">ISHOMA</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrachmah</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">15.40–16.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sosialisasi Keuangan</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Miftahul Rachman, S.M., M.M.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">16.00–16.15</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sosialisasi LSP</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Varia Virdinia Virdaus, S.Hum., M.A.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">16.15–16.20</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Penutupan PKKMB Hari Pertama</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">16.20–16.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Presensi Peserta</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">16.30–17.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Kepulangan Peserta</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Universitas Narotama</td></tr>
                    </tbody>
                </table>
            `;

            const scheduleDay2 = `
                <h3 style="margin-top: 0; border-bottom: 2px solid #e50914; padding-bottom: 10px; margin-bottom: 20px; font-size: 20px; font-weight: bold; font-family: sans-serif;">PKKMB Hari Ke-2 &mdash; 15 September 2026</h3>
                <table style="width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 13.5px; line-height: 1.5;">
                    <thead>
                        <tr style="border-bottom: 2px solid #555;"><th style="text-align:left; padding-bottom:10px; color: #fff;">Waktu</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Acara</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Koordinator</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Tempat</th></tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top; width: 90px;">08.00–08.05</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Opening Ceremony</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.05–09.05</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Kampus Berdampak</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Dr. Ir. Adi Prawito, M.M., M.T., IPM.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">09.05–09.25</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sosialisasi LPPM</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Made Kamisutara, S.T., M.Kom.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">09.25–09.45</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sosialisasi UPT Bahasa & Kerja Sama LN</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Ani Wulandari, S.S., M.M.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">09.45–10.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Persiapan Webinar</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">10.00–11.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Webinar: Pancasila & Bela Negara</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Dr. H. Agus Harimurti Yudhoyono, M.Sc., M.P.A., M.A.</td><td style="padding: 10px 0; color: #bbb;">Zoom Meeting</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">11.30–12.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">ISHOMA</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrachmah</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">12.00–13.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Webinar: Teknologi & AI</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Asst. Prof. Dr. Gema Goeyardi, CAT, CFTe, MFTA, MCFI, ATP</td><td style="padding: 10px 0; color: #bbb;">Zoom Meeting</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">13.30–13.40</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Loading Peserta</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">13.40–13.45</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Ice Breaking</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">13.45–14.45</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">LPDP & Peluang Pendidikan</td><td style="padding: 10px 10px 10px 0; color: #bbb;">LPDP</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">14.45–15.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">ISHOMA</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrachmah</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">15.00–15.15</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sosialisasi Kiwoom Sekuritas</td><td style="padding: 10px 10px 10px 0; color: #bbb;">PT. Kiwoom Sekuritas Indonesia</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">15.15–15.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sosialisasi Perpustakaan</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Rizky Tri Mayasari, S.IIP.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">15.30–15.45</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sosialisasi BRAR</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Asep Kurniawan, S.M., M.M.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">15.45–16.05</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sosialisasi Pemasaran</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Lutfi Putra Hakim Maulidin, S.Kom.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">16.05–16.20</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sosialisasi DKATS</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Amalia Prastika Sari, S.Pd.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">16.20–16.40</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sosialisasi BUSPRO</td><td style="padding: 10px 10px 10px 0; color: #bbb;">Wahyugara Damarjati, S.E., M.M.</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">16.40–16.45</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Closing Ceremony</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">16.45–17.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Presensi</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">17.00–17.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Clear Area</td><td style="padding: 10px 10px 10px 0; color: #bbb;">&mdash;</td><td style="padding: 10px 0; color: #bbb;">Universitas Narotama</td></tr>
                    </tbody>
                </table>
            `;

            const scheduleDay3 = `
                <h3 style="margin-top: 0; border-bottom: 2px solid #e50914; padding-bottom: 10px; margin-bottom: 20px; font-size: 20px; font-weight: bold; font-family: sans-serif;">PKKMB Hari Ke-3 &mdash; 16 September 2026</h3>
                <table style="width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 13.5px; line-height: 1.5;">
                    <thead>
                        <tr style="border-bottom: 2px solid #555;"><th style="text-align:left; padding-bottom:10px; color: #fff;">Waktu</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Acara</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Tempat</th></tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top; width: 100px;">06.00–06.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Registrasi Peserta</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">06.30–07.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Inspeksi Naradamping</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">07.00–07.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Ice Breaking</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">07.30–08.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Perkenalan Panitia Fakultas</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.00–08.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Loading Peserta</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.30–12.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sesi Fakultas</td><td style="padding: 10px 0; color: #bbb;">Ruangan Fakultas</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">12.00–12.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">ISHOMA</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrachmah</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">12.30–15.40</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sesi Fakultas</td><td style="padding: 10px 0; color: #bbb;">Ruangan Fakultas</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">15.40–16.10</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">ISHOMA</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrachmah</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">16.10–16.25</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Presensi Peserta</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">16.25–16.40</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Clear Area</td><td style="padding: 10px 0; color: #bbb;">Universitas Narotama</td></tr>
                    </tbody>
                </table>
            `;

            const scheduleDay4 = `
                <h3 style="margin-top: 0; border-bottom: 2px solid #e50914; padding-bottom: 10px; margin-bottom: 20px; font-size: 20px; font-weight: bold; font-family: sans-serif;">PKKMB Hari Ke-4 &mdash; 17 September 2026</h3>
                <table style="width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 13.5px; line-height: 1.5;">
                    <thead>
                        <tr style="border-bottom: 2px solid #555;"><th style="text-align:left; padding-bottom:10px; color: #fff;">Waktu</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Acara</th><th style="text-align:left; padding-bottom:10px; color: #fff;">Tempat</th></tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top; width: 100px;">06.00–06.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Registrasi Peserta</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">06.30–07.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Inspeksi Naradamping</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">07.00–08.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Senam Pagi</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.00–08.15</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Loading Peserta</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">08.15–12.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sesi Fakultas</td><td style="padding: 10px 0; color: #bbb;">Ruangan Fakultas</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">12.00–12.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">ISHOMA</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrachmah</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">12.30–14.50</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Sesi Fakultas</td><td style="padding: 10px 0; color: #bbb;">Ruangan Fakultas</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">14.50–15.20</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">ISHOMA</td><td style="padding: 10px 0; color: #bbb;">Masjid Baiturrachmah</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">15.20–17.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Perkenalan BEM & UKM</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">17.00–17.10</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Post Test</td><td style="padding: 10px 0; color: #bbb;">Conference Hall Lt. 2</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">17.10–18.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Persiapan Ekshibisi</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">18.30–21.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Ekshibisi</td><td style="padding: 10px 0; color: #bbb;">Selasar Gedung E & F</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">21.30–22.00</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Pembagian Sertifikat</td><td style="padding: 10px 0; color: #bbb;">Ruangan Fakultas</td></tr>
                        <tr style="border-bottom: 1px solid #333;"><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">22.00–22.15</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Kepulangan Peserta</td><td style="padding: 10px 0; color: #bbb;">Universitas Narotama</td></tr>
                        <tr><td style="padding: 10px 10px 10px 0; color: #aaa; vertical-align: top;">22.15–22.30</td><td style="padding: 10px 10px 10px 0; font-weight: 500;">Clear Area</td><td style="padding: 10px 0; color: #bbb;">Universitas Narotama</td></tr>
                    </tbody>
                </table>
            `;

            const infoWebnas1 = `
                <h3 style="margin-top: 0; border-bottom: 2px solid #e50914; padding-bottom: 10px; margin-bottom: 20px; font-size: 20px; font-weight: bold; font-family: sans-serif;">Pancasila & Bela Negara (Webnas 1)</h3>
                
                <div style="font-family: sans-serif; font-size: 13.5px; line-height: 1.6; color: #bbb;">
                    <p style="margin: 0 0 15px 0;">
                        <strong style="color: #fff;">Tema:</strong><br>
                        Garda Depan Negeri: Pancasila, Kebhinekaan, Jati Diri, dan Bela Negara di Masa Kini
                    </p>
                    
                    <p style="margin: 0 0 15px 0;">
                        <strong style="color: #fff;">Pemateri:</strong><br>
                        Dr. H. Agus Harimurti Yudhoyono, M.Sc., M.P.A., M.A.
                    </p>
                    
                    <div style="display: flex; gap: 20px; margin: 0 0 15px 0;">
                        <div>
                            <strong style="color: #fff;">Tempat:</strong><br>
                            Zoom Meeting
                        </div>
                        <div>
                            <strong style="color: #fff;">Tanggal:</strong><br>
                            15 September 2026
                        </div>
                    </div>
                
                    <p style="margin: 0 0 10px 0;">
                        <strong style="color: #fff;">Deskripsi Singkat:</strong><br>
                        Membahas pentingnya Pancasila, kebhinekaan, jati diri, dan bela negara bagi mahasiswa dalam menghadapi perkembangan teknologi, globalisasi, dan perubahan sosial. Mahasiswa diajak menjaga persatuan, menaati aturan, melestarikan budaya, berprestasi, serta memberikan kontribusi positif bagi masyarakat.
                    </p>
                </div>
            `;

            const infoWebnas2 = `
                <h3 style="margin-top: 0; border-bottom: 2px solid #e50914; padding-bottom: 10px; margin-bottom: 20px; font-size: 20px; font-weight: bold; font-family: sans-serif;">Teknologi & AI (Webnas 2)</h3>
                
                <div style="font-family: sans-serif; font-size: 13.5px; line-height: 1.6; color: #bbb;">
                    <p style="margin: 0 0 15px 0;">
                        <strong style="color: #fff;">Tema:</strong><br>
                        Di Balik Layar AI: Mengenal Teknologi yang Mengubah Cara Kita Berkarya
                    </p>
                    
                    <p style="margin: 0 0 15px 0;">
                        <strong style="color: #fff;">Pemateri:</strong><br>
                        Asst. Prof. Dr. Gema Goeyardi, CAT, CFTe, MFTA, MCFI, ATP
                    </p>
                    
                    <div style="display: flex; gap: 20px; margin: 0 0 15px 0;">
                        <div>
                            <strong style="color: #fff;">Tempat:</strong><br>
                            Zoom Meeting
                        </div>
                        <div>
                            <strong style="color: #fff;">Tanggal:</strong><br>
                            15 September 2026
                        </div>
                    </div>
                
                    <p style="margin: 0 0 10px 0;">
                        <strong style="color: #fff;">Deskripsi Singkat:</strong><br>
                        Mengenal konsep dasar AI, pemanfaatannya dalam menghasilkan karya, serta peluangnya di dunia akademik dan profesional. Peserta juga diajak menggunakan AI secara kritis, kreatif, dan bertanggung jawab dengan tetap memperhatikan etika dan orisinalitas.
                    </p>
                </div>
            `;

            document.querySelectorAll('.cine-zoomable').forEach(img => {
                img.addEventListener('click', function() {
                    const lightbox = document.getElementById('imageLightbox');
                    const lightboxImg = document.getElementById('lightboxImage');
                    const lightboxSchedule = document.getElementById('lightboxSchedule');
                    
                    lightbox.style.display = 'flex';
                    lightboxImg.src = this.src;
                    
                    // Reset styling container back to default
                    lightboxSchedule.style.maxWidth = '550px';

                    if (this.src.includes('kegiatantm.png')) {
                        lightboxSchedule.style.display = 'block';
                        lightboxSchedule.innerHTML = scheduleTM;
                        lightboxImg.style.maxWidth = '500px'; 
                    } else if(this.src.includes('kegiatanprapkkmb.png')) {
                        lightboxSchedule.style.display = 'block';
                        lightboxSchedule.innerHTML = schedulePraPKKMB;
                        lightboxImg.style.maxWidth = '500px'; 
                    } else if(this.src.includes('kegiatanpkkmbday1.png')) {
                        lightboxSchedule.style.display = 'block';
                        lightboxSchedule.innerHTML = scheduleDay1;
                        lightboxSchedule.style.maxWidth = '650px'; // Give more space for 4 columns
                        lightboxImg.style.maxWidth = '400px'; // Shrink the image relatively
                    } else if(this.src.includes('kegiatanpkkmbday2.png')) {
                        lightboxSchedule.style.display = 'block';
                        lightboxSchedule.innerHTML = scheduleDay2;
                        lightboxSchedule.style.maxWidth = '650px'; // Give more space for 4 columns
                        lightboxImg.style.maxWidth = '400px'; 
                    } else if(this.src.includes('kegiatanpkkmbday3.png')) {
                        lightboxSchedule.style.display = 'block';
                        lightboxSchedule.innerHTML = scheduleDay3;
                        lightboxImg.style.maxWidth = '500px'; 
                    } else if(this.src.includes('kegiatanpkkmbday4.png')) {
                        lightboxSchedule.style.display = 'block';
                        lightboxSchedule.innerHTML = scheduleDay4;
                        lightboxImg.style.maxWidth = '500px'; 
                    } else if(this.src.includes('kegiatanwebinar1.jpg')) {
                        lightboxSchedule.style.display = 'block';
                        lightboxSchedule.innerHTML = infoWebnas1;
                        lightboxImg.style.maxWidth = '400px'; // make the poster a bit smaller to match text size natively
                    } else if(this.src.includes('kegiatanwebinar2.jpg')) {
                        lightboxSchedule.style.display = 'block';
                        lightboxSchedule.innerHTML = infoWebnas2;
                        lightboxImg.style.maxWidth = '400px'; 
                    } else {
                        lightboxSchedule.style.display = 'none';
                        lightboxSchedule.innerHTML = '';
                        lightboxImg.style.maxWidth = '100%';
                    }
                });
            });
        </script>
    </section>
    <style>
        .cine-partners-inner {
            background: #fff; 
            padding: 25px 60px; 
            border-radius: 100px; 
            display: flex; 
            gap: 50px; 
            align-items: center; 
            box-shadow: 0 15px 40px rgba(0,0,0,0.15); 
            flex-wrap: wrap; 
            justify-content: center;
        }
        @media (max-width: 768px) {
            .cine-partners-inner {
                padding: 20px 25px;
                gap: 25px;
                border-radius: 30px;
            }
            .cine-partners-inner img {
                height: 50px !important;
            }
            .cine-partners-inner img[alt="Kemahasiswaan"] {
                height: 45px !important;
            }
            .cine-partners-inner img[alt="PKKMB Narotama"] {
                height: 60px !important;
            }
        }
    </style>
    <section class="cine-partners" style="display: flex; justify-content: center; margin-bottom: 60px; margin-top: 10px; padding: 0 20px;">
        <div class="cine-partners-inner">
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
