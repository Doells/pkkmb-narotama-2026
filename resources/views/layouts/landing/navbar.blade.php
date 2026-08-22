<nav class="cine-nav" aria-label="Navigasi utama">
    <div class="cine-container cine-nav-inner">
        <a href="{{ route('index-landing') }}" class="cine-logo" aria-label="PKKMB Narotama 2026">
            <img src="{{ asset('pkkmblogo-transparent.png') }}?v=2" alt="Logo PKKMB Narotama 2026">
        </a>

        <div class="cine-menu">
            <a href="{{ route('index-landing') }}" class="{{ request()->routeIs('index-landing') ? 'is-active' : '' }}">Beranda</a>
            <a href="{{ route('informasi-landing') }}" class="{{ request()->is('informasi*') ? 'is-active' : '' }}">Informasi</a>
            <a href="{{ route('index-landing') }}#jadwal">Jadwal</a>
            @auth
                <a href="{{ route('home-presences.indexuserdashboard') }}" class="cine-login">Dashboard <span>→</span></a>
            @else
                <a href="{{ route('auth.login') }}" class="cine-login {{ request()->routeIs('auth.login') ? 'is-active' : '' }}">Login <span>→</span></a>
            @endauth
        </div>

        <button type="button" class="cine-mobile-button" id="cine-mobile-button" aria-expanded="false" aria-controls="cine-mobile-menu" aria-label="Buka menu">
            <i></i><i></i>
        </button>

        <div class="cine-mobile-menu" id="cine-mobile-menu">
            <a href="{{ route('index-landing') }}">Beranda</a>
            <a href="{{ route('informasi-landing') }}">Informasi</a>
            <a href="{{ route('index-landing') }}#jadwal">Jadwal</a>
            @auth
                <a href="{{ route('home-presences.indexuserdashboard') }}" class="cine-login">Dashboard →</a>
            @else
                <a href="{{ route('auth.login') }}" class="cine-login">Login →</a>
            @endauth
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('cine-mobile-button');
    const menu = document.getElementById('cine-mobile-menu');
    if (!button || !menu) return;
    button.addEventListener('click', function () {
        const open = menu.classList.toggle('open');
        button.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    menu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            menu.classList.remove('open');
            button.setAttribute('aria-expanded', 'false');
        });
    });
});
</script>
