@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de facturas</h1>
@stop

@section('content')
<table class="table" id='listfactures'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Status</th>
            <th>Fecha</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Documento</th>
            <th>Tipo documento</th>
            <th>Descargar</th>
        </tr>
    </thead>
    <tbody>

    @foreach($factures as $facture)
        <tr>    
            <td>{{ $facture->id }}</td>
            <td>{{ $facture->status }}</td>
            <td>{{ $facture->created_at }}</td>
            <td>{{ $facture->Nombres }}</td>
            <td>{{ $facture->apellidos }}</td>
            <td>{{ $facture->cedula }}</td>
            <td>{{ $facture->tipo_documento }}</td>
            <td> <a  target="_blank" href="{{ url('dash/reports/pdf/'.$facture->id) }}" class="btn btn-success">Descargar</a></td>
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
        $('#listfactures').DataTable({
            //"scrollX": true,
        });
    });
</script>

@stop