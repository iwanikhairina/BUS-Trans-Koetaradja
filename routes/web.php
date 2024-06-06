<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalBusController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TitikHalteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/login", [AuthController::class, "showLogin"])->name("login.show");
Route::post("/login", [AuthController::class, "login"])->name("login.process");
Route::get("/register", [AuthController::class, "showRegister"])->name("register.show");
Route::post("/register/next", [AuthController::class, "showRegisterNext"])->name("register.show.next");
Route::post("/register", [AuthController::class, "register"])->name("register.process");
Route::get("/register/successfully", [AuthController::class, "registerSuccessfully"])->name("register.successfully");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");

Route::get("/services", [PageController::class, "services"])->name("services");

Route::get("/services/jadwal-bus", [JadwalBusController::class, "index"])->name("services.jadwal-bus");
Route::get("/services/jadwal-bus/add", [JadwalBusController::class, "addPage"])->name("services.jadwal-bus.add-page");
Route::post("/services/jadwal-bus/add", [JadwalBusController::class, "create"])->name("services.jadwal-bus.add");
Route::post("/services/jadwal-bus/tujuan-bus/add", [JadwalBusController::class, "createTujuan"])->name("services.jadwal-bus.tujuan-bus.add");
Route::put("/services/jadwal-bus/{jadwalBus}", [JadwalBusController::class, "edit"])->name("services.jadwal-bus.edit");
Route::get("/services/jadwal-bus/{jadwalBus}", [JadwalBusController::class, "detail"])->name("services.jadwal-bus.detail");
Route::delete("/services/jadwal-bus/{jadwalBus}", [JadwalBusController::class, "deleteKoridor"])->name("services.jadwal-bus.delete");
Route::delete("/services/jadwal-bus/tujuan-bus/{tujuanBus}", [JadwalBusController::class, "deleteTujuanBus"])->name("services.jadwal-bus.tujuan-bus.delete");

Route::get("/services/titik-halte", [TitikHalteController::class, "index"])->name("services.titik-halte");
Route::get("/services/titik-halte/add", [TitikHalteController::class, "addPage"])->name("services.titik-halte.add-page");
Route::post("/services/titik-halte/add", [TitikHalteController::class, "create"])->name("services.titik-halte.add");
Route::put("/services/titik-halte/{titikHalte}", [TitikHalteController::class, "edit"])->name("services.titik-halte.edit");
Route::get("/services/titik-halte/{titikHalte}", [TitikHalteController::class, "detail"])->name("services.titik-halte.detail");
Route::get("/services/titik-halte/delete/{titikHalte}", [TitikHalteController::class, "delete"])->name("services.titik-halte.delete");

Route::get("/contact", [PageController::class, "contact"])->name("contact");
Route::post("/contact/send", [KritikSaranController::class, "send"])->name("contact.send");

Route::get("/kritik-saran", [PageController::class, "kritikSaran"])->name("kritik-saran");
Route::get("/kritik-saran/ditanggapi", [PageController::class, "kritikSaranDitanggapi"])->name("kritik-saran.ditanggapi");
Route::post("/kritik-saran/balas/{kritikSaran}", [KritikSaranController::class, "balas"])->name("kritik-saran.balasan");
Route::get("/penilaian", [PageController::class, "penilaian"])->name("penilaian");
Route::get("/penilaian/kemarin", [PageController::class, "penilaianKemarin"])->name("penilaian.kemarin");

// AJAX
Route::post("/getDetailTujuan", [JadwalBusController::class, "getDetailTujuan"]);
