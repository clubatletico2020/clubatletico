<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{

    protected $table = 'suscripciones';

    protected $primaryKey = 'id';

    public $incrementing = true;
 
    protected $fillable = [
        'nombre',
        'correo',
    ];
 
    protected $hidden = [
         'remember_token',
    ];
  
    public $timestamps = true;
}
