@extends('adminlte::page')

@section('title', 'editar categorias')

@section('content_header')
    <h1>Editar Categoria</h1>
@stop

@section('content')

@include('dash.message')

<form action="{{ url('/dash/categorias/'.$categories['id_categorias']) }}" method="post">
    @csrf
    {{ method_field('PATCH') }}
    @include('categories.form')
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
