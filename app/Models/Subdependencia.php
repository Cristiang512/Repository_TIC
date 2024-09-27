<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdependencia extends Model
{
    // use HasFactory;
    protected $table='subdependencia';
    public $timestamps=false;
    protected $fillable = [
        'id_subdependencia',
        'nombre',
        'id_dependencia'
    ];
}
