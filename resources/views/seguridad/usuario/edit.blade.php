@extends ('layouts.admin')

@section ('contenido')
  
    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Editar Usuario: {{$usuario->name}}</h3>
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

			{{-- Formulario MODEL --}}
            {{-- El controllador usa una FUNCION dependiendo del METODO especificado- en este caso: PATCH --}}
			
            {!!Form::model($usuario,['method'=>'PATCH','route'=>['seguridad.ususario.update',$usuario->id]])!!}
            
            {{Form::token()}}

            <div class="form-group">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{$categoria->nombre}}" placeholder="Nombre...">

            </div>


            <div class="form-group">

                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" class="form-control" value="{{$categoria->descripcion}}" placeholder="Descripcion...">

            </div>
            

            <div class="form-group">

                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>

            </div>


            {!!Form::close()!!}

        </div>

    </div>


    @endsection