<!-- Topbar -->
<nav class="navbar fixed-top navbar-expand navbar-dark topbar mb-4 static-top shadow custom-navbar">
    <div class="navbar-item container-fluid d-flex justify-content-between">
        <a class="navbar-brands poppins-semibold" href="/">Trans Koetaradja</a>
        <div class="navbar-menu">
            <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
            <a class="{{ request()->is('services') ? 'active' : '' }}" href="{{ route('services') }}">Layanan</a>
            <a class="{{ request()->is('fitures') ? 'active' : '' }}" href="{{ '' }}">Fitur</a>
            <a class="{{ request()->is('contact') ? 'active' : '' }}" href="{{ '' }}">Kontak</a>
        </div>
        <div class="action">
            <a class="poppins-semibold" href="{{ route('register.show') }}">Daftar</a>
            <a class="masuk poppins-semibold" href="{{ route('login.show') }}">Masuk</a>
        </div>
    </div>
</nav>
<!-- End of Topbar -->
