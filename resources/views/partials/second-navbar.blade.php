<!-- Topbar -->
<nav class="navbar fixed-top navbar-expand navbar-dark topbar mb-4 static-top shadow custom-navbar">
    <div class="navbar-item">
        @if ($data_detail ?? false)
            <a href="{{ route('services') }}">Back</a>
        @endif
        <img src="{{ asset('img/logo_navbar.png') }}" class="navbar-subitem" alt="">
    </div>
    <div class="navbar-item">
        @if ($data_detail ?? false)
            <h1 class="poppins-semibold">{{ $data_detail }}</h1>
        @else
            <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
            <a class="{{ request()->is('services') || request()->is('services/titik-halte') || Illuminate\Support\Str::is('services/titik-halte/*', request()->path()) ? 'active' : '' }}"
                href="{{ route('services') }}">Layanan</a>
            @if (isAdmin())
                <a class="{{ request()->is('kritik') ? 'active' : '' }}" href="{{ route('kritik-saran') }}">Kritik dan
                    Saran</a>
                <a class="{{ request()->is('penilaian') ? 'active' : '' }}"
                    href="{{ route('penilaian') }}">Penilaian</a>
            @else
                <a class="{{ request()->is('fitures') ? 'active' : '' }}" href="{{ '' }}">Fitur</a>
                <a class="{{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a>
            @endif
        @endif
    </div>
    <div class="navbar-item">
        <img src="{{ asset('img/manage_search.png') }}" class="navbar-subitem" alt="">
    </div>
</nav>
<!-- End of Topbar -->
