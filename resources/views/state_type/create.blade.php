@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear tipo de estado</h1>
@stop

@section('content')

@include('dash.message')

    <form action="{{ url('dash/TipoEstado') }}" method="post" enctype='multipart/form-data'>
        @csrf

        @include('state_type.form')
        
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop