@extends ('layouts.admin')

@section ('contenido')
   {{--     ESTA VISTA SOLO MOSTRARA  --}}
	<div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="proveedor">Proveedor</label>
                {{--Traigo de IngresoController el return $ingreso, nombre que tengo en show() -> IngresoController            --}}
                <p>{{$ingreso->nombre}}</p>
            </div>
		</div>   
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Tipo Comprobante</label>
                <p>{{$ingreso->tipo_comprobante}}</p>
            </div>
		</div> 
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="serie_comprobante">Serie Comprobante</label>
                <p>{{$ingreso->serie_comprobante}}</p>
            </div>
        </div> 
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="num_comprobante">Número Comprobante</label>
                <p>{{$ingreso->num_comprobante}}</p>
            </div>
        </div> 
    </div> {{-- Row--}}

    <div class="row"> {{-- Fila para el detalle_ingreso --}}
    {{-- Panel de Boostrap --}}
        <div class="panel panel-primary">
            <div class="panel-body">
                {{-- Tabla de DETALLES agregados --}}
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5">
                                <th>Articulo</th>
                                <th>Cantidad</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Subtotal</th>
                            </thead>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                {{-- total de ingreso, total del select en show() <-IngresoController --}}
                                <th><h4 id="total">{{$ingreso->total_ingreso}}</h4></th>
                            </tfoot>
                            <tbody>
                                {{-- <tr> multiple dependiendo los detalles que tendrá el Ingreso
                                Por eso, bucle 
                                paso parametro del return de show()->IngresoController--}}
                                @foreach($detalles as $det)
                                <tr>{{-- valores retornates del SELECT --}}
                                    <td>{{$det->articulo}}</td>
                                    <td>{{$det->cantidad}}</td>
                                    <td>{{$det->precio_compra}}</td>
                                    <td>{{$det->precio_venta}}</td>
                                    {{-- SUBTOTAL hago el calculo --}}
                                    <td>{{$det->cantidad * $det->precio_compra}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                 </div> {{-- col sm-md-xs --}}
            </div>{{-- </panel-body --}}
        </div>{{-- </row --}}
    </div>

@endsection