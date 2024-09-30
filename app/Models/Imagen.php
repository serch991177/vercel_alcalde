<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "imagen";
    protected $primaryKey = 'id_imagen';

    protected $fillable = [
        'titulo_imagen',
        'url',
        'id_imagenes',
        'id_noticias',
        'id_entrevistas',
        'created_at',
        'updated_at',
        'estado'
    ];
}
