@extends ('layouts.admin')

@section ('contenido')
   {{-- Validacion - Mensajes de errores --}}
   {{-- La validacion se encuentra en Requests/ArticuloFormController.php --}}
    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Nuevo Articulo</h3>
			
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
            {!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            
            {{Form::token()}}



	<div class="row">
	
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <label for="codigo">Código Artículo</label>
                <input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Codigo del articulo...">
            </div>
		</div>   
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <label for="stock">Stock Mínimo</label>
                <input type="text" name="stock" value="0" class="form-control" placeholder="Stock del articulo...">
            </div>
		</div>
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
            </div>
		</div>
		
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <labeL>Unidad de Medida</label>
                <select name="unidad_medida" class="form-control">
                    <option selected>Elegir...</option>
                    <option value="unidades">Unidades</option>
                    <option value="gramos">Gramos</option>
                    <option value="kilogramos">Kilogramos</option>
                    <option value="litros">Litros</option>
                </select>
            </div>
		</div>
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripción del articulo...">
            </div>
		</div>	
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Categoría</label>
				<select name="idcategoria" class="form-control">
					@foreach ($categorias as $cat)
						<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
					@endforeach
				</select>
            </div>
		</div>
				
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control">
            </div>
		</div>
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="{{ url()->previous() }}">Cancelar</a>
            </div>
		</div>
		
	</div>
        
		
            {!!Form::close()!!}

    @endsection