<?php

namespace pizzagallo;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table='ingreso';
    protected $primaryKey='idingreso';
    public $timestamps=false;

    // campo tipo Fillable para llenar registros
    // Array con los campos que recibiran un valor para almacenarlos en la bd
    protected $fillable =[
        'idproveedor',
        'tipo_comprobante',
        'serie_comprobante',
		'num_comprobante',
		'fecha_hora',
		'impuesto',
		'estado',
    ];

    // campo tipo Guarded para especificar datos que NO se asignaran al modelo
    protected $guarded =[

    ];

}
