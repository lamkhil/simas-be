<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitikPantau extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function kualitas(){
        return $this->hasMany(KualitasAir::class);
    }

    public function kuantitas(){
        return $this->hasMany(KuantitasAir::class);
    }

    public function foto(){
        return $this->hasMany(FotoTitikPantau::class);
    }   
}
