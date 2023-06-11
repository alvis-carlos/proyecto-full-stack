@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear Categoria</h1>
@stop


@section('content')

@include('dash.message')

<form action="{{ url('dash/categorias') }}"  method="post">
    @csrf
    @include('categories.form')
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
   
@stop
