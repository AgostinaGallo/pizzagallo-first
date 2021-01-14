<?php

namespace pizzagallo;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='venta';
    protected $primaryKey='idventa';
    public $timestamps=false;

    // campo tipo Fillable para llenar registros
    // Array con los campos que recibiran un valor para almacenarlos en la bd
    protected $fillable =[
        'idcliente', // foranea - tabla 'persona', tipo 'cliente'
        'tipo_comprobante',
        'serie_comprobante',
		'num_comprobante',
		'fecha_hora',
		'impuesto',
		'total_venta',
		'estado',
    ];

    // campo tipo Guarded para especificar datos que NO se asignaran al modelo
    protected $guarded =[

    ];
}
