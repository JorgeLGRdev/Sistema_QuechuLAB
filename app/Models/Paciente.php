<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'apellido_paterno',
        'apellido_materno',
        'nombre',
        'sexo',
        'fecha_nacimiento',
    ];
}
