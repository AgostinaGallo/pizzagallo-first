@extends ('layouts.admin')

@section ('contenido')
    {{-- AGREGO DIRECTAMENTE UNA FILA , ya que el container lo agregue en el admin.blade.php--}}
    <div class="row">
        {{-- clase responsive: --}}
        {{-- desde pantallas grandes(lg) hasta celulares (xs), con columnas de 8 y para xs 12 de ancho--}}
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Usuarios del sistema <a href="usuario/create"><button class="btn btn-success">Nuevo</button></b></a></h3>
            {{-- agrego un formulario incluyendo otra vista creada --}}
            @include('seguridad.usuario.search')
        </div>
    </div>

{{-- Otra fila y columnas --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{-- Muestra en la tabla el listado de todas las categorias--}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">

                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Correo Electrónica</th>
                    <th>Opciones</th>
                </thead>
                
                {{-- Muestro total de registros usando un Bucle--}}
                @foreach ($usuarios as $usu)
                <tr>

                    <td> {{ $usu->id }} </td>
                    <td> {{ $usu->name }} </td>
                    <td> {{ $usu->email }} </td>
                    <td> 
                        <a href="{{URL::action('UsuarioController@edit',$usu->id)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                    </td>
                    
                </tr>

                @include('seguridad.usuario.modal')

                @endforeach
            </table>

        </div>{{--FIN table-responsive --}}
        {{-- Metodo para paginar categorias --}}
        {{ $usuarios-> render() }}

    </div>
</div>


@endsection