<?php

namespace pizzagallo\Http\Controllers;

use DB;

class CajaController extends Controller
{
    
    public function __construct()
    {

    }

    public function index()
    {
    
        //$query=trim($request->get('searchText')); // Filtro de Busqueda
        // tabla articulo tendra alias 'a'
        $ventas=DB::table('venta as v')
        ->select('v.idventa','v.fecha_hora','v.num_comprobante','v.total_venta')
        ->orderBy('v.fecha_hora','desc') // ORDENO descendiente por idingreso (MAS NUEVO AL MAS VIEJO)
        //			 AGRUPO los mismos campos del select
        ->groupBy('v.idventa','v.fecha_hora') 
        ->paginate(12);

        $ingresos=DB::table('ingreso as i')
        ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
        ->select('i.idingreso','i.fecha_hora','i.num_comprobante', 'i.total_ingreso') // DB::raw('sum(di.cantidad*precio_compra) as total')
        ->orderBy('i.fecha_hora','desc') // ordeno descendiente por idingreso (MAS NUEVO AL MAS VIEJO)
        // agrupo los campos mismos del select
        ->groupBy('i.idingreso','i.fecha_hora') 
        ->paginate(12);

        $saldo = $ventas->sum('total_venta') - $ingresos->sum('total_ingreso');
        //devuelvo la vista en la ubicacion dicha, con los parametros puestos en array
        return view('caja.index',["ingresos"=>$ingresos,"ventas"=>$ventas,"saldo"=>$saldo]);
    }

}


