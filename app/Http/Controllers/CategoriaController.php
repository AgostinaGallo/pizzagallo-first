<?php

namespace pizzagallo\Http\Controllers;

use Illuminate\Http\Request;

use pizzagallo\Http\Requests;
//AGREGO MIS METODOS
use pizzagallo\Categoria;
use Illuminate\Support\Facades\Redirect;
use pizzagallo\Http\Requests\CategoriaFormRequest;
use DB;


class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Si existe request, obtengo todos los registros de la tabla
        if ($request)
        {
            $query=trim($request->get('searchText')); // Filtro de Busqueda
            // condicion where donde busque nombre con el valor de query - los signos de porcentaje marcan del principio o final de busqueda
            $categorias=DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')
            ->where('condicion','=','1') //condicion donde 'condicion' sea igual a 1. significando que esta activo
            ->orderBy('idcategoria','desc') // condicion para ordenar
            ->paginate(5);  // paginacion
            //devuelvo la vista en la ubicacion dicha, con los parametros puestos en array
            return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
        }

    }

    public function create()
    {
        // SOLO RETORNO UNA VISTA
        return view("almacen.categoria.create");
    }

    public function store(CategoriaFormRequest $request)
    {   
        // Creo un objeto categoria y envio valores a cada una de las propiedades del modelo
        $categoria=new Categoria;
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->condicion='1';
        // guardo
        $categoria->save();

        //devuelvo una redireccion
        return Redirect::to('almacen/categoria');
    }

    public function show($id)
    {
        // retorno vista mostrando la categoria especifica con el id requerido
        return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    public function edit($id)
    {
        // llamo a la categoria especifica 
        return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
        // luego almacenare con la funcion id
    }

    public function update(CategoriaFormRequest $request, $id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }

    public function destroy($id)
    {
        // selecciono la categoria que recibo por el parametro ID
        $categoria=Categoria::findOrFail($id);
        // Cuando destruyo, cambio condicion a 0(Cero)
        $categoria->condicion='0';
        $categoria->update();
        return Redirect::to('almacen/categoria');

    }

}
