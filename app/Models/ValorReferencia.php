<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorReferencia extends Model
{
    use HasFactory;

    protected $fillable= [
        'sexo',
        'edad_inicial',
        'periodo_inicial',
        'edad_final',
        'periodo_final',
        'valor_texto',
        'valor_inicial',
        'valor_final',
        'nota_predefinida',
        'altura_inicial',
        'altura_final',
        'estudio_id'
    ];
}
