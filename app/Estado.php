<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //use HasFactory;
    protected $fillable = [
        'nombre','clave'
    ];

    public function ciudades(){
        return $this->hasMany('App\Ciudad','id_estado');
    }
}
