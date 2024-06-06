@extends('layouts.second')

@section('style')
    <style>
        .bg-image {
            background-image: url("img/bg-image.png");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .relative-content {
            position: relative;
            z-index: 99;
            padding-top: 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .bg-image::after {
            content: "";
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            height: 100vh;
            background-image: linear-gradient(white 20%, rgba(255, 255, 255, 0.5));
        }

        .title {
            color: #292477;
            font-size: 35px;
        }

        .subtitle {
            color: #292477;
            font-size: 20px;
            width: 70%;
            margin: 15px auto;
        }

        .services {
            display: flex;
            gap: 50px;
            justify-content: center;
            align-items: center;
            margin-top: 5%;
        }

        .services .service-item {
            width: 300px;
            height: 250px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(41, 36, 119, 0.8);
            border-radius: 20px;
            text-decoration: none;
        }

        .services .service-item img {
            width: 80px;
        }

        .services .service-item h1 {
            margin-top: 20px;
            font-size: 20px;
            color: white;
        }

        .services .service-item p {
            color: white;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid bg-image" style="background-image: url('{{ asset('img/bg-image.png') }}')">
        <div class="relative-content">
            <h1 class="title poppins-bold text-center">Layanan Kami</h1>
            <p class="subtitle poppins-semibold text-center">Kami Hadir Untuk Menjadi Teman Setia yang Menemani Perjalanan
                Anda
            </p>

            <div class="services">
                <a href="{{ route('services.jadwal-bus') }}" class="service-item">
                    <img src="{{ asset('img/Ellipse 1.png') }}" alt="">
                    <h1 class="poppins-bold">Jadwal Bus</h1>
                    <p>Cek jadwal dan rute bus sesuai kebutuhan mu</p>
                </a>
                <a href="{{ route('services.titik-halte') }}" class="service-item">
                    <img src="{{ asset('img/Ellipse 2.png') }}" alt="">
                    <h1 class="poppins-bold">Titik Halte</h1>
                    <p>Temukan titik halte disekitarmu</p>
                </a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
