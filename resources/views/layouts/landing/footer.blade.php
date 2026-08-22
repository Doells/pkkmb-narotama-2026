<footer class="cine-footer">
    <div class="cine-container cine-footer-grid">
        <div class="cine-footer-logo">
            <img src="{{ asset('pkkmblogo-transparent.png') }}?v=2" alt="Logo PKKMB Narotama 2026">
            <p>Mahakarya Garda Depan,<br>Mengukir Dampak untuk Negeri.</p>
        </div>
        <div class="cine-footer-col">
            <b>JELAJAHI</b>
            <a href="{{ route('index-landing') }}">Beranda</a>
            <a href="{{ route('informasi-landing') }}">Informasi</a>
            <a href="{{ route('auth.login') }}">Login Peserta</a>
        </div>
        <div class="cine-footer-col">
            <b>IKUTI KAMI</b>
            <a href="https://www.instagram.com/pkkmb_narotama/" target="_blank" rel="noopener">Instagram</a>
            <a href="https://www.tiktok.com/@pkkmb_narotama" target="_blank" rel="noopener">TikTok</a>
            <a href="https://sikawan.narotama.ac.id/" target="_blank" rel="noopener">Kemahasiswaan</a>
        </div>
        <div class="cine-footer-col">
            <b>PUSAT BANTUAN</b>
            <a href="{{ route('informasi-landing') }}#panitia">Hubungi Panitia</a>
            <a href="{{ route('informasi-landing') }}#pedoman">Pedoman Peserta</a>
        </div>
    </div>
    <div class="cine-container cine-footer-bottom">
        <span>© 2026 PKKMB Universitas Narotama</span>
        <span>Surabaya, Indonesia</span>
    </div>
</footer>
