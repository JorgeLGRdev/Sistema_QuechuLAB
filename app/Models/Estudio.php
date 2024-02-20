<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'precio',
        'contenedor',
        'metodo',
        'abreviatura',
        'unidades',
        'tipo_muestra',
        'sexo',
        'horas_proceso',
        'dias_entrega',
        'reporte_especial',
        'area_id',
    ];
}
