@extends ('layouts.admin')

@section ('contenido')
   {{--     ESTA VISTA SOLO MOSTRARA  --}}
	<div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="cliente">Cliente</label>
                {{--Traigo de VentaController el return $venta, nombre que tengo en show() -> VentaController            --}}
                <p>{{$venta->nombre}}</p>
            </div>
		</div>   
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Tipo Comprobante</label>
                <p>{{$venta->tipo_comprobante}}</p>
            </div>
		</div> 
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="serie_comprobante">Serie Comprobante</label>
                <p>{{$venta->serie_comprobante}}</p>
            </div>
        </div> 
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="num_comprobante">Número Comprobante</label>
                <p>{{$venta->num_comprobante}}</p>
            </div>
        </div> 
    </div> {{-- Row--}}

    <div class="row"> {{-- Fila para el detalle_venta --}}
    {{-- Panel de Boostrap --}}
        <div class="panel panel-primary">
            <div class="panel-body">
                {{-- Tabla de DETALLES agregados --}}
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5">
                                <th>Articulo</th>
                                <th>Cantidad</th>
                                <th>Precio Venta</th>
                                <th>Descuento</th>                                
                                <th>Subtotal</th>
                            </thead>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                {{-- total de venta, total del select en show() <-VentaController --}}
                                <th><h4 id="total">{{$venta->total_venta}}</h4></th>
                            </tfoot>
                            <tbody>
                                {{-- <tr> multiple dependiendo los detalles que tendrá el Venta
                                Por eso, bucle 
                                paso parametro del return de show()->VentaController--}}
                                @foreach($detalles as $det)
                                <tr>{{-- valores retornates del SELECT --}}
                                    <td>{{$det->articulo}}</td>
                                    <td>{{$det->cantidad}}</td>
                                    <td>{{$det->precio_venta}}</td>
                                    <td>{{$det->descuento}}</td>
                                    {{-- SUBTOTAL hago el calculo --}}
                                    <td>{{$det->cantidad*$det->precio_venta-$det->descuento}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                 </div> {{-- col sm-md-xs --}}
            </div>{{-- </panel-body> --}}
        </div>{{-- </row> --}}
    </div>

@endsection