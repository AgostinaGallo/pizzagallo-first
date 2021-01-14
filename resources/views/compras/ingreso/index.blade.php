@extends ('layouts.admin')

@section ('contenido')
    {{-- AGREGO DIRECTAMENTE UNA FILA , ya que el container lo agregue en el admin.blade.php--}}
    <div class="row">
        {{-- clase responsive: --}}
        {{-- desde pantallas grandes(lg) hasta celulares (xs), con columnas de 8 y para xs 12 de ancho--}}
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Ingresos <a href="ingreso/create"><button class="btn btn-success">Nuevo</button></b></a></h3>
            {{-- agrego un formulario incluyendo otra vista creada --}}
            @include('compras.ingreso.search')
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
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Comprobante</th>
                    <th>Serie</th>
                    <th>Numero</th>
                    <th>Impuesto</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                
                {{-- Muestro total de registros usando un Bucle--}}
				
                @foreach ($ingresos as $ing)
                <tr>
                    <td> {{ $ing->idingreso }} </td>
                    <td> {{ $ing->fecha_hora }} </td>
                    <td> {{ $ing->nombre }} </td>
                    <td> {{ $ing->tipo_comprobante }} </td>
                    <td> {{$ing->serie_comprobante }} </td>
                    <td> {{ $ing->num_comprobante }} </td>
                    <td> {{ $ing->impuesto }} </td>
                    <td> {{ $ing->total }} </td>
                    <td> {{ $ing->estado }} </td>
                    <td> 
                        <a href="{{URL::action('IngresoController@show',$ing->idingreso)}}"><button class="btn btn-primary">Detalles</button></a>
                        <a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal"><button class="btn btn-danger">Cancelar</button></a>
                    </td>
                </tr>

                @include('compras.ingreso.modal')
                @endforeach
                
            </table>

        </div>{{--FIN table-responsive --}}
        {{-- Metodo para PAGINAR categorias --}}
        {{ $ingresos->render() }}

    </div>
</div>


@endsection