<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $fillable = [
        'nombre','clave','vista'
    ];

    public function accesos(){
        return $this->hasMany('App\Acceso','id_modulo');
    }
}
