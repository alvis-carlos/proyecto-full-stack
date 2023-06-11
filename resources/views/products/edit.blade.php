@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Actualizar producto</h1>
@stop

@section('content')

@include('dash.message')

    <form action="{{ url('dash/productos/'.$productos['id_productos']) }}" method="post" enctype='multipart/form-data'>
        @csrf
        {{ method_field('PATCH') }}
        @include('products.form')
        
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop