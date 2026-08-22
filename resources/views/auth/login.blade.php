<!DOCTYPE html>
<html lang="id">
<head>
    @include('includes.landing.meta')
    @include('partials.fonts')
    @include('partials.tailwindstyles')
    <title>Login Peserta | PKKMB Narotama 2026</title>
    @include('includes.landing.style')
</head>
<body class="cine-page">
    <main class="cine-login-page">
        <section class="cine-login-art">
            <a href="{{ route('index-landing') }}" class="cine-login-brand"><img src="{{ asset('pkkmblogo-transparent.png') }}?v=2" alt="Logo PKKMB Narotama 2026"></a>
            <div class="cine-grain" aria-hidden="true"></div>
            <div class="cine-login-copy">
                <div class="cine-eyebrow">RUANG PESERTA</div>
                <h1>Scene-mu<br><em>dimulai di sini.</em></h1>
                <p>Akses informasi kelompok, tugas peserta, presensi, dan pengumuman khusus melalui satu ruang yang sama.</p>
            </div>
            <div class="cine-login-ticket"><span>PKKMB</span><b>2026</b><small>ADMIT ONE • GARDA DEPAN</small></div>
        </section>

        <section class="cine-login-panel">
            <div class="cine-login-box">
                <a href="{{ route('index-landing') }}" class="cine-back">← KEMBALI KE BERANDA</a>
                <div class="cine-login-title"><small>SELAMAT DATANG</small><h2>Login Peserta</h2><p>Gunakan NIM dan kata sandi yang telah diberikan oleh panitia.</p></div>

                @if(session()->has('loginError'))
                    <div class="cine-alert error" role="alert">{{ session('loginError') }}</div>
                @endif

                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <div class="cine-field">
                        <label for="nim">Nomor Induk Mahasiswa</label>
                        <div class="cine-input"><span>№</span><input type="number" name="nim" id="nim" value="{{ old('nim') }}" placeholder="Masukkan NIM" required autofocus autocomplete="username"></div>
                        @error('nim')<p class="cine-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="cine-field">
                        <label for="password">Kata Sandi</label>
                        <div class="cine-input"><span>●</span><input type="password" name="password" id="password" placeholder="Masukkan kata sandi" required autocomplete="current-password"></div>
                        @error('password')<p class="cine-error">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="cine-submit">Masuk ke Ruang Peserta <span>→</span></button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
