<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "imagenes";
    protected $primaryKey = 'id_imagenes';

    protected $fillable = [
        'titulo_imagen',
        'descripcion_imagen',
        'id_categorias',
        'me_gustas',
        'visitas',
        'fecha_registro',
        'estado'
    ];
}
