<?php

namespace pizzagallo\Http\Controllers;

use Illuminate\Http\Request;

use pizzagallo\Http\Requests;
use pizzagallo\Articulo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use pizzagallo\Http\Requests\ArticuloFormRequest;
use DB;

class ArticuloController extends Controller
{
    
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        // Si existe request, obtengo todos los registros de la tabla
        if ($request)
        {
            $query=trim($request->get('searchText')); // Filtro de Busqueda
            // tabla articulo tendra alias 'a'
            $articulos=DB::table('articulo as a')->where('a.estado','=','Activo') // SOLO ACTIVOS
            ->join('categoria as c','a.idcategoria','=','c.idcategoria') // inserto un join ya que articulo esta relacionado con categoria | especifico los campos que se unen
            ->select('a.idarticulo','a.nombre','a.codigo','a.unidad_medida','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')//campos que necesito resultantes de la union de las tablas.
            ->where('a.nombre','LIKE','%'.$query.'%') // filtro por nombre de articulo usando el alias
            ->orwhere('a.codigo','LIKE','%'.$query.'%') // filtro por codigo de articulo usando el alias
            ->where('a.estado','=','Activo') // SOLO ACTIVOS
            ->orderBy('a.idarticulo','desc') // condicion para ordenar
            ->paginate(8);  // paginacion
            //devuelvo la vista en la ubicacion dicha, con los parametros puestos en array
            return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }

    }

    public function create()
    {
        // SOLO RETORNO UNA VISTA
        $categorias=DB::table('categoria')->where('condicion','=','1')->get(); // selecciono todas las categorias con condicion 1, osea activas
        return view("almacen.articulo.create",["categorias"=>$categorias]);
    }

    public function store(ArticuloFormRequest $request)
    {   
        // Creo un objeto ARTICULO y envio valores a cada una de las propiedades del modelo
        $articulo=new Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
		$articulo->stock=$request->get('stock');
        $articulo->unidad_medida=$request->get('unidad_medida');
        $articulo->descripcion=$request->get('descripcion');
		
        $articulo->estado='Activo';
        
        // Condicon que establece el atributo IMAGEN del objeto Articulo que hace referencia al modelo
        if (Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName()); //muevo la imagen a public_path obteniendo el nombre del cliente
            $articulo->imagen=$file->getClientOriginalName();// a articulo en el atributo imagen le envio el archivo cargado
        }
		
        // guardo y redirecciono
        $articulo->save();
        return Redirect::to('almacen/articulo');
    }

    public function show($id)
    {
        // retorno vista mostrando el articulo con el id requerido
        return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
    }

    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id); // selecciono un articulo especifico, asignando a $articulo el objeto de Articulo
        $categorias=DB::table('categoria')->where('condicion','=','1')->get(); // para editar solicito todas las categorias activas
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]); // retorno la vista de edit.blade.php con los dos parametros creados
    }

    public function update(ArticuloFormRequest $request, $id)
    {
        $articulo=Articulo::findOrFail($id);

        // Copiado de store()  *borre estado
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
		$articulo->stock=$request->get('stock');
        $articulo->unidad_medida=$request->get('unidad_medida');
        $articulo->descripcion=$request->get('descripcion');
        
        if (Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName()); //muevo la imagen a public_path obteniendo el nombre del cliente
            $articulo->imagen=$file->getClientOriginalName();// a articulo en el atributo imagen le envio el archivo cargado
        }
        
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }

    public function destroy($id)
    {
        // selecciono el articulo que recibo por el parametro ID -- haciendo referencia al modelo articulo
        $articulo=Articulo::findOrFail($id);
        // cambio el estado a 'Inactivo'
        $articulo->estado='Inactivo';
        $articulo->update();// luego de actualizar redirecciono a la vista:
        return Redirect::to('almacen/articulo');

    /*Para eliminar  el articulo completamente
    Para eliminarlo completamente en la base de datos*/
        /*Articulo::destroy($id);
        return Redirect::to('almacen/articulo');*/
    }

}

