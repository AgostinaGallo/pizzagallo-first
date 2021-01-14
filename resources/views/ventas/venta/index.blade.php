@extends ('layouts.admin')

@section ('contenido')
    {{-- AGREGO DIRECTAMENTE UNA FILA , ya que el container lo agregue en el admin.blade.php--}}
    <div class="row">
        {{-- clase responsive: --}}
        {{-- desde pantallas grandes(lg) hasta celulares (xs), con columnas de 8 y para xs 12 de ancho--}}
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Ventas <a href="venta/create"><button class="btn btn-success">Nuevo</button></b></a></h3>
            {{-- agrego un formulario incluyendo otra vista creada --}}
            @include('ventas.venta.search')
        </div>
    </div>

{{-- Otra fila y columnas --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{-- Muestra en la tabla el listado de todos los CLIENTES--}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">

                <thead>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Comprobante</th>
                    <th>Serie</th>
                    <th>Numero</th>
                    <th>Impuesto</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                

                {{-- Muestro total de registros usando un Bucle--}}
				
                @foreach ($ventas as $ven)
                <tr>
                    <td> {{ $ven->idventa }} </td>
                    <td> {{ $ven->fecha_hora }} </td>
                    <td> {{ $ven->nombre }} </td>
                    <td> {{ $ven->tipo_comprobante }} </td>
                    <td> {{ $ven->serie_comprobante }} </td>
                    <td> {{ $ven->num_comprobante }} </td>
                    <td> {{ $ven->impuesto }} </td>
                    <td> {{ $ven->total_venta }} </td>
                    <td> {{ $ven->estado }} </td>
                    <td> 
                        <a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-primary">Detalles</button></a>
                        <a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">Cancelar</button></a>
                    </td>
                </tr>

                @include('ventas.venta.modal')
                @endforeach
                
            </table>

        </div>{{--FIN table-responsive --}}
        
        {{-- Metodo para PAGINAR categorias --}}
        {{ $ventas->render() }}

    </div>
</div>


@endsection