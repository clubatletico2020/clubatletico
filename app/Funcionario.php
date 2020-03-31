<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'funcionarios';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'url',
        'cargo',
        'tipo_funcionario_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];

    /*Desactiva los campos created_at y updated_at de la tabla*/
    public $timestamps = true;

    public function tipo_funcionario()
    {
        return $this->belongsTo('App\TipoFuncionario');
    }
}
