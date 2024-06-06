<?php

namespace App\Http\Controllers;

use App\Models\TitikHalte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TitikHalteController extends Controller
{
    public function index()
    {
        $titikHalte = TitikHalte::all();
        return view("titik-halte", [
            "data_detail" => "Titik Halte",
            "titik_halte" => $titikHalte
        ]);
    }

    public function addPage()
    {
        return view("titik-halte-add", [
            "titik_halte" => TitikHalte::all(),
            "data_detail" => "Tambah Rute",
        ]);
    }

    public function create(Request $request)
    {
        $newData = [
            "nama_rute" => $request->nama_rute,
        ];
        if ($file = $request->file("gambar_rute")) {
            $extension = $file->extension();
            $name = date("YmdHis") . "_titik_halte" . ".{$extension}";
            $file->move(public_path("uploads"), $name);
            $newData["gambar_rute"] = $name;
        }
        TitikHalte::create($newData);
        return back();
    }

    public function edit(Request $request, TitikHalte $titikHalte)
    {
        $newData = [
            "nama_rute" => $request->nama_rute,
        ];
        if ($file = $request->file("gambar_rute")) {
            $extension = $file->extension();
            $name = date("YmdHis") . "_titik_halte" . ".{$extension}";
            $file->move(public_path("uploads"), $name);
            $newData["gambar_rute"] = $name;
        }
        $titikHalte->update($newData);
        return back();
    }

    public function delete(TitikHalte $titikHalte)
    {
        $file = $titikHalte->gambar_rute;
        File::delete(public_path("uploads") . "/{$file}");
        $titikHalte->delete();
        return redirect()->route("services.titik-halte");
    }

    public function detail(TitikHalte $titikHalte)
    {
        return view("titik-halte-detail", [
            "titik_halte_selected" => $titikHalte,
            "titik_halte" => TitikHalte::all(),
            "data_detail" => $titikHalte->nama_rute,
        ]);
    }
}
