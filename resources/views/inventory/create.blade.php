@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asociar Inventario a un producto</h1>
@stop

@section('content')

@include('dash.message')

    <form action="{{ url('dash/inventario') }}" method="post" enctype='multipart/form-data'>
        @csrf

        @include('inventory.form')
        
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop