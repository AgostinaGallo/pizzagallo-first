<?php

namespace pizzagallo;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table='detalle_ingreso';
    protected $primaryKey='iddetalle_ingreso';
    public $timestamps=false;

    // campo tipo Fillable para llenar registros
    // Array con los campos que recibiran un valor para almacenarlos en la bd
    protected $fillable =[
        'idingreso',
        'idarticulo',
        'cantidad',
		'precio_compra',
		'precio_venta',
		'idpedido'
    ];

    // campo tipo Guarded para especificar datos que NO se asignaran al modelo
    protected $guarded =[

    ];
}
