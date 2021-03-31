<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

class Modulo extends Model
{
    protected $fillable = [
        'nombre','clave','vista'
    ];

    public function accesos(){
        return $this->hasMany('App\Acceso','id_modulo');
    }

    // public static function boot() {
    //     parent::boot();
    //     static::created(function($modulo) {
    //         Event::fire('modulo.created', $modulo);
    //     });
    //     static::updated(function($modulo) {
    //         event('modulo.updated', $modulo);
    //     });
    //     static::deleted(function($modulo) {
    //         Event::fire('modulo.deleted', $modulo);
    //     });
	// }
}
