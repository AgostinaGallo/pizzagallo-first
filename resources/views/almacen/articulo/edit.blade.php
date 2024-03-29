@extends ('layouts.admin')

@section ('contenido')
   {{-- Validacion - Mensajes de errores --}}
   {{-- La validacion se encuentra en Requests/ArticuloFormController.php --}}
    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Editar Articulo : {{$articulo->nombre}}</h3>
			
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
            
			{!!Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idarticulo],'files'=>'true'])!!}
            {{Form::token()}}

	<div class="row">
	
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control">
            </div>
		</div>	

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <label for="stock">Stock</label>
                <input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control">
            </div>
		</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="{{$articulo->nombre}}" class="form-control">
            </div>
		</div>
		
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <labeL>Unidad de Medida</label>
                <select name="unidad_medida" class="form-control">
                    <option value="{{$articulo->unidad_medida}}" selected>{{$articulo->unidad_medida}}</option>
                    <option value="unidades">Unidades</option>
                    <option value="gramos">Gramos</option>
                    <option value="litros">Litros</option>
                </select>
            </div>
		</div>
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" value="{{$articulo->descripcion}}" class="form-control" placeholder="Descripcion del articulo...">
            </div>
		</div>
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Categoría</label>
				<select name="idcategoria" class="form-control">
					@foreach ($categorias as $cat)
						@if ($cat->idcategoria==$articulo->idcategoria)
							<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
						@else
							<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
						@endif
					@endforeach
				</select>
            </div>
		</div>
		
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control">
				{{-- compruebo si existe una imagen cargada --}}
				
				@if (($articulo->imagen)!="")
					<img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="100px" width="100px">
				@endif
				
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