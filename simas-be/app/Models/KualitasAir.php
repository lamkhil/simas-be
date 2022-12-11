<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KualitasAir extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function titik_pantau(){
        return $this->belongsTo(TitikPantau::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function waktu_sample(){
        return $this->belongsTo(WaktuSampling::class);
    }
}
