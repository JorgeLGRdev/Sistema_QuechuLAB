<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'resultado',
        'parametro',
        'unidades',
        'val_ref_texto',
        'val_ref_inicial',
        'val_ref_final',
        'estudio_id',
        'detalle_orden_id',
    ];
}
