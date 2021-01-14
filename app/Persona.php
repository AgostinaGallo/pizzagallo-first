<?php

namespace pizzagallo;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='persona';
    protected $primaryKey='idpersona';
    public $timestamps=false;

    // campo tipo Fillable para llenar registros
    // Creo un array con los campos que recibiran un valor para almacenarlos en la bd
    protected $fillable =[
        'tipo_persona',
        'nombre',
        'tipo_documento',
		'num_documento',
		'direccion',
		'telefono',
		'email',
		'fecha_nacimiento'
    ];

    // campo tipo Guarded para especificar datos que NO se asignaran al modelo
    protected $guarded =[

    ];

}
