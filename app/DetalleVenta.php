<?php

namespace pizzagallo;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table='detalle_venta';
    protected $primaryKey='iddetalle_venta';
    public $timestamps=false;

    // campo tipo Fillable para llenar registros
    // Array con los campos que recibiran un valor para almacenarlos en la bd
    protected $fillable =[
        'iddventa', // foránea de tabla 'venta'
        'idarticulo',
        'cantidad',
		'precio_venta',
		'descuento',
		'idpedido'
    ];

    // campo tipo Guarded para especificar datos que NO se asignaran al modelo
    protected $guarded =[

    ];
}
