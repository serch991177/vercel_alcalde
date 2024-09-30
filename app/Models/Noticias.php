<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "noticias";
    protected $primaryKey = 'id_noticias';

    protected $fillable = [
        'titulo_noticia',
        'descripcion_noticia',
        'id_categorias',
        'me_gustas',
        'visitas',
        'fecha_registro',
        'estado'
    ];
}
