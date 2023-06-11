@extends('home.index')

@section('sections')

<div class="container-xl">

<br>

<h2 class='text-center'>Editar perfil</h2>

@if( Session::has('mensaje') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())

    @foreach($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $error }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforeach

@endif

<form action="{{ url('/home/profile/0') }}" method="post">
    @csrf
    {{ method_field('PATCH') }}
    @include('home.profiles.form')
</form>

</div>

@endsection