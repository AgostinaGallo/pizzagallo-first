
{!! Form::open(array('url'=>'almacen/empleado' , 'method'=>'GET' , 'autocomplete' =>'off', 'role'=>'search' )) !!}
{{-- Formulario que enviara la informacion a la pagina index | metodo GET | parametro autocomplete OFF | Rol 'Search' --}}

{{-- Objetos dentro del formulario --}}
<div class="form-group">

    <div class="input-group">

        <input type="text" class="form-control" name="searchText" placeholder="Buscar por DNI.." value="{{$searchText}}">
    
        <span class="input-group-btn"> {{-- El boton al costado de la caja de texto --}}
            
            <button type="submit" class="btn btn-primary">Buscar</button>
        
        </span>
    
    </div>

</div>

{{Form::close()}}