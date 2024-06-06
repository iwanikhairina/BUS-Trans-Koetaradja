@extends('layouts.second')

@section('style')
    <style>
        .content {
            padding-top: 70px;
        }

        .content header {
            background-color: #C6D3ED;
            display: flex;
            gap: 20px;
        }

        header .header-left {
            padding: 40px 30px;
            flex: 1;
        }

        header .header-left h1 {
            color: #443D8F;
            text-align: center;
        }

        header .header-left p {
            margin-top: 20px;
            color: black;
            text-align: justify;
        }

        header .header-right {
            flex: 1;
        }

        .contact-us {
            display: flex;
            justify-content: center;
            gap: 70px;
            margin-top: -200px;
        }

        .contact-us .contact-us-item {
            width: 350px;
            padding: 20px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, .3);
            border-radius: 10px;
            background-color: #fff;
        }

        .contact-us .contact-us-item .logo {
            height: 150px;
            display: flex;
            justify-content: center;
        }

        .contact-us .contact-us-item .logo img {
            transform: scale(0.6)
        }

        .contact-us .contact-us-item h1 {
            color: black;
            text-align: center;
            font-size: 25px;
        }

        .contact-us .contact-us-item p {
            color: black;
            text-align: center;
            font-size: 15px;
        }

        .contact-us .contact-us-item a.telp {
            color: black;
            display: block;
            text-align: center;
            font-size: 20px;
            text-decoration: none;
        }

        .contact-us .contact-us-item a.kontak {
            display: block;
            background-color: #F3B872;
            color: black;
            padding: 5px 40px;
            border-radius: 12px;
            text-decoration: none;
            margin: 0 auto;
            width: fit-content;
        }

        .form-saran {
            margin-top: 20px;
            padding: 30px 200px;
            position: relative;
        }

        .form-saran .logo-saran {
            position: absolute;
            left: -70px;
        }

        .form-saran .logo-saran img {
            width: 200px;
        }

        .form-saran h1 {
            color: black;
            text-shadow: 0px 3px 4px rgba(0, 0, 0, .25);
        }

        .form-saran form {
            width: 100%;
            margin-top: 20px;
        }

        .form-saran form .group {
            display: flex;
            gap: 15px;
        }

        .form-saran form .group input {
            width: 100%;
            background-color: #D9D9D9;
            outline: none;
            border: none;
            color: black;
            padding: 10px 15px;
        }

        .form-saran form .group input::placeholder {
            color: #898282;
        }

        .form-saran form textarea {
            margin-top: 20px;
            resize: none;
            width: 100%;
            height: 100px;
            background-color: #D9D9D9;
            outline: none;
            border: none;
            color: black;
            padding: 10px 15px;
        }

        .form-saran form .rating {
            margin-top: 10px;
        }

        .form-saran form .rating span {
            color: black;
            font-size: 20px;
        }

        .form-saran form .rating .star {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }

        .form-saran form .rating .star i {
            font-size: 40px;
            cursor: pointer;
            transition: 300ms;
        }

        .form-saran form .rating .star i:not(.selected):hover {
            color: rgba(255, 255, 0, 0.575);
        }

        .form-saran form .action {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .form-saran form .action button {
            border: none;
            radius: 10px;
            padding: 5px 30px;
            color: white;
            background-color: #7A7DB9;
        }

        .selected {
            color: yellow !important;
        }

        .hover-star {
            color: rgba(255, 255, 0, 0.575);
        }
    </style>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="content">
        <header>
            <div class="header-left">
                <h1 class="poppins-bold">KONTAK KAMI</h1>
                <p>Trans Koetaradja selalu berusaha memberikan pelayanan yang terbaik kepada masyarakat kota Banda Aceh dan
                    sekitarnya. Guna menunjang pelayanan kami maka berikut adalah pusat informasi kami. Silahkan hubungi
                    call center kami guna menyampaikan informasi terkait pelayanan Trans Koetaradja. </p>
            </div>
            <div class="header-right">
                <img src="{{ asset('img/Rectangle 16.png') }}" alt="">
            </div>
        </header>

        <div class="contact-us">
            <div class="contact-us-item">
                <div class="logo">
                    <img src="{{ asset('img/Rectangle 20.png') }}" alt="">
                </div>
                <h1 class="poppins-semibold">Hubungi Kami</h1>
                <p>Jika dalam perjalanan anda merasa terganggu silahkan huungi nomor dibawah ini.</p>
                <a class="telp poppins-semibold" href="">+6277-3276-344</a>
            </div>
            <div class="contact-us-item">
                <div class="logo">
                    <img src="{{ asset('img/Rectangle 21.png') }}" alt="">
                </div>
                <h1 class="poppins-semibold">Hubungi Kami</h1>
                <p>Jika dalam perjalanan anda merasa terganggu silahkan huungi nomor dibawah ini.</p>
                <a class="kontak" href="">Kontak</a>
            </div>
        </div>

        <div class="form-saran">
            <div class="logo-saran">
                <img src="{{ asset('img/Group 15.png') }}" alt="">
            </div>
            <h1 class="poppins-semibold">KOTAK SARAN</h1>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="group">
                    <input type="text" placeholder="Nama" name="nama" id="nama">
                    <input type="text" placeholder="Email" name="email" id="email">
                </div>
                <textarea name="kritik" id="kritik" placeholder="Kritik"></textarea>
                <textarea name="saran" id="saran" placeholder="Saran"></textarea>
                <input type="hidden" name="rating">
                <div class="rating">
                    <span>Kepuasaan Anda</span>
                    <div class="star">
                        <i data-rating="1" class="btn-rating fas fa-star"></i>
                        <i data-rating="2" class="btn-rating fas fa-star"></i>
                        <i data-rating="3" class="btn-rating fas fa-star"></i>
                        <i data-rating="4" class="btn-rating fas fa-star"></i>
                        <i data-rating="5" class="btn-rating fas fa-star"></i>
                    </div>
                </div>
                <textarea name="alasan" placeholder="Alasan" id="alasan"></textarea>
                <div class="action">
                    <button>Kirim</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('script')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(".btn-rating").on("click", function() {
            const value = $(this).attr("data-rating");
            const intValue = parseInt(value);
            $("input[name=rating]").val(value);
            $(".btn-rating").removeClass("selected");
            for (let i = 1; i <= intValue; i++) {
                $(`.btn-rating[data-rating=${i}]`).addClass("selected");
            }
        });

        $(".btn-rating").on("mouseenter", function() {
            const intValue = parseInt($(this).attr("data-rating"));
            for (let i = 1; i <= intValue; i++) {
                $(`.btn-rating[data-rating=${i}]`).addClass("hover-star");
            }
        });

        $(".btn-rating").on("mouseleave", function() {
            const intValue = parseInt($(this).attr("data-rating"));
            for (let i = 1; i <= intValue; i++) {
                $(`.btn-rating[data-rating=${i}]`).removeClass("hover-star");
            }
        });
    </script>
@endsection
