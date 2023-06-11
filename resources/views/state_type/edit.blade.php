@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Actualizar tipo estado</h1>
@stop

@section('content')

@include('dash.message')

    <form action="{{ url('dash/TipoEstado/'.$tipoestado['id_tipo_estado']) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('state_type.form')
        
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop