<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevistas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "entrevistas";
    protected $primaryKey = 'id_entrevistas';

    protected $fillable = [
        'titulo_entrevista',
        'descripcion_entrevista',
        'link_entrevista',
        'id_categorias',
        'me_gustas',
        'visitas',
        'fecha_registro',
        'estado'
    ];
}
