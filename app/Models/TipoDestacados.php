<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDestacados extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tipo_destacado";
    protected $primaryKey = 'id_tipo_destacado';

    protected $fillable = [
        'nombre_tpo_destacado',
        'estado'
    ];
}
