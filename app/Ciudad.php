<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public $table = "ciudades";
    protected $fillable = [
        'clave','nombre','id_estado'
    ];
    public function estados(){
        return $this->belongsTo('App\Estado','id_estado');
    }
}