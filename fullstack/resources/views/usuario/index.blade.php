<!--Template-->
@extends('layouts.app')
@section('content')
<div class="container-fluid">


<div class="alert alert-success alert-dismissible" role="alert">
@if(Session::has('Mensaje'))
{{ Session::get('Mensaje') }}
@endif


<button type="button" class="close" data-dismiss="alert" aria-label="close">
<span aria-hidden="true">&times;</span>
</button>

</div>




<a href="{{ url('usuario/create')}}" class="btn btn-success">Registrar nuevo usuario</a>
<br><br>

<table class="table table-light" class="container-fluid">


    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Primer Nombre</th>
            <th>Segundo Nombre</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Fecha de Nacimiento</th>
            <th>Tipo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Foto</th>
            <th>Acciones</th>
            
        </tr>
    </thead>

    <tbody>
    @foreach ( $usuarios as $usuario )
        <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->pNombre }}</td>
            <td>{{ $usuario->sNombre }}</td>
            <td>{{ $usuario->pApellido }}</td>
            <td>{{ $usuario->sApellido }}</td>
            <td>{{ $usuario->fechadenacimiento }}</td>
            <td>{{ $usuario->tipo }}</td>
            <td>{{ $usuario->telefono }}</td>
            <td>{{ $usuario->direccion }}</td>
            

            <td>
            
            <img src="{{ asset('storage').'/'.$usuario->foto }}" width="100" alt="">
            </td>

            <td>

                <a href="{{ url('/usuario/'.$usuario->id.'/edit') }}" class="btn btn-warning">
                Editar
                </a>
            |


            <form action="{{ url('/usuario/'.$usuario->id) }}" method="post" class="d-inline">
            @csrf
            {{ method_field('DELETE') }}
                <input  class="btn btn-danger" type="submit" onclick="return confirm('¿Quiere borrar el usuario?')" value="Borrar">
            </form>

             </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $usuarios->links() !!}
</div>
@endsection

