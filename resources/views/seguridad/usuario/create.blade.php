@extends ('layouts.admin')

@section ('contenido')
   {{-- Validacion - Mensajes de errores --}}
   {{-- La validacion se encuentra en Requests/CategoriaFormController.php --}}
    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Nuevo Usuario</h3>
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

            {{-- El controllador sabra que funcion utilizar dependiendo del METODO especificado --}}
            
			{!!Form::open(array('url'=>'seguridad/usuario','method'=>'POST','autocomplete'=>'off'))!!}
            
            {{Form::token()}}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Nombre</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Correo Electrónico</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Contraseña</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            

            <div class="form-group">

                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>

            </div>


            {!!Form::close()!!}

        </div>

    </div>


    @endsection