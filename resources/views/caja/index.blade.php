@extends ('layouts.admin')

@section ('contenido')
    <div class="row">
        {{-- desde pantallas grandes(lg) hasta celulares (xs), con columnas de 8 y para xs 12 de ancho--}}
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Caja: Informe</h3>
            {{-- agrego un formulario incluyendo otra vista creada --}}
            <h2>Saldo: ${{ $saldo }}</h2>
        </div>
    </div>

{{-- Otra fila y columnas --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{-- Muestra en la tabla el listado de todas las categorias--}}
        <h3 style="color: green;"><i class="fa fa-plus-square"></i> VENTAS</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">

                <thead>
                    <th>Fecha</th>
                    <th>Nro. Comprobante</th>
                    <th>Total</th>
                </thead>
                
                {{-- Muestro total de registros usando un Bucle--}}
                @foreach ($ventas as $ven)
                <tr>

                    <td> {{ $ven->fecha_hora }} </td>
                    <td> {{ $ven->num_comprobante}} </td>
                    <td> ${{ $ven->total_venta }} </td>
                    
                </tr>
                @endforeach
            </table>

        </div>{{--FIN table-responsive --}}
        {{-- Metodo para paginar categorias --}}
        {{ $ventas-> render() }}

    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{-- Muestra en la tabla el listado de todas las categorias--}}
        <h3 style="color: brown;"><i class="fa fa-minus-square"></i> COMPRAS</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">

                <thead>
                    <th>Fecha</th>
                    <th>Nro. Comprobante</th>
                    <th>Total</th>
                </thead>
                
                {{-- Muestro total de registros usando un Bucle--}}
                @foreach ($ingresos as $ing)
                <tr>

                    <td> {{ $ing->fecha_hora }} </td>
                    <td> {{ $ing->num_comprobante }} </td>
                    <td> {{ $ing->total_ingreso }} </td>
                  
                </tr>
                @endforeach
            </table>

        </div>{{--FIN table-responsive --}}
        {{-- Metodo para paginar categorias --}}
        {{ $ingresos-> render() }}

    </div>
</div>


@endsection