<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biografia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "biografia";
    protected $primaryKey = 'id_biografia';

    protected $fillable = [
        'biografia_spanish',
        'biografia_english',
        'estado'
    ];
}
