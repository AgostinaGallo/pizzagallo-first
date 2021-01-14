@extends ('layouts.admin')

@section ('contenido')
   {{-- Validacion - Mensajes de errores --}}
   {{-- La validacion se encuentra en Requests/CategoriaFormController.php --}}
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Editar proveedor: {{$persona->nombre}}</h3>
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
            {!!Form::model($persona,['method'=>'PATCH','route'=>['compras.proveedor.update',$persona->idpersona]])!!}
            
            {{Form::token()}}

            <div class="row">

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre...">
                    </div>
                </div>   
        
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" required value="{{$persona->direccion}}" class="form-control" placeholder="Dirección...">
                    </div>
                </div> 
        
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Documento</label>
                        <select name="tipo_documento" class="form-control">
                        @if ($persona->tipo_documento=='DNI')
                            <option value="DNI" selected>DNI</option>                  
                            <option value="CUIL">CUIL</option>
                            <option value="CUIT">CUIT</option>
                        @elseif ($persona->tipo_documento=='CUIL')
                            <option value="DNI">DNI</option>                  
                            <option value="CUIL" selected>CUIL</option>
                            <option value="CUIT">CUIT</option>
                        @else
                            <option value="DNI">DNI</option>                  
                            <option value="CUIL">CUIL</option>
                            <option value="CUIT" selected>CUIT</option>
                        @endif
                        </select>
                    </div>
                </div> 
        
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="num_documento">Número Documento</label>
                        <input type="text" name="num_documento" required value="{{$persona->num_documento}}" class="form-control">
                    </div>
                </div> 
                
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" required value="{{$persona->telefono}}" class="form-control">
                    </div>
                </div> 
        
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" required value="{{$persona->email}}" class="form-control">
                    </div>
                </div>
        
                {{--<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" value="{{$persona->fecha_nacimiento}}" class="form-control">
                    </div>
                </div>--}}
        
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button class="btn btn-danger" type="reset">Cancelar</button>
                    </div>
                </div>
            </div>

            {!!Form::close()!!}

        </div>

    </div>


    @endsection