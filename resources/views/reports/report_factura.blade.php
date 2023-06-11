@extends('adminlte::page')

@section('title', 'Reporte de Facturas')

@section('content_header')
    <h1>Reporte de facturas pagadas</h1>
@stop

@section('content')

<div class="container-xl">

@include('dash.message')
    <form action="{{ url('dash/reports/Create_factures') }}" method='post'>

        @csrf

        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Fecha desde:</label>
            <div class="col-sm-10">
                <input name='start_date' type="date" class="form-control-plaintext border border-primary rounded">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Fecha hasta:</label>
            <div class="col-sm-10">
                <input name='final_date' type="date" class="form-control-plaintext border border-primary rounded" id="staticEmail">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Formato</label>
            <div class="col-sm-10">
                <select name='type' class="form-control-plaintext border border-primary rounded" name="" id="">
                    <option value="">Seleccione...</option>
                    <option value="pdf">PDF</option>
                    <option value="excel">EXCEL</option>
                    <option value="csv">CSV</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success mb-3">Exportar</button>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop