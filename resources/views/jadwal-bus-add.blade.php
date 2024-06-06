@extends('layouts.second')

@section('style')
    <style>
        .bg-image {
            background-image: url("img/bg-image.png");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh !important;
            padding: 0;
            display: flex;
        }

        .bg-image::after {
            content: "";
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            height: 100vh;
            background-image: linear-gradient(white 50%, rgba(255, 255, 255, 0.9));
        }


        .bg-image .sidebar {
            position: relative;
            z-index: 1;
            background-color: #4E429E;
            padding-top: 70px !important;
            display: flex;
            flex-direction: column;
        }

        .bg-image .sidebar a {
            padding: 20px;
            color: white;
            text-decoration: none;
            border-top: 1px solid white;
            display: flex;
            flex-direction: column;
            /* border-bottom: 1px solid white; */
        }

        .bg-image .sidebar a.tambah-koridor {
            display: flex;
            align-items: center;
            gap: 5px;
            flex-direction: row;
        }

        .bg-image a span {
            font-size: 12px;
        }

        .bg-image .sidebar a:last-child {
            border-bottom: 1px solid white;
        }

        .relative-content {
            flex: auto;
            position: relative;
            z-index: 99;
            padding-top: 70px !important;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .relative-content img {
            width: 60%;
        }

        .relative-content form {
            width: 50%;
        }

        .relative-content form label {
            color: black;
        }

        .relative-content form input {
            border-radius: 5px;
            border: 1px solid black;
            color: black;
            padding: 20px 10px;
        }
    </style>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid bg-image" style="background-image: url('{{ asset('img/bg-image.png') }}')">
        <div class="sidebar">
            {{-- <a class="" href="{{ route('services.jadwal-bus.detail', ['jadwalBus' => 0]) }}">
                Koridor 1
                <span>asd</span>
            </a>
            <a class="" href="{{ route('services.jadwal-bus.detail', ['jadwalBus' => 1]) }}">
                Koridor 2b
                <span>asd</span>
            </a> --}}
            @foreach ($data as $bus)
                <a class="" href="{{ route('services.jadwal-bus.detail', ['jadwalBus' => $bus->id]) }}">
                    {{ $bus->nama_koridor }}
                    <span>{{ $bus->nama_rute }}</span>
                </a>
            @endforeach
            @if (isAdmin())
                <a class="tambah-koridor poppins-{{ request()->is('services/jadwal-bus/add') ? 'bold' : '' }}"
                    href="{{ route('services.jadwal-bus.add-page') }}">
                    <i class="fas fa-plus"></i> Tambah Koridor
                </a>
            @endif
        </div>
        <div class="relative-content">
            <form action="{{ route('services.jadwal-bus.add') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_koridor" class="form-label">Nama Koridor</label>
                    <input type="text" name="nama_koridor" id="nama_koridor" class="form-control"
                        placeholder="Koridor 1">
                </div>
                <div class="mb-3">
                    <label for="nama_rute" class="form-label">Nama Rute</label>
                    <input type="text" name="nama_rute" id="nama_rute" class="form-control"
                        placeholder="Pusat kota - Ulee lheue">
                </div>
                <button class="btn btn-success">Tambah</button>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
