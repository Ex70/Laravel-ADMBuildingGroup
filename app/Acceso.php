<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    protected $fillable = [
        'id_modulo','id_usuario'
    ];
    public function modulos(){
        return $this->belongsTo('App\Modulo','id_modulo');
    }
    public function usuarios(){
        return $this->belongsTo('App\User','id_usuario');
    }
}
