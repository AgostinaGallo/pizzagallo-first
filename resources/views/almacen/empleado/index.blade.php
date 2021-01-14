@extends ('layouts.admin')

@section ('contenido')
    {{-- AGREGO DIRECTAMENTE UNA FILA , ya que el container lo agregue en el admin.blade.php--}}
    <div class="row">
        {{-- clase responsive: --}}
        {{-- desde pantallas grandes(lg) hasta celulares (xs), con columnas de 8 y para xs 12 de ancho--}}
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Empleados <a href="empleado/create"><button class="btn btn-success">Nuevo</button></b></a></h3>
            {{-- agrego un formulario incluyendo otra vista creada --}}
            @include('almacen.empleado.search')
        </div>
    </div>

{{-- Otra fila y columnas --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{-- Muestra en la tabla el listado de todas los CLIENTES--}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">

                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Tipo Doc.</th>
                    <th>Número Doc.</th>
					<th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Opciones</th>
                </thead>
                
                {{-- Muestro total de registros usando un Bucle--}}
				
                @foreach ($personas as $per)
	
                <tr>
                    <td> {{ $per->idpersona }} </td>
                    <td> {{ $per->nombre }} </td>
                    <td> {{ $per->tipo_documento }} </td>
                    <td> {{ $per->num_documento }} </td>
					<td> {{ $per->direccion }} </td>
					<td> {{ $per->telefono }} </td>
					<td> {{ $per->email }} </td>
                    <td> {{ $per->fecha_nacimiento }} </td>
                    <td> 
                        <a href="{{URL::action('EmpleadoController@edit',$per->idpersona)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                    </td>
                </tr>

                @include('almacen.empleado.modal')
                @endforeach
                
            </table>

        </div>{{--FIN table-responsive --}}
        {{-- Metodo para paginar categorias --}}
        {{ $personas->render() }}

    </div>
</div>


@endsection