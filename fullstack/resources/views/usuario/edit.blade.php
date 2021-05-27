<!--Template-->
@extends('layouts.app')
@section('content')
<div class="container"> 


<form action="{{ url('/usuario/'.$usuario->id) }}" method="post" enctype="multipart/form-data" class="d-inline">
<!--Llave de seguridad -->
@csrf
{{ method_field('PATCH') }}

<!--Incluir plantilla del formulario desdela vista form con inclucion-->

@include('usuario.form',['modo'=>'Editar']);

</form>

</div>
@endsection