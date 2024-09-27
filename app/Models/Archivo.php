<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    // use HasFactory;
    protected $table='archivo';
    public $timestamps=false;
    protected $fillable = [
        'id_archivo',
        'nombre',
        'fecha_subida',
        'id_carpeta'
        // 'id_dependencia',
        // 'id_subdependencia'
    ];
}
