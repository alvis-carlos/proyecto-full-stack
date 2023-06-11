@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2>Lista de estados</h2>
@stop

@section('content')


@if( Session::has('mensaje') )
    {{ Session::get('mensaje') }}
@endif

<a class="btn btn-primary" href="{{ url('dash/estados/create') }}">Crear estado</a>

<br>
<br>
<table class="table table-light" id='ListState'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo estado</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $states as $state )
        <tr>
            <td>{{$state->id_estados}}</td>
            <td>{{$state->nombre_esta}}</td>
            <td>{{$state->nombre_tip_esta}}</td>
            <td>
                <a class="btn btn-warning" href="{{ url('/dash/estados/'.$state->id_estados.'/edit') }}">
                    Editar
                </a>
            </td>
            <td>
                <form action="{{ url('dash/estados/'.$state->id_estados) }}" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input class="btn btn-danger" type="submit"  onclick='return confirm("¿Desea borrar el tipo de estado?")' value="Borrar">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    
<script>
    $(document).ready(function() {
        $('#ListState').DataTable({
            dom: 'Bfrtip',
            pageLength: 10,
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        });
    });
</script>

@stop