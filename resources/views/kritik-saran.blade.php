@extends('layouts.user')

@section('style')
    <style>
        .bg-image {
            background-image: url("img/bg-image.png");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh !important;
            padding: 0;
        }

        .bg-image::after {
            content: "";
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            height: 100vh;
            background-image: linear-gradient(rgba(255, 255, 255, 0.5) 10%, rgba(0, 0, 0, 0.8) 90%);
        }

        .relative-content {
            padding-top: 70px;
            position: relative;
            z-index: 99;
        }

        .sub-navbar {
            margin-top: 10px;
            display: flex;
            background-color: #4e429e !important;
        }

        .sub-navbar .item {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            color: white;
            gap: 10px;
            cursor: pointer;
        }

        .sub-navbar .item.active {
            background-color: #443b83 !important;
        }

        .sub-navbar .item:hover {
            background-color: #443b83 !important;
        }

        .sub-navbar .item .notif {
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-content: center;
            background-color: white;
            color: #4e429e;
            border-radius: 5px;
            font-size: 12px;
        }

        .content {
            padding: 25px;
            height: calc(100vh - 140px);
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-y: auto;
            gap: 20px;
        }

        .comment {
            background-color: white;
            border-radius: 40px;
            border: 5px solid #4e429e;
            padding: 30px;
            width: 80%;
            display: flex;
            height: fit-content;
            gap: 10px;
        }

        .comment .left img {
            width: 150px;
            height: 150px;
            transform: scale(1.3);
        }

        .comment .right {
            width: 100%;
        }

        .comment .right .name h1 {
            color: black;
            font-size: 30px;
        }

        .comment .right .kritik-saran {
            display: flex;
            flex-direction: column;
            gap: 5px;
            color: black;
        }

        .comment .right .action {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .comment .right .balasan {
            margin-top: 20px;
            background-color: #443b83;
            color: white;
            border-radius: 15px;
            padding: 15px;
            padding-bottom: 5px !important;
        }
    </style>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid bg-image" style="background-image: url('{{ asset('img/bg-image.png') }}')">
        <div class="relative-content">
            <div class="sub-navbar">
                <a href="{{ route('kritik-saran') }}"
                    class="text-decoration-none item {{ request()->is('kritik-saran') ? 'active' : '' }}">
                    <span class="title">Kotak Masuk</span>
                    <span class="poppins-semibold notif">{{ $jumlah_notif }}</span>
                </a>
                <a href="{{ route('kritik-saran.ditanggapi') }}"
                    class="text-decoration-none item {{ request()->is('kritik-saran/ditanggapi') ? 'active' : '' }}">
                    <span class="title">Tertanggapi</span>
                </a>
            </div>
            <div class="content">
                @foreach ($kritik_saran as $kr)
                    <div class="comment">
                        <div class="left">
                            <img src="{{ asset('img/icon-profile.png') }}" alt="">
                        </div>
                        <div class="right">
                            <div class="name">
                                <h1 class="poppins-bold">{{ $kr->nama }}</h1>
                            </div>
                            <div class="kritik-saran">
                                <span class="poppins-semibold">Kritik : {{ $kr->kritik }}</span>
                                <span class="poppins-semibold">Saran : {{ $kr->saran }}</span>
                            </div>
                            @if ($tampil_balasan)
                                <div class="balasan">
                                    <p>{{ $kr->balasan }}</p>
                                </div>
                            @else
                                <div class="action">
                                    <button data-id="{{ $kr->id }}" type="button" data-toggle="modal"
                                        data-target="#exampleModal" class="btn-beri-balasan btn-sm btn-success">Beri
                                        Tanggapan</button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Berikan Balasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="formBalasan">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="form-label">Pesan</label>
                        <input type="text" name="balasan" id="balasan" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Balas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(".btn-beri-balasan").on("click", function() {
            const id = $(this).attr("data-id");
            $("#formBalasan").attr("action", `/kritik-saran/balas/${id}`);
        });
    </script>
@endsection
