@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Actualizar Estado</h1>
@stop

@section('content')

@include('dash.message')

    <form action="{{ url('dash/estados/'.$listEstato['id_estados']) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('state.form')
        
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop