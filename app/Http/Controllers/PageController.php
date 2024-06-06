<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function services()
    {
        return view("services", [
            "title" => "Layanan Kami",
        ]);
    }

    public function contact()
    {
        return view("contact");
    }

    public function kritikSaran()
    {
        return view("kritik-saran", [
            "kritik_saran" => KritikSaran::where("ditanggapi", false)->orderBy("updated_at", "DESC")->get(),
            "tampil_balasan" => false,
            "jumlah_notif" => KritikSaran::where("ditanggapi", false)->count(),
        ]);
    }

    public function kritikSaranDitanggapi()
    {
        return view("kritik-saran", [
            "kritik_saran" => KritikSaran::where("ditanggapi", true)->orderBy("updated_at", "DESC")->get(),
            "tampil_balasan" => true,
            "jumlah_notif" => KritikSaran::where("ditanggapi", false)->count(),
        ]);
    }

    public function penilaian()
    {
        return view("penilaian", [
            "rating" => KritikSaran::all(),
            "jumlah_notif" => KritikSaran::count(),
        ]);
    }

    public function penilaianKemarin()
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $rating = KritikSaran::whereDate('created_at', $yesterday)->get();

        return view('penilaian', [
            'rating' => $rating,
            'jumlah_notif' => $rating->count(),
        ]);
    }
}
