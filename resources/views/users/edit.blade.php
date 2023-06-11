@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

@include('dash.message')

    <form action="{{ url('dash/users/'.$datauser['id']) }}" method="post">
        @csrf
        {{ method_field('PATCH') }}
        @include('users.form')
        
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop