@extends ('layouts.admin')

@section ('contenido')
    {{-- AGREGO DIRECTAMENTE UNA FILA , ya que el container lo agregue en el admin.blade.php--}}
    <div class="row">
        {{-- clase responsive: --}}
        {{-- desde pantallas grandes(lg) hasta celulares (xs), con columnas de 8 y para xs 12 de ancho--}}
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Artículos <a href="articulo/create"><button class="btn btn-success">Nuevo</button></b></a></h3>
            {{-- agrego un formulario incluyendo otra vista creada --}}
            @include('almacen.articulo.search')
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
                    <th>Código</th>
					<th>Nombre</th>
					<th>Stock</th>
                    <th>Unidad Medida</th>
					<th>Categoría</th>                                 
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                
                {{-- Muestro total de registros usando un Bucle--}}
                @foreach ($articulos as $art)
                
                <tr>

                    <td> {{ $art->idarticulo}} </td>
					<td> {{ $art->codigo }} </td>
                    <td> {{ $art->nombre }} </td>
					<td> {{ $art->stock }} </td>
					<td> {{ $art->unidad_medida }} </td>
                    <td> {{ $art->categoria }} </td>
                    <td> {{ $art->descripcion }} </td>

                    <td>{{-- llamo con asset a la imagen almacenada en la ruta | muestro texto alternativo con nombre si hubiese un error para mostrar imagen--}}
                        <img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{ $art->nombre }}" height="100px" width="100px" class="img-thumbnail"> 
                    </td>
                    
					<td> {{ $art->estado }} </td>

                    <td> 
                        <a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                    </td>
                    
                </tr>

                @include('almacen.articulo.modal')
                @endforeach
            </table>

        </div>{{--FIN table-responsive --}}
        {{-- Metodo para paginar categorias --}}
        {{ $articulos-> render() }}

    </div>
</div>


@endsection