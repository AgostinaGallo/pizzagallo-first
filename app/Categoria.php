<?php

namespace pizzagallo;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';
    protected $primaryKey='idcategoria';
    public $timestamps=false;

    // campo tipo Fillable para llenar registros
    // Array con los campos que recibiran un valor para almacenarlos en la bd
    protected $fillable =[
        'nombre',
        'descripcion',
        'condicion'
    ];

    // campo tipo Guarded para especificar datos que NO se asignaran al modelo
    protected $guarded =[

    ];

}
