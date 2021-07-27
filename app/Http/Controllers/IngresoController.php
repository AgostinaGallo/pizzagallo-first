<?php

namespace pizzagallo\Http\Controllers;

use Illuminate\Http\Request;

use pizzagallo\Http\Requests;
use Illuminate\Support\Facades\Redirect; // Redirecciones
use Illuminate\Support\Facades\Input; // Inputs
use pizzagallo\Http\Requests\PersonaFormRequest; // Request/Validacione Persona
use pizzagallo\Http\Requests\IngresoFormRequest; // Request/Validacione Ingreso
use pizzagallo\Ingreso; // Modelo Ingreso de app/
use pizzagallo\Articulo; // Modelo Articulo de app/
use pizzagallo\DetalleIngreso; // Modelo DetalleIngreso de app/
use DB; // Funciones de Bases de Datos

use Carbon\Carbon; // Para usar formato fecha-hora de mi zona horaria
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        // Si existe request, obtengo todos los registros de la tabla
        if ($request)
		{
			$query=trim($request->get('searchText'));
			$ingresos=DB::table('ingreso as i')
			->join('persona as p', 'i.idproveedor','=','p.idpersona')
			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
			->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado', 'i.total_ingreso') // DB::raw('sum(di.cantidad*precio_compra) as total')
			->where('i.num_comprobante','LIKE','%'.$query.'%') // busco por numero de comprobante
			->orderBy('i.idingreso','desc') // ordeno descendiente por idingreso (MAS NUEVO AL MAS VIEJO)
			// agrupo los campos mismos del select
			->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado') 
			->paginate(7);
			return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
		}
	}
    public function create()
    {
		// consulta por tipo_persona = proveedor
		$personas=DB::table('persona')->where('tipo_persona','=','Proveedor')->get();
		// consulta tabla articulo
		$articulos=DB::table('articulo as art')
			// (Para mostrar) concateno el codigo con nombre de articulo
			->select(DB::raw('CONCAT(art.codigo, " ", art.nombre, " (", art.unidad_medida, ")") AS articulo'), 'art.idarticulo')
			// donde el articulo a mostrar este activo
			->where('art.estado','=','Activo')
			->get();
		return view('compras.ingreso.create',["personas"=>$personas,"articulos"=>$articulos]);
	}

	public function store(IngresoFormRequest $request) // Uso el formRequest para validar los datos
	{
		//		 Capturador de excepciones
		try{
			// inicio y finalizo la transaccion, para ingreso y detalle_ingreso ( controlo el proceso )
			DB::beginTransaction();
			// envio los datos que estoy recibiendo del objeto formulario
			//--- INGRESO
			$ingreso=new Ingreso;
			$ingreso->idproveedor=$request->get('idproveedor');
			$ingreso->tipo_comprobante=$request->get('tipo_comprobante');
			$ingreso->serie_comprobante=$request->get('serie_comprobante');
			$ingreso->num_comprobante=$request->get('num_comprobante');
			$ingreso->total_ingreso=$request->get('total_ingreso');
			// Clase carbon zona horaria de mi ubicacion
			$mytime = Carbon::now('America/Argentina/Buenos_Aires');
			$ingreso->fecha_hora=$mytime->toDateTimeString();
			$ingreso->impuesto='21';
			$ingreso->estado='A';
			$ingreso->save();

			//--- DETALLE_INGRESO
			$idarticulo = $request->get('idarticulo');
			$cantidad = $request->get('cantidad');
			$precio_compra = $request->get('precio_compra');
			$precio_venta = $request->get('precio_venta');
			
			/* recorro el array de los valores de DETALLE_INGRESO, 
			creando un objeto del modelo DetalleIngreso()
			 */
			$cont = 0;
			while($cont < count($idarticulo)){
				$detalle = new DetalleIngreso(); // Referencia al MODELO
				$detalle->idingreso = $ingreso->idingreso; // paso el idingreso autogenerado anteriormente del objeto Ingreso
				$detalle->idarticulo = $idarticulo[$cont];
				$detalle->cantidad = $cantidad[$cont];
				$detalle->precio_compra = $precio_compra[$cont];
				$detalle->precio_venta = isset($precio_venta[$cont])? $precio_venta[$cont]: null;
				$detalle->save();
				$cont=$cont+1;

				$articulo = Articulo::find($detalle->idarticulo); 
				$articulo->increment('stock', $detalle->cantidad);
			}

			DB::commit();

		}catch(\Exception $e)
		{
			// Si existe un error, anulo toda la transaccion
			DB::rollback();
		}

		return Redirect::to('compras/ingreso');
	}

	
	public function show($id) 	// muestro el ingreso y su detalle de un $idingreso especifico
	{
		$ingreso=DB::table('ingreso as i')
			->join('persona as p', 'i.idproveedor','=','p.idpersona')
			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
			->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado', 'i.total_ingreso')// DB::raw('sum(di.cantidad*precio_compra) as total')
			// busco el ingreso en especifico
			->where('i.idingreso','=',$id)
			->first(); // el primer dato que encuentre con el where

		// DETALLE INGRESO
		$detalles=DB::table('detalle_ingreso as d')
			->join('articulo as a','d.idarticulo','=','a.idarticulo')
			->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta')
			->where('d.idingreso','=',$id)
			->get();

		// VISTA: devuelvo las variables como parametros 
		return view("compras.ingreso.show",["ingreso"=>$ingreso, "detalles"=>$detalles]);
	}

	public function destroy($id)
	{
		// Busco en el modelo por $id especifico, cambio estado a C = cancelado
		$ingreso=Ingreso::findOrFail($id);
		$ingreso->Estado='C';
		$ingreso->update();
		return Redirect::to('compras/ingreso');
	}

}
