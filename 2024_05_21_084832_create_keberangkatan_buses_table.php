<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keberangkatan_buses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tujuan_bus_id");
            $table->string("waktu_keberangkatan");
            $table->string("nama_bus");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keberangkatan_buses');
    }
};
