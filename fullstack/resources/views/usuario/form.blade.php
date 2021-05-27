

<h1>{{ $modo }} Usuario</h1>


@if(count($errors)>0)

<div class="alert alert-danger" role="alert"> 

<ul>
@foreach( $errors->all() as $error)
<li>{{ $error }} </li>
@endforeach
</ul>
</div>

@endif

<div class="form-group">
<label for="pNombre">Primer Nombre</label>   
<input class="form-control"  type="text" name="pNombre" value="{{ isset ($usuario->pNombre)?$usuario->pNombre:old('pNombre') }}" id="pNombre"> 
</div>

<div class="form-group">
<label for="sNombre">Segundo Nombre</label>   
<input class="form-control"  type="text" name="sNombre" value="{{ isset ($usuario->sNombre)?$usuario->sNombre:old('sNombre') }}" id="sNombre"> 
</div>

<div class="form-group">
<label for="pApellido">Primer Apellido</label>   
<input class="form-control"  type="text" name="pApellido" value="{{ isset ($usuario->pApellido)?$usuario->pApellido:old('pApellido') }}" id="pApellido"> 
</div>

<div class="form-group">
<label for="sApellido">Segundo Apellido</label>   
<input class="form-control"  type="text" name="sApellido" value="{{ isset ($usuario->sApellido)?$usuario->sApellido:old('sApellido') }}" id="sApellido"> 
</div>

<div class="form-group">
<label for="fechadenacimiento">Fecha de Nacimiento</label> 
<input class="form-control"  type="date" name="fechadenacimiento" value="{{ isset ($usuario->fechadenacimiento)?$usuario->fechadenacimiento:old('fechadenacimiento')}}" id="fechadenacimiento" >
</div>

<div class="form-group">
<label for="tipo">Tipo | Rol  </label> 
<select class="form-control"  type="text" name="tipo" value="{{ isset ($usuario->tipo)?$usuario->tipo:old('tipo') }}" id="tipo" >
<option selected >Seleccione Rol</option>
        <option>Profesor</option>
        <option>Estudiante</option>
        <option>Aseo</option>
        <option>Cocina</option>
        </select>      
</div>

<div class="form-group">
<label for="telefono">Teléfono</label> 
<input class="form-control"  type="text" name="telefono" value="{{ isset ($usuario->telefono)?$usuario->telefono:old('telefono') }}" id="telefono" >
</div>


<div class="form-group">
<label for="direccion">Dirección</label> 
<input class="form-control"  type="text" name="direccion" value="{{ isset ($usuario->direccion)?$usuario->direccion:old('direccion') }}" id="direccion" >
</div>
<label for="foto"></label>
@if(isset($usuario->foto ))
<img src="{{ asset('storage').'/'.$usuario->foto }}" width="100" alt="">
@endif
<input type="file" name="foto" id="foto" value="" >
 
<input type="submit" value="{{$modo}} Datos" class="btn btn-success">

<a href="{{ url('usuario/')}}" class="btn btn-primary">Regresar</a>

