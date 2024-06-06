@extends('layouts.user')

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

        .welcome {
            color: #292477;
        }

        .please {
            color: black;
            font-size: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            justify-content: center;
        }

        .form-items {
            background-color: #292577;
            border-radius: 20px;
            width: 50%;
            display: flex;
            align-items: center;
            padding: 7px 20px;
            color: white;
        }

        .form-items label {
            flex: 1.1;
            margin-top: 6px;
        }

        .form-items span {
            margin-right: 10px;
        }

        .form-items input {
            flex: 2;
            background-color: transparent;
            outline: none;
            border: none;
            color: white;
        }

        .btn-next {
            background-color: #6C16A0;
            border: none;
            padding: 7px 20px;
            border-radius: 15px;
            color: white;
        }
    </style>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid bg-image" style="background-image: url('{{ asset('img/bg-image.png') }}')">
        <div class="relative-content">
            <h1 class="welcome poppins-black">SELAMAT DATANG DI WEB TRANS KOETARADJA</h1>
            <p class="text-center please mt-3">Silahkan buat username dan password anda :</p>
            <form action="{{ route('register.process') }}" method="POST">
                @csrf
                <input type="hidden" name="nama" value="{{ $data_diri['nama'] }}">
                <input type="hidden" name="ttl" value="{{ $data_diri['ttl'] }}">
                <input type="hidden" name="alamat" value="{{ $data_diri['alamat'] }}">
                <input type="hidden" name="email" value="{{ $data_diri['email'] }}">

                <div class="form-items">
                    <label for="username" class="poppins-bold">Username</label>
                    <span>:</span>
                    <input type="text" name="username" id="username">
                </div>
                <div class="form-items">
                    <label for="password" class="poppins-bold">Password</label>
                    <span>:</span>
                    <input type="password" name="password" id="password">
                </div>
                <div class="form-items">
                    <label for="conf_password" class="poppins-bold">Ulangi Password</label>
                    <span>:</span>
                    <input type="password" name="conf_password" id="conf_password">
                </div>
                <button class="btn-next poppins-bold">Selanjutnya</button>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
