@extends('home.index')

@section('sections')
<br>
<h2 class='text-center'>{{ Auth::user()->name }}</h2>
<div class="container-xl">

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

<form action="{{ url('home/profile') }}" method="post">
    @csrf
    @include('home.profiles.form')
</form>
 
</div>
@endsection