<!--Template-->
@extends('layouts.app')
@section('content')
<div class="container"> 

<form action="{{ url('/usuario') }}" method="post" enctype="multipart/form-data" class="d-inline">
@csrf
@include('usuario.form',['modo'=>'Crear']);

</form>

</div>
@endsection