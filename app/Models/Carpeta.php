<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carpeta extends Model
{
    // use HasFactory;
    protected $table='carpeta';
    public $timestamps=false;
    protected $fillable = [
        'is_carpeta',
        'nombre',
        'descripcion',
        'fecha_creacion',
        'id_dependencia',
        'id_subdependencia'
    ];
}
