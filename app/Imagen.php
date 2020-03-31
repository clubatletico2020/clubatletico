<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{   
    protected $table = 'imagenes';

    protected $fillable = [
    	'url', 'galeria_id',
    ];

    public function galeria()
    {
        return $this->belongsTo('App\Galeria');
    }
	
}
