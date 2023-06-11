@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear usuario</h1>
@stop

@section('content')

@include('dash.message')

    <form action="{{ url('dash/users') }}" method="post">
        @csrf

        @include('users.form')
        
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop