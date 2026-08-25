@extends('layouts.landing.base')

@section('content')
@php
$teams = [
    ['name' => 'Ade Chandra Kurnia Purwanto, S.Kom., M.H.', 'title' => 'Kepala Sub Direktorat Kemahasiswaan, Alumni, Tracer Study', 'link' => 'https://www.instagram.com/masss.chan/'],
    ['name' => 'Amalia Prastika Sari, S.Pd.', 'title' => 'Staf Direktorat Kemahasiswaan, Alumni, Tracer Study', 'link' => 'https://www.instagram.com/amaliaprastika/'],
    ['name' => 'Alfandi Kusuma', 'title' => 'Steering Commite', 'link' => 'https://www.instagram.com/alfama.id/'],
    ['name' => 'Nilasari Eka Ambarwati', 'title' => 'Steering Commite', 'link' => 'https://www.instagram.com/_vanniillaa/'],
    ['name' => 'Toti Valentino Putra', 'title' => 'Steering Commite', 'link' => 'https://www.instagram.com/tvaltra_/'],
    ['name' => 'Mochammad Dicky Tri Pranata', 'title' => 'Ketua Pelaksana', 'link' => 'https://www.instagram.com/dikianaksingkong/'],
    ['name' => 'Rina Nur Aminah', 'title' => 'Koordinator Divisi Kesekretariatan', 'link' => 'https://www.instagram.com/rinaaja_28/'],
    ['name' => 'Siti Masriyah', 'title' => 'Anggota Divisi Kesekretariatan', 'link' => 'https://www.instagram.com/xriyahh._/'],
    ['name' => 'Chyntia Hasde', 'title' => 'Anggota Divisi Kesekretariatan', 'link' => 'https://www.instagram.com/_chyfss/'],
    ['name' => 'Meyla Shafa', 'title' => 'Anggota Divisi Kesekretariatan', 'link' => 'https://www.instagram.com/meyyshafaaa/'],
    ['name' => 'Tiara Atikah Almasah', 'title' => 'Anggota Divisi Kesekretariatan', 'link' => 'https://www.instagram.com/tiaraatikahh/'],
    ['name' => 'Meltina Julianti Rumheng', 'title' => 'Koordinator Divisi Acara dan Kreatif', 'link' => 'https://www.instagram.com/meltinarumheng/'],
    ['name' => 'Annisa Nurul Rachma', 'title' => 'Anggota Divisi Acara dan Kreatif', 'link' => 'https://www.instagram.com/ansxxnr/'],
    ['name' => 'Faiz Rasya Nastain', 'title' => 'Anggota Divisi Acara dan Kreatif', 'link' => 'https://www.instagram.com/nxstaaa.r/'],
    ['name' => 'Ninda Aprilia Rochma', 'title' => 'Anggota Divisi Acara dan Kreatif', 'link' => 'https://www.instagram.com/nindaaprl_/'],
    ['name' => 'Sabrina Ayu Anggraeni', 'title' => 'Anggota Divisi Acara dan Kreatif', 'link' => 'https://www.instagram.com/__heyitsbina/'],
    ['name' => 'Nadia Octovani Adelia', 'title' => 'Koordinator Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/octonaaa_/'],
    ['name' => 'Muhammad Reza A', 'title' => 'Anggota Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/rezafifn/'],
    ['name' => 'Nuriza Yudista Sari', 'title' => 'Anggota Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/nr.ydistasr/'],
    ['name' => 'Ainun Rahmadhani', 'title' => 'Anggota Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/ainunrmdn_/'],
    ['name' => 'Fredo Rizky Dewantara', 'title' => 'Anggota Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/rizkyy_dewantaraa/'],
    ['name' => 'Pinkan Wardah Aulia', 'title' => 'Anggota Divisi Dokumentasi & Teknologi Informasi', 'link' => 'https://www.instagram.com/pnkwra/'],
    ['name' => 'Maulana Adrian Saputra', 'title' => 'Koordinator Divisi Perlengkapan', 'link' => 'https://www.instagram.com/adriaansapp/'],
    ['name' => 'Achmad Farros Robihansyah', 'title' => 'Anggota Divisi Perlengkapan', 'link' => 'https://www.instagram.com/faizz.yh_/'],
    ['name' => 'Muhamad Haris Al-Aziz', 'title' => 'Anggota Divisi Perlengkapan', 'link' => 'https://www.instagram.com//'],
    ['name' => 'Lina Sefiyatiningsih', 'title' => 'Anggota Divisi Perlengkapan', 'link' => 'https://www.instagram.com/buihkentut/'],
    ['name' => 'Muhammad Sofi', 'title' => 'Anggota Divisi Perlengkapan', 'link' => 'https://www.instagram.com/_mhmmdsofi/'],
    ['name' => 'Wida Humairoh Primarani', 'title' => 'Koordinator Divisi Hubungan Masyarakat', 'link' => 'https://www.instagram.com/wdaprm_/'],
    ['name' => 'Martina Rahael', 'title' => 'Anggota Divisi Hubungan Masyarakat', 'link' => 'https://www.instagram.com/vy_rehell/'],
    ['name' => 'Jayanti Nur Fatika', 'title' => 'Anggota Divisi Hubungan Masyarakat', 'link' => 'https://www.instagram.com/atikajy/'],
    ['name' => 'Zainal Abidin', 'title' => 'Anggota Divisi Hubungan Masyarakat', 'link' => 'https://www.instagram.com/zainsva_/'],
    ['name' => 'Benedictus Berttria Octo Raharjo', 'title' => 'Koordinator Divisi Naradamping', 'link' => 'https://www.instagram.com/albeneex/'],
    ['name' => 'Moh. Ruki Ardiansyah', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/rukiardnsyh/'],
    ['name' => 'Rivky Dimas Ariyanto', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/rivdimz_/'],
    ['name' => 'Andien Putri Oveanti', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/_andienputri/'],
    ['name' => 'Merlin Rumthe', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/uknowmer/'],
    ['name' => 'Afni Rahma Andini', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/afnra9/'],
    ['name' => 'Rohma Fitriani', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/_rhmafitrni/'],
    ['name' => 'Intan Permata Sari Sinaga', 'title' => 'Anggota Divisi Naradamping', 'link' => 'https://www.instagram.com/intaan_0.0/'],
    ['name' => 'Karina Vellishia', 'title' => 'Koordinator Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com/karinaaaav_/'],
    ['name' => 'Riska Ayu Purnamasari', 'title' => 'Anggota Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com/gizso/'],
    ['name' => 'Maulana Ahmad Afandi', 'title' => 'Anggota Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com//'],
    ['name' => 'Fanny Leonora Lekito', 'title' => 'Anggota Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com/fannylekitoo_/'],
    ['name' => 'Herlin Diana', 'title' => 'Anggota Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com//'],
    ['name' => 'Nabilah Dwi Ramadhani', 'title' => 'Anggota Divisi Logistik dan Kesehatan', 'link' => 'https://www.instagram.com/_nbilahdwi/'],
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
                        <div class="w-[64px] h-[64px] bg-cine-navy/5 rounded-full flex flex-shrink-0 items-center justify-center mb-4 text-cine-navy transition-colors">
                            <span class="text-2xl font-black">{{ $initial }}</span>
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