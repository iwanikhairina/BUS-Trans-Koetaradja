<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalBus extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function tujuan_bus()
    {
        return $this->hasMany(TujuanBus::class);
    }
}
