<!-- Topbar -->
<nav class="navbar fixed-top navbar-expand navbar-dark topbar mb-4 static-top shadow custom-navbar">
    <div class="navbar-item">
        <a class="navbar-brands poppins-semibold" href="/">Trans Koetaradja</a>
    </div>
    <div class="navbar-item">
        <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
        <a class="{{ request()->is('services') || request()->is('services/titik-halte') ? 'active' : '' }}"
            href="{{ route('services') }}">Layanan</a>
        @if (isAdmin())
            <a class="{{ request()->is('kritik-saran') || request()->is('kritik-saran/ditanggapi') ? 'active' : '' }}"
                href="{{ route('kritik-saran') }}">Kritik dan
                Saran</a>
            <a class="{{ request()->is('penilaian') || request()->is('penilaian/kemarin') ? 'active' : '' }}"
                href="{{ route('penilaian') }}">Penilaian</a>
        @else
            <a class="{{ request()->is('fitures') ? 'active' : '' }}" href="{{ '' }}">Fitur</a>
            <a class="{{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a>
        @endif
    </div>
    <div class="navbar-item">
        @if (!isAdmin())
            <a class="poppins-semibold text-decoration-none text-white" href="{{ route('register.show') }}">Daftar</a>
            <a class="masuk poppins-semibold text-decoration-none" href="{{ route('login.show') }}">Masuk</a>
        @endif
    </div>
</nav>
<!-- End of Topbar -->
