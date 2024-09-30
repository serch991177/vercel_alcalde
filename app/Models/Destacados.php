<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destacados extends Model
{
    use HasFactory;
    protected $table = "destacados";
    protected $primaryKey = 'id_destacados';

    protected $fillable = [
        'nombre_destacado',
        'id_imagenes',
        'id_entrevistas',
        'id_proyectos',
        'id_noticias',
        'id_tipo_destacado',
        'estado'
    ];
}
