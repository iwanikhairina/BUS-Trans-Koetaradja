<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    public function send(Request $request)
    {
        $newData = [
            "nama" => $request->nama,
            "email" => $request->email,
            "kritik" => $request->kritik,
            "saran" => $request->saran,
            "rating" => $request->rating,
            "alasan" => $request->alasan,
        ];

        KritikSaran::create($newData);
        return redirect()->route("services");
    }

    public function balas(Request $request, KritikSaran $kritikSaran)
    {
        $kritikSaran->update([
            "ditanggapi" => true,
            "balasan" => $request->balasan
        ]);
        return back();
    }
}
