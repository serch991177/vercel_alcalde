<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propuestas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "propuestas";
    protected $primaryKey = 'id_propuesta';

    protected $fillable = [
        'nombre_completo',
        'dni',
        'celular',
        'correo',
        'ubicacion',
        'documento_propuesta',
        'mensaje',
        'me_gustas',
        'visitas',
        'id_categorias',
        'estado',
        'fecha_registro',
        'genero',
        'edad'
    ];
}
