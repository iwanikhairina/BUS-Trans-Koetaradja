<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanBus extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function jadwal_bus()
    {
        return $this->belongsTo(JadwalBus::class);
    }

    public function keberangkatan_bus()
    {
        return $this->hasMany(KeberangkatanBus::class);
    }
}
