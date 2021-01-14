<?php

namespace pizzagallo;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='articulo';
    protected $primaryKey='idarticulo';
    public $timestamps=false;

    // campo tipo Fillable para llenar registros
    // Creo un array con los campos que recibiran un valor para almacenarlos en la bd
    protected $fillable =[
        'idcategoria', // hago referencia a la tabla categoria
        'codigo',
        'nombre',
        'stock',
        'descripcion',
        'imagen',
        'estado'
    ];

    // campo tipo Guarded para especificar datos que NO se asignaran al modelo
    protected $guarded =[

    ];  
}
