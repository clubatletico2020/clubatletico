<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $fillable = [
    	'nombre'
    ];

    public function imagen()
    {
        return $this->hasMany('App\Imagen');
    }
}
