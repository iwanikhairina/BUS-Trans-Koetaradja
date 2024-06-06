<?php

namespace App\Http\Controllers;

use App\Models\JadwalBus;
use App\Models\KeberangkatanBus;
use App\Models\TujuanBus;
use Illuminate\Http\Request;

class JadwalBusController extends Controller
{
    public function index()
    {
        return view("jadwal-bus", [
            "data" => JadwalBus::all(),
            "data_detail" => "Jadwal Bus",
        ]);
    }

    public function addPage()
    {
        return view("jadwal-bus-add", [
            "data" => JadwalBus::all(),
            "data_detail" => "Tambah Koridor",
        ]);
    }

    public function create(Request $request)
    {
        $newData = [
            "nama_koridor" => $request->nama_koridor,
            "nama_rute" => $request->nama_rute,
        ];
        JadwalBus::create($newData);
        $id = JadwalBus::latest()->first()->id;
        return redirect()->route("services.jadwal-bus.detail", ["jadwalBus" => $id]);
    }

    public function createTujuan(Request $request)
    {
        if ($request->tujuan_id) {
            TujuanBus::find($request->tujuan_id)->update(["nama_tujuan" => $request->nama_tujuan]);
            KeberangkatanBus::where("tujuan_bus_id", $request->tujuan_id)->delete();

            $array_keberangkatan = array_slice($request->all(), 4);
            if (sizeof($array_keberangkatan) < 3) {
                $keberangkatan = [
                    "tujuan_bus_id" => TujuanBus::find($request->tujuan_id)->id,
                    "waktu_keberangkatan" => $request->waktu_keberangkatan_0,
                    "nama_bus" => $request->nama_bus_0,
                ];
                KeberangkatanBus::create($keberangkatan);
            } else {
                $array_keberangkatan = array_chunk($array_keberangkatan, ceil(count($array_keberangkatan) / (sizeof($array_keberangkatan) / 2)));
                foreach ($array_keberangkatan as $value) {
                    $keberangkatan = [
                        "tujuan_bus_id" => TujuanBus::find($request->tujuan_id)->id,
                        "waktu_keberangkatan" => $value[0],
                        "nama_bus" => $value[1],
                    ];
                    KeberangkatanBus::create($keberangkatan);
                }
            }
        } else {
            $tujuan = [
                "jadwal_bus_id" => $request->jadwal_bus_id,
                "nama_tujuan" => $request->nama_tujuan,
            ];
            TujuanBus::create($tujuan);

            $array_keberangkatan = array_slice($request->all(), 3);
            if (sizeof($array_keberangkatan) < 3) {
                $keberangkatan = [
                    "tujuan_bus_id" => TujuanBus::latest()->first()->id,
                    "waktu_keberangkatan" => $request->waktu_keberangkatan,
                    "nama_bus" => $request->nama_bus,
                ];
                KeberangkatanBus::create($keberangkatan);
            } else {
                $array_keberangkatan = array_chunk($array_keberangkatan, ceil(count($array_keberangkatan) / (sizeof($array_keberangkatan) / 2)));
                foreach ($array_keberangkatan as $value) {
                    $keberangkatan = [
                        "tujuan_bus_id" => TujuanBus::latest()->first()->id,
                        "waktu_keberangkatan" => $value[0],
                        "nama_bus" => $value[1],
                    ];
                    KeberangkatanBus::create($keberangkatan);
                }
            }
        }

        return back();
    }

    public function detail(JadwalBus $jadwalBus)
    {

        return view("jadwal-bus-detail", [
            "data" => JadwalBus::all(),
            "data_tujuan" => $jadwalBus->tujuan_bus,
            "data_bus_selected" => $jadwalBus,
            "data_detail" => $jadwalBus->nama_koridor,
        ]);
    }

    public function getDetailTujuan(Request $request)
    {
        $id = $request->tujuan_id;
        $tujuan = TujuanBus::find($id);
        $jadwal = $tujuan->keberangkatan_bus;
        return response()->json([
            "tujuan" => $tujuan,
        ]);
    }

    public function edit(Request $request, JadwalBus $jadwalBus)
    {
        $jadwalBus->update([
            "nama_koridor" => $request->nama_koridor,
            "nama_rute" => $request->nama_rute,
        ]);
        return back();
    }

    public function deleteTujuanBus(TujuanBus $tujuanBus)
    {
        $tujuanBus->delete();
        KeberangkatanBus::where("tujuan_bus_id", $tujuanBus->id)->delete();
        return back();
    }

    public function deleteKoridor(JadwalBus $jadwalBus)
    {
        $jadwalBus->delete();
        TujuanBus::where("jadwal_bus_id", $jadwalBus->id)->delete();
        return redirect()->route("services.jadwal-bus");
    }
}
