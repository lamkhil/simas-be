<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuantitasAir extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function titik_pantau()
    {
        return $this->belongsTo(TitikPantau::class);
    }
}
