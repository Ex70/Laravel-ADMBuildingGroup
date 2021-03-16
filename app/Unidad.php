<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    public $table = "unidades";
    protected $fillable = [
        'clave','descripcion',
    ];
}
