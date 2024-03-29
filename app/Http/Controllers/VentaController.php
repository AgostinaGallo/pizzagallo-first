<?php

namespace pizzagallo\Http\Controllers;

use Illuminate\Http\Request;

use pizzagallo\Http\Requests;

use Illuminate\Support\Facades\Redirect; // Redirecciones
use Illuminate\Support\Facades\Input; // Inputs
use pizzagallo\Http\Requests\VentaFormRequest; // Request/validacion de venta
use pizzagallo\Venta; # Modelo  Venta
use pizzagallo\Articulo; # Modelo  Venta
use pizzagallo\DetalleVenta; # Modelo  DetalleVenta
use DB; # Funciones de Bases de Datos

use Carbon\Carbon; # Formato fecha-hora de mi zona horaria
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request) // Si existe request, obtengo todos los registros de la tabla.
		{
			$query=trim($request->get('searchText'));
			$ventas=DB::table('venta as v')
			->join('persona as p', 'v.idcliente','=','p.idpersona')
			->join('detalle_venta as dv','v.idventa','=','dv.idventa')
			->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
			->where('v.num_comprobante','LIKE','%'.$query.'%') // BUSCO por numero de comprobante
			->orderBy('v.idventa','desc') // ORDENO descendiente por idingreso (MAS NUEVO AL MAS VIEJO)
//			 AGRUPO los mismos campos del select
			->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado') 
			->paginate(7);
			return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);
		}
	}
    public function create()
    {
		// CONSULTA por: tipo_persona = Cliente 
		# $personas=DB::table('persona')->where('tipo_persona','=','Cliente')get();
		//  !!Para aceptar que CUALQUIER tipo_persona sea cliente: SACAR el ->where()   

		$personas=DB::table('persona')->get(); // Cualquier tipo_persona será un cliente.

		// Consulta tabla articulo
		$articulos=DB::table('articulo as art')
			// INNER JOIN para traer los articulos comprados en detalle_ingreso
			->leftJoin('detalle_ingreso as di','art.idarticulo','=','di.idarticulo') // !!!! ESTO AGREGUE para que me muestre articulos que NO estan en INGRESO(no comprados), antiguo codigo: ->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
			->join('categoria as c','art.idcategoria','=','c.idcategoria')
			// Promedio todos los precios de venta para establecer 1 precio.
			->select(DB::raw('CONCAT(art.codigo, " ", art.nombre, " (", art.unidad_medida, ")") AS articulo'), 'art.idarticulo', 'art.stock',DB::raw('avg(di.precio_venta) as precio_promedio'))
			->where('c.nombre','!=', 'Insumos') // El articulo a vender NO PUEDE ser tipo Insumo 
			->where('art.estado','=','Activo') // El articulo debe ser activo
			->where('art.stock','>','0') // El stock debe existir
			->groupBy('articulo','art.idarticulo','art.stock') // AGRUPO ya que 'articulo' fue renombrado con calculo precio_promedio(linea58)   
			->get();
			// ENVIO todas las personas(clientes) y todos los articulos
		return view('ventas.venta.create',["personas"=>$personas,"articulos"=>$articulos]);
	}

	public function store(VentaFormRequest $request) // FormRequest valida datos
	{
	// Capturador de excepciones
		try{
			//	(controlo el proceso)
			// Inicio y Finalizo la transacción: para Venta y detalle_venta 
			DB::beginTransaction();
			
			//  Enviaré los datos que recibo del Objeto Formulario
			
			//		VENTA
			$venta=new Venta;
			$venta->idcliente=$request->get('idcliente');
			$venta->tipo_comprobante=$request->get('tipo_comprobante');
			$venta->serie_comprobante=$request->get('serie_comprobante');
			$venta->num_comprobante=$request->get('num_comprobante');
			$venta->total_venta=$request->get('total_venta');

			// Clase carbon zona horaria de mi ubicacion
			$mytime = Carbon::now('America/Argentina/Buenos_Aires');
			$venta->fecha_hora=$mytime->toDateTimeString();
			$venta->impuesto='21';
			$venta->estado='A';
			$venta->save();

			//	  DETALLE_VENTA
			$idarticulo = $request->get('idarticulo');
			$cantidad = $request->get('cantidad');
			$descuento = $request->get('descuento');
			$precio_venta = $request->get('precio_venta');

				/* RECORRO array de valores de DETALLE_INGRESO, 
				creando un objeto del modelo DetalleIngreso() */
			$cont = 0;
			while($cont < count($idarticulo)){
				$detalle = new DetalleVenta(); // Referencia Clase DetalleVenta
				$detalle->idventa = $venta->idventa; 
				$detalle->idarticulo = $idarticulo[$cont];
				$detalle->cantidad = $cantidad[$cont];
				$detalle->descuento = $descuento[$cont];
				$detalle->precio_venta = $precio_venta[$cont];
				$detalle->save();
				$cont=$cont+1;

				$articulo = Articulo::find($detalle->idarticulo); 
				$articulo->decrement('stock', $detalle->cantidad);
			}

			DB::commit();


		}catch(\Exception $e)
		{
		// Si existe un error, ANULA toda la transaccion.
			DB::rollback();
		}

		return Redirect::to('ventas/venta');
	}

	

	public function show($id) 	// muestro Venta y su Detalle_Venta mediante $idventa especifico
	{
		// 		VENTA
		$venta=DB::table('venta as v')
			->join('persona as p', 'v.idcliente','=','p.idpersona')
			->join('detalle_venta as dv','v.idventa','=','dv.idventa')
			// no se calcula porque todo se guarda en 'total_venta', tabla 'venta'
			->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado', 'v.total_venta') 
			// busco el venta en especifico
			->where('v.idventa','=',$id)
			->first(); // selecciono la PRIMER venta aparecida.

		// 		DETALLE Venta
		$detalles=DB::table('detalle_venta as dev')
			->join('articulo as a','dev.idarticulo','=','a.idarticulo')
			->select('a.nombre as articulo','dev.cantidad', 'dev.descuento','dev.precio_venta')
			->where('dev.idventa','=',$id)
			->get();

		// VISTA: devuelvo las variables como parametros 
		return view("ventas.venta.show",["venta"=>$venta, "detalles"=>$detalles]);
	}

	public function destroy($id)
	{
		// BUSCA en Modelo por $id especifico. 
		$venta=Venta::findOrFail($id); // selecciona la venta que coincida con la PK y el $id recibido
		// CAMBIA estado a C=cancelado
		$venta->Estado='C';
		$venta->update();
		return Redirect::to('ventas/venta');
	}
}
