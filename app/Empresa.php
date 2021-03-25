<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nombre','rfc','direccion','telefono','correo','logo'
    ];
}
