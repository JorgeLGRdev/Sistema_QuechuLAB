<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Orden extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'doctor',
        'estado',
        'paciente_id',
    ];
}
