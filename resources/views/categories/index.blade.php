@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    <p>Lista de categorias</p>
    <a href="{{ url('dash/categorias/create') }}" class="btn btn-primary">Crear Categorias</a>
<br>
<br>
    <table id="ListCategories" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $categorie)
            <tr>
                <td>{{ $categorie->id_categorias }}</td>
                <td>{{ $categorie->nombre_catego }}</td>
                <td>
                    <a  class="btn btn-warning" href="{{ url('dash/categorias/'.$categorie->id_categorias.'/edit') }}">
                        Editar
                    </a>
                </td>
                <td>
                    <form action="{{ url('/dash/categorias/'.$categorie->id_categorias) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" type="submit"  onclick='return confirm("¿Desea borrar la categoria?")' value="Borrar">
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
        $('#ListCategories').DataTable({
            dom: 'Bfrtip',
            pageLength: 5,
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        });
    });
</script>

@stop