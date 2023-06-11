@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Invebtario almacenado</h1>
@stop

@section('content')
<a class="btn btn-primary" href="{{ url('dash/inventario/create') }}">Crear Nuevo producto</a>

<br>
<br>
<div class='container px-lg-5"'>
<table class="table table-light" id='Listinventory' width:40>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>fecha Vencimiento</th>
            <th>talla</th>
            <th>peso</th>
            <th>marca</th>
            <th>lote</th>
            <th>Precio</th>
            <th>stock</th>
            <th>imagen</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $inventorys as $inventory )
        <tr>
            <td>{{ $inventory->id_productos }}</td>
            <td>{{ $inventory->nombres_productos }}</td>
            <td>{{ $inventory->nombre_catego }}</td>
            <td>{{ $inventory->fecha_vencimiento }}</td>
            <td>{{ $inventory->talla }}</td>
            <td>{{ $inventory->peso }}</td>
            <td>{{ $inventory->marca }}</td>
            <td>{{ $inventory->lote }}</td>
            <td>{{ $inventory->valor }}</td>
            <td>{{ $inventory->cantidad_stock }}</td>
            <td><img  width='80' src="{{asset('storage').'/'.$inventory->imagen}}" alt="{{$inventory->imagen}}"></td>
            <td><a href="{{ url('dash/inventario/'.$inventory->id.'/edit') }}" class="btn btn-warning">editar</a></td>
            <td>
                <form action="{{ url('dash/inventario/'.$inventory->id) }}" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input class="btn btn-danger" type="submit"  onclick='return confirm("¿Desea eliminar el inventario?")' value="Borrar">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

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
        $('#Listinventory').DataTable({
            dom: 'Bfrtip',
            pageLength: 10,
            "scrollX": true,
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        });
    });
</script>

@stop