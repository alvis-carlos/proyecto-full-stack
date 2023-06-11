@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear estado</h1>
@stop

@section('content')

@include('dash.message')

    <form action="{{ url('dash/estados') }}" method="post" enctype='multipart/form-data'>
        @csrf

        @include('state.form')
        
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop