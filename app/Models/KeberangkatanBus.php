<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeberangkatanBus extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function tujuan_bus()
    {
        return $this->belongsTo(TujuanBus::class);
    }
}
