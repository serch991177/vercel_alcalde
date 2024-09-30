<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuarios extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "usuarios";
    protected $primaryKey = 'id_usuarios';

    protected $fillable = [
        'nombre_completo',
        'ci',
        'password',
        'estado',
        'email',
        'created_at',
        'updated_at',
        'contrasena_real'
    ];
}
