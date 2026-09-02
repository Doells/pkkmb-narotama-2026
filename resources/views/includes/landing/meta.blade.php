<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
@if(isset($title) && $title === 'Beranda')
    <meta name="description" content="PKKMB Universitas Narotama 2026 — Pengenalan Kehidupan Kampus bagi Mahasiswa Baru. Dapatkan informasi kegiatan, jadwal, berita, panduan, dan informasi penting PKKMB 2026.">
    <link rel="canonical" href="https://pkkmb.narotama.ac.id/">
    <meta property="og:title" content="PKKMB Narotama 2026 | Universitas Narotama">
    <meta property="og:description" content="PKKMB Universitas Narotama 2026 — Pengenalan Kehidupan Kampus bagi Mahasiswa Baru. Dapatkan informasi kegiatan, jadwal, berita, panduan, dan informasi penting PKKMB 2026.">
    <meta property="og:url" content="https://pkkmb.narotama.ac.id/">
    
    <meta name="twitter:title" content="PKKMB Narotama 2026 | Universitas Narotama">
    <meta name="twitter:description" content="PKKMB Universitas Narotama 2026 — Pengenalan Kehidupan Kampus bagi Mahasiswa Baru. Dapatkan informasi kegiatan, jadwal, berita, panduan, dan informasi penting PKKMB 2026.">
@else
    <meta name="description" content="Langkah pertama menuju perjalanan baru bersama PKKMB Universitas Narotama 2026.">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'PKKMB 2026' }} | PKKMB Universitas Narotama 2026">
    <meta property="og:description" content="Langkah pertama menuju perjalanan baru bersama PKKMB Universitas Narotama 2026.">
    <meta property="og:url" content="{{ url()->current() }}">
    
    <meta name="twitter:title" content="{{ $title ?? 'PKKMB 2026' }} | PKKMB Universitas Narotama 2026">
    <meta name="twitter:description" content="Langkah pertama menuju perjalanan baru bersama PKKMB Universitas Narotama 2026.">
@endif

<meta name="keywords" content="PKKMB Narotama, PKKMB 2026, Universitas Narotama, Mahasiswa Baru, Ospek">
<meta name="author" content="Universitas Narotama">
<meta name="robots" content="index, follow">

<meta property="og:image" content="{{ asset('pkkmblogo-transparent.png') }}">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" type="image/png" href="{{ asset('pkkmblogo-transparent.png') }}?v={{ filemtime(public_path('pkkmblogo-transparent.png')) }}">
<link rel="shortcut icon" type="image/png" href="{{ asset('pkkmblogo-transparent.png') }}?v={{ filemtime(public_path('pkkmblogo-transparent.png')) }}">
<link rel="apple-touch-icon" href="{{ asset('pkkmblogo-transparent.png') }}?v={{ filemtime(public_path('pkkmblogo-transparent.png')) }}">

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}"/>
