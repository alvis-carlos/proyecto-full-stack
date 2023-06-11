@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Actualizar Inventario</h1>
@stop

@section('content')

@include('dash.message')

    <form action="{{ url('dash/inventario/'.$listInventory['id']) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('inventory.form')
        
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
