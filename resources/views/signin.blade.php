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
            background-image: linear-gradient(white 20%, rgba(255, 255, 255, 0.7));
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
            flex: 0.7;
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

        .bottom {
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
            color: #292477;
        }

        .bottom a {
            color: #292477;
        }
    </style>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid bg-image" style="background-image: url('{{ asset('img/bg-image.png') }}')">
        <div class="relative-content">
            <h1 class="welcome poppins-black">SELAMAT DATANG DI WEB TRANS KOETARADJA</h1>
            <p class="text-center please mt-3">Silahkan masukkan <br>Username dan Password anda :</p>
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
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
                <button class="btn-next poppins-bold">Masuk</button>
            </form>
            <div class="bottom">
                <a class="text-decoration-none poppins-bold" href="">Lupa Password</a>
                <p>Belum punya akun? <a href="{{ route('register.show') }}" class="text-decoration-none poppins-bold">Buat
                        Akun</a></p>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
