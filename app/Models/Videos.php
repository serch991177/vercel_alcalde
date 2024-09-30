<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "videos";
    protected $primaryKey = 'id_videos';

    protected $fillable = [
        'titulo_video',
        'descripcion_video',
        'url',
        'id_categorias',
        'me_gustas',
        'visitas',
        'fecha_registro',
        'estado'
    ];
}
