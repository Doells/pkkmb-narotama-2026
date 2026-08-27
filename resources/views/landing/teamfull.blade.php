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
    <section class="w-full bg-cine-navy pt-[168px] pb-[64px]">
        <div class="max-w-[1180px] mx-auto px-[24px] text-center lg:text-left">
            <span class="inline-block text-cine-yellow font-bold text-xs tracking-widest uppercase mb-4">Pusat Informasi</span>
            <h1 class="text-4xl lg:text-5xl font-black text-cine-cream mb-4 tracking-tighter">Kepanitiaan PKKMB 2026</h1>
            <p class="text-base text-cine-cream/80 font-medium max-w-[600px] mx-auto lg:mx-0 leading-relaxed">
                Seluruh jajaran struktural mahasiswa dan panitia universitas yang bertugas mensukseskan pelaksanaan CineAction Universitas Narotama.
            </p>
        </div>
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