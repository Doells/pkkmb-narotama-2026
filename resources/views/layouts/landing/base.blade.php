<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.landing.meta')
    @include('partials.fonts')
    @include('partials.tailwindstyles')
    @if(isset($title) && $title === 'Beranda')
        <title>PKKMB Narotama 2026 | Universitas Narotama</title>
    @else
        <title>{{ $title ?? 'PKKMB 2026' }} | PKKMB Universitas Narotama 2026</title>
    @endif
    @include('includes.landing.style')
    @stack('style')
</head>
<body class="cine-page antialiased">
    @include('layouts.landing.navbar')
    @yield('content')
    @include('layouts.landing.footer')
    @include('includes.landing.script')
    @include('partials.scripts')
    @stack('javascript')
</body>
</html>
