@extends ('layouts.admin')

@section ('contenido')
   {{-- Validacion - Mensajes de errores --}}
   {{-- La validacion se encuentra en Requests/VentaFormController.php --}}
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Venta</h3>
            {{-- Si existe al menos un error entro al bucle e informo --}}
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    {{-- Muestro todos los errores que encuentro --}}
                    @foreach ($errors->all() as $error)
                    <li> {{$error}} </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
            {{-- El controllador sabra que funcion utilizar dependiendo del METODO especificado --}}
            {!!Form::open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

	<div class="row">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="cliente">CLIENTES: Cliente - Proveedor - Empleado</label>
                <select name="idcliente" id="idcliente" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
                    {{--$personas recibo del return create() del controlador--}}
                    @foreach($personas as $persona)
                    <option value="{{$persona->idpersona}}">{{$persona->nombre}}</option> 
                    @endforeach
                </select>
            </div>
		</div>   

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label>Tipo Comprobante</label>
                <select name="tipo_comprobante" class="form-control">
                    <option value="Factura">Factura</option>
                    <option value="Ticket">Ticket</option>
                </select>
            </div>
		</div> 

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="serie_comprobante">Serie Comprobante(3 digitos)</label>
                <input type="text" name="serie_comprobante" required value="{{old('serie_comprobante')}}" class="form-control" placeholder="000">
            </div>
        </div> 

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="num_comprobante">Número Comprobante(4 digitos)</label>
                <input type="text" name="num_comprobante" required value="{{old('num_comprobante')}}" class="form-control" placeholder="0000">
            </div>
        </div> 
    </div> {{-- Row--}}

    <div class="row"> {{-- Fila para el detalle_Venta --}}
    {{-- Panel de Boostrap --}}
        <div class="panel panel-primary">
            <div class="panel-body">

                {{-- ARTICULO --}}
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Artículo</label>
                           <select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
                               @foreach ($articulos as $articulo)
                                {{-- articulo es el alias resultante del controller  --}}
                                <option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}">{{$articulo->articulo}}</option>   
                               @endforeach  
                        </select> 
                    </div>
                </div>

                {{-- CANTIDAD --}}
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        {{-- pcantidad = p adelante porque es auxiliar --}}
                        <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="0">
                    </div>
                </div>

                {{-- STOCK --}}
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" disabled name="pstock" id="pstock" class="form-control" placeholder="0"> {{--disabled name NO me permite modificar --}}
                    </div>
                </div>

                {{-- PRECIO VENTA --}}
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="precio_venta">Precio Venta</label>
                        <input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="0.00"> {{-- puedo bloquear o habilitar cambiar precio venta, en este caso esta habilitado --}}
                    </div>
                </div>   

                {{-- DESCUENTO --}}
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="descuento">Descuento</label>
                        {{-- pdescuento = p adelante porque es auxiliar --}}
                        <input type="number" name="pdescuento" id="pdescuento" class="form-control" value="0.00">
                    </div>
                </div>


                {{-- Boton AGREGAR DETALLES --}}
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        {{-- bt_add usado en javascript para capturar su click--}}
                        <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div> 

                {{-- Tabla de DETALLES agregados --}}
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5">
                                <th>Opciones</th>
                                <th>Articulo</th>
                                <th>Cantidad</th>
                                <th>Precio venta</th>
                                <th>Descuento</th>
                                <th>Subtotal</th>
                            </thead>
                            <tfoot>
                                <th>TOTAL</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h4 id="total">$ 0.00</h4> <input type="hidden" name="total_venta" id="total_venta"></th>
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>    

            </div>{{-- </panel-body> --}}
        </div>{{-- </row> --}}
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                {{-- Token permite trabajar con transacciones (desde el controlador) --}}
                <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>
        
            {!!Form::close()!!}



@push('scripts')
{{--    CODIGO  JAVASCRIPT -- JQUERY --}}  
<script>
    $(document).ready(function(){
        $('#bt_add').click(function(){
            agregar();
        });
    });

    var cont=0;
    total = 0;
    subtotal = []; // guardo todos los subtotales de detalle_Venta
    $("#guardar").hide(); // Oculto boton al inicio del documento
    $("#pidarticulo").change(mostrarValores);

    function mostrarValores()
    {
        datosArticulo=document.getElementById('pidarticulo').value.split('_');
        $("#pprecio_venta").val(datosArticulo[2]);
        $("#pstock").val(datosArticulo[1]);
    }

    function agregar(){

        datosArticulo=document.getElementById('pidarticulo').value.split('_');

        idarticulo = datosArticulo[0];
        articulo = $("#pidarticulo option:selected").text();
        cantidad = $("#pcantidad").val();
        descuento = $("#pdescuento").val();
        precio_venta = $("#pprecio_venta").val();
        stock = $("#pstock").val();
        
        // valido
        if (idarticulo !="" && cantidad !="" && cantidad>0 && descuento !="" && precio_venta!="")
        {

            if (stock >= cantidad) // si el Stock es MAYOR que la Cantidad , puedo vender.
            {
                subtotal[cont]=(cantidad*precio_venta-descuento);
                total=total+subtotal[cont];

                var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';

                cont++;
                limpiar();

                $("#total").html("$ " + total);
                $("#total_venta").val(total);
                evaluar();
                // AGREGO LA FILA DE LA TABLA id=detalles
                $('#detalles').append(fila);

            }else{
                alert('La cantidad a vender supera el Stock');
            }    
        }
        else
        {
            alert("Error al ingresar el detalle de la venta, revise los datos del artículo.");
        }
    
    }

    /* Limpio los inputs de textbox, 
    antes de agregar a detalle_Venta,
    con sus respectivos id */
    function limpiar(){
        $("#pcantidad").val("");
        $("#pdescuento").val("");
        $("#pprecio_venta").val("");
    }
    /* Oculto botones si no existe registro
    en detalle_Venta <- validación
    - No enviara venta sin un detalle */
    function evaluar(){
        if(total>0){
            $("#guardar").show();
        }
        else{
            $("#guardar").hide();
        }
    }

    /* Funcion eliminar */
    // Recibe index , vuelve a calcular el total, muestro el nuevo total, remuevo la fila seleccionada y evaluo si total>0
    function eliminar(index){
        total = total - subtotal[index];
        $("#total").html("$ " + total);
        $("#total_venta").val(total);
        $("#fila" + index).remove();
        evaluar();
        
    }

</script>

@endpush

@endsection