@extends ('layouts.admin')

@section ('contenido')
   {{-- Validacion - Mensajes de errores --}}
   {{-- La validacion se encuentra en Requests/CategoriaFormController.php --}}
    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Editar Categoria: {{$categoria->nombre}}</h3>
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
			
            {!!Form::model($categoria,['method'=>'PATCH','route'=>['almacen.categoria.update',$categoria->idcategoria]])!!}
            
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
                <a class="btn btn-danger" href="{{ url()->previous() }}">Cancelar</a>

            </div>


            {!!Form::close()!!}

        </div>

    </div>


    @endsection