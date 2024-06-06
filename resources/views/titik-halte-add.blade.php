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
            /* gap: 20px; */
        }

        .bg-image .sidebar a {
            padding: 20px;
            color: white;
            text-decoration: none;
            border-top: 1px solid white;
            /* border-bottom: 1px solid white; */
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

        .relative-content form input[type=file] {
            padding: 5px;
        }

        .relative-content img {
            width: 40%;
        }
    </style>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid bg-image" style="background-image: url('{{ asset('img/bg-image.png') }}')">
        <div class="sidebar">
            @foreach ($titik_halte as $th)
                <a class=""
                    href="{{ route('services.titik-halte.detail', ['titikHalte' => $th->id]) }}">{{ $th->nama_rute }}
                </a>
            @endforeach
            @if (isAdmin())
                <a class="poppins-{{ request()->is('services/titik-halte/add') ? 'bold' : '' }}"
                    href="{{ route('services.titik-halte.add-page') }}">
                    <i class="fas fa-plus"></i> Tambah Rute
                </a>
            @endif
        </div>
        <div class="relative-content">
            <form action="{{ route('services.titik-halte.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_rute" class="form-label">Nama Rute</label>
                    <input type="text" name="nama_rute" id="nama_rute" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="gambar_rute" class="form-label">Gambar Rute</label>
                    <input type="file" name="gambar_rute" id="gambar_rute" class="form-control-file">
                </div>
                <button class="btn btn-success">Tambah</button>
            </form>
            {{-- <img src="{{ asset("img/{$data_bus['image']}") }}" alt=""> --}}
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
