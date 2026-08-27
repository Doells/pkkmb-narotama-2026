@extends('layouts.landing.base')

@section('content')
@php
$teams = [
    ['name' => 'Ade Chandra Kurnia Purwanto, S.Kom., M.H.', 'image' => 'img/panitia/ade.jpg', 'title' => 'Kepala Sub Direktorat Kemahasiswaan, Alumni, Tracer Study', 'link' => 'https://www.instagram.com/masss.chan/'],
    ['name' => 'Amalia Prastika Sari, S.Pd.', 'image' => 'img/panitia/Amalia Prastika Sari, S.Pd.jpg', 'title' => 'Staf Direktorat Kemahasiswaan, Alumni, Tracer Study', 'link' => 'https://www.instagram.com/amaliaprastika/'],
    ['name' => 'Alfandi Kusuma', 'image' => 'img/panitia/Alfandi Kusuma.jpg', 'title' => 'Steering Commite', 'link' => 'https://www.instagram.com/alfama.id/'],
    ['name' => 'Nilasari Eka Ambarwati', 'image' => 'img/panitia/Nilasari Eka Ambarwati.jpg', 'title' => 'Steering Commite', 'link' => 'https://www.instagram.com/_vanniillaa/'],
    ['name' => 'Toti Valentino Putra', 'image' => 'img/panitia/Toti Valentino Putra.jpg', 'title' => 'Steering Commite', 'link' => 'https://www.instagram.com/tvaltra_/'],
    ['name' => 'Mochammad Dicky Tri Pranata', 'image' => 'img/panitia/Moch. Dicky Tri Pranata.jpg', 'title' => 'Ketua Pelaksana', 'link' => 'https://www.instagram.com/dikianaksingkong/'],
    ['name' => 'Rina Nur Aminah', 'image' => 'img/panitia/Rina Nur Aminah.jpg', 'title' => 'Koordinator Divisi Kesekretariatan', 'link' => 'https://www.instagram.com/rinaaja_28/'],
    ['name' => 'Siti Masriyah', 'image' => 'img/panitia/Siti Masriyah.jpg', 'title' => 'Anggota Divisi Kesekretariatan', 'link' => 'https://www.instagram.com/xriyahh._/'],
    ['name' => 'Chyntia Hasde', 'image' => 'img/panitia/Chyntia Hasde.jpg', 'title' => 'Anggota Divisi Kesekretariatan', 'link' => 'https://www.instagram.com/_chyfss/'],
    ['name' => 'Meyla Shafa', 'image' => 'img/panitia/Meyla Shafa Rizkianti.jpg', 'title' => 'Anggota Divisi Kesekretariatan', 'link' => 'https://www.instagram.com/meyyshafaaa/'],
    ['name' => 'Tiara Atikah Almasah', 'image' => 'img/panitia/Tiara Atikah Almasah.jpg', 'title' => 'Anggota Divisi Kesekretariatan', 'link' => 'https://www.instagram.com/tiaraatikahh/'],
    ['name' => 'Meltina Julianti Rumheng', 'image' => 'img/panitia/Meltina Julianti Rumheng.jpg', 'title' => 'Koordinator Divisi Acara dan Kreatif', 'link' => 'https://www.instagram.com/meltinarumheng/'],
    ['name' => 'Annisa Nurul Rachma', 'image' => 'img/panitia/Anisa Nurul Rachma.jpg', 'title' => 'Anggota Divisi Acara dan Kreatif', 'link' => 'https://www.instagram.com/ansxxnr/'],
    ['name' => 'Faiz Rasya Nastain', 'image' => 'img/panitia/Faiz Rasya Nastain.jpg', 'title' => 'Anggota Divisi Acara dan Kreatif', 'link' => 'https://www.instagram.com/nxstaaa.r/'],
    ['name' => 'Ninda Aprilia Rochma', 'image' => 'img/panitia/Ninda Aprilia Rochma.jpg', 'title' => 'Anggota Divisi Acara dan Kreatif', 'link' => 'https://www.instagram.com/nindaaprl_/'],
    ['name' => 'Sabrina Ayu Anggraeni', 'image' => 'img/panitia/Sabrina Ayu Anggraeni.jpg', 'title' => 'Anggota Divisi Acara dan Kreatif', 'link' => 'https://www.instagram.com/__heyitsbina/'],
    ['name' => 'Nadia Octovani Adelia', 'image' => 'img/panitia/Nadia Octovani Adelia.jpg', 'title' => 'Koordinator Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/octonaaa_/'],
    ['name' => 'Muhammad Reza A', 'image' => 'img/panitia/Muhamad Reza Afifudin.jpg', 'title' => 'Anggota Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/rezafifn/'],
    ['name' => 'Nuriza Yudista Sari', 'image' => 'img/panitia/Nuriza Yudista Sari.jpg', 'title' => 'Anggota Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/nr.ydistasr/'],
    ['name' => 'Ainun Rahmadhani', 'image' => 'img/panitia/Ainun Rahmadhani.jpg', 'title' => 'Anggota Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/ainunrmdn_/'],
    ['name' => 'Fredo Rizky Dewantara', 'image' => 'img/panitia/Fredo Rizky Dewantara.jpg', 'title' => 'Anggota Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/rizkyy_dewantaraa/'],
    ['name' => 'Pinkan Wardah Aulia', 'image' => 'img/panitia/Pinkan Wardah Aulia.jpg', 'title' => 'Anggota Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/pnkwra/'],
    ['name' => 'Maulana Adrian Saputra', 'image' => 'img/panitia/Maulana Andrian Saputra.jpg', 'title' => 'Koordinator Divisi Perlengkapan', 'link' => 'https://www.instagram.com/adriaansapp/'],
    ['name' => 'Achmad Farros Robihansyah', 'image' => 'img/panitia/Achmad Farros Robihansyah.jpg', 'title' => 'Anggota Divisi Perlengkapan', 'link' => 'https://www.instagram.com/faizz.yh_/'],
    ['name' => 'Muhamad Haris Al-Aziz', 'image' => 'img/panitia/Muhamad Haris Al-Aziz.jpg', 'title' => 'Anggota Divisi Perlengkapan', 'link' => 'https://www.instagram.com/haris_alazis/'],
    ['name' => 'Lina Sefiyatiningsih', 'image' => 'img/panitia/Lina Sefiyatiningsih.jpg', 'title' => 'Anggota Divisi Perlengkapan', 'link' => 'https://www.instagram.com/buihkentut/'],
    ['name' => 'Muhammad Sofi', 'image' => 'img/panitia/Muhammad Sofi.jpg', 'title' => 'Anggota Divisi Perlengkapan', 'link' => 'https://www.instagram.com/_mhmmdsofi/'],
    ['name' => 'Wida Humairoh Primarani', 'image' => 'img/panitia/Wida Humairoh Primarani.jpg', 'title' => 'Koordinator Divisi Hubungan Masyarakat', 'link' => 'https://www.instagram.com/wdaprm_/'],
    ['name' => 'Martina Rahael', 'image' => 'img/panitia/Martina Rahael.jpg', 'title' => 'Anggota Divisi Hubungan Masyarakat', 'link' => 'https://www.instagram.com/vy_rehell/'],
    ['name' => 'Jayanti Nur Fatika', 'image' => 'img/panitia/Jayanti Nur Fatika.jpg', 'title' => 'Anggota Divisi Hubungan Masyarakat', 'link' => 'https://www.instagram.com/atikajy/'],
    ['name' => 'Zainal Abidin', 'image' => 'img/panitia/Zainal Abidin.jpg', 'title' => 'Anggota Divisi Hubungan Masyarakat', 'link' => 'https://www.instagram.com/zainsva_/'],
    ['name' => 'Benedictus Berttria Octo Raharjo', 'image' => 'img/panitia/Benedictus Berttria Octo Raharjo.jpg', 'title' => 'Koordinator Divisi Naradamping', 'link' => 'https://www.instagram.com/albeneex/'],
    ['name' => 'Moh. Ruki Ardiansyah', 'image' => 'img/panitia/Moh. Ruki Ardiansyah.jpg', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/rukiardnsyh/'],
    ['name' => 'Rivky Dimas Ariyanto', 'image' => 'img/panitia/Rivky Dimas Ariyanto.jpg', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/rivdimz_/'],
    ['name' => 'Andien Putri Oveanti', 'image' => 'img/panitia/Andien Putri Oveanti.jpg', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/_andienputri/'],
    ['name' => 'Merlin Rumthe', 'image' => 'img/panitia/Merlin Rumthe.jpg', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/uknowmer/'],
    ['name' => 'Afni Rahma Andini', 'image' => 'img/panitia/Afni Rahma Andini.jpg', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/afnra9/'],
    ['name' => 'Rohma Fitriani', 'image' => 'img/panitia/Rohma Fitriani.jpg', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/_rhmafitrni/'],
    ['name' => 'Intan Permata Sari Sinaga', 'image' => 'img/panitia/Intan Permata Sari Sinaga.jpg', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/intaan_0.0/'],
    ['name' => 'Karina Vellishia', 'image' => 'img/panitia/Karina Vellishia.jpg', 'title' => 'Koordinator Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com/karinaaaav_/'],
    ['name' => 'Riska Ayu Purnamasari', 'image' => 'img/panitia/Riska Ayu Purnamasari.jpg', 'title' => 'Anggota Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com/gizso/'],
    ['name' => 'Maulana Ahmad Afandi', 'image' => 'img/panitia/Maulana Ahmad Afandi.jpg', 'title' => 'Anggota Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com/innsencc_/'],
    ['name' => 'Fanny Leonora Lekito', 'image' => 'img/panitia/Fanny Leonora Lekito.jpg', 'title' => 'Anggota Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com/fannylekitoo_/'],
    ['name' => 'Herlin Diana', 'image' => 'img/panitia/Herlin Diana.jpg', 'title' => 'Anggota Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com/ilenbily/'],
    ['name' => 'Nabilah Dwi Ramadhani', 'image' => 'img/panitia/Nabilah Dwi Ramadhani.jpg', 'title' => 'Anggota Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com/_nbilahdwi/'],
];
@endphp

    <!-- Page Header -->
    <section class="w-full bg-cine-navy pb-[40px] lg:pb-[64px] relative overflow-hidden" style="padding-top: 100px;">
        <div class="max-w-[1180px] mx-auto px-[24px] flex flex-col lg:flex-row items-center justify-between gap-[40px]">
            <div class="w-full lg:w-3/5 text-center lg:text-left z-10">
                <span class="inline-block text-cine-yellow font-bold text-xs tracking-widest uppercase mb-4">Pusat Informasi</span>
                <h1 class="text-4xl lg:text-5xl font-black text-cine-cream mb-4 tracking-tighter">Kepanitiaan PKKMB 2026</h1>
                <p class="text-base text-cine-cream/80 font-medium max-w-[600px] mx-auto lg:mx-0 leading-relaxed">
                    Seluruh jajaran struktural mahasiswa dan panitia universitas yang bertugas mensukseskan pelaksanaan CineAction Universitas Narotama.
                </p>
            </div>
            
            <div style="width: 40%; display: flex; justify-content: flex-end; align-items: center; position: relative; z-index: 10;">
                <!-- Modern Minimalist Movie Ticket Decoration -->
                <div style="display: flex; background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05)); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 12px; overflow: hidden; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); box-shadow: 0 20px 40px rgba(0,0,0,0.3); transform: rotate(2deg) translateY(-10px); width: 340px; height: 140px;">
                    <!-- Ticket Stub -->
                    <div style="width: 25%; background: rgba(39, 169, 232, 0.8); display: flex; flex-direction: column; justify-content: center; align-items: center; border-right: 2px dashed rgba(255,255,255,0.3); position: relative;">
                        <!-- Cutout holes -->
                        <div style="position: absolute; left: -10px; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; background: #073B5C; border-radius: 50%;"></div>
                        <div style="position: absolute; right: -11px; top: -10px; width: 20px; height: 20px; background: #073B5C; border-radius: 50%;"></div>
                        <div style="position: absolute; right: -11px; bottom: -10px; width: 20px; height: 20px; background: #073B5C; border-radius: 50%;"></div>
                        
                        <span style="transform: rotate(-90deg); color: #FFF; font-weight: 800; font-size: 14px; letter-spacing: 4px; text-transform: uppercase; white-space: nowrap;">Admit One</span>
                    </div>
                    <!-- Ticket Main Body -->
                    <div style="width: 75%; padding: 20px 24px; display: flex; flex-direction: column; justify-content: center;">
                        <span style="font-size: 10px; color: #FFC83D; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 4px;">PKKMB Festival</span>
                        <h3 style="margin: 0; font-size: 26px; color: #FFF; font-weight: 900; letter-spacing: -0.5px; line-height: 1;">CineAction</h3>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.1);">
                            <span style="color: rgba(255,255,255,0.6); font-size: 12px; font-weight: 600;">Est. 2026</span>
                            <span style="background: rgba(255, 200, 61, 0.2); color: #FFC83D; font-size: 10px; padding: 4px 8px; border-radius: 4px; font-weight: 700;">VIP PASS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative Glow -->
        <div style="position: absolute; top: 50%; left: 75%; transform: translate(-50%, -50%); width: 800px; height: 800px; background: rgba(39, 169, 232, 0.1); border-radius: 50%; filter: blur(80px); pointer-events: none;"></div>
    </section>

    <!-- Main Grid -->
    <section class="w-full bg-cine-cream min-h-[500px] py-[56px] lg:py-[88px]">
        <div class="max-w-[1180px] mx-auto px-[24px]">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-[24px]">
                <!-- Render Data from Array -->
                @foreach($teams as $person)
                    @php
                        // Get first alphabetic letter
                        $sanitized = preg_replace('/[^a-zA-Z]/', '', $person['name']);
                        $initial = strtoupper(substr($sanitized, 0, 1) ?: 'N');
                    @endphp
                    <div class="bg-white rounded-[16px] shadow-sm hover:shadow-md border border-cine-navy/10 flex flex-col items-center p-[20px] transition-all hover:border-cine-blue">
                        <div class="w-[100px] h-[100px] bg-cine-navy/5 rounded-2xl flex flex-shrink-0 items-center justify-center mb-4 text-cine-navy transition-colors overflow-hidden border-2 border-transparent">
                            @if(isset($person['image']))
                                <img src="{{ asset($person['image']) }}" alt="{{ $person['name'] }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl font-black">{{ $initial }}</span>
                            @endif
                        </div>
                        <div class="text-center flex-grow flex flex-col w-full">
                            <h1 class="font-bold text-cine-navy text-sm mb-1 leading-snug">{{ $person['name'] }}</h1>
                            <h2 class="font-semibold text-cine-navy/60 text-[10px] uppercase tracking-wide mt-auto">{{ $person['title'] }}</h2>
                            @if(isset($person['link']))
                                <div class="mt-3">
                                    <a href="{{ $person['link'] }}" target="_blank" class="text-[10px] font-bold text-cine-blue hover:text-cine-yellow transition-colors block">
                                        Instagram &rarr;
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="cine-team-actions">
                <a href="{{ route('informasi-landing') }}" class="cine-button cine-button-dark">
                    <b>←</b> Kembali ke Informasi
                </a>
            </div>
        </div>
    </section>
@endsection