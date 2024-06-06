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
            width: 224px !important;
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
            width: calc(100vw - 224px);
            flex: auto;
            position: relative;
            z-index: 99;
            padding-top: 70px !important;
            padding: 20px;
        }

        .relative-content img {
            width: 60%;
        }

        .scroll {
            position: relative;
            width: 100%;
            min-height: 200px;
            max-height: calc(100vh - 70px);
            overflow-y: auto;
            padding: 20px;
            padding-left: 100px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .scroll .action {
            position: absolute;
            top: 20px;
            left: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .scroll .jadwal-bus {
            width: 400px;
            border-radius: 15px;
            padding: 15px 0;
            background-color: #C5C6C9;
            height: fit-content;
        }

        .scroll .jadwal-bus .jadwal-bus-header {
            padding: 0 15px;
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .scroll .jadwal-bus .jadwal-bus-header img {
            width: 40px;
        }

        .scroll .jadwal-bus .jadwal-bus-header h1 {
            font-size: 18px;
            transform: translateY(3px);
            color: black;
        }

        .scroll .jadwal-bus .jadwal-bus-body {
            margin-top: 10px;
            padding: 0 10px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .scroll .jadwal-bus .jadwal-bus-body .jadwal-bus-item {
            padding: 15px;
            background-color: #D9D9D9;
            border-radius: 10px;
        }

        .scroll .jadwal-bus .jadwal-bus-body .jadwal-bus-item span {
            color: black;
        }

        .modal-content {
            overflow-y: auto !important;
        }

        .input-modal {
            color: black !important;
        }

        .modal-input-group .modal-input-group-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-input-group-item {
            /* width: 90%; */
        }

        .modal-action {
            width: 100%;
        }

        .modal-action button {
            width: 100%;
        }

        i {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid bg-image" style="background-image: url('{{ asset('img/bg-image.png') }}')">
        <div class="sidebar">
            @foreach ($data as $bus)
                <a class="poppins-{{ $data_bus_selected->id == $bus->id ? 'bold' : '' }}"
                    href="{{ route('services.jadwal-bus.detail', ['jadwalBus' => $bus->id]) }}">
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
            <div class="scroll">
                @if (isAdmin())
                    <div class="action">
                        <button data-koridor-id="{{ $data_bus_selected->id }}" class="btn-hapus-koridor btn-sm btn-danger"
                            type="button" data-toggle="modal" data-target="#hapusModalKoridor">Hapus Data Koridor</button>
                        <button data-koridor-id="{{ $data_bus_selected->id }}"
                            data-nama-koridor="{{ $data_bus_selected->nama_koridor }}"
                            data-nama-rute="{{ $data_bus_selected->nama_rute }}"
                            class="btn-edit-koridor btn-sm btn-primary" type="button" data-toggle="modal"
                            data-target="#updateModalKoridor">Edit Koridor</button>
                        <button class="btn-sm btn-secondary" type="button" data-toggle="modal"
                            data-target="#exampleModal">Tambah
                            Tujuan</button>
                    </div>
                @endif
                @foreach ($data_tujuan as $tujuan)
                    <div class="jadwal-bus">
                        <div class="jadwal-bus-header">
                            <img src="{{ asset('img/bus.png') }}" alt="">
                            <h1>{{ $tujuan->nama_tujuan }}</h1>
                            @if (isAdmin())
                                <i data-tujuan-id="{{ $tujuan->id }}" data-toggle="modal" data-target="#editModal"
                                    class="btn-edit-tujuan fas fa-edit"></i>
                                <i data-tujuan-id="{{ $tujuan->id }}" class="btn-hapus-tujuan fas fa-trash"
                                    data-toggle="modal" data-target="#hapusModal"></i>
                            @endif
                        </div>
                        <div class="jadwal-bus-body">
                            @foreach ($tujuan->keberangkatan_bus as $keberangkatan_bus)
                                <div class="jadwal-bus-item">
                                    <span>{{ "{$keberangkatan_bus->waktu_keberangkatan}, {$keberangkatan_bus->nama_bus}" }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tujuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('services.jadwal-bus.tujuan-bus.add') }}" method="POST">
                    <input type="hidden" name="jadwal_bus_id" value="{{ $data_bus_selected->id }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="nama_tujuan" class="form-label input-modal">Nama Tujuan</label>
                            <input class="form-control input-modal" type="text" name="nama_tujuan" id="nama_tujuan"
                                placeholder="Lamnyong">
                        </div>
                        <hr>
                        <div class="modal-input-group">
                            <div class="modal-input-group-wrap">
                                <div class="mb-2 modal-input-group-item">
                                    <label for="waktu_keberangkatan" class="form-label input-modal">Waktu Keberangkatan
                                    </label>
                                    <input class="form-control input-modal" type="time" name="waktu_keberangkatan"
                                        id="waktu_keberangkatan">
                                </div>
                                <div class="mb-2 modal-input-group-item">
                                    <label for="nama_bus" class="form-label input-modal">Nama Bus
                                    </label>
                                    <input class="form-control input-modal" type="text" name="nama_bus" id="nama_bus"
                                        placeholder="BUS TR 01">
                                </div>
                            </div>
                        </div>
                        <div class="modal-action">
                            <button type="button" class="btn-tambah-keberangkatan btn btn-info mt-2">Tambah
                                Keberangkatan</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Tujuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('services.jadwal-bus.tujuan-bus.add') }}" method="POST">
                    <input type="hidden" name="jadwal_bus_id" value="{{ $data_bus_selected->id }}">
                    <input type="hidden" name="tujuan_id" class="tujuan_id_update">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="nama_tujuan" class="form-label input-modal">Nama Tujuan</label>
                            <input class="form-control input-modal nama-tujuan-update" type="text" name="nama_tujuan"
                                id="nama_tujuan" placeholder="Lamnyong">
                        </div>
                        <hr>
                        <div class="modal-input-group modal-input-group-update">
                            <div class="modal-input-group-wrap">
                                <div class="mb-2 modal-input-group-item">
                                    <label for="waktu_keberangkatan" class="form-label input-modal">Waktu Keberangkatan
                                    </label>
                                    <input class="form-control input-modal" type="time" name="waktu_keberangkatan"
                                        id="waktu_keberangkatan">
                                </div>
                                <div class="mb-2 modal-input-group-item">
                                    <label for="nama_bus" class="form-label input-modal">Nama Bus
                                    </label>
                                    <input class="form-control input-modal" type="text" name="nama_bus"
                                        id="nama_bus" placeholder="BUS TR 01">
                                </div>
                            </div>
                        </div>
                        <div class="modal-action">
                            <button type="button" class="btn-tambah-keberangkatan btn btn-info mt-2">Tambah
                                Keberangkatan</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Koridor Modal -->
    <div class="modal fade" id="updateModalKoridor" tabindex="-1" aria-labelledby="updateModalKoridorLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalKoridorLabel">Update Koridor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="formEditKoridor">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="nama_koridor" class="form-label">Nama Koridor</label>
                            <input class="form-control nama_koridor_update" type="text" name="nama_koridor"
                                id="nama_koridor">
                        </div>
                        <div class="mb-2">
                            <label for="nama_rute" class="form-label">Nama Rute</label>
                            <input class="form-control nama_rute_update" type="text" name="nama_rute" id="nama_rute">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="formHapus">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">apakah anda yakin ingin menghapus data ini?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ya, Hapus!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Koridor Modal -->
    <div class="modal fade" id="hapusModalKoridor" tabindex="-1" aria-labelledby="hapusModalKoridorLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusModalKoridorLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="formHapusKoridor">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">apakah anda yakin ingin menghapus data ini?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ya, Hapus!</button>
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

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

    <script>
        let counter = 1;
        $(document).on("click", ".btn-tambah-keberangkatan", function() {
            $(".modal-input-group").append(`
            <div class="modal-input-group-wrap">
                <div class="mb-2 modal-input-group-item">
                    <label for="waktu_keberangkatan_${counter}" class="form-label input-modal">Waktu Keberangkatan
                    </label>
                    <input class="form-control input-modal" type="time" name="waktu_keberangkatan_${counter}"
                        id="waktu_keberangkatan_${counter}">
                </div>
                <div class="mb-2 modal-input-group-item">
                    <label for="nama_bus_${counter}" class="form-label input-modal">Nama Bus
                    </label>
                    <input class="form-control input-modal" type="text" name="nama_bus_${counter}" id="nama_bus_${counter}"
                        placeholder="BUS TR 01">
                </div>
                <i class="btn-hapus-section fas fa-trash-alt"></i>
            </div>
            `);
            counter++;
        });

        $(document).on("click", ".btn-hapus-section", function() {
            $(this).parent().remove();
        });

        $(document).on("click",
            ".btn-edit-tujuan",
            function() {
                const tujuanId = $(this).attr("data-tujuan-id");

                $.ajaxSetup({
                    "headers": {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/getDetailTujuan",
                    data: {
                        tujuan_id: tujuanId,
                    },
                    beforeSend: function() {
                        $(".nama-tujuan-update").val("Loading...");
                        $(".modal-input-group-update").html("Loading...");
                    },
                    success: function(response) {
                        const tujuan = response.tujuan;
                        const keberangkatanBus = tujuan.keberangkatan_bus;
                        let listKeberangkatan = "";
                        keberangkatanBus.forEach((bus, i) => {
                            listKeberangkatan += `
                            <div class="modal-input-group-wrap">
                                <div class="mb-2 modal-input-group-item">
                                    <label for="waktu_keberangkatan_${i}" class="form-label input-modal">Waktu Keberangkatan
                                    </label>
                                    <input class="form-control input-modal" type="time" name="waktu_keberangkatan_${i}"
                                        id="waktu_keberangkatan_${i}" value="${bus.waktu_keberangkatan}">
                                </div>
                                <div class="mb-2 modal-input-group-item">
                                    <label for="nama_bus_${i}" class="form-label input-modal">Nama Bus
                                    </label>
                                    <input class="form-control input-modal" type="text" name="nama_bus_${i}" id="nama_bus_${i}"
                                        placeholder="BUS TR 01" value="${bus.nama_bus}">
                                </div>
                                ${i > 0 ? '<i class="btn-hapus-section fas fa-trash-alt"></i>' : ''}
                            </div>
                            `;
                        });
                        $(".tujuan_id_update").val(tujuan.id);
                        $(".nama-tujuan-update").val(tujuan.nama_tujuan);
                        $(".modal-input-group-update").html(listKeberangkatan);
                    }
                });
            });

        $(document).on("click", ".btn-hapus-tujuan", function() {
            const id = $(this).attr("data-tujuan-id");
            $("#formHapus").attr("action", `/services/jadwal-bus/tujuan-bus/${id}`);
        });

        $(document).on("click", ".btn-hapus-koridor", function() {
            const id = $(this).attr("data-koridor-id");
            $("#formHapusKoridor").attr("action", `/services/jadwal-bus/${id}`);
        });

        $(document).on("click", ".btn-edit-koridor", function() {
            const id = $(this).attr("data-koridor-id");
            const namaKoridor = $(this).attr("data-nama-koridor");
            const namaRute = $(this).attr("data-nama-rute");
            $(".nama_koridor_update").val(namaKoridor);
            $(".nama_rute_update").val(namaRute);
            $("#formEditKoridor").attr("action", `/services/jadwal-bus/${id}`);
        });
    </script>
@endsection
