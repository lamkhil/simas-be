<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuSampling extends Model
{
    use HasFactory;

    protected $guarded=[];

    function kualitas(){
        return $this->hasMany(KualitasAir::class)->with('titik_pantau');
    }
}
