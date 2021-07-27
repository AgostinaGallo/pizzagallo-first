<?php

namespace pizzagallo\Http\Controllers;

use Illuminate\Http\Request;

use pizzagallo\Http\Requests;
use pizzagallo\Persona;
use Illuminate\Support\Facades\Redirect;
use pizzagallo\Http\Requests\PersonaFormRequest;
use DB;

class EmpleadoController extends Controller
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
            
			$personas=DB::table('persona')
			->where('nombre','LIKE','%'.$query.'%')
            ->where ('tipo_persona','=','Empleado') //condicion donde 'condicion'  sea 'Cliente'
            ->orwhere('num_documento','LIKE','%'.$query.'%') // OrWhere - la segunda condicion a cumplir si la anterior no es verdadera. Donde busco por numero de documento
            ->where ('tipo_persona','=','Empleado') // y ademas la persona sea cliente
			->orderBy('idpersona','desc') // condicion para ordenar
            ->paginate(5);  // paginacion
            
			//devuelvo la vista en la ubicacion dicha, con los parametros puestos en array
			return view('almacen.empleado.index',["personas"=>$personas,"searchText"=>$query]);
        }

    }


    public function create()
    {
        // SOLO RETORNO UNA VISTA create, dentro de la carpeta Ventas y dentro de Clientes
        return view("almacen.empleado.create");
    }


    public function store(PersonaFormRequest $request)
    {   
        // Creo un objeto categoria y envio valores a cada una de las propiedades del modelo   
		$persona=new Persona;
        $persona->tipo_persona='Empleado'; // cuando el formulario envie datos, el tipo de persona sera Cliente
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
		$persona->num_documento=$request->get('num_documento');	
		$persona->direccion=$request->get('direccion');	
		$persona->telefono=$request->get('telefono');
		$persona->email=$request->get('email');	
		$persona->fecha_nacimiento=$request->get('fecha_nacimiento');					
        // guardo
        $persona->save();
        //devuelvo una redireccion
        return Redirect::to('almacen/empleado');
    }


    public function show($id)
    {
        // retorno vista mostrando la categoria especifica con el id requerido
        return view("almacen.empleado.show",["persona"=>Persona::findOrFail($id)]);
    }


    public function edit($id)
    {
        // llamo a la persona con el $id especifico
        return view("almacen.empleado.edit",["persona"=>Persona::findOrFail($id)]);   
    }


    public function update(PersonaFormRequest $request, $id)
    {
        $persona=Persona::findOrFail($id);
		
		// para enviar datos -- copio los mismos de la funcion store() desde nombre
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
		$persona->num_documento=$request->get('num_documento');	
		$persona->direccion=$request->get('direccion');	
		$persona->telefono=$request->get('telefono');
		$persona->email=$request->get('email');	
		$persona->fecha_nacimiento=$request->get('fecha_nacimiento');
        // actualizo
        $persona->update();
		return Redirect::to('almacen/empleado');
    }


    public function destroy($id)
    {
        // selecciono la persona que recibo por el parametro ID
        $persona=Persona::findOrFail($id);
        // cambio el estado de la persona a Inactivo
        $persona->tipo_persona='Inactivo';
        // actualizo
        $persona->update();
        return Redirect::to('almacen/empleado');
    }
	
}
